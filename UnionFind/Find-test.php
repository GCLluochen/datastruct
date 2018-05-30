<?php
namespace Datastruct\UnionFind;

require_once("./../autoload.php");

use Datastruct\UnionFind\UFInterface;
use Datastruct\UnionFind\QuickFind;
use Datastruct\UnionFind\UnionFind;
use Datastruct\UnionFind\UnionFind2;


/**
 * 并查集性能测试
 * @param int $uf 实现了并查集接口的类
 * @param itn $m 操作次数
 */
function testUF(UFInterface $uf, int $m):float
{
    //获取并查集元素个数
    $size = $uf->getSize();
    $startTime = microtime(true) * 1000;
    //进行 $m 次合并操作
    for ($j = 0; $j < $m; $j++) {
        $a = mt_rand(0, $size - 1);
        $b = mt_rand(0, $size - 1);
        $uf->unionElements($a, $b);
    }

    //进行 $m 次查询操作(查询两个元素是否属于同一集合)
    for ($j = 0; $j < $m; $j++) {
        $a = mt_rand(0, $size - 1);
        $b = mt_rand(0, $size - 1);
        $uf->isConnected($a, $b);
    }
    $endTime = microtime(true) * 1000;
    return ($endTime - $startTime) / 1000;//秒
}

//测试元素个数
$testSize = 10000;
//测试操作次数
$m = 100000;

//QuickFind
//$qf = new QuickFind($testSize);
//print "QuickFind: " . testUF($qf, $m) . "\n";

//UnionFind
$uf1 = new UnionFind($testSize);
print "UnionFind: " . testUF($uf1, $m) . "\n";

//UnionFind2
$uf2 = new UnionFind2($testSize);
print "UnionFind2: " . testUF($uf2, $m) . "\n";
die;
