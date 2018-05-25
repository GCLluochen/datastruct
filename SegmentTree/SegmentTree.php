<?php
namespace Datastruct\SegmentTree;

require_once("./../autoload.php");

use Datastruct\TestArray;
use Datastruct\SegmentTree\MergeInterface;

/**
 * 线段树--基于动态数组
 * Class SegmentTree
 * @package Datastruct\SegmentTree
 */
class SegmentTree
{
    //实际存储数据的树结构 数组
    public $tree;
    //TestArray
    protected $data;
    //合并操作实现的类 MergeInterface
    public $merge;


    public function __construct(array $arr, MergeInterface $merge)
    {
        $arrLen = count($arr);
        $this->data = new TestArray($arrLen);
        for ($i = 0; $i < $arrLen; $i++) {
            $this->data->push($arr[$i]);
        }

        //线段树的长度最大为 数据个数 * 4
        $treeLen = intval(4 * $arrLen);
        $this->tree = [];//new TestArray($treeLen);
        for ($i = 0; $i < $treeLen; $i++) {
            $this->tree[$i] = null;
        }
        $this->merge = $merge;//初始化合并类

        //构造区间树
        $this->buildSegmentTree(0, 0, $this->getSize() - 1);
    }

    /**
     * 构造以 $treeIndex 为根,从 $leftStart 到 $rightEnd 之间数据的线段树
     * @param int $treeIndex 要构造的线段树的根节点位置
     * @param int $leftStart 要构造的线段树的左边界
     * @param int $rightEnd 要构造的线段树的右边界
     * @param MergeInterface $merge 左右子树的合并操作
     */
    protected function buildSegmentTree(int $treeIndex, int $leftStart, int $rightEnd)
    {
        //print 'index: ' . $treeIndex .'--leftStart: ' . $leftStart . '--rightEnd: ' . $rightEnd ."\n";
        //如果当前线段树只有一个节点
        if ($leftStart == $rightEnd) {
            //echo $treeIndex . '---' . $this->data->get($leftStart) . "\n";
            if ($leftStart >=0 && $leftStart < $this->data->getSize()) {
                $this->tree[$treeIndex] = $this->data->get($leftStart);
            }
            return;
        }

        //如果有多个节点,则分别构造该节点的左右子树
        $leftChild = $this->leftChild($treeIndex);
        $rightChild = $this->rightChild($treeIndex);

        //print 'index: ' . $treeIndex .'--leftChild: ' . $leftChild . '--rightChild: ' . $rightChild ."\n";

        //计算左右子树的分界点
        $mid = $leftStart + ($rightEnd - $leftStart) / 2;

        //构造左子树
        $this->buildSegmentTree($leftChild, $leftStart, $mid);
        //构造右子树
        $this->buildSegmentTree($rightChild, $mid + 1, $rightEnd);

        //根据业务逻辑决定线段树的节点需要存储何种类型的数据
        //此处以求 指定区间的数据之和 为例
        $this->tree[$treeIndex] = $this->merge->merge($this->tree[$leftChild], $this->tree[$rightChild]);
        //通过 Merge 接口的自定义实现 来执行左右子树的合并

//        print $treeIndex . "\n";
//        print $this->tree->get($leftChild) . '---' . $this->tree->get($rightChild) . "\n";


        //$this->tree->set($treeIndex, $this->merge->merge($this->tree->get($leftChild), $this->tree->get($rightChild)));
    }

    /**
     * 检测索引值是否不合理
     * @param int $index
     */
    private function indexValid(int $index)
    {
        if ($index < 0 || $index > $this->getSize()) {
            throw new \InvalidArgumentException('Illegal Index!');
        }
        return true;
    }

    /**
     * 获取线段树数据元素个数
     * @return int
     */
    public function getSize():int
    {
        return $this->data->getSize();
    }

    /**
     * 获取线段树数据元素指定索引的元素
     * @param int $index
     * @return int
     */
    public function get(int $index)
    {
        $this->indexValid($index);

        return $this->data->get($index);
    }

    /**
     * 返回完全二叉树表示的数组中,某个节点的左孩子节点
     * @param int $index
     * @return int
     */
    private function leftChild(int $index):int
    {
        return 2 * $index + 1;
    }

    /**
     * 返回完全二叉树表示的数组中,某个节点的右孩子节点
     * @param int $index
     * @return int
     */
    private function rightChild(int $index):int
    {
        return 2 * $index + 2;
    }

    public function __toString():string
    {
        $str = '[';
        for ($j = 0; $j < count($this->tree); $j++) {
            if (isset($this->tree[$j])) {
                $str .= $this->tree[$j];
            } else {
                $str .= 'null';
            }
            $str .= ',';
        }
        $str .= ']' . "\n";
        return $str;
    }

    /**
     * 查找线段树中指定节点区间的值
     * @param int $start
     * @param int $end
     */
    public function query(int $queryL, int $queryR)
    {
        //首先判断区间是否合理
        if ($this->indexValid($queryL) && $this->indexValid($queryR) && $queryL
         <= $queryR) {
            return $this->queryRecursion(0, 0, $this->getSize() - 1, $queryL, $queryR);
        }
    }

    /**
     * 在以 $treeIndex 为根的线段树中的 [$left...$right] 区间内查找区间为 [$queryL...$queryR]的值
     * @param int $treeIndex
     * @param int $left
     * @param int $right
     * @param int $queryL
     * @param int $queryR
     */
    private function queryRecursion(int $treeIndex, int $left, int $right, int $queryL, int $queryR)
    {
        //如果要查找的区间即为给定区间
        if ($left == $queryL && $right == $queryR) {
            return $this->tree[$treeIndex];
        }

        //要查找的区间和给定区间不完全匹配
        //计算给定区间的中值
        $mid = $left + ($right - $left) / 2;
        //计算给定区间索引的左右孩子索引
        $leftChild = $this->leftChild($treeIndex);
        $rightChild = $this->rightChild($treeIndex);

        if ($queryR <= $mid) {
            //如果要查找区间的右边界不大于给定区间中值,则在给定区间的左范围内查找
            return $this->queryRecursion($leftChild, $left, $mid, $queryL, $queryR);
        } elseif ($queryL > $mid) {
            //如果要查找区间的左边界大于给定区间中值,则在给定区间的右范围内查找
            return $this->queryRecursion($rightChild, $mid + 1, $right, $queryL, $queryR);
        } elseif ($queryL < $mid && $queryR > $mid) {
            //如果要查找的区间从给定区间中间跨越了,则分别查找

            //1. 从要查找的区间左边界——给定区间中点
            $leftHalf = $this->queryRecursion($leftChild, $left, $mid, $queryL, $mid);
            //2. 从给定区间中点 +1 到要查找的区间的右边界
            $rightHalf = $this->queryRecursion($rightChild, $mid + 1, $right, $mid + 1, $queryR);

            //合并分开查找的结果
            return $this->merge->merge($leftHalf, $rightHalf);
        }
    }

    /**
     * 更新线段树中某个节点的值
     * @param int $index 要更新的节点索引
     * @param $newVal
     */
    public function set(int $index, $newVal)
    {
        if ($this->indexValid($index)) {
            $this->setRecursion(0, 0, $this->getSize() - 1, $index, $newVal);
        }
    }

    /**
     * 更新以 treeIndex  为根的线段树中索引为 index 的节点值
     * @param int $treeIndex
     * @param int $left
     * @param int $right
     * @param int $index
     * @param $newVal
     */
    private function setRecursion(int $treeIndex, int $left, int $right, int $index, $newVal)
    {
        //如果区间为1(已达到叶子节点)
        if ($left == $right) {
            $this->tree[$treeIndex] = $newVal;
            return;
        }

        //计算当前以 treeIndex 为根的线段树的 中点
        $mid = $left + ($right - $left) / 2;
        //获取其左右孩子区间节点索引
        $leftChild = $this->leftChild($treeIndex);
        $rightChild = $this->rightChild($treeIndex);

        //如果要查找的右边界 小于等于 当前线段树的中点
        if ($right <= $mid) {
            //更新左孩子树
            $this->setRecursion($rightChild, $mid + 1, $right, $index, $newVal);
        } else {
            //更新右孩子树
            $this->setRecursion($leftChild, $left, $mid, $index, $newVal);
        }

        //更新当前节点
        $this->tree[$treeIndex] = $this->merge->merge($this->tree[$leftChild], $this->tree[$rightChild]);
    }

}