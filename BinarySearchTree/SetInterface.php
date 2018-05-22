<?php
namespace Datastruct\BinarySearchTree;

/**
 * 集合-接口定义
 * Interface SetInterface
 * @package Datastruct\BinarySearchTree
 */
interface SetInterface
{
    /**
     * 添加元素到集合
     * 重复元素不处理
     * @param $ele
     * @return mixed
     */
    public function add($ele);

    /**
     * 移除集合中指定值的元素
     * @param $ele
     * @return mixed
     */
    public function remove($ele);

    /**
     * 判断指定元素是否存在集合中
     * @param $ele
     * @return bool
     */
    public function contains($ele);

    /**
     * 返回集合元素个数
     * @return int
     */
    public function getSize();

    /**
     * 获取集合是否为空
     * @return bool
     */
    public function isEmpty();

}