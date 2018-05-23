<?php
namespace Datastruct\Heap;

require_once("./../autoload.php");

use Datastruct\Heap\MinPriorityQueue;

/**
 * 优先队列测试
 */


/**
 * 从 N 个元素中选取前 M个 元素(从大到小)
 */
//从 100000 中取出前 100 个
$maxLen = 30;
$prevCount = 5;

$tmpSortArr = [];
for ($i = 0; $i < $maxLen; $i++) {
    $tmpSortArr[$i] = mt_rand(10, 10000);
}


echo '原始数组: ' . "\n";
$testArr = $tmpSortArr;
asort($tmpSortArr);
$tmpSortArr = array_slice($tmpSortArr, 0);
print_r(implode( '-', $testArr));//未排序的数组
echo "\n";
print_r(implode( '-', $tmpSortArr));
echo "\n-------------------------------------------------\n";


//初始化最小优先队列
$prevPq = new MinPriorityQueue($prevCount);
//首先将未排序的 N 个元素中的 前 M 个元素入队优先队列
for ($i = 0; $i < $prevCount; $i++) {
    $prevPq->enqueue($testArr[$i]);
}

echo '最小优先队列长度: ' . $prevPq->getSize() . "\n";
print_r($prevPq->minHeap->data);
echo "\n-------------------------------------------------\n";

//然后从 N 中 第 M+1 个元素开始向后遍历,如果当前元素值大于优先队列中最小元素,则元素入队
for ($i = $prevCount; $i < $maxLen; $i++) {
    //获取当前队列中的最小值(根节点值)
    $curMin = $prevPq->getFirst();
    if ($testArr[$i] > $curMin) {
        //如果数组中当前索引的值大于最小优先队列中的根节点值,则替换
        $prevPq->minHeap->replace($testArr[$i]);
    }
}
print_r($prevPq->minHeap->data);
die;
