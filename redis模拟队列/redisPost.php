<?php

	require_once('./redis-queue.php');

	$link = mysqli_connect('localhost', 'root', '123456', 'redis');

	mysqli_set_charset($link, 'utf8');

	$pass = md5($_POST['password']);


	$sql = "insert into user(name,pass) values('{$_POST['username']}','{$pass}')";


	setDataToQueue($redis, 'regData', $sql);

	getDataFromQueue($redis, 'regData', $link);


	function handlerQueueData($sql)
	{
		global $link;

		$msg = json_decode($sql, true);

		$result = mysqli_query($link, $msg);

		// var_dump($result);
	}
