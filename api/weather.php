<?php
// 	header('Content-Type: text/html; charset=utf-8;');
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://www.weather.go.kr/weather/process/timeseries-dfs-body-ajax.jsp?myPointCode=4139059200&unit=K');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	
	$result = iconv("EUC-KR","UTF-8", $result);
// 	echo $result;

	$day = 0;
	
	if( !($count = $_GET['count']) )
		$count = 5;

	for ($i=0; $i<$count; $i++)
	{
		$time = explode('<p class="time_hr">', $result);
		$time = explode('</p>', $time[$i + 1]);
		$time = $time[0];

		$temp = explode('<td class=""><p class="plus">', $result);
		$temp = explode('</p>', $temp[$i + 1]);
		$temp = $temp[0];
		
		$arr[$i]['time'] = $time;
		$arr[$i]['temp'] = $temp;
		$arr[$i]['day'] = $day;
		
		if($time >= 24)
			$day += 1;
	}
	
// 	print_r($arr);
	$json = json_encode($arr);
	echo($json);
?>