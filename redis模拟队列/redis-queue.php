<?php


 $redis = new Redis();
 // var_dump($redis);
 
 $redis->connect('127.0.0.1', 6379);


 //Redis将消息放进队列
 function setDataToQueue($redis, $redisKey = 'sendMmail', $data = '')
 {
 	$data = json_encode( $data );
 	$redis->rpush( $redisKey, $data);
 }


 //Redis模拟队列从队列中拿数据
 function getDataFromQueue($redis, $redisKey = 'sendMmail', $link)
 {
 	$row;

 	while( $row = $redis->lpop( $redisKey ) ){

 		
/* 		$msg = json_decode($row, true);
 		
 		// $data[] = $
 		$res = mysqli_query($link, $msg);

 		var_dump($res);*/

 		//使用用户自定义回调函数
 		call_user_func('handlerQueueData', $row);
 	}
 }