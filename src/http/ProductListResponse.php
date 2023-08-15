<?php

namespace keystore\http;

use keystore\contracts\ProductListInterface;
use keystore\contracts\ProductTopListInterface;
use keystore\entities\ProductItem;

/**
 * @inheritDoc
 *
 * Class ProductListResponse
 * @package keystore\http
 */
class ProductListResponse extends AbstractHttpPaginationResponse implements ProductListInterface, ProductTopListInterface
{
    /**
     * @var ProductItem[]
     */
    protected $items;

    /**
     * @inheritDoc
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $data
     * @return void
     */
    protected function setItems(array $data)
    {
        $this->items = array_map(static function (array $item) {
            return ProductItem::fromArray($item);
        }, $data);
    }
}
