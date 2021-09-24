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
     * Function telegram_simple_message - Hàm gửi tin nhắn qua Telegram với 1 đoạn text đơn giản
     *
     * @param array  $config  Mảng dữ liệu chứa cấu hình config tới Telegram
     * @param string $chat_id ID của nhóm chat hoặc người đã start chat với BOT
     * @param string $message Nội dung thông điệp được gửi đi
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 58:50
     */
    function telegram_simple_message(array $config = array(), string $chat_id = '', string $message = ''): bool
    {
        $telegram = new nguyenanhung\TelegramMessenger\TelegramMessenger();
        $telegram->setSdkConfig($config)->setChatId($chat_id)->setMessage($message);

        return $telegram->sendMessage();
    }
}
