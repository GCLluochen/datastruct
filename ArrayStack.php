<?php
namespace Datastruct;

require_once("./autoload.php");


use Datastruct\TestArray;
use Datastruct\StackInterface;

/*require_once('./TestArray.php');
require_once('./StackInterface.php');*/

class ArrayStack implements StackInterface
{
	//$data: type TestArray
	protected $data;

	public function __construct(int $capacity = 1)
	{
		//采用动态数组 TestArray 作为栈的存储类型
		$this->data = new TestArray($capacity);
	}
	
	/**
	 *入栈
	 */
	public function push($ele):void
	{
		$this->data->push($ele);
	}

	/**
	 *出栈
	 */
	public function pop()
	{
		return $this->data->removeLast();
	}

	/**
	 * 获取栈顶元素
	 */
	public function peek()
	{
		return $this->data->getLast();
	}

	/**
	 * 获取栈是否为空
	 */
	public function isEmpty():bool
	{
		return $this->data->isEmpty();
	}

	/**
	 * 获取栈容量
	 */
	public function getLength():int
	{
		return $this->data->getLength();
	}

	public function getSize():int
	{
		return $this->data->getSize();
	}

	/**
     * 打印数组时的格式
     * @return string
     */
    public function __toString():string
    {
        $str = sprintf("Array Length: %d, Size: %d\n(\n", $this->data->getLength(), $this->data->getSize());
        for ($i = 0; $i < $this->data->getSize(); $i++) {
            $str .= '   [' . $i . '] => ' . $this->data->get($i);
            if ($i < ($this->data->getSize() - 1)) {
                $str .= "\n";
            }
        }
        $str .= "  top \n)";
        return $str;
    }

}