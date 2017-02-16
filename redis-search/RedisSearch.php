<?php
/**
 * Created by PhpStorm.
 * User: liangzhi
 * Date: 16-11-21
 * Time: 下午2:21
 */

namespace Cpphp;

include_once('./CpphpRedis.php');
/**
 * Class RedisSearch
 * @desc 使用Redis进行搜索,完成一个搜索引擎的功能
 * @package Cpphp
 */
class RedisSearch extends CpphpRedis
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 生成基本的索引
     */
    public function makeBaseIndex($content='', $docId=2)
    {
//        $content = 'The connection will not be closed on close or end of request until the php process ends. So be patient on to many open (specially on redis server side) when using persistent connections on many servers connecting to one redis server.
//Also more than one persistent connection can be made identified by either host + port + timeout or host + persistent_id or unix socket + timeout.';

        $keywords = preg_split('/\s+/', $content);

        //非用词列表
        $unUsedList = ['the', 'and'];

        //需要过滤的特殊字符
//        $filterChars = ['\'', '\"', '+', '-', ')', '('];

        for($i=0; $i<count($keywords); $i++){
            if( strlen( $keywords[$i] ) > 2 ){

                if( !in_array( strtolower($keywords[$i]), $unUsedList) ){

                    $words = trim(strtolower($keywords[$i]), '(');

                    $this->redis->sadd('idx'.$words, $docId);

                }
            }
        }

    }

    /**
     * 移除文章非用词(非用词就是那些在文档中频繁出现但是没有提供相应信息量的单次，比如：the a ..)
     */
    protected function removeUnusedWords($content)
    {
        //非用词列表
        $unUsedList = ['the', 'and'];

    }

    //搜索入口
    public function baseSearch($word)
    {
        $word = 'idx'.$word;
        $res = $this->redis->sInter($word);

//        var_dump($res);
        return $res;
    }
}



//$s = new RedisSearch;

//$s->makeBaseIndex();
//$s->baseSearch('redis');