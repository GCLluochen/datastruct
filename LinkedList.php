<?php
namespace Datastruct;

require_once("./autoload.php");
//require_once("./Node.php");

use Datastruct\Node;

/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 2018/5/16
 * Time: 13:56
 */

class LinkedList
{
    //private $head;//链表头节点
    private $size;//链表长度
    //private $dummyHead;//链表虚拟头结点
    public $dummyHead;//链表虚拟头结点——测试 removeElements 函数特殊设置

    public function __construct()
    {
        //$this->head = null;
        $this->dummyHead = new Node(null, null);
        $this->size = 0;
    }

    /**
     * 获取链表长度
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * 判断链表是否为空
     * @return bool
     */
    public function isEmpty()
    {
        return $this->size == 0;
    }

    /**
     * 判断索引是否有效
     * @param int $index
     * @return bool
     */
    public function indexValid(int $index)
    {
        if ($index < 0 || $index > $this->size) {
            throw new \InvalidArgumentException('Illegal index');
        }
        return true;
    }

    /**
     * 插入节点到指定 '索引' 处
     * @param int $index
     * @param $ele
     */
    public function insertTo(int $index, $ele)
    {
        $this->indexValid($index);
        /*if ($index == 0) {
            $this->addFirst($ele);
        }*/
        $prev = $this->dummyHead;
        //遍历链表到要插入位置的前一个节点
        //for ($i = 0; $i < $index - 1; $i++) {
        for ($i = 0; $i < $index; $i++) {
            $prev = $prev->next;
        }
        //创建新节点，新节点的next为 要插入位置前一个节点的 next，然后设置 前一个节点的next 为新节点
        $prev->next = new Node($ele, $prev->next);
        $this->size ++;
    }

    /**
     * 向链表开头添加元素
     * @param $ele
     */
    public function addFirst($ele)
    {
        /*$newNode = new Node($ele);
        $newNode->next = $this->head;
        $this->head = $newNode;

        //以上三句可缩写为
        //$this->head = new Node($ele, $this->head);
        $this->size ++;*/

        $this->insertTo(0, $ele);
    }

    /**
     * 添加元素到链表末尾
     * @param $ele
     */
    public function addLast($ele)
    {
        $this->insertTo($this->size, $ele);
    }

    /**
     * 类的字符串表示
     * @return string
     */
    public function __toString():string
    {
        $str = "LinkedList,  Size: ".$this->size . "\n";
        $cur = $this->dummyHead->next;
        while ($cur != null) {
            $str .= $cur->data . '->';
            $cur = $cur->next;
        }
        $str .= 'NULL' . "\n";
        return $str;
    }

    /**
     * 查找指定位置的元素
     * @param int $index
     * @return mixed
     */
    public function get(int $index)
    {
        $this->indexValid($index);
        $cur = $this->dummyHead->next;
        for ($i = 0; $i < $index; $i++) {
            $cur = $cur->next;
        }
        return $cur->data;
    }

    /**
     * 修改指定位置的链表元素值
     * @param int $index 位置(实际索引+1)
     * @param $ele 新值
     */
    public function set(int $index, $ele)
    {
        $this->indexValid($index);
        $cur = $this->dummyHead->next;
        for ($i = 0; $i < $index; $i++) {
            $cur = $cur->next;
        }
        $cur->data = $ele;
    }

    /**
     * 查找链表是否存在元素
     * @param $ele
     * @return bool
     */
    public function contains($ele):bool
    {
        $cur = $this->dummyHead->next;
        while ($cur != null) {
            if ($cur->data == $ele) {
                return true;
            }
            $cur = $cur->next;
        }
        return false;
    }

    /**
     * 移除指定位置的节点
     * @param int $index
     * @return mixed
     */
    public function remove(int $index)
    {
        $this->indexValid($index);
        $preNode = $this->dummyHead;
        for ($i = 0; $i < $index; $i++) {
            $preNode = $preNode->next;
        }
        $delNode = $preNode->next;//需要移除的节点
        $delData = $delNode->data;//欲删除位置的值
        $preNode->next = $delNode->next;
        $delNode->next = null;
        $this->size--;
        return $delData;
    }

    /**
     * 移除链表首个元素
     * @return mixed
     */
    public function removeFirst()
    {
        return $this->remove(0);
    }

    /**
     * 移除链表最后一个元素
     * @return mixed
     */
    public function removeLast()
    {
        return $this->remove($this->size);
    }

}