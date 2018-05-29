<?php
namespace Datastruct\AVL;

require_once("./../autoload.php");

use Datastruct\AVL\AVLTree;
use Datastruct\BinarySearchTree\BinarySearchTree;
//use Datastruct\TestArray;


/**
 * BST 和 AVLTree 的性能对比测试
 */

//文件路径
$filePath = dirname(__DIR__) . '/beijingsubway.txt';
$fileStr = file_get_contents($filePath);
//空格分离字符串文本,得到字符数组
$tarr = explode(' ', $fileStr);
//$tarr = array_slice($tarr, 0, 60);


/*//转为自定义的动态数组对象
$tarr = new TestArray(count($arrTmp));
foreach ($arrTmp as $v) {
    $tarr->push($v);
}*/

/*print 'word size: ' . count($tarr) . "\n";
$avlTree = new AVLTree();

for ($i = 0; $i < count($tarr); $i++) {
    $avlTree->add($tarr[$i]);
}
var_dump($avlTree->isBST());
var_dump($avlTree->isBalanced());*/

//BinarySearchTree
$startTime = microtime(true) * 1000;//开始时间毫秒数
$bst = new BinarySearchTree();
for ($i = 0; $i < count($tarr); $i++) {
    $bst->add($tarr[$i]);
}
/*for ($i = 0; $i < count($tarr); $i++) {
    $bst->remove($tarr[$i]);
}*/
$endTime = microtime(true) * 1000;//结束时间毫秒数
$costTime = floatval($endTime - $startTime) / 1000;
print "BST: " . $costTime . "\n";


//AVLTree
$startTime = microtime(true) * 1000;//开始时间毫秒数
$avlTree = new AVLTree();
for ($i = 0; $i < count($tarr); $i++) {
    $avlTree->add($tarr[$i]);
}
for ($i = 0; $i < count($tarr); $i++) {
    $avlTree->remove($tarr[$i]);
}
$endTime = microtime(true) * 1000;//结束时间毫秒数
$costTime = floatval($endTime - $startTime) / 1000;
print "AVLTree: " . $costTime . "\n";
die;
