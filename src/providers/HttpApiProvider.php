<?php

namespace keystore\providers;


use keystore\commands\GroupSearchParams;
use keystore\commands\OrderCreateParams;
use keystore\commands\PaginationParams;
use keystore\commands\ProductSearchParams;
use keystore\contracts\ApiProviderInterface;
use keystore\contracts\AuthCredentialsInterface;
use keystore\contracts\HttpClientInterface;
use keystore\exceptions\AbstractKeystoreException;
use keystore\helpers\Assert;
use keystore\helpers\AwaitOrderCreate;
use keystore\http\AttributeListResponse;
use keystore\http\CategoryListResponse;
use keystore\http\GroupListResponse;
use keystore\http\HttpResponseFactory;
use keystore\http\OrderCreatedResponse;
use keystore\http\OrderDetailResponse;
use keystore\http\OrderStatusResponse;
use keystore\http\ProductDetailResponse;
use keystore\http\ProductListResponse;
use keystore\http\UserBalanceResponse;

/**
 * HTTP поставщик данных
 *
 * Class HttpApiProvider
 * @package keystore\providers
 */
class HttpApiProvider implements ApiProviderInterface
{
    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @param HttpClientInterface $client
     * @param AuthCredentialsInterface $credentials
     */
    public function __construct(
        HttpClientInterface      $client,
        AuthCredentialsInterface $credentials
    )
    {
        $client->setAuth($credentials);
        $this->client = $client;
    }

    /**
     * @inheritDoc
     * @throws AbstractKeystoreException
     */
    public function categoryList(PaginationParams $params = null)
    {
        $url = '/api/v1/category/list';
        $data = $this->client->sendGet($url, $params);

        return HttpResponseFactory::fromArray(static function (array $data) {
            return CategoryListResponse::fromArray($data);
        }, $data);
    }

    /**
     * @inheritDoc
     * @throws AbstractKeystoreException
     */
    public function attributeList(PaginationParams $params = null)
    {
        $url = '/api/v1/attribute/list';
        $data = $this->client->sendGet($url, $params);

        return HttpResponseFactory::fromArray(static function (array $data) {
            return AttributeListResponse::fromArray($data);
        }, $data);
    }

    /**
     * @inheritDoc
     * @throws AbstractKeystoreException
     */
    public function groupList(GroupSearchParams $params = null)
    {
        $url = '/api/v1/group/list';
        $data = $this->client->sendGet($url, $params);

        return HttpResponseFactory::fromArray(static function (array $data) {
            return GroupListResponse::fromArray($data);
        }, $data);
    }

    /**
     * @inheritDoc
     * @throws AbstractKeystoreException
     */
    public function productList(ProductSearchParams $params = null)
    {
        $url = '/api/v1/product/list';
        $data = $this->client->sendPost($url, $params);

        return HttpResponseFactory::fromArray(static function (array $data) {
            return ProductListResponse::fromArray($data);
        }, $data);
    }

    /**
     * @inheritDoc
     */
    public function productView($id)
    {
        Assert::integer("ID", $id);
        $url = '/api/v1/product/view';
        $data = $this->client->sendGet($url,[
            'id' => $id,
        ]);

        return HttpResponseFactory::fromArray(static function (array $data) {
            return ProductDetailResponse::fromArray($data);
        }, $data);
    }

    /**
     * @inheritDoc
     * @throws AbstractKeystoreException
     */
    public function productTopList(PaginationParams $params = null)
    {
        $url = '/api/v1/product/top';
        $data = $this->client->sendGet($url, $params);

        return HttpResponseFactory::fromArray(static function (array $data) {
            return ProductListResponse::fromArray($data);
        }, $data);
    }

    /**
     * @inheritDoc
     * @throws AbstractKeystoreException
     */
    public function userBalance()
    {
        $url = '/api/v1/user/balance';
        $data = $this->client->sendGet($url);

        return HttpResponseFactory::fromArray(static function (array $data) {
            return UserBalanceResponse::fromArray($data);
        }, $data);
    }

    /**
     * @inheritDoc
     * @throws AbstractKeystoreException
     */
    public function orderCreate(OrderCreateParams $params)
    {
        $url = '/api/v1/order/create';
        $data = $this->client->sendGet($url, $params);

        return HttpResponseFactory::fromArray(static function (array $data) {
            return OrderCreatedResponse::fromArray($data);
        }, $data);
    }

    /**
     * @inheritDoc
     */
    public function orderStatus($id)
    {
        Assert::integer("ID", $id);
        $url = '/api/v1/order/status';
        $data = $this->client->sendGet($url, [
            'id' => $id,
        ]);

        return HttpResponseFactory::fromArray(static function (array $data) {
            return OrderStatusResponse::fromArray($data);
        }, $data);
    }

    /**
     * @inheritDoc
     */
    public function orderDownload($id)
    {
        Assert::integer("ID", $id);
        $url = '/api/v1/order/download';
        $data = $this->client->sendGet($url, [
            'id' => $id,
        ]);

        return HttpResponseFactory::fromArray(static function (array $data) {
            return OrderDetailResponse::fromArray($data);
        }, $data);
    }

    /**
     * @inheritDoc
     * @throws AbstractKeystoreException
     */
    public function awaitOrderCreate(OrderCreateParams $params)
    {
        return (new AwaitOrderCreate($this))->createByParams($params);
    }
}
