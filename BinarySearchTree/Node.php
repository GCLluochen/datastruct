<?php
namespace Datastruct\BinarySearchTree;

/**
 * 二分搜索树的节点类
 */
class Node
{
    public $data;
    //Node--左节点
    public $left;
    //Node--右节点
    public $right;

    /**
     * 初始化节点
     * Node constructor.
     * @param $ele
     */
    public function __construct($ele)
    {
        $this->data = $ele;
        $this->left = null;
        $this->right = null;
    }

    public function __toString():string
    {
       /* $str = 'Node: ' . $this->data . "  left: {\n    " . $this->left . "\n   }\nright: {\n   " . $this->right . "\n  }";*/
       $str = "Node: " . $this->data;
        return $str;
    }
}