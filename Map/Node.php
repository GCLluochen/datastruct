<?php
namespace Datastruct\Map;

/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 2018/5/16
 * Time: 13:56
 */

/**
 * 链表实现Map ——节点类
 */
class Node
{
    //public $data;//当前节点数据
    public $key;//map-key
    public $val;//map-value
    public $next;//下一节点的引用

    public function __construct($key, $val, Node $next = null)
    {
        $this->key = $key;
        $this->val = $val;
        $this->next = null;
        if ($next) {
            $this->next = $next;
        }
    }

    /**
     * 打印节点
     * @return string
     */
    public function __toString():string
    {
        /*$str = 'Node:' . "\n";
        $str .= "data: " . $this->data . "-----next: " . $this->next;
        return $str;*/

        $str = '';
        /*$cur = $this;
        while ($cur != null) {
            $str .= $cur->key . ' : ' . $cur->val . '->';
            $cur = $cur->next;
        }*/
        return $str;
    }
}