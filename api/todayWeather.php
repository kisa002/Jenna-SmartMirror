<?php
// 	header('Content-Type: text/html; charset=utf-8;');
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://www.weather.go.kr/weather/process/timeseries-dfs-body-ajax.jsp?myPointCode=4139059200&unit=K');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	
	$result = iconv("EUC-KR","UTF-8", $result);
// 	echo $result;

	for ($i=0; $i<10; $i++)
	{
		$time = explode('<p class="time_hr">', $result);
		$time = explode('</p>', $time[$i + 1]);
		$time = $time[0];

		$temp = explode('<td class=""><p class="plus">', $result);
		$temp = explode('</p>', $temp[$i + 1]);
		$temp = $temp[0];
		
		$weather = explode('.png" alt="', $result);
		$weather = explode('"', $weather[$i + 1]);
		$weather = $weather[0];
		
		$img = explode('"><img src="/', $result);
		$img = explode('"', $img[$i + 2]);
		$img = $img[0];
		
		$arr[$i]['time'] = $time;
		$arr[$i]['temp'] = $temp;
		$arr[$i]['weather'] = $weather;
		$arr[$i]['img'] = $img;
		$arr[$i]['day'] = 0;
		
		if($time >= 24)
			break;
	}
	
// 	print_r($arr);
	$json = json_encode($arr, JSON_UNESCAPED_UNICODE);
	echo($json);
?>