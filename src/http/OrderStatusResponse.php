<?php

namespace keystore\http;

use keystore\contracts\OrderStatusInterface;

/**
 * @inheritDoc
 *
 * Class OrderStatusResponse
 * @package keystore\http
 */
class OrderStatusResponse extends AbstractHttpResponse implements OrderStatusInterface
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function isUnpaid(): bool
    {
        return $this->status === OrderStatusInterface::STATUS_UNPAID;
    }

    public function isInProcess(): bool
    {
        return $this->status === OrderStatusInterface::STATUS_IN_PROCESS;
    }

    public function isCompleted(): bool
    {
        return $this->status === OrderStatusInterface::STATUS_COMPLETED;
    }

    public function isCanceled(): bool
    {
        return $this->status === OrderStatusInterface::STATUS_CANCELED;
    }

    public function isError(): bool
    {
        return $this->status === OrderStatusInterface::STATUS_ERROR;
    }

    public function isRefund(): bool
    {
        return $this->status === OrderStatusInterface::STATUS_REFUND;
    }


}
