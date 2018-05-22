<?php
namespace Datastruct;

/**
 * 链表队列-测试
 */
require_once("./autoload.php");

use Datastruct\LinkedListQueue;

$llq = new LinkedListQueue();
$llq->enqueue(10);
$llq->enqueue(33);
$llq->enqueue(104);
$llq->enqueue(2156);
$llq->enqueue(3017);
echo $llq . "\n";
$llq->dequeue();
echo $llq . "\n";
$llq->enqueue(5173);
$llq->enqueue(8848);
echo $llq . "\n";
