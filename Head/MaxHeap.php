<?php
namespace Datastruct\Heap;

require_once("./../autoload.php");

use Datastruct\TestArray;

/**
 * 最大堆
 * Class MaxHeap
 * @package Datastruct\Heap
 */
class MaxHeap
{
    //TestArray
    protected $data;

    public function __construct($capacity = 0)
    {
        $this->data = new TestArray($capacity);
    }

    /**
     * 获取堆中元素个数
     * @return int
     */
    public function getSize():int
    {
        return $this->data->getSize();
    }

    /**
     * 获取 堆 是否为空
     * @return bool
     */
    public function isEmpty():bool
    {
        return $this->getSize() == 0;
    }

    /**
     * 获取指定索引所在节点的父节点索引
     * 索引从 0 开始
     * (索引值 - 1) / 2
     * @param $index
     */
    public function getParent(int $index)
    {
        if ($index == 0) {
            throw new \InvalidArgumentException('Index 0 has no parent!');
        }
        return ($index - 1) / 2;
    }

    /**
     * 获取指定索引的左子节点
     * 索引从 0 开始
     * (索引值 * 2) + 1
     * @param $index
     */
    public function getLeftChild(int $index)
    {
        return $index * 1 + 1;
    }

    /**
     * 获取指定索引的右子节点
     * 索引从 0 开始
     * (索引值 * 2) + 2
     * @param $index
     */
    public function getRightChild(int $index)
    {
        return $index * 1 + 2;
    }

}