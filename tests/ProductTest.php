<?php

use keystore\AuthApiKey;
use keystore\contracts\HttpClientInterface;
use keystore\contracts\ProductDetailInterface;
use keystore\contracts\ProductListInterface;
use keystore\contracts\ProductTopListInterface;
use keystore\entities\CategoryItem;
use keystore\entities\GroupItem;
use keystore\entities\PaginationLinks;
use keystore\entities\PaginationMeta;
use keystore\KeystoreClientFactory;
use PHPUnit\Framework\TestCase;

/**
 * Продукты
 *
 * Class ProductTest
 */
class ProductTest extends TestCase
{
    /**
     * @return void
     */
    public function testListSuccess()
    {
        $json = '{
          "success": true,
          "data": {
            "items": [
              {
                "id": 3844,
                "name": "Iure repudiandae sit et numquam",
                "miniature": "http://mock/media/products/42a2650c72ed14bf1b971f14368bde2a.jpg",
                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Metus dictum at tempor commodo. Nisl vel pretium lectus quam id. In hac habitasse platea dictumst. Nec ultrices dui sapien eget mi proin sed libero. Metus vulputate eu scelerisque felis imperdiet proin fermentum leo vel. Lacinia at quis risus sed vulputate odio ut enim blandit. Mi ipsum faucibus vitae aliquet. Eros donec ac odio tempor orci. Nibh nisl condimentum id venenatis a condimentum vitae sapien. Consequat semper viverra nam libero justo laoreet. Pellentesque elit eget gravida cum sociis natoque penatibus et magnis. Justo eget magna fermentum iaculis eu non. Gravida quis blandit turpis cursus. Lobortis elementum nibh tellus molestie nunc non blandit massa enim. Dictum sit amet justo donec enim diam vulputate ut pharetra. Non arcu risus quis varius quam quisque id. Mauris commodo quis imperdiet massa tincidunt nunc.",
                "manual": "",
                "price": 123.9,
                "minimum_order": 2,
                "quantity": 8816,
                "purchase_counter": 55625,
                "view": 0,
                "group": {
                  "id": 52,
                  "category_id": 28,
                  "name": "Id"
                },
                "category": {
                  "id": 28,
                  "name": "Steam",
                  "icon": "http://mock/media/no-miniature.png"
                },
                "url": "http://mock/products/view/quis-et-illum-velit"
              }
            ],
            "_links": {
              "self": {
                "href": "http://mockapi/v1/product/list?key=2ddbf242b63f193b8e810109b6eb1d47939cdf8f&page=1"
              },
              "first": {
                "href": "http://mock/api/v1/product/list?key=2ddbf242b63f193b8e810109b6eb1d47939cdf8f&page=1"
              },
              "last": {
                "href": "http://mock/api/v1/product/list?key=2ddbf242b63f193b8e810109b6eb1d47939cdf8f&page=8"
              },
              "next": {
                "href": "http://mock/api/v1/product/list?key=2ddbf242b63f193b8e810109b6eb1d47939cdf8f&page=2"
              }
            },
            "_meta": {
              "totalCount": 150,
              "pageCount": 8,
              "currentPage": 1,
              "perPage": 20
            }
          }
        }';
        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendData')
            ->willReturn(json_decode($json, true));

        $service = KeystoreClientFactory::http($mockClient, new AuthApiKey(""));
        $result = $service->productList();

        $links = $result->getLinks();
        $meta = $result->getMeta();

        $this->assertInstanceOf(ProductListInterface::class, $result);
        $this->assertCount(1, $result->getItems());
        $this->assertInstanceOf(PaginationLinks::class, $links);
        $this->assertInstanceOf(PaginationMeta::class, $meta);
        $this->assertEquals(150, $meta->getTotalCount());
        $this->assertEquals("Iure repudiandae sit et numquam", $result->getItems()[0]->getName());
        $this->assertEquals(3844, $result->getItems()[0]->getId());
        $this->assertEquals(123.9, $result->getItems()[0]->getPrice());
        $this->assertEquals(8816, $result->getItems()[0]->getQuantity());
        $this->assertEquals(55625, $result->getItems()[0]->getPurchaseCounter());
        $this->assertEquals(0, $result->getItems()[0]->getView());
        $this->assertInstanceOf(GroupItem::class, $result->getItems()[0]->getGroup());
        $this->assertInstanceOf(CategoryItem::class, $result->getItems()[0]->getCategory());
        $this->assertEquals("http://mock/products/view/quis-et-illum-velit", $result->getItems()[0]->getUrl());
    }

    /**
     * @return void
     */
    public function testTopListSuccess()
    {
        $json = '{
            "success": true,
            "data": {
                "items": [
                    {
                        "id": 1,
                        "name": "Ex est omnis et",
                        "miniature": "http://mock/media/no-miniature.png",
                        "description": "Лежавшая на дороге пыль быстро замесилась в грязь, и лошадям ежеминутно становилось тяжелее тащить бричку. Чичиков уже начинал сильно беспокоиться, не видя так долго заниматься Коробочкой? Коробочка ли, Манилова ли, хозяйственная ли жизнь, или нехозяйственная — мимо их! Не то на свете таких лиц, над отделкою которых натура недолго мудрила, не употребляла никаких мелких инструментов, как-то: напильников, буравчиков и прочего, но просто рубила со своего плеча: хватила топором раз — вышел нос, хватила в другой раз приеду, заберу и пеньку. — Так себе, — отвечал шепотом и потупив голову Алкид. — Хорошо, хорошо, — говорил Чичиков. — Право, недорого! Другой — мошенник обманет вас, продаст вам дрянь, а не Заманиловка? — Ну вот видишь, вот уж точно, как будто бы, по русскому выражению, натаскивал клещами на лошадь хомут. — И кобылы не нужно. Ну, скажите сами, — на крыльцо со свечою, которая успела уже притащить перину и, взбивши — ее с обоих боков руками, напустила целый потоп перьев по всей России от одного конца до — другого; прилагательные всех родов без дальнейшего разбора, как что — гнусно рассказывать, и во рту после вчерашнего точно эскадрон — переночевал. Представь: снилось, что меня высекли, ей-ей! и, — вообрази, кто? Вот ни за самого себя не — мечта! А в плечищах у него была лошадь какой-нибудь голубой или розовой шерсти, и тому подобную чепуху, так что он не обращал никакого внимания на то, как бы речь шла о хлебе. — Да, — отвечал Манилов, — все было пригнано плотно и как бы вдруг припомнив: — А! теперь хорошо! прощайте, матушка! Кони тронулись. Селифан был во всю стену, писанные масляными красками, — словом, все те, которых называют господами средней руки. В это время к окну индейский петух — окно же было — пятьдесят. Фенарди четыре часа вертелся мельницею. — Здесь — Ноздрев, подходя к ручке Маниловой. — — продолжал он, обращаясь к Чичикову. — Краденый, ни за самого себя не — стоит. — Ей-богу, продала. — Ну вот уж и нечестно с твоей стороны: слово дал, да и полно. — Экой ты, право, такой! с тобой, как я — тебе дал пятьдесят рублей, тут же провертел пред ними кое-что. Шарманка играла не без удовольствия взглянул на него глаза. — Это вам так показалось: он только топырится или горячится, как говорит народ. (Прим. Н. В. — Гоголя.)]] — Нет, матушка, не обижу, — говорил он, а между тем взглянул искоса на Собакевича, он ему на ярмарке — нужно домой. — Пустяки, пустяки, брат, не пущу. — Право, я боюсь на первых-то порах, чтобы как-нибудь не надул ее этот.",
                        "manual": "",
                        "price": 1410.2,
                        "minimum_order": 1,
                        "quantity": 14880,
                        "purchase_counter": 16,
                        "view": 5,
                        "group": {
                            "id": 10,
                            "category_id": 5,
                            "name": "Quia"
                        },
                        "category": {
                            "id": 5,
                            "name": "Steam",
                            "icon": "http://mock/media/no-miniature.png"
                        },
                        "url": "http://mock/products/view/quis-et-illum-velit"
                    }
                ],
                "_links": {
                    "self": {
                        "href": "http://mock/api/v1/product/top?key=3acdfabf09716baedc133cb60488ed207e7ee730&page=1&per-page=100"
                            },
                            "first": {
                        "href": "http://mock/api/v1/product/top?key=3acdfabf09716baedc133cb60488ed207e7ee730&page=1&per-page=100"
                            },
                            "last": {
                        "href": "http://mock/api/v1/product/top?key=3acdfabf09716baedc133cb60488ed207e7ee730&page=1&per-page=100"
                            }
                 },
                "_meta": {
                    "totalCount": 3,
                    "pageCount": 1,
                    "currentPage": 1,
                    "perPage": 100
               }
            }
        }';
        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendData')
            ->willReturn(json_decode($json, true));

        $service = KeystoreClientFactory::http($mockClient, new AuthApiKey(""));
        $result = $service->productTopList();

        $links = $result->getLinks();
        $meta = $result->getMeta();

        $this->assertInstanceOf(ProductTopListInterface::class, $result);
        $this->assertCount(1, $result->getItems());
        $this->assertInstanceOf(PaginationLinks::class, $links);
        $this->assertInstanceOf(PaginationMeta::class, $meta);
        $this->assertEquals(3, $meta->getTotalCount());
        $this->assertEquals("Ex est omnis et", $result->getItems()[0]->getName());
        $this->assertEquals(1, $result->getItems()[0]->getId());
        $this->assertEquals(1410.2, $result->getItems()[0]->getPrice());
        $this->assertEquals(14880, $result->getItems()[0]->getQuantity());
        $this->assertEquals(16, $result->getItems()[0]->getPurchaseCounter());
        $this->assertEquals(5, $result->getItems()[0]->getView());
        $this->assertInstanceOf(GroupItem::class, $result->getItems()[0]->getGroup());
        $this->assertInstanceOf(CategoryItem::class, $result->getItems()[0]->getCategory());
        $this->assertEquals("http://mock/products/view/quis-et-illum-velit", $result->getItems()[0]->getUrl());
    }

    /**
     * @return void
     */
    public function testViewSuccess()
    {
        $json = '{
          "success": true,
          "data":     {
              "id": 3863,
              "name" : "Lorem Dolor Keys",
              "miniature": "http://mock/media/products/0143f7df0dffef138edbb25d0b8a0482.jpg",
              "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas accumsan sed eros vel malesuada. Proin laoreet aliquet metus, sit amet laoreet diam. Nullam at dignissim enim. Aliquam malesuada auctor urna id scelerisque. Donec posuere libero in varius euismod. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur vel ante lorem. Nulla ac scelerisque felis. Maecenas lacinia non ex vel varius. ",
              "manual": "",
              "price": 533.4,
              "minimum_order": 2,
              "quantity": 19083,
              "purchase_counter": 38487,
              "view": 96512,
              "group": {
                "id": 52,
                "category_id": 28,
                "name": "Keys"
              },
              "category": {
                "id": 28,
                "name": "Steam",
                "icon": "http://mock/media/no-miniature.png"
              },
              "url": "http://mock/products/view/quis-et-illum-velit"
            }
        }';
        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendData')
            ->willReturn(json_decode($json, true));

        $service = KeystoreClientFactory::http($mockClient, new AuthApiKey(""));
        $result = $service->productView(3863);

        $this->assertInstanceOf(ProductDetailInterface::class, $result);
        $this->assertEquals("Lorem Dolor Keys", $result->getName());
        $this->assertEquals(3863, $result->getId());
        $this->assertEquals(533.4, $result->getPrice());
        $this->assertEquals(19083, $result->getQuantity());
        $this->assertEquals(38487, $result->getPurchaseCounter());
        $this->assertEquals(96512, $result->getView());
        $this->assertEquals(2, $result->getMinimumOrder());
        $this->assertInstanceOf(GroupItem::class, $result->getGroup());
        $this->assertInstanceOf(CategoryItem::class, $result->getCategory());
        $this->assertEquals("http://mock/products/view/quis-et-illum-velit", $result->getUrl());
    }
}
