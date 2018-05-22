<?php
namespace  Datastruct\Map;

require_once("./../autoload.php");
//require_once("./../TestArray.php");

use Datastruct\Map\MapInterface;
use Datastruct\Map\LinkedListMap;
use Datastruct\Map\BSTMap;
use Datastruct\TestArray;

/**
 * 链表实现的 Map 测试
 */


//文件路径
$filePath = dirname(__DIR__) . '/beijingsubway.txt';

$fileStr = file_get_contents($filePath);
//空格分离字符串文本,得到字符数组
$arrTmp = explode(' ', $fileStr);
//转为自定义的动态数组对象
$tarr = new TestArray(count($arrTmp));
foreach ($arrTmp as $v) {
    $tarr->push($v);
}


//链表实现的 Map
/*$newMap = new LinkedListMap();
for ($i = 0; $i < $tarr->getSize(); $i++) {
    $key = $tarr->get($i);
    //0 == null => true
    $newMap->add($key, intval($newMap->get($key)) + 1);
}
echo "LLMap--Subway: \n different words: " . $newMap->getSize() . "\n";
echo $newMap . "\n Words: " . $newMap->getSize() . "\n";
echo "code: " . $newMap->get('code') . "\n";*/

//二分搜索树 实现的 Map
/*$newBstMap = new BSTMap();
for ($i = 0; $i < $tarr->getSize(); $i++) {
    $key = $tarr->get($i);
    //0 == null => true
    $newBstMap->add($key, intval($newBstMap->get($key)) + 1);
}
echo "BSTMap--Subway: \n different words: " . $newBstMap->getSize() . "\n";
echo $newBstMap . "\n Words: " . $newBstMap->getSize() . "\n";
echo "code: " . $newBstMap->get('code') . "\n";*/


testMapSpendTime(new LinkedListMap(), $tarr);
testMapSpendTime(new BSTMap(), $tarr);

/**
 * 测试集合的时间消耗
 * @param SetInterface $set
 * @param $fromArr
 */
function testMapSpendTime(MapInterface $set, $fromArr)
{
    $startTime = microtime(true) * 1000;
    $obj = new $set();
    for ($i = 0; $i < $fromArr->getSize(); $i++) {
        $key = $fromArr->get($i);
        $obj->add($fromArr->get($i), intval($obj->get($key)) + 1);
    }
    $endTime = microtime(true) * 1000;
    $timeUse = $endTime - $startTime;
    echo (get_class($set)) . "--Subway: \n different words: " . $obj->getSize() . "  time: $timeUse\n";
}
