# Hướng dẫn cài đặt & sử dụng

Tài liệu được xây dựng nhằm mục đích hướng dẫn sử dụng class Telegram Messenger

### B1: Setup môi trường

Class được xây dựng theo chuẩn Composer PSR-4, vì vậy có thể setup nhanh qua composer với câu lệnh như sau

```shell
composer require nguyenanhung/telegram-messenger
```

```php
<?php
/**
 * Project telegram-messenger
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/5/19
 * Time: 11:00
 */
require_once __DIR__ . '/vendor/autoload.php';
```

@see: https://github.com/nguyenanhung/telegram-messenger/blob/master/sample/example.php

### B2: Config Telegram BOT

Mảng config là 1 array chứa thông tin về tên BOT, API Key, tương tự như sau

```php
<?php
/**
 * Project telegram-messenger
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/5/19
 * Time: 10:52
 */
return array(
    // Telegram Messenger
    'telegram_messages' => array(
        'bot_name'        => 'xxx',
        'bot_api_key'     => 'xxx',
        'default_chat_id' => 1234,
    )
);
```

@see: https://github.com/nguyenanhung/telegram-messenger/blob/master/sample/samle_config.php

### B3: Sử dụng

Để sử dụng, có thể tham khảo qua bài viết https://tungvandev.github.io/2019-08-17/teletegram-ung-dung-trong-theo-doi-service/ để hiểu rõ hơn về luồng hoạt động và cấu trúc gửi tin đi. Phần hướng dẫn ở đây sẽ hướng dẫn trực tiếp cho việc cấu hình code
để có thể gửi tin đi.

#### Gửi tin qua class TelegramMessenger

Mặc định, package cung cấp 1 class cho việc gửi tin đi với 4 method cơ bản như sau

- [x] SendMessage via ChatID
- [x] SendPhoto via ChatID
- [x] SendAudio via ChatID
- [x] SendVideo via ChatID
- [x] SendDocument via ChatID

##### SendMessage via ChatID

Đoạn code để gửi tin đi có thể thực hiện như sau

```php
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
echo "<pre>";
print_r($telegram->getVersion());
echo "</pre>";

// Truyền config vào class Telegram
$telegram->setSdkConfig($config);
echo "<pre>";
print_r($telegram->getSdkConfig());
echo "</pre>";

// Gắn cấu hình Chat_ID và Nội dung cần gửi tin đi
$telegram->setChatId('xxx')
         ->setMessage('Test via PHP');

// Gửi tin tới người nhận
// Result == TRUE nếu gửi tin thành công
// ngược lại là thất bại
$result = $telegram->sendMessage();

echo "<pre>";
print_r($result);
echo "</pre>";

```

@see: https://github.com/nguyenanhung/telegram-messenger/blob/master/sample/example.php

##### SendPhoto via ChatID

Đang cập nhật

##### SendAudio via ChatID

Đang cập nhật

##### SendVideo via ChatID

Đang cập nhật

##### SendDocument via ChatID

Đang cập nhật

#### Gửi tin qua Quick Helper

Hệ thống build thêm các quick helper sau để hỗ trợ gửi tin đi

##### Hàm: telegram_simple_message

Cách sử dụng tham khảo đoạn code dưới

```php
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
$chat_id = -387151297;

// Khai báo nội dung cần gửi đi
$message = 'Test gửi tin';

// Gửi tin tới người nhận
// Result == TRUE nếu gửi tin thành công
// ngược lại là thất bại
$result = telegram_simple_message($config, $chat_id, $message);

echo "<pre>";
print_r($result);
echo "</pre>";
```

@see: https://github.com/nguyenanhung/telegram-messenger/blob/master/sample/example_with_helper.php

## Contact

| STT  | Họ tên         | Email                | Skype            |
| ---- | -------------- | -------------------- | ---------------- |
| 1    | Hung Nguyen    | dev@nguyenanhung.com | nguyenanhung5891 |
