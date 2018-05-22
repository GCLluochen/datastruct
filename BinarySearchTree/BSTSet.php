<?php
namespace Datastruct\BinarySearchTree;

require_once("./../autoload.php");

use Datastruct\BinarySearchTree\BinarySearchTreee;
use Datastruct\BinarySearchTree\SetInterface;
//require_once("./BinarySearchTree.php");
//require_once("./SetInterface.php");

/**
 * 集合——二分搜索树实现
 * Class BSTSet
 * @package Datastruct\BinarySearchTree
 */
class BSTSet implements SetInterface
{
    //BinarySearchTree
    protected $bst;

    public function __construct()
    {
        $this->bst = new BinarySearchTree();
    }

    /**
     * 添加元素到集合中
     * @param $ele
     */
    public function add($ele)
    {
        $this->bst->add($ele);
    }

    /**
     * 从集合中删除元素
     * @param $ele
     */
    public function remove($ele)
    {
        return $this->bst->remove($ele);
    }

    /**
     * 获取集合元素个数
     * @return int
     */
    public function getSize()
    {
        return $this->bst->getLength();
    }


    /**
     * 判断集合是否为空
     * @return bool
     */
    public function isEmpty()
    {
        return $this->bst->isEmpty();
    }

    /**
     * 查找集合中是否存在指定元素
     * @param $ele
     * @return bool
     */
    public function contains($ele)
    {
        return $this->bst->contains($ele);
    }


}