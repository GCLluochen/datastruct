<?php
namespace Datastruct;

require_once('./autoload.php');

use Datastruct\TestArray;
use Datastruct\StackInterface;

/*require_once('./StackInterface.php');
require_once('./LinkedList.php');*/

/**
 * 链表实现的 栈
 * Class LinkedListStack
 * @package Datastruct
 */
class LinkedListStack implements StackInterface
{
    protected $list;
    public function __construct()
    {
        $this->list = new LinkedList();
    }

    /**
     * 入栈
     */
    public function push($ele):void
    {
        //向链表的表头插入元素
        $this->list->addFirst($ele);
    }

    /**
     * 出栈
     */
    public function pop()
    {
        //移除链表的表头元素
        return $this->list->removeFirst();
    }

    /**
     * 查看栈顶元素
     */
    public function peek()
    {
        return $this->list->get(0);
    }

    /**
     * 获取栈容量
     */
    public function getSize():int
    {
        return $this->list->getSize();
    }

    /**
     * 检测栈是否为空
     */
    public function isEmpty():bool
    {
        return $this->list->isEmpty();
    }

    /**
     * 类的字符串表示
     * @return string
     */
    public function __toString():string
    {
        $str = "Stack  top: \n";
        $str .= $this->list . "\n";
        return $str;
    }
}
