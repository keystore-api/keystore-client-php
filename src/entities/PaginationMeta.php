<?php

namespace keystore\entities;

/**
 * Мета-данные пагинации
 *
 * Class PaginationMeta
 * @package keystore\entities
 */
class PaginationMeta extends AbstractObject
{
    /**
     * @var int
     */
    protected $totalCount;

    /**
     * @var int
     */
    protected $pageCount;

    /**
     * @var int
     */
    protected $currentPage;

    /**
     * @var int
     */
    protected $perPage;

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }

    /**
     * @return int
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }
}
