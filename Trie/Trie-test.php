<?php
namespace Datastruct\Trie;

require_once("./../autoload.php");

use Datastruct\Trie\Trie;
use Datastruct\BinarySearchTree\BSTSet;
use Datastruct\TestArray;

/**
 * BSTSet 和 Trie 的性能对比测试
 * 这个测试目前不能执行
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
//print_r($tarr);die;
print 'word size: ' . $tarr->getSize() . "\n";

//开始时间
$startTime = microtime(true) * 1000;
$newBst = new BSTSet();
//添加数据
for ($i = 0; $i < $tarr->getSize(); $i++) {
    $newBst->add($tarr->get($i));
}
//查找数据
for ($i = 0; $i < $tarr->getSize(); $i++) {
    $newBst->contains($tarr->get($i));
}
//结束时间
$endTime = microtime(true) * 1000;
$spendTime = ($endTime - $startTime) / 1000;
print 'BSTSet: ' . $spendTime . "\n";

//开始时间
$startTime = microtime(true) * 1000;
$newTrie = new Trie();
//添加数据
for ($i = 0; $i < $tarr->getSize(); $i++) {
    $newTrie->add($tarr->get($i));
}
//查找数据
for ($i = 0; $i < $tarr->getSize(); $i++) {
    $newTrie->contains($tarr->get($i));
}
//结束时间
$endTime = microtime(true) * 1000;
$spendTime = ($endTime - $startTime) / 1000;
print 'Trie: ' . $spendTime;
die;
