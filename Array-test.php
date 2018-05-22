<?php
namespace Datastruct;

require_once("./autoload.php");

use Datastruct\TestArray;

//$test = new TestArray(10);
/*$test->push(11);// 0 => 11
$test->push(22);// 1 => 22
$test->push(44);// 2 => 44
echo $test . "\n";

$test->insert(2, 33);// 2 => 33, 3 => 44
echo $test . "\n";
$test->insert(1, 105);// 1 => 105, 2 => 22
echo $test . "\n";
$test->shift(1205);
echo $test . "\n";
echo $test->find(105);
$test->remove(1);
echo $test . "\n";
$test->removeIfExists*/
/**
 * 查找元素，存在则删除
 */
//echo $test . "\n";

$test2 = new TestArray(5);
$test2->push(56);
$test2->push(57);
$test2->push(63);
$test2->push(10);
$test2->push(33);

//下面是第六个元素(索引为5)
$test2->push(206);
$test2->push(2333);
$test2->push(666);
$test2->push(1024);
$test2->push(999);
$test2->push(444554);
echo $test2 . "\n";
$test2->removeLast();
echo $test2;
die;