<?php
namespace Datastruct;

interface QueueInterface
{
    /**
     * 入队
     * @param $ele
     * @return mixed
     */
    public function enqueue($ele);

    /**
    * 出队(pop出首个元素)
    */
    public function dequeue();

    /**
    * 获取队列首部元素
    */
    public function getFirst();

    /**
    * 获取队列数据个数
    */
    public function getSize():int;

    /**
    * 获取队列是否为空
	 */
    public function isEmpty():bool;
}