Keystore API Client
=======================================================

Установка
------------
Устанавливать рекомендуется через composer выполнив:

    composer require keystore-api/keystore-client-php "~1.0.0"

Использование
-----

### Аутентификация

- Аутентификация осуществляется через API-ключ
- Параметр для этого ключа называется "key"
- API-ключ доступен в разделе "Настройки" аккаунта

### Начало работы

#### Полный вариант

```php
$key = '<secret>';
$baseUrl = 'https://<domain>';

// Создание объекта аутентификации
$auth = new AuthApiKey($key);
// Создание HTTP клиента
$client = new HttpGuzzleClient($baseUrl);
// Создание HTTP провайдера данных
$provider = new HttpApiProvider($httpClient, $auth);
// Создание сервиса
$service = new KeystoreClient($provider);
```

#### Сокращенный вариант

```php
$key = '<secret>';
$baseUrl = 'https://<domain>';

// Создание сервиса
$service = KeystoreClientFactory::create($baseUrl, $key);
```

### Список категорий

```php
...

$service = KeystoreClientFactory::create($baseUrl, $key);
$result = $service->categoryList();
```

### Список групп

```php
...

$service = KeystoreClientFactory::create($baseUrl, $key);
$result = $service->groupList();
```

#### С использованием параметров поиска

```php
...

$params = new GroupSearchParams();
$params
    ->setCategoryId(1)
    ->setPerPage(100);

$service = KeystoreClientFactory::create($baseUrl, $key);
$result = $service->groupList($params);
```

### Список товаров

```php
...

$service = KeystoreClientFactory::create($baseUrl, $key);
$result = $service->productList();
```

#### С использованием параметров поиска

⚠️ Для большинства сценариев использования, рекомендуем получать только активные товары, используя
метод `setOnlyInStock(true)`.

```php
...

$params = new ProductSearchParams();
$params
    ->setCategoryId(1)
    ->setOnlyInStock(true) // Только товары в наличие
    ->setPage(2) // Установка страницы (пагинация)
    ->setPerPage(100);

$service = KeystoreClientFactory::create($baseUrl, $key);
$result = $service->productList($params);
```

#### Пример получения всех товаров
```php
...

$service = KeystoreClientFactory::create($baseUrl, $key);
$params = new ProductSearchParams();
$params
    ->setOnlyInStock(true)
    ->setOnlyExclusive(true)
    ->setPerPage(500);

$currentPage = 1;
$allItems = [];

do {
    $params->setPage($currentPage);
    $result = $service->productList($params);
    $meta = $result->getMeta();

    // Добавляем продукты с текущей страницы в общий список
    $allItems = array_merge($allItems, $result->getItems());
    $currentPage++;

    // Если это не последний запрос, добавляем задержку в 0.5 секунды перед следующим запросом
    if ($currentPage <= $meta->getPageCount()) {
        usleep(500000);
    }
} while ($currentPage <= $meta->getPageCount());
```

### Просмотр товара

```php
...

$service = KeystoreClientFactory::create($baseUrl, $key);
$result = $service->productView(1);
```

### Топ-100 товаров

```php
...

$service = KeystoreClientFactory::create($baseUrl, $key);
$result = $service->productTopList();
```

### Просмотр баланса

```php
...

$service = KeystoreClientFactory::create($baseUrl, $key);
$result = $service->userBalance();
```

### Создание заказа

```php
...

$params = new OrderCreateParams(1, 5);

$service = KeystoreClientFactory::create($baseUrl, $key);
$result = $service->orderCreate($params);
```

### Просмотр заказа

```php
...

$service = KeystoreClientFactory::create($baseUrl, $key);
$result = $service->orderDownload(1);
```

### Создание и получение информации по заказу

```php
...

$params = new OrderCreateParams(1, 5);

// Создание заказа и получение информации о нем
// В ответ возвращается один из объектов:
// OrderCreatedInterface - если заказ создан, но не обработан (имеет статус PENDING)
// OrderDetailInterface - если заказ создан и обработан (имеет статус OK)
$service = KeystoreClientFactory::create($baseUrl, $key);
$result = $service->awaitOrderCreate($params);
```

Данные ответа
-----

| Модель            | Экземпляр класса                              | 
|-------------------|-----------------------------------------------|
| Список категорий  | CategoryListInterface                         |
| Список групп      | GroupListInterface                            |
| Список товаров    | ProductListInterface                          |
| Просмотр товара   | ProductDetailInterface                        |
| Топ-100 товаров   | ProductListInterface                          |
| Просмотр баланса  | UserBalanceInterface                          |
| Создание заказа   | OrderCreatedInterface                         |
| Просмотр заказа   | OrderDetailInterface                          |
| Создание и получение информации по заказу   | OrderDetailInterface OrderCreatedInterface OrderDownloadInterface |

Обработка ошибок
-----

### Исключения

| Модель                    | Экземпляр класса           | 
|---------------------------|----------------------------|
| Интерфейс всех исключений | KeystoreExceptionInterface |
| Ошибка передаваемых данных | InvalidDataException       |
| Ошибка авторизации        | UnauthorizedException      |
| Ошибка запроса            | BadRequestException        |
| Ресурс не найден   | NotFoundException        |

HTTP клиент
-----

### Использование своего HTTP клиента

По умолчанию запросы отправляются через Guzzle. Для подключения своего HTTP клиента:

```php
// Создание своего HTTP клиента
class MyHTTPClient impliments HttpClientInterface
{
    ...
}
$httpClient = new MyHTTPClient();
// Создание сервиса
$service = KeystoreClientFactory::http($httpClient, $auth);
```

### Использование своего провайдера данных

По умолчанию запросы отправляются через HTTP. Для подключения своего провайдера:

```php
// Создание своего провайдера
class MyProvider impliments ApiProviderInterface
{
    ...
}

$provider = new MyProvider();
// Создание сервиса
$service = new KeystoreClient($provider);
```