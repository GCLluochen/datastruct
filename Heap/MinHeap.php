<?php
namespace Datastruct\Heap;

require_once("./../autoload.php");

use Datastruct\TestArray;

/**
 * 最小堆
 * Class MinHeap
 * @package Datastruct\Heap
 */
class MinHeap
{
    //TestArray
    protected $data;

    public function __construct($capacity = 0)
    {
        $this->data = new TestArray($capacity);
    }

    public function __get($name)
    {
        return $this->data;
    }


    /**
     * 获取堆中元素个数
     * @return int
     */
    public function getSize():int
    {
        return $this->data->getSize();
    }

    /**
     * 获取 堆 是否为空
     * @return bool
     */
    public function isEmpty():bool
    {
        return $this->getSize() == 0;
    }

    /**
     * 获取指定索引所在节点的父节点索引
     * 索引从 0 开始
     * (索引值 - 1) / 2
     * @param $index
     */
    public function getParent(int $index)
    {
        if ($index == 0) {
            throw new \InvalidArgumentException('Index 0 has no parent!');
        }
        return intval(($index - 1) / 2);
    }

    /**
     * 获取指定索引的左子节点
     * 索引从 0 开始
     * (索引值 * 2) + 1
     * @param $index
     */
    public function getLeftChild(int $index)
    {
        return $index * 2 + 1;
    }

    /**
     * 获取指定索引的右子节点
     * 索引从 0 开始
     * (索引值 * 2) + 2
     * @param $index
     */
    public function getRightChild(int $index)
    {
        return $index * 2 + 2;
    }

    /**
     * 向堆中添加元素
     * @param $ele
     */
    public function add($ele)
    {
        $this->data->push($ele);
        //判断新添加的元素是否需要上浮
        //新加的元素索引为 堆元素个数 - 1
        $this->siftUp(intval($this->getSize()) - 1);
    }

    /**
     * 需要上浮的元素索引值
     * @param int $index
     */
    private function siftUp(int $index)
    {
        //判断指定索引处的节点值是否小于父节点
        while ($index > 0 && $this->data->get($index) < $this->data->get($this->getParent($index))) {
            //大于,交换当前节点与父节点的值
            $this->data->swap($index, $this->getParent($index));
            $index = $this->getParent($index);
        }
    }

    /**
     * 获取堆中最小的元素值
     * @return int|null
     */
    public function findMin()
    {
        if ($this->data->isEmpty()) {
            return null;
        }
        return $this->data->get(0);
    }

    /**
     * 取出堆中最小元素 ( 最小堆)
     * 首先取出堆中根节点(数组索引0) 的值,然后将堆中最后一个节点(数组长度-1索引处)的值设置为根节点(
     * 同时将最后一个节点置空,然后将根节点分别同左、右子节点比较,同较大的节点交换值,然后继续向下交换,
     * 直到当前值不小于子节点)
     */
    public function extractMin()
    {
        //取出堆中最小的元素
        $maxData = $this->findMin();

        //交换堆中根节点(即最小的元素节点)与最后一个节点的值
        $this->data->swap(0, $this->getSize() - 1);
        //移除堆的最后一个节点
        $this->data->removeLast();

        //从新的根节点向下依次比较,直到堆满足最小堆条件(每个节点均 < 其任一子节点)
        $this->siftDown(0);

        return $maxData;
    }

    /**
     * 从指定索引节点开始向下比较,使得以该节点为根的树在比较后满足最大堆
     * @param int $index
     */
    private function siftDownSelf(int $index)
    {
        if ($index < 0 || $index > $this->getSize()) {
            throw new \InvalidArgumentException('Undefined Index!');
        } elseif ($this->getLeftChild($index) < $this->getSize()
        && $this->getRightChild($index) < $this->getSize()) {
            $rootIndex = $index;
            //首先获取要比较的值
            $rootData = $this->data->get($index);
            //获取节点的左子节点
            $leftChild = $this->data->get($this->getLeftChild($index));
            //获取节点的右子节点
            $rightChild = $this->data->get($this->getRightChild($index));

            while ($rootData < $leftChild || $rootData < $rightChild) {
                //如果节点小于左节点 和 右节点
                if ($rootData < $leftChild && $rootData < $rightChild) {
                    if ($leftChild < $rightChild) {
                        //如果左子节点 小于 右子节点
                        //交换根节点与右子节点
                        $rightIndex = $this->getRightChild($rootIndex);
                        $this->data->swap($rootIndex, $rightIndex);
                        //将交换后的右子节点作为新的比较节点
                        $rootIndex = $rightIndex;
                    } elseif ($leftChild > $rightChild) {
                        //如果左子节点 大于 右子节点
                        //交换根节点与左子节点
                        $leftIndex = $this->getLeftChild($rootIndex);
                        $this->data->swap($rootIndex, $leftIndex);
                        //将交换后的左子节点作为新的比较节点
                        $rootIndex = $leftIndex;
                    }
                } elseif ($rootData < $leftChild && $rootData > $rightChild) {
                    //如果新的根节点 小于 左子节点 + 大于 右子节点
                    //交换根节点与左子节点
                    $leftIndex = $this->getLeftChild($rootIndex);
                    $this->data->swap($rootIndex, $leftIndex);
                    //将交换后的左子节点作为新的比较节点
                    $rootIndex = $leftIndex;
                } elseif ($rootData > $leftChild && $rootData < $rightChild) {
                    //如果新的根节点 大于 左子节点 + 小于 右子节点
                    //交换根节点与左右子节点
                    $rightIndex = $this->getRightChild($rootIndex);
                    $this->data->swap($rootIndex, $rightIndex);
                    //将交换后的右子节点作为新的比较节点
                    $rootIndex = $rightIndex;
                }
                //获取交换后新的参照节点的值
                $rootData = $this->data->get($rootIndex);
                //获取初始根节点 左/右 子节点的左子节点
                $leftChild = $this->data->get($this->getLeftChild($rootIndex));
                //获取初始根节点 左/右 子节点的右子节点
                $rightChild = $this->data->get($this->getRightChild($rootIndex));
            }
        }
    }

    /**
     * 堆节点下沉——参考实现
     * @param int $index
     */
    private function siftDown(int $index)
    {
        $heapSize = $this->getSize();

        //判断当前节点的左节点是否不为空
        while ($this->getLeftChild($index) < $heapSize) {
            $minIndex = $this->getLeftChild($index);
            if (($minIndex + 1) < $heapSize && ($this->data->get($minIndex + 1) < $this->data->get($minIndex))) {
                //如果当前节点存在右子节点,且右子节点 小于 左子节点
                //则该节点左右子节点中的最小节点为右节点,否则该节点左右子节点中的最小节点为左节点
                $minIndex = $this->getRightChild($index);
            }
            //判断当前节点是否 小于 左右子节点中的最小值
            if ($this->data->get($index) < $this->data->get($minIndex)) {
                //小于,最小堆成立,跳出循环
                break;
            } else {
                //不小于,则交换当前节点与左右子节点中的最小值所在节点
                $this->data->swap($minIndex, $index);
                //新的 “根” 节点为左右子节点中的最小值节点的索引
                $index = $minIndex;
            }
        }
    }

    /**
     * 修改堆中根节点为新的值
     * @param $newVal 新的值
     */
    public function replace(int $newVal)
    {
        //首先找到最小值
        $maxData = $this->findMin();
        //将根节点更新为新值
        $this->data->set(0, $newVal);
        //对更新后的新的根节点进行下沉(siftDown)
        $this->siftDown(0);
        return $maxData;
    }

    /**
     * 将数组构造成最小堆的形式
     * 原理: 从最后一个非叶子节点(即最后一个节点的parent),逆序向前,让每一个节点进行 下沉(siftDown)操作,无叶子节点则不进行下沉
     * 直到该节点无叶子节点或 < 全部子节点
     * @param array $arr 要构造的数组
     */
    public function heapify(array $arr)
    {
        $this->data = (new TestArray(count($arr)))->initFromArray($arr);
        //首先将该数组视为一个最小堆
        //获取最后一个节点的索引(数组长度-1)
        $lastIndex = $this->getSize() - 1;
        //获取最后一个非叶子节点
        $lastParentIndex = $this->getParent($lastIndex);
        for ($i = $lastParentIndex; $i >= 0; $i--) {
            //依次对每个非叶子节点下沉
            $this->siftDown($i);
        }

    }

}