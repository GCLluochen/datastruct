<?php
namespace Datastruct\BinarySearchTree;

require_once("./../autoload.php");

/**
 * 二分搜索树——测试
 * 添加节点测试
 */
$bst = new BinarySearchTree();
$testArr = [87, 55, 102, 36, 65, 93, 130, 63];
foreach ($testArr as $v) {
    $bst->add($v);
}
print_r($bst);
//var_dump($bst->contains(65));
echo "preOrder: ";
$bst->preOrder();
echo "\n middleOrder: ";
$bst->middleOrder();
echo "\n rearOrder: ";
$bst->rearOrder();
echo "\n Min: " . $bst->minimum() . "\n";
echo "Max: " . $bst->maximum() . "\n";

//测试-删除最小节点-ok
//$bst->removeMinimum();
//测试-删除最大节点-ok
//$bst->removeMaximum();
//print_r($bst);

die;
