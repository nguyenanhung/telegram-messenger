<?php
/**
 * Project telegram-messenger
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 06/04/2021
 * Time: 10:33
 */

namespace nguyenanhung\TelegramMessenger;

/**
 * Class Helper
 *
 * @package   nguyenanhung\TelegramMessenger
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Helper
{
    /**
     * Function sendRequest - Hàm request tới Endpoint sử dụng phương thức POST, thư viện cURL với TLS v1.2
     *
     * @param string $url URL Endpoint cần gọi
     * @param array $params Data Params cần truyền dữ liệu
     * @param int $timeout Thời gian chờ phản hồi dữ liệu tối đa
     *
     * @return bool|string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 00:35
     */
    public static function sendRequest($url = '', $params = array(), $timeout = 30)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $params
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    /**
     * Function writeLn
     *
     * @param        $message
     * @param string $newLine
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/02/2021 42:50
     */
    public static function writeLn($message, $newLine = "\n")
    {
        if (function_exists('json_encode') && (is_array($message) || is_object($message))) {
            $message = json_encode($message);
        }
        echo $message . $newLine;
    }

    /**
     * Is CLI?
     *
     * Test to see if a request was made from the command line.
     *
     * @return    bool
     */
    public static function isCLI()
    {
        return (PHP_SAPI === 'cli' or defined('STDIN'));
    }

    public static function telegramEscapeMessage($message, $parse_mode = 'Markdown')
    {
        if ($parse_mode === 'Markdown' || $parse_mode === 'MarkdownV2') {
            // Escape all special characters in Markdown
            $message = self::markdown_escape_message($message);
        } elseif ($parse_mode === 'HTML') {
            // Escape special characters in HTML using htmlspecialchars
            $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        }
        return $message;
    }

    public static function markdown_escape_message($message)
    {
        // Escape các ký tự đặc biệt trong Markdown của Telegram
        $escape_chars_general = array(
            '[' => '\\[', // Open square bracket
            ']' => '\\]', // Close square bracket
            '(' => '\\(', // Open parenthesis
            ')' => '\\)', // Close parenthesis
            '~' => '\\~', // Tilde
            '`' => '\\`', // Backtick
            '>' => '\\>', // Greater than
            '#' => '\\#', // Hash
            '+' => '\\+', // Plus
            '-' => '\\-', // Minus
            '=' => '\\=', // Equal
            '|' => '\\|', // Pipe
            '{' => '\\{', // Open curly brace
            '}' => '\\}', // Close curly brace
            '.' => '\\.', // Dot
            '!' => '\\!',  // Exclamation mark
        );

        $message = preg_replace_callback(
            '/(```(.*?)```|`(.*?)`)/s',
            array('self', 'escape_code_block'),
            $message
        );

        $message = preg_replace_callback(
            '/\[(.*?)\]\((.*?)\)/',
            array('self', 'escape_inline_links'),
            $message
        );

        // Escape các ký tự đặc biệt chung cho tất cả các trường hợp còn lại
        return str_replace(array_keys($escape_chars_general), array_values($escape_chars_general), $message);
    }

    public static function escape_code_block($matches)
    {
        return str_replace(['`', '\\'], ['\\`', '\\\\'], $matches[0]);
    }

    public static function escape_inline_links($matches)
    {
        $escaped_url = str_replace([')', '\\'], ['\\)', '\\\\'], $matches[2]);
        return '[' . $matches[1] . '](' . $escaped_url . ')';
    }
}
