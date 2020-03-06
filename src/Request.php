<?php
/**
 * Project telegram-messenger
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/5/19
 * Time: 10:47
 */

namespace nguyenanhung\TelegramMessenger;

/**
 * Trait Request
 *
 * @package   nguyenanhung\TelegramMessenger
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
trait Request
{
    /**
     * Function sendRequest
     *
     * @param string $url
     * @param array  $params
     * @param int    $timeout
     *
     * @return bool|string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 9/5/19 51:20
     */
    public function sendRequest($url = '', $params = array(), $timeout = 30)
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
}
