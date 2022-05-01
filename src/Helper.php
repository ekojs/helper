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

    function is_kabisat($tahun=null): int {
        $tahun = intval(!empty($tahun) ? $tahun : date('Y'));
        return ((($tahun % 4 == 0) && ($tahun % 100 != 0) || ($tahun % 400 == 0))?1:0);
    }
}

// @codeCoverageIgnoreStart
if(!function_exists('IDateTimes')){
// @codeCoverageIgnoreEnd

    function IDateTimes($strDate='', $withTimes=true): string {
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

    function dateDiff($dates=null,$now=null): string {
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


