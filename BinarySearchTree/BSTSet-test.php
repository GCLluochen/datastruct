<?php
namespace Datastruct\BinarySearchTree;

require_once("./../autoload.php");
/*require_once("./BSTSet.php");
require_once("./LinkedListSet.php");
require_once("./../LinkedList.php");
require_once("./../TestArray.php");*/

use Datastruct\BinarySearchTree\BSTSet;
use Datastruct\BinarySearchTree\LinkedListSet;
use Datastruct\TestArray;

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

//读取文件内容，将每个单词放入数组中
/*$fp = fopen($filePath, 'r');
while (!feof($fp)) {
    $tmpStr = fgets($fp, 1024);

}*/

//二分搜索树实现的集合
$newBst = new BSTSet();
for ($i = 0; $i < $tarr->getSize(); $i++) {
    $newBst->add($tarr->get($i));
}
echo "BSTSet--Subway: \n different words: " . $newBst->getSize() . "\n";

//链表实现的集合
$newList = new LinkedListSet();
for ($i = 0; $i < $tarr->getSize(); $i++) {
    $newList->add($tarr->get($i));
}
echo "LinkedListSet--Subway: \n different words: " . $newList->getSize() . "\n";
die;
