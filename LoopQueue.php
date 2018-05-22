<?php
namespace Datastruct;

require_once("./autoload.php");

use Datastruct\TestArray;
use Datastruct\StackInterface;
use Datastruct\QueueInterface;

/*require_once('./TestArray.php');
require_once('./QueueInterface.php');*/

/**
 * 循环队列
 */
class LoopQueue implements QueueInterface
{
	/**
	 * 队列数据项
	 * type: TestArray
	 */
	protected $data;
	public $front;
    public $tail;
    public $size;
    public $capacity;

	public function __construct(?int $capacity)
	{
	    //初始化
		$this->data = [];
		$this->front = 0;
		//初始化队列尾部的位置
		$this->tail = 0;
		$this->size = 0;
		//数组总长度为期望长度+1(循环队列中需要有一个空占位)
		$this->capacity = $capacity + 1;
	}

	/**
	 * 入队,从队尾插入
	 */
	public function enqueue($ele)
	{
	    //判断数组是否已满，已满则扩容
        if ($this->isFull()) {
            $this->resize($this->getCapacity() * 2);
        }
        $this->data[$this->tail] = $ele;
        //设置队列尾部索引值
        $this->tail = ($this->tail + 1) % $this->capacity;
        //元素个数自增
        $this->size++;
	}

	/**
	 * 出队，从队首移除
	 */
	public function dequeue()
	{
        if ($this->isEmpty()) {
            throw new \InvalidArgumentException('无法出队: 队列为空');
        }
        $frontData = $this->data[$this->front];
        $this->data[$this->front] = null;//将当前队列首个元素置空
        $this->front = ($this->front + 1) % $this->capacity;//队首后移
        $this->size --;//队列长度自减

        //判断是否需要缩减队列总长度
        if ($this->size == ceil($this->capacity / 4) && $this->capacity / 2 != 0) {
            $this->resize(ceil($this->capacity / 2));
        }
        return $frontData;
	}

    /**
     * 获取队列首元素
     * 即 front 索引处的元素
     * @return mixed
     */
	public function getFirst()
	{
	    if ($this->isEmpty()){
	        throw new \InvalidArgumentException('队列为空');
        }
		return $this->data[$this->front];
	}

    /**
     * 获取队列元素个数
     * @return int
     */
	public function getSize():int
	{
		return $this->size;
	}

    /**
     * 获取队列容量
     * 实际可使用容量需要 - 1
     * @return int
     */
	public function getCapacity():int
	{
		return $this->capacity - 1;
	}

    /**
     * 获取队列是否为空
     * 判断 front 是否等于 tail 即可
     * @return bool
     */
	public function isEmpty():bool
	{
		return $this->front == $this->tail;
	}

    /**
     * 判断队列是否已满
     * @return bool
     */
	protected function isFull():bool
    {
        return (($this->tail + 1) % $this->getCapacity() == $this->front);
    }

    /**
     * 队列扩容
     * @param int $newCapacity 新的容量
     */
    private function resize(int $newCapacity)
    {
        $newData = [];
        for ($i = 0; $i < $this->size;$i ++) {
            $newData[$i] = $this->data[($this->front + $i) % $this->capacity];
        }
        $this->data = $newData;
        $this->capacity = $newCapacity + 1;
        $this->front = 0;
        $this->tail = $this->size;
    }

	/**
     * 打印数组时的格式
     * @return string
     */
    public function __toString():string
    {
        $str = sprintf("Queue Length: %d, Size: %d Front \n(\n", $this->getCapacity(), $this->getSize());
        for ($i = $this->front; $i != $this->tail; $i = ($i + 1) % $this->capacity) {
            $str .= '   [' . $i . '] => ' . $this->data[$i];
            if (($i + 1) % $this->capacity != $this->tail) {
                $str .= "\n";
            }
        }
        $str .= "\n) tail";
        return $str;
    }
}