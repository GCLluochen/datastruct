<?php
namespace Datastruct;

require_once("./autoload.php");

use Datastruct\QueueInterface;
use Datastruct\Node;

/**
 * 链表队列
 * Class LinkedListQueue
 * @package Datastruct
 */
class LinkedListQueue implements QueueInterface
{
    private $head;//队列头节点
    private $tail;//队列尾节点
    private $size;//队列长度

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
        $this->size = 0;
    }

    /**
     * 入队
     * @param Node $ele
     * @return bool
     */
    public function enqueue($ele)
    {
        //如果尾节点为空
        if ($this->tail == null) {
            $this->tail = new Node($ele);
            $this->head = $this->tail;
        } else {
            //初始化新节点,tail的next指向新节点, 然后设置tail为新节点
            $this->tail->next = new Node($ele);
            $this->tail = $this->tail->next;
        }
        $this->size++;
        return true;
    }

    /**
     * 出队
     * @return mixed
     */
    public function dequeue()
    {
        if ($this->head == null) {
            throw new \RuntimeException('链表为空,无法出队');
        }
        $delNode = $this->head;
        //将头节点指向下一个节点
        $this->head = $this->head->next;
        //如果重新指向后的头节点为空,则队列为空
        if ($this->head == null) {
            $this->tail = null;
        }
        $this->size --;
        return $delNode->data;
    }

    /**
     * 查看链表队列队首元素
     */
    public function getFirst()
    {
        if ($this->isEmpty()) {
            throw new \RuntimeException('队列为空');
        }
        return $this->head->data;
    }

    /**
     * 获取链表队列长度
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * 判断链表队列是否为空
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->size == 0;
    }

    /**
     * 打印数组时的格式
     * @return string
     */
    public function __toString():string
    {
        $str = sprintf("LinkedQueue Size: %d\n(\nHead", $this->getSize(), $this->getSize());
        $curNode = $this->head;
        while ($curNode != null) {
            $str .= '   ' . $curNode->data . ' -> ';
            $curNode = $curNode->next;
        }
        $str .= "\n)";
        return $str;
    }
}