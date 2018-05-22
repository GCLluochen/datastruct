<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 2018/5/16
 * Time: 11:24
 */
namespace Datastruct;

/**
 * 普通队列 和 循环队列的性能测试
 */
require_once("./autoload.php");

use Datastruct\QueueInterface;
use Datastruct\ArrayQueue;
use Datastruct\LoopQueue;
use Datastruct\StackInterface;
use Datastruct\ArrayStack;
use Datastruct\LinkedListStack;
use Datastruct\Node;
use Datastruct\LinkedListQueue;

/*require_once("./QueueInterface.php");
require_once("./ArrayQueue.php");
require_once("./LoopQueue.php");
require_once("./StackInterface.php");
require_once("./ArrayStack.php");
require_once("./LinkedListStack.php");*/

/**
 * 队列—性能测试(数组队列 + 循环队列 + 链表队列)
 * @param QueueInterface $queue 队列类型
 * @param int $totalRun 运行次数
 * @return float 执行微秒 数
 */
function testQueue(QueueInterface $queue, int $totalRun):float
{
    //开始时间——微秒
    $startTime = microtime(true) * 1000;
    //依次入队
    for ($i = 0; $i < $totalRun; $i++) {
        $queue->enqueue($i + 1);
    }

    //依次出队
    for ($i = 0; $i < $totalRun; $i++) {
        $queue->dequeue();
    }
    //结束时间——微秒
    $endTime = microtime(true) * 1000;
    return floatval($endTime - $startTime);
}

$runTimes = 400000;
/*$res = testQueue(new ArrayQueue($runTimes), $runTimes);
echo 'ArrayQueue: ' . $res . "\n";//27930微秒*/

$res = testQueue(new LoopQueue($runTimes), $runTimes);
echo 'LoopQueue: ' . $res . "\n";//17.9111微秒

$res = testQueue(new LinkedListQueue(), $runTimes);
echo 'LinkedListQueue: ' . $res . "\n";//15.0678


/**
 * 栈——性能测试(数组栈 + 链表栈)
 * @param StackInterface $queue
 * @param int $totalRun
 * @return float 执行微秒 数
 */
/*function testStack(StackInterface $queue, int $totalRun):float
{
    //开始时间——微秒
    $startTime = microtime(true) * 1000;
    //依次入队
    for ($i = 0; $i < $totalRun; $i++) {
        $queue->push($i + 1);
    }

    //依次出队
    for ($i = 0; $i < $totalRun; $i++) {
        $queue->pop();
    }
    //结束时间——微秒
    $endTime = microtime(true) * 1000;
    return floatval($endTime - $startTime);
}

$runTimes = 400000;
$res = testStack(new ArrayStack($runTimes), $runTimes);
echo 'ArrayStack: ' . $res . "\n";//27.930秒

$res = testStack(new LinkedListStack(), $runTimes);
echo 'LinkedListStack: ' . $res . "\n";//17.9111微秒*/


die;
