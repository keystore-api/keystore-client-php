<?php

namespace keystore\http;

use keystore\contracts\CategoryListInterface;
use keystore\entities\AttributeItem;

/**
 * @inheritDoc
 *
 * Class AttributeListResponse
 * @package keystore\http
 */
class AttributeListResponse extends AbstractHttpPaginationResponse implements CategoryListInterface
{
    /**
     * @var AttributeItem[]
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
            return AttributeItem::fromArray($item);
        }, $data);
    }
}
