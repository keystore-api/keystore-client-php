<?php

namespace keystore\http;

use keystore\contracts\OrderCreatedInterface;

/**
 * @inheritDoc
 *
 * Class OrderCreatedResponse
 * @package keystore\http
 */
class OrderCreatedResponse extends AbstractHttpResponse implements OrderCreatedInterface
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @var string|null
     */
    protected $link;

    /**
     * @var int
     */
    protected $id;

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function isOk()
    {
        return $this->status === self::STATUS_OK;
    }
}
