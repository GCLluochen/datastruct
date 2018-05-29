<?php
namespace Datastruct\AVL;

/**
 * 平衡二叉树的节点
 */
class Node
{
    public $data;
    //Node--左节点
    public $left;
    //Node--右节点
    public $right;
    //当前节点高度(左右子树高度的最大值)
    public $nodeHeight;
    //当前节点平衡因子(左右子树高度差)
    public $balanFac;

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
        $this->nodeHeight = 1;//新加节点默认高度为1
    }

    public function __toString():string
    {
       /* $str = 'Node: ' . $this->data . "  left: {\n    " . $this->left . "\n   }\nright: {\n   " . $this->right . "\n  }";*/
       $str = "Node: " . $this->data;
        return $str;
    }
}