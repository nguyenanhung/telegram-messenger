<?php
/**
 * Project telegram-messenger
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/5/19
 * Time: 10:46
 */

namespace nguyenanhung\TelegramMessenger;
/**
 * Interface TelegramMessengerInterface
 *
 * @package   nguyenanhung\TelegramMessenger
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface TelegramMessengerInterface
{
    const VERSION                       = '1.0.3';
    const TELEGRAM_MESSENGER_CONFIG_KEY = 'telegram_messages';
    const TELEGRAM_API                  = 'https://api.telegram.org/bot';
    const METHOD_GET_UPDATES            = '/getUpdates';
    const METHOD_SEND_MESSAGE           = '/sendMessage';
    const METHOD_SEND_PHOTO             = '/sendPhoto';
    const METHOD_SEND_AUDIO             = '/sendAudio';
    const METHOD_SEND_VIDEO             = '/sendVideo';
    const METHOD_SEND_DOCUMENT          = '/sendDocument';

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Get BOT Updates ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

    /**
     * Function getBotUpdates
     *
     * @return array|mixed
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-08-06 16:50
     *
     */
    public function getBotUpdates();

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ChatID ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

    /**
     * Function setChatId
     *
     * @param string $chatId
     *
     * @return $this|mixed
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-08-04 03:00
     *
     */
    public function setChatId($chatId = NULL);

    /**
     * Function getChatId
     *
     * @return int|mixed|string|null
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-08-04 03:00
     *
     */
    public function getChatId();

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ FileAttachment ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

    /**
     * Function setFileAttachment
     *
     * @param null $fileAttachment
     *
     * @return $this
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-08-04 03:37
     *
     */
    public function setFileAttachment($fileAttachment = NULL);

    /**
     * Function getFileAttachment
     *
     * @return string|null
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-08-04 03:37
     *
     */
    public function getFileAttachment();

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Message ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

    /**
     * Function setMessage
     *
     * @param null $message
     *
     * @return mixed|$this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 9/5/19 55:19
     */
    public function setMessage($message = NULL);

    /**
     * Function getMessage
     *
     * @return string|null
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-08-04 03:00
     *
     */
    public function getMessage();

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Sending Method ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

    /**
     * Function sendMessage
     *
     * @return bool
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-08-04 02:59
     *
     */
    public function sendMessage();

    /**
     * Function sendPhoto
     *
     * @return bool|mixed
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-08-04 03:23
     *
     */
    public function sendPhoto();

    /**
     * Function sendAudio
     *
     * @return bool|mixed
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-08-04 03:30
     *
     */
    public function sendAudio();

    /**
     * Function sendVideo
     *
     * @return bool|mixed
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-08-04 03:33
     *
     */
    public function sendVideo();

    /**
     * Function sendDocument
     *
     * @return bool|mixed
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-08-04 03:35
     *
     */
    public function sendDocument();
}
