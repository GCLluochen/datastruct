<?php
namespace Datastruct\SegmentTree;

require_once("./../autoload.php");

use Datastruct\SegmentTree\SegmentTree;
use Datastruct\SegmentTree\MergeInterface;

$mergeFunc = new class implements MergeInterface {
    public function merge($l, $r)
    {
        //返回左右子树之和
        return $l + $r;
    }
};
$testArr = [5, 9, 13, 22, 47, 115, 1024];
$segTree = new SegmentTree($testArr, $mergeFunc);
print_r($segTree->tree);
print $segTree;
//查找指定区间的值
echo $segTree->query(2, 4);
die;
