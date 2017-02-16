<?php
/**
 * Created by PhpStorm.
 * User: liangzhi
 * Date: 16-11-21
 * Time: 下午3:44
 */


if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

    include './RedisSearch.php';

    $s = new \Cpphp\RedisSearch;

    $ids = $s->baseSearch("{$_POST['keyword']}");

    var_dump($ids);

    $mysqli = new mysqli('localhost', 'root', '123456', 'redis');

    $mysqli->set_charset('utf8');

    for ($i=0; $i<count($ids); $i++){
        $sql = 'select id,content from article where id='.$ids[$i];
        $resObj = $mysqli->query($sql);

        $data[] = $resObj->fetch_assoc();
    }

}



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>redis搜索测试</title>
</head>
<body>

    <form action="./index.php" method="post">
        <input type="text" name="keyword" />
        <button>搜索</button>
    </form>

    <?php
        if( !empty($data) ):
            echo '<table border="1" width="600"><tr><td>序号</td><td>内容</td></tr>';
            foreach ($data as $item):

    ?>
        <tr>
            <td><?php echo $item['id']?></td>
            <td><?php echo $item['content']?></td>
        </tr>
    <?php
        endforeach;

        echo '</table>';
        endif;
    ?>
</body>
</html>
