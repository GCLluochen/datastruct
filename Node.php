<?php
namespace Datastruct;

/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 2018/5/16
 * Time: 13:56
 */

/**
 * 链表——节点类
 */
class Node
{
    public $data;//当前节点数据
    public $next;//下一节点的引用

    public function __construct($newData, Node $next = null)
    {
        $this->data = $newData;
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
        $cur = $this;
        while ($cur != null) {
            $str .= $cur->data . '->';
            $cur = $cur->next;
        }
        $str .= 'NULL' . "\n";
        return $str;
    }
}