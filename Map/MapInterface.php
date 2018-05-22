<?php
namespace Datastruct\Map;


/**
 * LinkedListMap 接口
 * Interface MapInterface
 * @package Datastruct
 */
interface MapInterface
{
    /**
     * 向map添加元素
     * @param $key
     * @param $val
     * @return mixed
     */
    public function add($key, $val);

    /**
     * 删除map指定key的元素
     * @param $key
     * @return mixed
     */
    public function remove($key);

    /**
     * 获取map中指定key的元素
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * 修改map中指定key的元素值
     * @param $key
     * @param $newVal
     * @return mixed
     */
    public function set($key, $newVal);

    /**
     * 判断map中是否存在key为指定key的元素
     * @param $key
     * @return mixed
     */
    public function contains($key);

    /**
     * 获取map元素个数
     * @return int
     */
    public function getSize():int;

    /**
     * 获取map是否为空
     * @return bool
     */
    public function isEmpty():bool;
}