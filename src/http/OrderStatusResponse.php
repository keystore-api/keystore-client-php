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

    /**
     * @return bool
     */
    public function isUnpaid()
    {
        return $this->status === OrderStatusInterface::STATUS_UNPAID;
    }

    /**
     * @return bool
     */
    public function isInProcess()
    {
        return $this->status === OrderStatusInterface::STATUS_IN_PROCESS;
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        return $this->status === OrderStatusInterface::STATUS_COMPLETED;
    }

    /**
     * @return bool
     */
    public function isCanceled()
    {
        return $this->status === OrderStatusInterface::STATUS_CANCELED;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return $this->status === OrderStatusInterface::STATUS_ERROR;
    }

    /**
     * @return bool
     */
    public function isRefund()
    {
        return $this->status === OrderStatusInterface::STATUS_REFUND;
    }


}
