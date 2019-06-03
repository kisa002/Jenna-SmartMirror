<?php
// 	header('Content-Type: text/html; charset=utf-8;');
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://www.weather.go.kr/weather/process/timeseries-dfs-body-ajax.jsp?myPointCode=4139059200&unit=K');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	
	$result = iconv("EUC-KR","UTF-8", $result);
// 	echo $result;

	$temp = explode('<dd class="now_weather1_center temp1 MB10">', $result);
	$temp = explode('</dd>', $temp[1]);
	$temp = $temp[0];
	
	echo $temp;
?>