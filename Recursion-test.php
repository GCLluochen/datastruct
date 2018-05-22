<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 2018/5/18
 * Time: 13:42
 */

//递归测试

/**
 * 统计数组从指定处向后的所有元素值之和
 * @param array $arr 数组
 * @param int $leftStart 指定从何处开始向后统计
 */
function sum(array $arr, int $leftStart)
{
    if ($leftStart == count($arr)) {
        return 0;
    }
    return ($arr[$leftStart] + sum($arr, $leftStart + 1));
}
$arr = [5, 9, 13, 68, 112, 425, 888];
$total = sum($arr, 0);
//步骤分解
//1. sum ($arr, 0)
//2. $arr[0] + sum($arr, 1)
//3. $$arr[0] + ($arr[1] + sum($arr, 2))
//4. $$arr[0] + ($arr[1] + $arr[2] + sum($arr, 3))
//5. $$arr[0] + ($arr[1] + $arr[2] + $arr[3] + sum($arr, 4))
//6. $$arr[0] + ($arr[1] + $arr[2] + $arr[3] + $arr[4] + sum($arr, 5))
//7. $$arr[0] + ($arr[1] + $arr[2] + $arr[3] + $arr[4] + $arr[5] + sum($arr, 6))
//8. $$arr[0] + ($arr[1] + $arr[2] + $arr[3] + $arr[4] + $arr[5] + $arr[6] + sum($arr, 7))
//sum($arr, 7)  => 7 == count($arr)  =>  0
//5+9+13+68+112+425+888
echo $total . "\narray_sum: " .array_sum($arr). "\n";
