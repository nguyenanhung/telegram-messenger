<?php
/**
 * Project telegram-messenger
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/5/19
 * Time: 11:08
 */

use nguyenanhung\TelegramMessenger\Helper;

if (!function_exists('telegram_msg_escape_special_characters')) {
    function telegram_msg_escape_special_characters($message, $parse_mode = 'Markdown')
    {
        return Helper::telegramEscapeMessage($message, $parse_mode);
    }
}
if (!function_exists('telegram_simple_message')) {
    /**
     * Function telegram_simple_message - Hàm gửi tin nhắn qua Telegram với 1 đoạn text đơn giản
     *
     * @param array $config Mảng dữ liệu chứa cấu hình config tới Telegram
     * @param string $chat_id ID của nhóm chat hoặc người đã start chat với BOT
     * @param string $message Nội dung thông điệp được gửi đi
     * @param bool $markdown Gửi tin sử dụng Markdown
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 58:50
     */
    function telegram_simple_message($config = array(), $chat_id = '', $message = '', $markdown = false)
    {
        $telegram = new nguyenanhung\TelegramMessenger\TelegramMessenger();
        $telegram->setSdkConfig($config)->setChatId($chat_id)->setMessage($message);
        if ($markdown === true) {
            $telegram->parseModeMarkdown();
        }
        return $telegram->sendMessage();
    }
}
if (!function_exists('telegram_console_deploy_message')) {
    function telegram_console_deploy_message($token, $chat_id, $project, $stages, $url = '')
    {
        if (Helper::isCLI()) {
            $project = trim($project);
            $stages = ucfirst(trim($stages));
            if (empty($url) && function_exists('base_url')) {
                $url = base_url();
            }
            $config = array(
                'telegram_messages' => array(
                    'bot_name' => $project . ' - ' . $stages,
                    'bot_api_key' => $token,
                    'default_chat_id' => $chat_id,
                )
            );
            $message = $stages . ' *' . $project . '* is *SUCCESS*' . PHP_EOL;
            $message .= 'Time: ' . date('Y-m-d H:i:s') . PHP_EOL;
            $message .= 'Server IP: ' . trim(Helper::sendRequest('https://icanhazip.com/')) . PHP_EOL;
            $message .= 'URL: ' . $url . PHP_EOL;
            $result = telegram_simple_message($config, $chat_id, $message, true);
            $status = $result ? 'is Success!' : 'is Failed!';
            Helper::writeLn("Send Message " . $status);
            exit();
        }
    }
}
