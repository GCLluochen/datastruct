<?php
namespace Datastruct\Heap;

require_once("./../autoload.php");

use Datastruct\Heap\MaxHeap;
use Datastruct\QueueInterface;

/**
 * 优先队列——基于最大堆实现
 * Class PriorityQueue
 * @package Datastruct\Map
 */
class PriorityQueue implements QueueInterface
{
    //MaxHeap
    protected $maxHeap;

    public function __construct($capacity = 0)
    {
        $this->maxHeap = new MaxHeap($capacity);
    }

    /**
     * 入队
     * @param $ele
     * @return mixed
     */
    public function enqueue($ele)
    {
        $this->maxHeap->add($ele);
    }

    /**
     * 出队(pop出首个元素)
     */
    public function dequeue()
    {
        return $this->maxHeap->extractMax();
    }

    /**
     * 获取队列首部元素
     * 即最大堆的根节点
     */
    public function getFirst()
    {
        return $this->maxHeap->findMax();
    }

    /**
     * 获取队列数据个数
     */
    public function getSize():int
    {
        return $this->maxHeap->getSize();
    }

    /**
     * 获取队列是否为空
     */
    public function isEmpty():bool
    {
        return $this->maxHeap->isEmpty();
    }
}