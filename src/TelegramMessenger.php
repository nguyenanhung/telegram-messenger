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
    const VERSION                       = '1.0.7';
    const TELEGRAM_MESSENGER_CONFIG_KEY = 'telegram_messages';
    const TELEGRAM_API                  = 'https://api.telegram.org/bot';
    const METHOD_GET_UPDATES            = '/getUpdates';
    const METHOD_SEND_MESSAGE           = '/sendMessage';
    const METHOD_SEND_PHOTO             = '/sendPhoto';
    const METHOD_SEND_AUDIO             = '/sendAudio';
    const METHOD_SEND_VIDEO             = '/sendVideo';
    const METHOD_SEND_DOCUMENT          = '/sendDocument';

    /** @var array|null SDK Config */
    protected $sdkConfig;
    /** @var null|string|int ChatID */
    protected $chatId = NULL;
    /** @var null|string Text Message */
    protected $message = NULL;
    /** @var null|string File Attachment content */
    protected $fileAttachment = NULL;

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

    /**
     * Function sendRequest - Hàm request tới Endpoint sử dụng phương thức GET, thư viện cURL với TLS v1.2
     *
     * @param string $url     URL Endpoint cần gọi
     * @param array  $params  Data Params cần truyền dữ liệu
     * @param int    $timeout Thời gian chờ phản hồi dữ liệu tối đa
     *
     * @return bool|string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 00:35
     */
    private function __sendRequest($url = '', $params = array(), $timeout = 30)
    {
        $endpoint = $url . '?' . http_build_query($params);
        $curl     = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL            => $endpoint,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => $timeout,
            CURLOPT_FOLLOWLOCATION => TRUE,
            CURLOPT_SSLVERSION     => CURL_SSLVERSION_TLSv1_2,
            CURLOPT_CUSTOMREQUEST  => "POST",
        ));
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
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
        $errorResponse = array('error' => TRUE);
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
        $sendRequest = self::__sendRequest($endpoint);
        $res         = json_decode(trim($sendRequest));

        // Get Updates thành công
        if ((isset($res->ok) && ($res->ok == TRUE)) && isset($res->result)) {
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
    public function setChatId($chatId = NULL)
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

        return NULL;
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
    public function setFileAttachment($fileAttachment = NULL)
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

        return NULL;
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
    public function setMessage($message = NULL)
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
     * @return mixed|string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 04/01/2021 34:48
     */
    public function implementMessage($defaultMessage = NULL)
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

            return FALSE;
        }

        // Cấu hình SDK
        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];

        // Xác định API Key
        if (!isset($sdkConfig['bot_api_key'])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình API Key cho việc gửi tin đi Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return FALSE;
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

            return FALSE;
        }

        // Thiết lập Endpoint và Tham số gửi tin đi
        $endpoint    = self::TELEGRAM_API . $sdkConfig['bot_api_key'] . self::METHOD_SEND_MESSAGE;
        $params      = array('text' => $textMessage, 'chat_id' => $chatId);
        $sendRequest = self::__sendRequest($endpoint, $params);
        $res         = json_decode(trim($sendRequest));

        // Nếu không xác định được nội dung trả về
        if ($res == NULL) {
            // Không Decode được mã trả về
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được mã trả về!';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return $sendRequest;
        }

        // Trường hợp gửi tin nhắn thành công
        if ((isset($res->ok) && ($res->ok == TRUE)) && isset($res->result)) {
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

            return FALSE;
        }

        // Cấu hình SDK
        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];

        // Xác định API Key
        if (!isset($sdkConfig['bot_api_key'])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình API Key cho việc gửi tin đi Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return FALSE;
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

            return FALSE;
        }

        // Thiết lập Endpoint và Tham số gửi tin đi
        $endpoint    = self::TELEGRAM_API . $sdkConfig['bot_api_key'] . self::METHOD_SEND_PHOTO;
        $params      = array('photo' => $photo, 'chat_id' => $chatId, 'caption' => $caption);
        $sendRequest = self::__sendRequest($endpoint, $params);
        $res         = json_decode(trim($sendRequest));

        // Nếu không xác định được nội dung trả về
        if ($res == NULL) {
            // Không Decode được mã trả về
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được mã trả về!';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return FALSE;
        }

        // Trường hợp gửi tin nhắn thành công
        if ((isset($res->ok) && ($res->ok == TRUE)) && isset($res->result)) {
            // Gửi tin nhắn thành công
            $responseMsg = self::_CLASS_NAME_ . ' -> ' . self::METHOD_SEND_PHOTO . ' Success with Params -> ' . json_encode($params);
            if (function_exists('log_message')) {
                log_message('debug', $responseMsg);
            }

            return TRUE;
        }

        return FALSE;
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

            return FALSE;
        }

        // Cấu hình SDK
        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];

        // Xác định API Key
        if (!isset($sdkConfig['bot_api_key'])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình API Key cho việc gửi tin đi Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return FALSE;
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

            return FALSE;
        }

        // Thiết lập Endpoint và Tham số gửi tin đi
        $endpoint    = self::TELEGRAM_API . $sdkConfig['bot_api_key'] . self::METHOD_SEND_AUDIO;
        $params      = array('audio' => $audio, 'chat_id' => $chatId, 'caption' => $caption);
        $sendRequest = self::__sendRequest($endpoint, $params);
        $res         = json_decode(trim($sendRequest));

        // Nếu không xác định được nội dung trả về
        if ($res == NULL) {
            // Không Decode được mã trả về
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được mã trả về!';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return FALSE;
        }

        // Trường hợp gửi tin nhắn thành công
        if ((isset($res->ok) && ($res->ok == TRUE)) && isset($res->result)) {
            // Gửi tin nhắn thành công
            $responseMsg = self::_CLASS_NAME_ . ' -> ' . self::METHOD_SEND_AUDIO . ' Success with Params -> ' . json_encode($params);
            if (function_exists('log_message')) {
                log_message('debug', $responseMsg);
            }

            return TRUE;
        }

        return FALSE;
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

            return FALSE;
        }

        // Cấu hình SDK
        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];

        // Xác định API Key
        if (!isset($sdkConfig['bot_api_key'])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình API Key cho việc gửi tin đi Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return FALSE;
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

            return FALSE;
        }

        // Thiết lập Endpoint và Tham số gửi tin đi
        $endpoint    = self::TELEGRAM_API . $sdkConfig['bot_api_key'] . self::METHOD_SEND_VIDEO;
        $params      = array('video' => $video, 'chat_id' => $chatId, 'caption' => $caption);
        $sendRequest = self::__sendRequest($endpoint, $params);
        $res         = json_decode(trim($sendRequest));

        // Nếu không xác định được nội dung trả về
        if ($res == NULL) {
            // Không Decode được mã trả về
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được mã trả về!';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return FALSE;
        }

        // Trường hợp gửi tin nhắn thành công
        if ((isset($res->ok) && ($res->ok == TRUE)) && isset($res->result)) {
            // Gửi tin nhắn thành công
            $responseMsg = self::_CLASS_NAME_ . ' -> ' . self::METHOD_SEND_VIDEO . ' Success with Params -> ' . json_encode($params);
            if (function_exists('log_message')) {
                log_message('debug', $responseMsg);
            }

            return TRUE;
        }

        return FALSE;
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

            return FALSE;
        }

        // Cấu hình SDK
        $sdkConfig = $this->sdkConfig[self::TELEGRAM_MESSENGER_CONFIG_KEY];

        // Xác định API Key
        if (!isset($sdkConfig['bot_api_key'])) {
            $responseMsg = self::_CLASS_NAME_ . ' -> Không tìm thấy cấu hình API Key cho việc gửi tin đi Telegram Messenger';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return FALSE;
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

            return FALSE;
        }

        // Thiết lập Endpoint và Tham số gửi tin đi
        $endpoint    = self::TELEGRAM_API . $sdkConfig['bot_api_key'] . self::METHOD_SEND_DOCUMENT;
        $params      = array('document' => $document, 'chat_id' => $chatId, 'caption' => $caption);
        $sendRequest = self::__sendRequest($endpoint, $params);
        $res         = json_decode(trim($sendRequest));

        // Nếu không xác định được nội dung trả về
        if ($res == NULL) {
            // Không Decode được mã trả về
            $responseMsg = self::_CLASS_NAME_ . ' -> Không xác định được mã trả về!';
            if (function_exists('log_message')) {
                log_message('error', $responseMsg);
            }

            return FALSE;
        }

        // Trường hợp gửi tin nhắn thành công
        if ((isset($res->ok) && ($res->ok == TRUE)) && isset($res->result)) {
            // Gửi tin nhắn thành công
            $responseMsg = self::_CLASS_NAME_ . ' -> ' . self::METHOD_SEND_DOCUMENT . ' Success with Params -> ' . json_encode($params);
            if (function_exists('log_message')) {
                log_message('debug', $responseMsg);
            }

            return TRUE;
        }

        return FALSE;
    }
}
