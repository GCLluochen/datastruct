<?php
namespace Datastruct\Map;

require_once("./autoload.php");

use Datastruct\Map\LinkedList;
use Datastruct\Map\MapInterface;

/**
 * LinkedListMap-链表实现
 * Class LinkedListMap
 * @package Datastruct
 */
class LinkedListMap implements MapInterface
{
    //LinkedList
    protected $llmap;

    public function __construct()
    {
        $this->llmap = new LinkedList();
    }

    /**
     * 向map添加元素
     * @param $key
     * @param $val
     * @return mixed
     */
    public function add($key, $val)
    {
        $this->llmap->add($key, $val);
    }

    /**
     * 删除map指定key的元素
     * @param $key
     * @return mixed
     */
    public function remove($key)
    {
        return $this->llmap->remove($key);
    }

    /**
     * 获取map中指定key的元素
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->llmap->get($key);
    }

    /**
     * 修改map中指定key的元素值
     * @param $key
     * @param $newVal
     * @return mixed
     */
    public function set($key, $newVal)
    {
        $this->llmap->set($key, $newVal);
    }

    /**
     * 判断map中是否存在key为指定key的元素
     * @param $key
     * @return mixed
     */
    public function contains($key)
    {
        return $this->llmap->contains($key);
    }

    /**
     * 获取map元素个数
     * @return int
     */
    public function getSize():int
    {
        return $this->llmap->getSize();
    }

    /**
     * 获取map是否为空
     * @return bool
     */
    public function isEmpty():bool
    {
        return $this->llmap->isEmpty();
    }

    public function __toString()
    {
        $str = '' . $this->llmap;
        return $str;
    }

}
