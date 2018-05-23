<?php
namespace Datastruct\Heap;

require_once("./../autoload.php");

use Datastruct\TestArray;
use Datastruct\Heap\MaxHeap;

/**
 * 最大堆的 添加-取出测试
 */
$maxLen = 1000000;
/*$mh = new MaxHeap();
$testArr = [];
for ($i = 0; $i < $maxLen; $i++) {
    $mh->add(mt_rand(1, 100) + $i);
}
for ($i = 0; $i < $maxLen; $i ++) {
    $testArr[$i] = $mh->extractMax();
}

for ($j = 0; $j < $maxLen; $j++) {
    if ($j > 0 && ($testArr[$j - 0] < $testArr[$j])) {
        throw new \RuntimeException('这个堆不正确');
    }
}

echo '堆操作完成';
*/

$testArr = [];
for ($i = 0; $i < $maxLen; $i++) {
    $testArr[$i] = mt_rand(1, 100000) + $i;
}
echo '数组构造完成, 长度: ' . count($testArr) . "\n";
echo "开始构造堆: \n";
echo "普通方式(循环添加到堆)耗时-微秒: ";
echo testHeap($testArr, 0) . "\n";
echo "数组构造方式, 耗时-微秒: ";
echo testHeap($testArr, 1) ."\n";
die;

/**
 * 直接添加元素到堆 和 通过已有数组构造堆  性能对比测试
 */
function testHeap(array $arr, $heapify = 0)
{
    //开始时间——微秒
    $startTime = microtime(true) * 1000;
    $arrLen = count($arr);
    $mh = new MaxHeap($arrLen);
    if ($heapify == 0) {
        for ($i = 0; $i < $arrLen; $i++) {
            $mh->add($arr[$i]);
        }
    } else {
        //通过数组构造成堆
        $mh->heapify($arr);
    }
    //结束时间——微秒
    $endTime = microtime(true) * 1000;

    return floatval($endTime - $startTime);
}


die;
