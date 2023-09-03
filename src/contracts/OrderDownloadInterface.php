<?php

namespace keystore\contracts;

/**
 * Скачивание заказа
 *
 * Class OrderDownloadInterface
 * @package keystore\contract
 */
interface OrderDownloadInterface
{
    /**
     * @return string|null
     */
    public function getLink();
}
