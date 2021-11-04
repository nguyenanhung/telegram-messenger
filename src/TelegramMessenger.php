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
 * Class TelegramMessenger
 *
 * @package   nguyenanhung\TelegramMessenger
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class TelegramMessenger
{
    const _CLASS_NAME_                  = 'TelegramMessenger';
    const VERSION                       = '1.1.1';
    const TELEGRAM_MESSENGER_CONFIG_KEY = 'telegram_messages';
    const TELEGRAM_API                  = 'https://api.telegram.org/bot';
    const METHOD_GET_ME                 = '/getMe';
    const METHOD_GET_UPDATES            = '/getUpdates';
    const METHOD_SEND_MESSAGE           = '/sendMessage';
    const METHOD_SEND_PHOTO             = '/sendPhoto';
    const METHOD_SEND_AUDIO             = '/sendAudio';
    const METHOD_SEND_VIDEO             = '/sendVideo';
    const METHOD_SEND_DOCUMENT          = '/sendDocument';

    /** @var array|null SDK Config */
    protected $sdkConfig;

    /** @var null|string|int ChatID */
    protected $chatId;

    /** @var null|string Text Message */
    protected $message;

    /** @var null|string File Attachment content */
    protected $fileAttachment;

    /**
     * TelegramMessenger constructor.
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function __construct()
    {
    }

    /**
     * Function getVersion
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 03:40
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Function setSdkConfig
     *
     * @param array $sdkConfig
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:47
     */
    public function setSdkConfig($sdkConfig = array())
    {
        $this->sdkConfig = $sdkConfig;

        return $this;
    }

    /**
     * Function getSdkConfig
     *
     * @return array|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:43
     */
    public function getSdkConfig()
    {
        return $this->sdkConfig;
    }

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Bot Updates ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

    /**
     * Function getBotUpdates
     *
     * @return bool[]|mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:38
     */
    public function getBotUpdates()
    {
        $errorResponse = array('error' => true);
        if (!isset($this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY])) {
            return $errorResponse;
        }

        // Cấu hình SDK
        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];

        // Xác định API Key
        if (!isset($sdkConfig['bot_api_key'])) {
            return $errorResponse;
        }

        // Thiết lập Endpoint và Tham số gửi tin đi
        $endpoint    = self::TELEGRAM_API . $sdkConfig['bot_api_key'] . self::METHOD_GET_UPDATES;
        $sendRequest = Helper::sendRequest($endpoint);
        $res         = json_decode(trim($sendRequest));

        // Get Updates thành công
        if (isset($res->ok, $res->result) && ($res->ok === true)) {
            return $res;
        }

        // Default returns Error Message
        return $errorResponse;
    }

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Bot ME ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

    /**
     * Function getMe
     *
     * @return bool[]|mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 06/04/2021 51:20
     */
    public function getMe()
    {
        $errorResponse = array('error' => true);
        if (!isset($this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY])) {
            return $errorResponse;
        }

        // Cấu hình SDK
        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];

        // Xác định API Key
        if (!isset($sdkConfig['bot_api_key'])) {
            return $errorResponse;
        }

        // Thiết lập Endpoint và Tham số gửi tin đi
        $endpoint    = self::TELEGRAM_API . $sdkConfig['bot_api_key'] . self::METHOD_GET_ME;
        $sendRequest = Helper::sendRequest($endpoint);
        $res         = json_decode(trim($sendRequest));

        // Get Updates thành công
        if (isset($res->ok, $res->result) && ($res->ok === true)) {
            return $res;
        }

        // Default returns Error Message
        return $errorResponse;
    }

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ChatID ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

    /**
     * Function setChatId
     *
     * @param null $chatId
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:33
     */
    public function setChatId($chatId = null)
    {
        $this->chatId = $chatId;

        return $this;
    }

    /**
     * Function getChatId
     *
     * @return int|string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:30
     */
    public function getChatId()
    {
        return $this->chatId;
    }

    /**
     * Function implementChatId
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 32:03
     */
    public function implementChatId()
    {
        if (!empty($this->chatId)) {
            return (string) $this->chatId;
        }

        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];
        if (isset($sdkConfig['default_chat_id'])) {
            return (string) $sdkConfig['default_chat_id'];
        }

        return null;
    }

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ FileAttachment ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

    /**
     * Function setFileAttachment
     *
     * @param null $fileAttachment
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:26
     */
    public function setFileAttachment($fileAttachment = null)
    {
        $this->fileAttachment = $fileAttachment;

        return $this;
    }

    /**
     * Function getFileAttachment
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:23
     */
    public function getFileAttachment()
    {
        return $this->fileAttachment;
    }

    /**
     * Function implementFileAttachment
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 37:32
     */
    public function implementFileAttachment()
    {
        if (!empty($this->fileAttachment)) {
            return $this->fileAttachment;
        }

        return null;
    }

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Message ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

    /**
     * Function setMessage
     *
     * @param null $message
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:20
     */
    public function setMessage($message = null)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Function getMessage
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:17
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Function implementMessage
     *
     * @param null $defaultMessage
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/09/2021 14:33
     */
    public function implementMessage($defaultMessage = null)
    {
        if (!empty($this->message)) {
            return $this->message;
        }

        return $defaultMessage;
    }

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Sending Method ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

    /**
     * Function sendMessage
     *
     * @return bool|string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:14
     */
    public function sendMessage()
    {
        if (!isset($this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Cấu hình SDK
        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];

        // Xác định API Key
        if (!isset($sdkConfig['bot_api_key'])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình API Key cho việc gửi tin đi Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Xác định tham số gửi tin đi
        $chatId = $this->implementChatId();

        // Xác định nội dung thông điệp cần gửi đi
        $textMessage = $this->implementMessage();

        if (empty($chatId) || empty($textMessage)) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được chủ đề cuộc trò chuyện và nội dung gửi đi. ChatID: ' . $chatId . ' - TextMessage: ' . $textMessage;
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Thiết lập Endpoint và Tham số gửi tin đi
        $endpoint    = self::TELEGRAM_API . $sdkConfig['bot_api_key'] . self::METHOD_SEND_MESSAGE;
        $params      = array('text' => $textMessage, 'chat_id' => $chatId);
        $sendRequest = Helper::sendRequest($endpoint, $params);
        $res         = json_decode(trim($sendRequest));

        // Nếu không xác định được nội dung trả về
        if ($res === null) {
            // Không Decode được mã trả về
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được mã trả về!';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return $sendRequest;
        }

        // Trường hợp gửi tin nhắn thành công
        if (isset($res->ok, $res->result) && ($res->ok === true)) {
            // Gửi tin nhắn thành công
            $responseMsg = self::_CLASS_NAME_ . ' -> ' . self::METHOD_SEND_MESSAGE . ' Success with Params -> ' . json_encode($params);
            if (function_exists('log_message')) {
                log_message('debug', $responseMsg);
            }

            return $sendRequest;
        }

        return $sendRequest;
    }

    /**
     * Function sendPhoto
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:12
     */
    public function sendPhoto()
    {
        if (!isset($this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Cấu hình SDK
        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];

        // Xác định API Key
        if (!isset($sdkConfig['bot_api_key'])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình API Key cho việc gửi tin đi Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Xác định tham số gửi tin đi
        $chatId  = $this->implementChatId();
        $caption = $this->implementMessage('Photo');
        $photo   = $this->implementFileAttachment();

        if (empty($chatId) || empty($photo)) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được chủ đề cuộc trò chuyện và nội dung gửi đi. ChatID: ' . $chatId . ' - Caption: ' . $caption . ' - Photo: ' . $photo;
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Thiết lập Endpoint và Tham số gửi tin đi
        $endpoint    = self::TELEGRAM_API . $sdkConfig['bot_api_key'] . self::METHOD_SEND_PHOTO;
        $params      = array('photo' => $photo, 'chat_id' => $chatId, 'caption' => $caption);
        $sendRequest = Helper::sendRequest($endpoint, $params);
        $res         = json_decode(trim($sendRequest));

        // Nếu không xác định được nội dung trả về
        if ($res === null) {
            // Không Decode được mã trả về
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được mã trả về!';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Trường hợp gửi tin nhắn thành công
        if (isset($res->ok, $res->result) && ($res->ok === true)) {
            // Gửi tin nhắn thành công
            $responseMsg = self::_CLASS_NAME_ . ' -> ' . self::METHOD_SEND_PHOTO . ' Success with Params -> ' . json_encode($params);
            if (function_exists('log_message')) {
                log_message('debug', $responseMsg);
            }

            return true;
        }

        return false;
    }

    /**
     * Function sendAudio
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:08
     */
    public function sendAudio()
    {
        if (!isset($this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Cấu hình SDK
        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];

        // Xác định API Key
        if (!isset($sdkConfig['bot_api_key'])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình API Key cho việc gửi tin đi Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Xác định tham số gửi tin đi
        $chatId  = $this->implementChatId();
        $caption = $this->implementMessage('Audio');
        $audio   = $this->implementFileAttachment();
        if (empty($chatId) || empty($audio)) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được chủ đề cuộc trò chuyện và nội dung gửi đi. ChatID: ' . $chatId . ' - Caption: ' . $caption . ' - Audio: ' . $audio;
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Thiết lập Endpoint và Tham số gửi tin đi
        $endpoint    = self::TELEGRAM_API . $sdkConfig['bot_api_key'] . self::METHOD_SEND_AUDIO;
        $params      = array('audio' => $audio, 'chat_id' => $chatId, 'caption' => $caption);
        $sendRequest = Helper::sendRequest($endpoint, $params);
        $res         = json_decode(trim($sendRequest));

        // Nếu không xác định được nội dung trả về
        if ($res === null) {
            // Không Decode được mã trả về
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được mã trả về!';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Trường hợp gửi tin nhắn thành công
        if (isset($res->ok, $res->result) && ($res->ok === true)) {
            // Gửi tin nhắn thành công
            $responseMsg = self::_CLASS_NAME_ . ' -> ' . self::METHOD_SEND_AUDIO . ' Success with Params -> ' . json_encode($params);
            if (function_exists('log_message')) {
                log_message('debug', $responseMsg);
            }

            return true;
        }

        return false;
    }

    /**
     * Function sendVideo
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:05
     */
    public function sendVideo()
    {
        if (!isset($this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Cấu hình SDK
        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];

        // Xác định API Key
        if (!isset($sdkConfig['bot_api_key'])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình API Key cho việc gửi tin đi Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Xác định tham số gửi tin đi
        $chatId  = $this->implementChatId();
        $caption = $this->implementMessage('Video');
        $video   = $this->implementFileAttachment();
        if (empty($chatId) || empty($video)) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được chủ đề cuộc trò chuyện và nội dung gửi đi. ChatID: ' . $chatId . ' - Caption: ' . $caption . ' - Video: ' . $video;
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Thiết lập Endpoint và Tham số gửi tin đi
        $endpoint    = self::TELEGRAM_API . $sdkConfig['bot_api_key'] . self::METHOD_SEND_VIDEO;
        $params      = array('video' => $video, 'chat_id' => $chatId, 'caption' => $caption);
        $sendRequest = Helper::sendRequest($endpoint, $params);
        $res         = json_decode(trim($sendRequest));

        // Nếu không xác định được nội dung trả về
        if ($res === null) {
            // Không Decode được mã trả về
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được mã trả về!';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Trường hợp gửi tin nhắn thành công
        if (isset($res->ok, $res->result) && ($res->ok === true)) {
            // Gửi tin nhắn thành công
            $responseMsg = self::_CLASS_NAME_ . ' -> ' . self::METHOD_SEND_VIDEO . ' Success with Params -> ' . json_encode($params);
            if (function_exists('log_message')) {
                log_message('debug', $responseMsg);
            }

            return true;
        }

        return false;
    }

    /**
     * Function sendDocument
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 16:01
     */
    public function sendDocument()
    {
        if (!isset($this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Cấu hình SDK
        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];

        // Xác định API Key
        if (!isset($sdkConfig['bot_api_key'])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình API Key cho việc gửi tin đi Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Xác định tham số gửi tin đi
        $chatId   = $this->implementChatId();
        $caption  = $this->implementMessage('Document');
        $document = $this->implementFileAttachment();
        if (empty($chatId) || empty($document)) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được chủ đề cuộc trò chuyện và nội dung gửi đi. ChatID: ' . $chatId . ' - Caption: ' . $caption . ' - Document: ' . $document;
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Thiết lập Endpoint và Tham số gửi tin đi
        $endpoint    = self::TELEGRAM_API . $sdkConfig['bot_api_key'] . self::METHOD_SEND_DOCUMENT;
        $params      = array('document' => $document, 'chat_id' => $chatId, 'caption' => $caption);
        $sendRequest = Helper::sendRequest($endpoint, $params);
        $res         = json_decode(trim($sendRequest));

        // Nếu không xác định được nội dung trả về
        if ($res === null) {
            // Không Decode được mã trả về
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được mã trả về!';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return false;
        }

        // Trường hợp gửi tin nhắn thành công
        if (isset($res->ok, $res->result) && ($res->ok === true)) {
            // Gửi tin nhắn thành công
            $responseMsg = self::_CLASS_NAME_ . ' -> ' . self::METHOD_SEND_DOCUMENT . ' Success with Params -> ' . json_encode($params);
            if (function_exists('log_message')) {
                log_message('debug', $responseMsg);
            }

            return true;
        }

        return false;
    }
}
