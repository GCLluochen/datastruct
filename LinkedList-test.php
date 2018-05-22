<?php
namespace Datastruct;

require_once("./autoload.php");

use Datastruct\Node;
use Datastruct\LinkedList;

/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 2018/5/16
 * Time: 15:18
 */
/**
 * 链表——测试
 */

//require_once("./LinkedList.php");

/**
 * 移除指定链表中值为 ele 的全部节点
 * @param \Datastruct\Node $head 链表头结点
 * @param $ele 元素值
 */
/*function removeElements(Node $head, $ele)
{
    //如果头节点非空且值等于要删除的值
    //循环删除链表开始部分值为 要删除的值 的节点
    while ($head != null && $head->data == $ele) {
        $delNode = $head;
        $head = $head->next;
        $delNode->next = null;
    }
    //判断当前头节点是否为空
    if ($head == null) {
        return null;
    }

    $preNode = $head;
    while ($preNode->next != null) {
        if ($preNode->next->data == $ele) {
            $delNode = $preNode->next;
            $preNode->next = $delNode->next;
            $delNode->next == null;
        } else {
            $preNode = $preNode->next;
        }
    }
    return $head;
}*/


/**
 * 递归删除链表中指定值的节点
 * 如果当前节点的值不等于要删除的值，则返回当前节点和删除了指定值的 之后节点
 * 如果相等，直接返回删除了指定值的 之后节点
 * @param \Datastruct\Node|null $curHead
 * @param $ele
 * @return \Datastruct\Node|null
 */
function removeElements(?Node $curHead, $ele, $depth)
{
    echo generateDepthString($depth);
    echo 'Call: remove ' . $ele . ' in ' . $curHead;

    //判断当前是否已到尾节点的next ( null )
    if ($curHead == null) {
        echo "\n" . generateDepthString($depth);
        echo 'Return : ' . $curHead . "\n";

        return null;
    }
    /*if ($curHead->next == null) {
        var_dump($curHead);die;
    }*/

    //删除头节点之后节点中值为 ele 的节点
    $partNode = removeElements($curHead->next, $ele, $depth+1);

    echo generateDepthString($depth);
    echo "After remove: " . $ele , ' in ' . $partNode;

    if ($curHead->data == $ele) {
        //如果当前节点的 data == $ele
        //直接返回当前节点之后已移除 $ele 的链表的"头节点"
        return $partNode;
    } else {
        //如果当前节点的 data != $ele
        //将当前节点之后已删除了值为 $ele 的 "头节点" 链接到当前节点之后
        $curHead->next = $partNode;
        return $curHead;
    }
}

function generateDepthString($depth)
{
    $str = '';
    for ($i = 0; $i < $depth; $i++) {
        $str .= '--';
    }
    return $str;
}


$link = new LinkedList();
for ($i = 1; $i < 30; $i += 3) {
    $link->addLast($i);
}
echo $link . "\n";
$link->addFirst(208);
$link->addFirst(208);
echo $link . "\n";
$link->set(5, 208);
echo $link . "\n";
/*
$link->insertTo(5, 222);
echo $link . "<br/>";

$link->remove(2);
echo $link . "<br/>";

$link->removeFirst();
echo $link . "<br/>";*/

$link->dummyHead->next = removeElements($link->dummyHead->next, 208, 0);
echo $link;
die;
