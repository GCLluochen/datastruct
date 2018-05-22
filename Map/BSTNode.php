<?php
namespace Datastruct\Map;

/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 2018/5/16
 * Time: 13:56
 */

/**
 * 二分搜索树实现Map ——节点类
 */
class BSTNode
{
    //public $data;//当前节点数据
    public $key;//map-key
    public $val;//map-value
    public $left;//左子节点
    public $right;//右子节点

    /**
     * 初始化节点
     * Node constructor.
     * @param $ele
     */
    public function __construct($key, $val)
    {
        $this->key = $key;
        $this->val = $val;
        $this->left = null;
        $this->right = null;
    }

    public function __toString():string
    {
        /* $str = 'Node: ' . $this->data . "  left: {\n    " . $this->left . "\n   }\nright: {\n   " . $this->right . "\n  }";*/
        $str = "Node: " . $this->key . '->' .$this->val;
        return $str;
    }

}