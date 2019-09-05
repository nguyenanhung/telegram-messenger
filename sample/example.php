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
$config   = include __DIR__ . '/samle_config.php';

// Get Version
d($telegram->getVersion());

// Config
$telegram->setSdkConfig($config);
d($telegram->getSdkConfig());

// Send Simple Message
$telegram->setChatId('xxx')->setMessage('Test via PHP');
d($telegram->sendMessage());
