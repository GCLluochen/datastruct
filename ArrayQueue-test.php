<?php
namespace Datastruct;

require_once("./autoload.php");

use Datastruct\ArrayQueue;

//require_once('./ArrayQueue.php');

$aq = new ArrayQueue(5);
$aq->enqueue(65);
$aq->enqueue(99);
$aq->enqueue(104);
echo $aq . "\n";
echo "队列首个元素为: " . $aq->getFirst() . "\n";
$aq->dequeue();
echo $aq . "\n";
die;