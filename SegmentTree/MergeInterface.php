<?php
namespace Datastruct\SegmentTree;

/**
 * 线段树数据合并接口
 * Interface MergeInterface
 * @package Datastruct\SegmentTree
 */
interface MergeInterface
{
    public function merge($l, $r);
}