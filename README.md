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

// Установка базового адреса
HttpGuzzleClient::$baseUrl = 'https://base.url';
// Создание объекта аутентификации
$auth = new AuthApiKey($key);
// Создание HTTP клиента
$client = new HttpGuzzleClient();
// Создание HTTP провайдера данных
$provider = new HttpApiProvider($httpClient, $auth);
// Создание сервиса
$service = new KeystoreClient($provider);
```

#### Сокращенный вариант

```php
$key = '<secret>';

// Создание сервиса
$service = KeystoreClientFactory::create($key);
```

### Список категорий

```php
...

$service = KeystoreClientFactory::create($key);
$result = $service->categoryList();
```

### Список групп

```php
...

$service = KeystoreClientFactory::create($key);
$result = $service->groupList();
```

#### С использованием параметров поиска

```php
...

$params = new GroupSearchParams();
$params
    ->setCategoryId(1)
    ->setPerPage(100);

$service = KeystoreClientFactory::create($key);
$result = $service->groupList($params);
```

### Список товаров

```php
...

$service = KeystoreClientFactory::create($key);
$result = $service->productList();
```

#### С использованием параметров поиска

```php
...

$params = new ProductSearchParams();
$params
    ->setCategoryId(1)
    ->setName("Name")
    ->setPerPage(100);

$service = KeystoreClientFactory::create($key);
$result = $service->productList($params);
```

### Просмотр товара

```php
...

$service = KeystoreClientFactory::create($key);
$result = $service->productView(1);
```

### Топ-100 товаров

```php
...

$service = KeystoreClientFactory::create($key);
$result = $service->productTopList();
```

### Просмотр баланса

```php
...

$service = KeystoreClientFactory::create($key);
$result = $service->userBalance();
```

### Создание заказа

```php
...

$params = new OrderCreateParams(1, 5);

$service = KeystoreClientFactory::create($key);
$result = $service->orderCreate($params);
```

### Просмотр заказа

```php
...

$service = KeystoreClientFactory::create($key);
$result = $service->orderDownload(1);
```

Данные ответа
-----

| Модель           | Экземпляр класса       | 
|------------------|------------------------|
| Список категорий | CategoryListInterface  |
| Список групп     | GroupListInterface     |
| Список товаров   | ProductListInterface   |
| Просмотр товара  | ProductDetailInterface |
| Топ-100 товаров  | ProductListInterface   |
| Просмотр баланса | UserBalanceInterface   |
| Создание заказа  | OrderCreatedInterface  |
| Просмотр заказа  | OrderDetailInterface   |

Обработка ошибок
-----

### Исключения

| Модель                     | Экземпляр класса           | 
|----------------------------|----------------------------|
| Интерфейс всех исключений  | KeystoreExceptionInterface |
| Ошибка передаваемых данных | InvalidDataException       |
| Ошибка авторизации         | UnauthorizedException      |
| Ошибка запроса             | BadRequestException        |

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