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
	 * Function sendRequest - Hàm request tới Endpoint sử dụng phương thức GET, thư viện cURL với TLS v1.2
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
		$endpoint = $url . '?' . http_build_query($params);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $endpoint,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => $timeout,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
			CURLOPT_CUSTOMREQUEST => "POST",
		));
		$result = curl_exec($curl);
		curl_close($curl);

		return $result;
	}
}
