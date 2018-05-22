<?php
namespace Datastruct\Map;

require_once("./autoload.php");

use Datastruct\Map\BSTNode;
use Datastruct\Map\MapInterface;

/**
 * LinkedListMap-链二分搜索树 实现
 * Class BSTMap
 * @package Datastruct
 */
class BSTMap implements MapInterface
{
    protected $root;//根节点
    private $size;//树节点个数

    public function __construct()
    {
        //初始化根节点
        $this->root = null;// new BSTNode($key, $val, null, null);
        $this->size = 0;
    }

    /**
     * 获取树节点个数
     * @return int
     */
    public function getSize():int
    {
        return $this->size;
    }

    /**
     * 判断树是否为空
     * @return bool
     */
    public function isEmpty():bool
    {
        return $this->size == 0;
    }

    /**
     * 返回以 node 为根的二分树中key所在的节点
     * @param $key
     */
    public function getNode($node, $key)
    {
        if ($node == null) {
            return null;
        }
        if ($key < $node->key) {
            return $this->getNode($node->left, $key);
        } elseif ($key > $node->val) {
            return $this->getNode($node->right, $key);
        } elseif ($key == $node->key) {
            //如果当前节点的 key == 要查找的key , 返回node
            return $node;
        }
    }

    /**
     * 插入新节点
     * @param $key
     * @param $val
     */
    public function add($key, $val)
    {
        //调用递归实现
        $this->root = $this->addNode($this->root, $key, $val);
    }

    /**
     * 向以 node 为根的节点插入新节点,返回插入后的根节点
     * 递归实现
     * @param Node $node
     * @param $ele
     */
    private function addNode(?BSTNode $node, $key, $val)
    {
        //重构代码
        if ($node == null) {
            $this->size++;
            return new BSTNode($key, $val);
        }
        if ($key < $node->key) {
            $node->left = $this->addNode($node->left, $key, $val);
        } elseif ($key > $node->key) {
            $node->right = $this->addNode($node->right, $key, $val);
        } elseif ($key > $node->key) {
            //如果已有key,设置为新值
            $node->val = $val;
        }
        return $node;
    }

    /**
     * 类的字符串表示
     * @return string
     */
    public function __toString():string
    {
        $str = '';//"BSTMap,  Size: ".$this->size . "\n";
        /*$cur = $this->dummyHead->next;
        while ($cur != null) {
            $str .= $cur->key . ':' . $cur->val . '  ->  ';
            $cur = $cur->next;
        }
        $str .= "\n";*/
        return $str;
    }

    /**
     * 查找指定key的节点值
     * @param int $key
     * @return mixed
     */
    public function get($key)
    {
        $searNode = $this->getNode($this->root, $key);
        return ($searNode != null) ? $searNode->val : null;
    }

    /**
     * 修改指定key的链表元素值
     * @param int $key 指定key
     * @param $val 新值
     */
    public function set($key, $val)
    {
        $setNode = $this->getNode($this->root, $key);
        if ($setNode) {
            $setNode->val = $val;
        } else {
            throw new \InvalidArgumentException('Key not exists!');
        }
    }

    /**
     * 查找链表是否存在key
     * @param $key
     * @return bool
     */
    public function contains($key):bool
    {
        $setNode = $this->getNode($this->root, $key);
        return $setNode != null;
    }

    /**
     * 删除 Map 中指定key 的节点
     * @param $key
     */
    public function remove($key)
    {
        //判断 key 是否存在节点
        $hasNode = $this->getNode($this->root, $key);
        if (!$hasNode) {
            return null;
        } else {
            $this->root = $this->removeRecursion($this->root, $key);
            return $hasNode->val;
        }
    }

    /**
     * 删除以 node 为根节点的树中指定 key 的节点
     * @param \Datastruct\Map\BSTNode $node
     * @param $key
     */
    private function removeRecursion(BSTNode $node, $key)
    {
        if ($node == null) {
            return null;
        }
        if ($key < $node->key) {
            $node->left = $this->removeRecursion($node->left, $key);
            return $node;
        } elseif ($key > $node->key) {
            $node->right = $this->removeRecursion($node->right, $key);
            return $node;
        } elseif ($key == $node->key) {
            //左子树为空
            if ($node->left == null) {
                $rightNode = $node->right;
                $node->right = null;
                $this->size --;
                return $rightNode;
            }
            //右子树为空
            if ($node->right == null) {
                $leftNode = $node->left;
                $node->left = null;
                $this->size --;
                return $leftNode;
            }
            //左右子节点均不为空

            //找到node节点右子节点的最小节点
            $newNode = $this->minimum($node->right);
            //移除node节点右子节点中的最小节点
            $newNode->right = $this->removeMin($node->right);
            //用最小节点替代要删除的节点
            $newNode->left = $node->left;

            $node->left = $node->right = null;
            return $newNode;
        }
    }


    /**
     * 查找最小值
     */
    public function minimum()
    {
        //递归实现
        if ($this->size == 0) {
            throw new \RuntimeException('Tree is empty!');
        }
        return $this->findMin($this->root);

        //非递归实现
        /*$curNode = $this->root;
        while ($curNode->left != null) {
            $curNode = $curNode->left;
        }
        return $curNode->data;*/
    }

    private function findMin(?BSTNode $node)
    {
        //如果当前节点已无左子节点,则当前节点为最小值
        if ($node->left == null) {
            return $node->data;
        }
        //否则继续查找节点的左节点
        return $this->findMin($node->left);
    }

    /**
     * 查找最大值
     */
    public function maximum()
    {
        //递归实现
        if ($this->size == 0) {
            throw new \RuntimeException('Tree is empty!');
        }
        return $this->findMax($this->root);

        //非递归实现
        /*$curNode = $this->root;
        while ($curNode->right != null) {
            $curNode = $curNode->right;
        }
        return $curNode->data;*/
    }

    private function findMax(?BSTNode $node)
    {
        //如果当前节点已无右子节点,则当前节点为最大值
        if ($node->left == null) {
            return $node->data;
        }
        //否则继续查找节点的右节点
        return $this->findMax($node->right);
    }

    /**
     * 删除二分搜索树中最小值所在节点
     */
    public function removeMinimum()
    {
        $retMin = $this->minimum();

        //删除最小值所在节点
        $this->removeMin($this->root);

        return $retMin;
    }

    /**
     * 删除以 node 为根的树中的最小节点
     * 返回删除后新的树的根
     * @param \Datastruct\BinarySearchTree\Node|null $node
     * @return \Datastruct\BinarySearchTree\Node
     */
    private function removeMin(?BSTNode $node):?BSTNode
    {
        //如果当前节点已无左子节点
        if ($node->left == null) {
            //保存当前节点的右子节点作为当前节点的替代
            $rightNode = $node->right;
            $node->right = null;
            $this->size --;
            return $rightNode;
        }
        //如果仍有左子节点,继续向下遍历
        //将删除后的树赋值为当前节点的左节点
        $node->left = $this->removeMin($node->left);
        return $node;
    }

    /**
     * 删除二分搜索树中最大值所在节点
     */
    public function removeMaximum()
    {
        $retMax = $this->maximum();

        //删除最大值所在节点
        $this->removeMax($this->root);

        return $retMax;
    }

    /**
     * 删除以 node 为根的树中的最大节点
     * 返回删除后新的树的根
     * @param \Datastruct\BinarySearchTree\Node|null $node
     * @return \Datastruct\BinarySearchTree\Node
     */
    private function removeMax(?BSTNode $node):?BSTNode
    {
        //如果当前节点已无右子节点
        if ($node->right == null) {
            //保存当前节点的左子节点作为当前节点的替代
            $leftNode = $node->left;
            $node->left = null;
            $this->size --;
            return $leftNode;
        }
        //如果仍有右子节点,继续向下遍历
        //将删除后的树赋值为当前节点的右节点
        $node->right = $this->removeMax($node->right);
        return $node;
    }

}
