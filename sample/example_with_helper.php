<?php
/**
 * Project telegram-messenger
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/5/19
 * Time: 11:31
 */
require_once __DIR__ . '/../vendor/autoload.php';

// Khai báo biến chứa data config
// Đường dẫn tới file cấu hình, hoặc có thể config 1 array và gán cho biến config
$config = include __DIR__ . '/sample_config.php';

// Khai báo Chat_ID
$chat_id = $config['telegram_messages']['default_chat_id'];

// Khai báo nội dung cần gửi đi
$message = 'Test gửi tin';

// Gửi tin tới người nhận
// Result == TRUE nếu gửi tin thành công
// ngược lại là thất bại
$result = telegram_simple_message($config, $chat_id, $message);

echo "<pre>";
print_r($result);
echo "</pre>";
