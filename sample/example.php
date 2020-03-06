<?php
/**
 * Project telegram-messenger
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/5/19
 * Time: 11:00
 */
require_once __DIR__ . '/../vendor/autoload.php';

use nguyenanhung\TelegramMessenger\TelegramMessenger;

$telegram = new TelegramMessenger();

// Khai báo biến chứa data config
// Đường dẫn tới file cấu hình, hoặc có thể config 1 array và gán cho biến config
$config = include __DIR__ . '/sample_config.php';

// Get Version
d($telegram->getVersion());

// Truyền config vào class Telegram
$telegram->setSdkConfig($config);
d($telegram->getSdkConfig());

// Gắn cấu hình Chat_ID và Nội dung cần gửi tin đi
$telegram->setChatId('xxx')
         ->setMessage('Test via PHP');

// Gửi tin tới người nhận
// Result == TRUE nếu gửi tin thành công
// ngược lại là thất bại
$result = $telegram->sendMessage();

d($result);
