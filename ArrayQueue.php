<?php
namespace Datastruct;

require_once("./autoload.php");

/*require_once('./TestArray.php');
require_once('./QueueInterface.php');*/

use Datastruct\TestArray;
use Datastruct\QueueInterface;

/**
 * 数组队列
 */
class ArrayQueue implements QueueInterface
{
	/**
	 * 队列数据项
	 * type: TestArray
	 */
	protected $data;

	public function __construct(?int $capacity)
	{
		$this->data = new TestArray($capacity);
	}

	/**
	 * 入队,从队尾插入
	 */
	public function enqueue($ele)
	{
		$this->data->push($ele);
	}

	/**
	 * 出队，从队首移除
	 */
	public function dequeue()
	{
		return $this->data->removeFirst();
	}

	/**
	 * 获取队列首元素
	 */
	public function getFirst()
	{
		return $this->data->getFirst();
	}

	/**
	 * 获取队列元素个数
	 */
	public function getSize():int
	{
		return $this->data->getSize();
	}

	/**
	 * 获取队列最大长度
	 */
	public function getCapacity():int
	{
		return $this->data->getLength();
	}

	/**
	 * 获取队列是否为空
	 */
	public function isEmpty():bool
	{
		return $this->data->isEmpty();
	}

	/**
     * 打印数组时的格式
     * @return string
     */
    public function __toString():string
    {
        $str = sprintf("Queue Length: %d, Size: %d\n(\n", $this->getCapacity(), $this->getSize());
        for ($i = 0; $i < $this->getSize(); $i++) {
            $str .= '   Front [' . $i . '] => ' . $this->data->get($i);
            if ($i < ($this->getSize() - 1)) {
                $str .= "\n";
            }
        }
        $str .= "\n)";
        return $str;
    }
}