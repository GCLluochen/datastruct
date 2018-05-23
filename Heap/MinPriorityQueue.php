<?php
namespace Datastruct\Heap;

require_once("./../autoload.php");

use Datastruct\Heap\MinHeap;
use Datastruct\QueueInterface;

/**
 * 优先队列——基于最小堆实现
 * Class MinPriorityQueue
 * @package Datastruct\Map
 */
class MinPriorityQueue implements QueueInterface
{
    //MinHeap
    public $minHeap;

    public function __construct($capacity = 0)
    {
        $this->minHeap = new MinHeap($capacity);
    }

    /**
     * 入队
     * @param $ele
     * @return mixed
     */
    public function enqueue($ele)
    {
        $this->minHeap->add($ele);
    }

    /**
     * 出队(pop出首个元素)
     */
    public function dequeue()
    {
        return $this->minHeap->extractMin();
    }

    /**
     * 获取队列首部元素
     * 即最大堆的根节点
     */
    public function getFirst()
    {
        return $this->minHeap->findMin();
    }

    /**
     * 获取队列数据个数
     */
    public function getSize():int
    {
        return $this->minHeap->getSize();
    }

    /**
     * 获取队列是否为空
     */
    public function isEmpty():bool
    {
        return $this->minHeap->isEmpty();
    }
}