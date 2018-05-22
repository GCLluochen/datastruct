<?php
namespace Datastruct;

require_once(__DIR__ . "/autoload.php");

use Datastruct\LinkedListStack;

/*require_once('./LinkedListStack.php');*/

$as = new LinkedListStack();
$as->push(65);
$as->push(99);
$as->push(104);
echo $as . "\n";
$as->pop();
echo $as . "\n";
$as->push(333);
$as->push(666);
$as->push(1024);
echo $as . "\n";
$as->push(97);
echo $as . "\n";

echo "栈顶元素为: " . $as->peek() . "\n";
die;
