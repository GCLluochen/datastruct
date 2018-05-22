<?php
namespace Datastruct\Map;

require_once("./autoload.php");

use Datastruct\Map\Node;

/**
 * 用以实现 Map 的链表
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
        //初始化虚拟头结点
        $this->dummyHead = new Node(null, null, null);
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
     * 根据key查找节点
     * @param $key
     */
    public function getNode($key)
    {
        $cur = $this->dummyHead->next;
        while ($cur != null) {
            if ($cur->key == $key) {
                return $cur;
            }
            $cur = $cur->next;
        }
        return null;
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
     * 向链表开头添加元素
     * @param $key 要添加的key
     * @param $val 要添加的val
     */
    public function add($key, $val)
    {
        $hasNode = $this->getNode($key);
        if (!$hasNode) {
            $this->dummyHead->next = new Node($key, $val, $this->dummyHead->next);
            $this->size ++;
        } else {
            //节点已存在,更新为新值
            $hasNode->val = $val;
            //$this->set($key, $val);
        }
    }

    /**
     * 类的字符串表示
     * @return string
     */
    public function __toString():string
    {
        $str = '';//"LinkedList,  Size: ".$this->size . "\n";
        $cur = $this->dummyHead->next;
        while ($cur != null) {
            $str .= $cur->key . ':' . $cur->val . '  ->  ';
            $cur = $cur->next;
        }
        $str .= "\n";
        return $str;
    }

    /**
     * 查找指定key的元素
     * @param int $key
     * @return mixed
     */
    public function get($key)
    {
        //$this->indexValid($key);
        $cur = $this->dummyHead->next;

        while ($cur != null) {
            if ($cur->key == $key) {
                return $cur->val;
            }
            $cur = $cur->next;
        }
        return null;
    }

    /**
     * 修改指定key的链表元素值
     * @param int $key 指定key
     * @param $val 新值
     */
    public function set($key, $val)
    {
        $setNode = $this->getNode($key);
        if ($setNode) {
            $setNode->val = $val;
        } else {
            throw new \InvalidArgumentException('Key not exists!');
        }
    }

    /**
     * 查找链表是否存在key
     * @param $key
     * @return bool
     */
    public function contains($key):bool
    {
        $setNode = $this->getNode($key);
        return $setNode != null;
    }

    /**
     * 移除指定 key 的节点
     * @param int $key 要移除的key
     * @return mixed
     */
    public function remove($key)
    {
        $prevNode = $this->dummyHead;
        while ($prevNode->next != null) {
            if ($prevNode->next->key == $key) {
                break;
            }
            $prevNode = $prevNode->next;
        }
        if ($prevNode != null) {
            $delNode = $prevNode->next;//需要移除的节点
            $delData = $delNode->val;//欲删除位置的值
            $prevNode->next = $delNode->next;
            $delNode->next = null;
            $this->size--;
            return $delData;
        }
        return null;
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