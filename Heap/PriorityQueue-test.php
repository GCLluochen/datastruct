<?php
namespace Datastruct\Heap;

require_once("./../autoload.php");

use Datastruct\Heap\PriorityQueue;

/**
 * 优先队列测试
 */
$testArr = [];
$maxLen = 100000;
for ($i = 0; $i < $maxLen; $i++) {
    $testArr[$i] = mt_rand(10, 10000);
}
//echo count($testArr);
$pq = new PriorityQueue($maxLen);

//开始时间——微秒
$startTime = microtime(true) * 1000;

for ($j = 0; $j < $maxLen; $j++) {
    //入队
    $pq->enqueue($testArr[$j]);
}
//结束时间——微秒
$endTime = microtime(true) * 1000;
$costTime = floatval($endTime - $startTime);
echo '优先队列长度: ' . $pq->getSize() . "\n入队消耗时间: " .$costTime. "\n";

//开始时间——微秒
$startTime = microtime(true) * 1000;

while (!$pq->isEmpty()) {
    //出队队
    $pq->dequeue();
}
//结束时间——微秒
$endTime = microtime(true) * 1000;
$costTime = floatval($endTime - $startTime);
echo "出队消耗时间: " .$costTime. "\n";

