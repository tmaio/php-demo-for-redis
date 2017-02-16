<?php


include_once('./RedisSearch.php');

$s = new \Cpphp\RedisSearch();

$mysqli = new mysqli('localhost', 'root', '123456', 'redis');

//var_dump($mysqli);

$mysqli->set_charset('utf8');

$sql = 'select id,content from article';

$results = $mysqli->query($sql);

while ($row = $results->fetch_assoc() ){
    $data[] = $row;
}

//var_dump($data);
for ($i=0; $i<count($data); $i++){
    $s->makeBaseIndex($data[$i]['content'], $data[$i]['id']);
}


