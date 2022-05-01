<?php declare(strict_types=1);
/**
 * Author: Eko Junaidi Salam <eko.junaidi.salam@gmail.com>
 * License: AGPL-3.0-or-later
 *
 * Helper collections
 */

// @codeCoverageIgnoreStart
if(!function_exists('is_kabisat')){
// @codeCoverageIgnoreEnd

	/**
	 * Check year is kabisat or not
	 * @param $year int Year
	 * @return int
	 */
    function is_kabisat(int $year=0): int {
        $year = $year > 0 ? $year : date('Y');
        return ((($year % 4 == 0) && ($year % 100 != 0) || ($year % 400 == 0))?1:0);
    }
}

// @codeCoverageIgnoreStart
if(!function_exists('IDateTimes')){
// @codeCoverageIgnoreEnd

	/**
	 * Indonesian Date Times
	 * @param $strDate		string	Date Times in string ex: yyyy-mm-dd h:i:s
	 * @param $withTimes	bool	Include times in format H:i:s
	 * 
	 * @return string	DateTimes in string ex: Minggu, 01 Mei 2022 H:i:s
	 */
    function IDateTimes(string $strDate='', $withTimes=true): string {
	    $date = strtotime(!empty($strDate)?$strDate:(new DateTimeImmutable("now",new DateTimeZone("Asia/Jakarta")))->format("Y-m-d H:i:s"));
	    $monthList = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
	    $dayList = ["Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"];

	    $dayName = $dayList[date('w',$date)];
	    $day = date('d',$date);
	    $month = $monthList[date('n',$date)-1];
	    $year = date('Y',$date);
	    $times = $withTimes ? " ".date('H:i:s', $date) : null;
	    return "$dayName, $day $month $year".$times;
    }
}

// @codeCoverageIgnoreStart
if(!function_exists('dateDiff')){
// @codeCoverageIgnoreEnd

	/**
	 * Get interval between two dates
	 * @param $dates	null|string	Date with format yyyy-mm-dd
	 * @param $now		null|string Now or Custom Date
	 * 
	 * @return string	xx Tahun xx Bulan xx Hari
	 */
    function dateDiff(?string $dates=null, ?string $now=null): string {
	    if(empty($dates) && empty($now)) return "";

	    $date = new DateTimeImmutable($dates, new DateTimeZone("Asia/Jakarta"));
	    $now = new DateTimeImmutable(!empty($now) ? $now : "now", new DateTimeZone("Asia/Jakarta"));
	    $interval = $date->diff($now);

	    $sameDay = intval($interval->format("%a"));
	    if($sameDay > 0){
		    [$year,$month,$day] = explode(" ",$interval->format("%Y %M %D"));
		    $years = intval($year) ?? null;
		    $months = intval($month) ?? null;
		    $days = intval($day) ?? null;
	    }else{
		    $days = 1;
		    $day = $sameDay;
	    }

	    $str = "";
	    if(!empty($years)) $str .= $year." Tahun";
	    if(!empty($months)) $str .= (!empty($years) ? " ":null).$month." Bulan";
	    if(!empty($days)) $str .= (!empty($months) || !empty($years)? " ":null).$day." Hari";
	    return $str;
    }
}

// @codeCoverageIgnoreStart
if(!function_exists('get_client_ip')){
// @codeCoverageIgnoreEnd

	/**
	 * Get Client IP
	 * 
	 * @return string IP
	 */
	function getClientIp(): string {
		$ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
	}
}

// @codeCoverageIgnoreStart
if(!function_exists('uuid_v3')){
// @codeCoverageIgnoreEnd

    function uuid_v3($namespace, $name) {
        if(!is_valid_uuid($namespace)) return false;
    
        // Get hexadecimal components of namespace
        $nhex = str_replace(array('-','{','}'), '', $namespace);
    
        // Binary Value
        $nstr = '';
    
        // Convert Namespace UUID to bits
        for($i = 0; $i < strlen($nhex); $i+=2) {
          $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
        }
    
        // Calculate hash value
        $hash = md5($nstr . $name);
    
        return sprintf('%08s-%04s-%04x-%04x-%12s',
            // 32 bits for "time_low"
            substr($hash, 0, 8),

            // 16 bits for "time_mid"
            substr($hash, 8, 4),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 3
            (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x3000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,

            // 48 bits for "node"
          substr($hash, 20, 12)
        );
    }
}

// @codeCoverageIgnoreStart
if(!function_exists('uuid_v4')){
// @codeCoverageIgnoreEnd

    function uuid_v4() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
        
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
        
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
        
            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}

// @codeCoverageIgnoreStart
if(!function_exists('uuid_v5')){
// @codeCoverageIgnoreEnd

    function uuid_v5($namespace, $name) {
        if(!is_valid_uuid($namespace)) return false;
    
        // Get hexadecimal components of namespace
        $nhex = str_replace(array('-','{','}'), '', $namespace);
    
        // Binary Value
        $nstr = '';
    
        // Convert Namespace UUID to bits
        for($i = 0; $i < strlen($nhex); $i+=2) {
          $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
        }
    
        // Calculate hash value
        $hash = sha1($nstr . $name);
    
        return sprintf('%08s-%04s-%04x-%04x-%12s',
            // 32 bits for "time_low"
            substr($hash, 0, 8),
        
            // 16 bits for "time_mid"
            substr($hash, 8, 4),
        
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 5
            (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000,
        
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,
        
            // 48 bits for "node"
            substr($hash, 20, 12)
        );
    }
}

// @codeCoverageIgnoreStart
if(!function_exists('is_valid_uuid')){
// @codeCoverageIgnoreEnd

    function is_valid_uuid($uuid) {
        return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'.'[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1;
    }
}

// @codeCoverageIgnoreStart
if(!function_exists('setMyHeader')){
// @codeCoverageIgnoreEnd

	function setMyHeader(?int $code = NULL, ?string $msg = NULL): ?object {
		$obj = new StdClass();
		if (!empty($code)){
			switch ($code) {
				case 100: $text = 'Continue'; break;
				case 101: $text = 'Switching Protocols'; break;
				case 200: $text = 'OK'; break;
				case 201: $text = 'Created'; break;
				case 202: $text = 'Accepted'; break;
				case 203: $text = 'Non-Authoritative Information'; break;
				case 204: $text = 'No Content'; break;
				case 205: $text = 'Reset Content'; break;
				case 206: $text = 'Partial Content'; break;
				case 300: $text = 'Multiple Choices'; break;
				case 301: $text = 'Moved Permanently'; break;
				case 302: $text = 'Moved Temporarily'; break;
				case 303: $text = 'See Other'; break;
				case 304: $text = 'Not Modified'; break;
				case 305: $text = 'Use Proxy'; break;
				case 400: $text = 'Bad Request'; break;
				case 401: $text = 'Unauthorized'; break;
				case 402: $text = 'Payment Required'; break;
				case 403: $text = 'Forbidden'; break;
				case 404: $text = 'Not Found'; break;
				case 405: $text = 'Method Not Allowed'; break;
				case 406: $text = 'Not Acceptable'; break;
				case 407: $text = 'Proxy Authentication Required'; break;
				case 408: $text = 'Request Time-out'; break;
				case 409: $text = 'Conflict'; break;
				case 410: $text = 'Gone'; break;
				case 411: $text = 'Length Required'; break;
				case 412: $text = 'Precondition Failed'; break;
				case 413: $text = 'Request Entity Too Large'; break;
				case 414: $text = 'Request-URI Too Large'; break;
				case 415: $text = 'Unsupported Media Type'; break;
				case 500: $text = 'Internal Server Error'; break;
				case 501: $text = 'Not Implemented'; break;
				case 502: $text = 'Bad Gateway'; break;
				case 503: $text = 'Service Unavailable'; break;
				case 504: $text = 'Gateway Time-out'; break;
				case 505: $text = 'HTTP Version not supported'; break;
				case 600: $text = 'Database Unavailable'; break;
				default:
					// trigger_error('Unknown http status code "' . htmlentities(strval($code)) . '"',E_USER_ERROR);
					return null;
				break;
			}

			$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
			$obj->protocol = $protocol;
			$obj->code = $code;
			$obj->text = $text;
			$obj->json = json_encode(array('code'=>$code,'status'=>(!empty($msg)?$msg:$text)));
		}else{
			$obj->protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
			$obj->code = 200;
			$obj->text = 'OK';
			$obj->json = json_encode(array('code'=>200,'status'=>(!empty($msg)?$msg:'OK')));
		}
		return $obj;
	}
}
