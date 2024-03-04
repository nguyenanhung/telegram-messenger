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
		if (\nguyenanhung\TelegramMessenger\Helper::isCLI()) {
			$project = trim($project);
			$stages = strtoupper(trim($stages));
			if (empty($url) && function_exists('base_url')) {
				$url = base_url();
			}
			$message = $project . ' - ' . $stages . ' -> SUCCESS | On time ' . date('Y-m-d H:i:s') . ' | Visit: ' . $url;
			$result = telegram_simple_message($token, $chat_id, 'CI/CD Monitoring - ' . $message);
			$status = $result ? ' is Success!' : ' is Failed!';
			\nguyenanhung\TelegramMessenger\Helper::writeLn("Send Message " . $message . " is " . $status);
			exit();
		}
	}
}
