<?php
namespace Datastruct;

/**
 * 动态数组
 * Class TestArray
 * @package Datastruct
 */
final class TestArray
{
    //数组数据项
    private $data;
    //数组总长度
    private $len;
    //数组数据类型
    private $arrayType;
    //数组当前元素个数
    private $size = 0;

    public function __construct(int $len)
    {
        if (!is_null($len) && filter_var($len, FILTER_VALIDATE_INT)) {
            $this->data = [];
            $this->len = $len;
        }
    }

    /**
     * 将一个数组初始化为 TestArray
     * @param array $arr
     */
    public function initFromArray(array $arr)
    {
        $this->data = [];
        for ($i = 0; $i < count($arr); $i++) {
            $this->data[$i] = $arr[$i];
        }
        $this->size = count($arr);
        return $this;
    }

    /**
     * 获取数组已有元素个数
     * @return int
     */
    public function getSize():int
    {
        return $this->size;
    }

    /**
     * 获取数组总长度
     * @return int
     */
    public function getLength():int
    {
        return intval($this->len);
    }

    public function isEmpty():bool
    {
        return boolval($this->size == 0);
    }

    /**
     * 向数组末尾追加元素
     * @param int $ele
     * @throws \Exception
     */
    public function push($ele)
    {
        $this->insert($this->size, $ele);
    }

    /**
     * 向数组开头插入元素
     * @param int $ele
     */
    public function shift(int $ele)
    {
        $this->insert(0, $ele);
    }

    /**
     * 插入元素到数组指定索引处，当前索引及后续元素后移
     * @param int $index
     * @param int $ele
     * @return null
     */
    public function insert(int $index, $ele):void
    {
        if ($index < 0 || $index > $this->len) {
            throw new \InvalidArgumentException('Undefined offset');
        }
        if (intval($this->len) == 0) {
            $this->len = 1;
        }
        if ($this->size == $this->len) {
            $newCapacity = 2 * $this->len;//获取扩容后的数组长度
            $this->resize($newCapacity);

            //throw new \InvalidArgumentException('Array is full');
        }

        $i = $this->size - 1;//获取数组最后一个元素的索引位置
        for (; $i >= $index; $i--) {
            $this->data[$i + 1] = $this->data[$i];
        }
        $this->data[$index] = $ele;//将指定索引出的值设置插入的值
        $this->size++;//数组已有元素个数+1
    }

    /**
     * 获取指定索引位置的数组元素
     * @param int $index
     * @return int
     */
    public function get(int $index)
    {
        if ($index < 0 || $index >= $this->size) {
            throw new \InvalidArgumentException('Undefined offset');
        }
        return $this->data[$index];
    }

    /**
     * 获取数组尾部元素
     */
    public function getLast()
    {
        return $this->get($this->size - 1);
    }

    /**
     * 获取数组首部元素
     */
    public function getFirst()
    {
        return $this->get(0);
    }

    /**
     * 修改指定索引处的数组元素值
     * @param int $index
     * @param int $ele
     */
    public function set(int $index, int $ele):void
    {
        if ($index < 0 || $index >= $this->size) {
            throw new \InvalidArgumentException('Undefined offset');
        }
        $this->data[$index] = $ele;
    }

    /**
     * 打印数组时的格式
     * @return string
     */
    public function __toString():string
    {
        $str = sprintf("Array Length: %d, Size: %d\n(\n", $this->len, $this->size);
        for ($i = 0; $i < $this->size; $i++) {
            $str .= '   [' . $i . '] => ' . $this->data[$i];
            if ($i < ($this->size - 1)) {
                $str .= "\n";
            }
        }
        $str .= "\n)";
        return $str;
    }

    /**
     * 查找指定元素是否存在于数组中，存在则返回元素索引值，否则返回-1
     * @param int $index
     * @return int
     */
    public function find(int $ele):int
    {
        for ($i = 0; $i < $this->size; $i++) {
            if ($this->data[$i] == $ele) {
                return $i;
            }
        }
        return -1;
    }

    public function contains(int $ele):boolean
    {
        $index = $this->find($ele);
        if ($index == -1) {
            return false;
        }
        return true;
        /*for ($i = 0; $i < $this->size; $i++) {
            if ($this->data[$i] == $ele) {
                return true;
            }
        }
        return false;*/
    }

    /**
     * 删除指定索引处的数组元素
     * @param int $index
     * @return int
     */
    public function remove(int $index)
    {
        //首先判断索引是否合理
        if ($index < 0 || $index >= $this->size) {
            throw new \InvalidArgumentException('Undefined offset');
        }
        //首先保存要删除的元素
        $moveEle = $this->data[$index];
        for ($i = $index + 1; $i < $this->size; $i++) {
            $this->data[$i - 1] = $this->data[$i];
        }
        $this->size--;//数组元素个数减少
       
        //如果数组元素个数减少到数组总长度一半，则数据动态缩减空间
        if ($this->size == ceil($this->len / 4)) {
            $this->resize(ceil($this->len / 2));
        }
        //返回删除的元素值
        return $moveEle;
    }

    /**
     * 移除数组首位元素
     * @return int
     */
    public function removeFirst()
    {
        return $this->remove(0);
    }

    /**
     * 移除数组末尾元素
     * @return int
     */
    public function removeLast()
    {
        return $this->remove($this->size - 1);
    }

    /**
     * 查找元素，存在则删除
     */
    public function removeIfExists(int $ele):void
    {
        $index = $this->find($ele);
        if ($index !== -1) {
            $this->remove($index);
        }
    }

    /**
     * 数组扩容操作
     */
    private function resize(int $newCapacity):void
    {
        $this->len = $newCapacity;//修改数组总长度
        $newData = new TestArray($newCapacity);//创建新长度的数组对象
        //复制原数组的值到新数组
        for ($i = 0;$i < $this->size; $i++) {
            $newData->push($this->data[$i]);
        }
        $this->data = $newData->data;
    }

    /**
     * 交换指定索引的值
     * @param int $frontIndex
     * @param int $backIndex
     */
    public function swap(int $frontIndex, int $backIndex)
    {
        //判断索引值是否有效
        if ($frontIndex < 0 || $frontIndex > $this->size || $backIndex < 0 || $backIndex > $this->size) {
            throw new \InvalidArgumentException('Undefined Index!');
        }
        $tmpData = $this->data[$frontIndex];
        $this->data[$frontIndex] = $this->data[$backIndex];
        $this->data[$backIndex] = $tmpData;
    }
}
