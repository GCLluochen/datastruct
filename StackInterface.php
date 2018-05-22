<?php
namespace Datastruct;

interface StackInterface
{
	/**
	 * 入栈
	 */
	public function push($ele):void;

	/**
	 * 出栈
	 */
	public function pop();

	/**
	 * 查看栈顶元素
	 */
	public function peek();

	/**
	 * 获取栈容量
	 */
	public function getSize():int;

	/**
	 * 检测栈是否为空
	 */
	public function isEmpty():bool;
}