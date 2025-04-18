<?php


use keystore\AuthApiKey;
use keystore\contracts\GroupListInterface;
use keystore\contracts\HttpClientInterface;
use keystore\entities\PaginationLinks;
use keystore\entities\PaginationMeta;
use keystore\KeystoreClientFactory;
use PHPUnit\Framework\TestCase;

/**
 * Группы
 *
 * Class GroupTest
 */
class GroupTest extends TestCase
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
                        "id": 26,
                        "category_id": 12,
                        "name": "Assumenda"
                    }
                ],
                "_links": {
                    "self": {
                        "href": "http://mock/api/v1/group/list?key=3acdfabf09716baedc133cb60488ed207e7ee730&per-page=1&page=1"
                    },
                    "first": {
                        "href": "http://mock/api/v1/group/list?key=3acdfabf09716baedc133cb60488ed207e7ee730&per-page=1&page=1"
                    },
                    "last": {
                        "href": "http://mock/api/v1/group/list?key=3acdfabf09716baedc133cb60488ed207e7ee730&per-page=1&page=26"
                    },
                    "next": {
                        "href": "http://mock/api/v1/group/list?key=3acdfabf09716baedc133cb60488ed207e7ee730&per-page=1&page=2"
                    }
                },
                "_meta": {
                    "totalCount": 26,
                    "pageCount": 26,
                    "currentPage": 1,
                    "perPage": 1
                }
            }
        }';
        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendGet')
            ->willReturn(json_decode($json, true));

        $service = KeystoreClientFactory::http($mockClient, new AuthApiKey(""));
        $result = $service->groupList();

        $links = $result->getLinks();
        $meta = $result->getMeta();

        $this->assertInstanceOf(GroupListInterface::class, $result);
        $this->assertCount(1, $result->getItems());
        $this->assertInstanceOf(PaginationLinks::class, $links);
        $this->assertInstanceOf(PaginationMeta::class, $meta);
        $this->assertEquals(26, $meta->getTotalCount());
        $this->assertEquals("Assumenda", $result->getItems()[0]->getName());
        $this->assertEquals(26, $result->getItems()[0]->getId());
        $this->assertEquals(12, $result->getItems()[0]->getCategoryId());
    }
}
