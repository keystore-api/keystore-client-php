<?php

namespace keystore\http;

use keystore\contracts\OrderDetailInterface;

/**
 * @inheritDoc
 *
 * Class OrderDetailResponse
 * @package keystore\http
 */
class OrderDetailResponse extends AbstractHttpResponse implements OrderDetailInterface
{
    /**
     * @var string
     */
    protected $link;

    /**
     * @inheritDoc
     */
    public function getLink()
    {
        return $this->link;
    }
}
