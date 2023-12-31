<?php

namespace keystore\commands;

use keystore\helpers\Assert;

/**
 * Параметры пагинации
 *
 * Class PaginationParams
 * @package keystore\commands
 */
class PaginationParams extends AbstractRequestParams
{
    /**
     * @var int|null
     */
    private $perPage;

    /**
     * @var int|null
     */
    private $page;

    /**
     * @param int|null $perPage
     * @return PaginationParams
     */
    public function setPerPage($perPage)
    {
        if ($perPage !== null) {
            self::validatePerPage($perPage);
        }
        $this->perPage = $perPage;

        return $this;
    }

    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        if ($this->perPage !== null  || $this->page !== null) {
            return array_merge(parent::toArray(), [
                'per-page' => $this->perPage,
                'page' => $this->page,
            ]);
        }

        return parent::toArray();
    }

    /**
     * Валидация пагинации
     *
     * @param $perPage
     * @return void
     */
    private static function validatePerPage($perPage)
    {
        Assert::integer("Per Page", $perPage);
        Assert::range("Per Page", $perPage, 1, 1000);
    }
}