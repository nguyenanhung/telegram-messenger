<?php
/**
 * Project telegram-messenger
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/5/19
 * Time: 11:08
 */

if (!function_exists('telegram_simple_message')) {
    /**
     * Function telegram_simple_message
     *
     * @param array  $config
     * @param string $chat_id
     * @param string $message
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 9/5/19 12:08
     */
    function telegram_simple_message($config = array(), $chat_id = '', $message = '')
    {
        $telegram = new nguyenanhung\TelegramMessenger\TelegramMessenger();
        $telegram->setSdkConfig($config)->setChatId($chat_id)->setMessage($message);
        $result = $telegram->sendMessage();
        return $result;
    }
}
