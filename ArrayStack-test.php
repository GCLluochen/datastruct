<?php
namespace Datastruct;

require_once("./autoload.php");
//require_once('./ArrayStack.php');

use Datastruct\ArrayStack;

/*$as = new ArrayStack(5);
$as->push(65);
$as->push(99);
$as->push(104);
//echo $as . "\n";
$as->pop();
echo $as . "\n";
$as->push(333);
$as->push(666);
$as->push(1024);
echo $as . "\n";
$as->push(97);
echo $as . "\n";

echo "栈顶元素为: " . $as->peek() . "\n";
die;*/


/* 有序的括号-练习 */
$testStr = '{[()]}';
function testParenValid (string $testStr) {
	$parenArr = new ArrayStack(strlen($testStr));
	for ($i = 0;$i < strlen($testStr);$i++) {
		$curChar = $testStr[$i];
		if (in_array($curChar, ['(', '[', '{'])) {
			//如果为左括号,则入栈
			$parenArr->push($curChar);
			//echo $parenArr . "\n";
		} else {
			//如果为右括号，则判断是否与栈顶的符号匹配
			if ($parenArr->isEmpty()) {
				echo '栈为空' . "\n";
				exit(0);
			}
			$topStack = $parenArr->pop();
			if ($curChar == ')' && $topStack != '(') {
				return false;
			} elseif ($curChar == ']' && $topStack != '[') {
				return false;
			} elseif ($curChar == '}' && $topStack != '{') {
				return false;
			}
		}
	}
	return $parenArr->isEmpty();
}

$res = testParenValid($testStr);
var_dump($res);
die;