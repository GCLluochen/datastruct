<?php
namespace Datastruct;

require_once("./autoload.php");

use Datastruct\LoopQueue;

//require_once("./LoopQueue.php");


$lq = new LoopQueue(10);
//print_r($lq);
$lq->enqueue(56);
$lq->enqueue(67);
$lq->enqueue(92);
echo $lq . "\n";
$lq->dequeue();
echo $lq . "\n";
$lq->enqueue(33);
$lq->enqueue(214);
$lq->enqueue(306);
$lq->enqueue(498);
$lq->enqueue(557);
$lq->enqueue(720);
$lq->enqueue(960);
echo "下一次的tail是: \n";
$lq->enqueue(1060);
echo $lq . "\n";
die;
