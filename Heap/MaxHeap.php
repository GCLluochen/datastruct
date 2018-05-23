<?php
namespace Datastruct\Heap;

require_once("./../autoload.php");

use Datastruct\TestArray;

/**
 * 最大堆
 * Class MaxHeap
 * @package Datastruct\Heap
 */
class MaxHeap
{
    //TestArray
    protected $data;

    public function __construct($capacity = 0)
    {
        $this->data = new TestArray($capacity);
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
        return ($index - 1) / 2;
    }

    /**
     * 获取指定索引的左子节点
     * 索引从 0 开始
     * (索引值 * 2) + 1
     * @param $index
     */
    public function getLeftChild(int $index)
    {
        return $index * 1 + 1;
    }

    /**
     * 获取指定索引的右子节点
     * 索引从 0 开始
     * (索引值 * 2) + 2
     * @param $index
     */
    public function getRightChild(int $index)
    {
        return $index * 1 + 2;
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
        $this->siftUp($this->getSize() - 1);
    }

    /**
     * 需要上浮的元素索引值
     * @param int $index
     */
    private function siftUp(int $index)
    {
        //判断指定索引处的节点值是否大于父节点
        while ($this->data->get($index) > $this->data->get($this->getParent($index))) {
            //大于,交换当前节点与父节点的值
            $this->data->swap($index, $this->getParent($index));
            $index = $this->getParent($index);
        }
    }

    /**
     * 获取堆中最大的元素值
     * @return int|null
     */
    public function findMax()
    {
        if ($this->data->isEmpty()) {
            return null;
        }
        return $this->data->get(0);
    }

    /**
     * 取出堆中最大元素 ( 最大堆)
     * 首先取出堆中根节点(数组索引0) 的值,然后将堆中最后一个节点(数组长度-1索引处)的值设置为根节点(
     * 同时将最后一个节点置空,然后将根节点分别同左、右子节点比较,同较大的节点交换值,然后继续向下交换,
     * 直到当前值不小于子节点)
     *
     */
    public function extarctMax()
    {
        //取出堆中最大的元素
        $maxData = $this->findMax();

        //交换堆中根节点(即最大的元素节点)与最后一个节点的值
        $this->data->swap(0, $this->getSize() - 1);
        //移除堆的最后一个节点
        $this->data->removeLast();

        //从新的根节点向下依次比较,直到堆满足最大堆条件(每个节点均 >= 其任一子节点)
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
            $maxIndex = $this->getLeftChild($index);
            if (($maxIndex + 1) < $heapSize && ($this->data->get($maxIndex + 1) > $this->data->get($maxIndex))) {
                //如果当前节点存在右子节点,且右子节点 大于 左子节点
                //则该节点左右子节点中的最大值为右节点,否则该节点左右子节点中的最大值为左节点
                $maxIndex = $this->getRightChild($index);
            }
            //判断当前节点是否 大于 左右子节点中的最大值
            if ($this->data->get($index) > $this->data->get($maxIndex)) {
                //大于,最大堆成立,跳出循环
                break;
            } else {
                //不大于,则交换当前节点与左右子节点中的最大值所在节点
                $this->data->swap($maxIndex, $index);
                //新的 “根” 节点为左右子节点中的最大值节点的索引
                $index = $maxIndex;
            }
        }
    }

}