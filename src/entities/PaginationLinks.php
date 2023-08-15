<?php

namespace keystore\entities;


/**
 * Ссылки пагинации
 *
 * Class PaginationLinks
 * @package keystore\entities
 */
class PaginationLinks extends AbstractObject
{
    /**
     * @var string|null
     */
    protected $self;

    /**
     * @var string|null
     */
    protected $first;

    /**
     * @var string|null
     */
    protected $last;

    /**
     * @var string|null
     */
    protected $next;

    /**
     * @return string|null
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * @return string|null
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * @return string|null
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * @return string|null
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param array $data
     */
    protected function setSelf($data)
    {
        $this->self = $data['href'] ?: null;
    }

    /**
     * @param array $data
     */
    public function setFirst($data)
    {
        $this->first = $data['href'] ?: null;
    }

    /**
     * @param array $data
     */
    public function setLast($data)
    {
        $this->last = $data['href'] ?: null;
    }

    /**
     * @param array $data
     */
    public function setNext($data)
    {
        $this->next = $data['href'] ?: null;
    }
}
