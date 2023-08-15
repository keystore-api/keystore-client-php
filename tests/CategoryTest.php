<?php


use keystore\AuthApiKey;
use keystore\contracts\CategoryListInterface;
use keystore\contracts\HttpClientInterface;
use keystore\entities\PaginationLinks;
use keystore\entities\PaginationMeta;
use keystore\KeystoreClientFactory;
use PHPUnit\Framework\TestCase;

/**
 * Категории
 *
 * Class CategoryTest
 */
class CategoryTest extends TestCase
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
                        "id": 1,
                        "name": "Steam",
                        "icon": "http://mock/media/no-miniature.png"
                    },
                    {
                        "id": 2,
                        "name": "Myself",
                        "icon": "http://mock/media/no-miniature.png"
                    },
                    {
                        "id": 3,
                        "name": "Origin",
                        "icon": "http://mock/media/no-miniature.png"
                    },
                    {
                        "id": 4,
                        "name": "EA",
                        "icon": "http://mock/media/no-miniature.png"
                    },
                    {
                        "id": 5,
                        "name": "Steam",
                        "icon": "http://mock/media/no-miniature.png"
                    },
                    {
                        "id": 6,
                        "name": "Myself",
                        "icon": "http://mock/media/no-miniature.png"
                    },
                    {
                        "id": 7,
                        "name": "Origin",
                        "icon": "http://mock/media/no-miniature.png"
                    },
                    {
                        "id": 8,
                        "name": "EA",
                        "icon": "http://mock/media/no-miniature.png"
                    },
                    {
                        "id": 9,
                        "name": "Steam",
                        "icon": "http://mock/media/no-miniature.png"
                    },
                    {
                        "id": 10,
                        "name": "Myself",
                        "icon": "http://mock/media/no-miniature.png"
                    },
                    {
                        "id": 11,
                        "name": "Origin",
                        "icon": "http://mock/media/no-miniature.png"
                    },
                    {
                        "id": 12,
                        "name": "EA",
                        "icon": "http://mock/media/no-miniature.png"
                    }
                ],
                "_links": {
                    "self": {
                        "href": "http://mock/api/v1/category/list?key=3acdfabf09716baedc133cb60488ed207e7ee730&page=1"
                    },
                    "first": {
                        "href": "http://mock/api/v1/category/list?key=3acdfabf09716baedc133cb60488ed207e7ee730&page=1"
                    },
                    "last": {
                        "href": "http://mock/api/v1/category/list?key=3acdfabf09716baedc133cb60488ed207e7ee730&page=1"
                    }
                },
                "_meta": {
                    "totalCount": 12,
                    "pageCount": 1,
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
        $result = $service->categoryList();

        $links = $result->getLinks();
        $meta = $result->getMeta();

        $this->assertInstanceOf(CategoryListInterface::class, $result);
        $this->assertCount(12, $result->getItems());
        $this->assertInstanceOf(PaginationLinks::class, $links);
        $this->assertInstanceOf(PaginationMeta::class, $meta);
        $this->assertEquals(12, $meta->getTotalCount());
        $this->assertEquals("Steam", $result->getItems()[0]->getName());
        $this->assertEquals(1, $result->getItems()[0]->getId());
    }
}
