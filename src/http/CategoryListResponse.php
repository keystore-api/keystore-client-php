<?php

namespace keystore\http;

use keystore\contracts\CategoryListInterface;
use keystore\entities\CategoryItem;

/**
 * @inheritDoc
 *
 * Class CategoryListResponse
 * @package keystore\http
 */
class CategoryListResponse extends AbstractHttpPaginationResponse implements CategoryListInterface
{
    /**
     * @var CategoryItem[]
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
            return CategoryItem::fromArray($item);
        }, $data);
    }
}
