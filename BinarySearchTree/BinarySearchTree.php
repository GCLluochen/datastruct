<?php
namespace Datastruct\BinarySearchTree;

require_once("./../autoload.php");

use Datastruct\BinarySearchTree\Node;

/**
 * 二分搜索树
 * Class BinarySearchTree
 * @package Datastruct\BinarySearchTree
 */
class BinarySearchTree
{
    //根节点
    protected $root;
    //树节点数
    protected $size;

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    /**
     * 获取树节点个数
     * @return int
     */
    public function getLength():int
    {
        return $this->size;
    }

    /**
     * 判断数是否为空
     * @return bool
     */
    public function isEmpty():bool
    {
        return $this->size == 0;
    }

    /**
     * 插入新节点
     * @param $ele
     */
    public function add($ele)
    {
        /*if ($this->root == null) {
            $this->root = new Node($ele);
            $this->size ++;
        } else {
            $this->addNode($this->root, $ele);
        }*/
        $this->root = $this->addNode($this->root, $ele);
    }

    /**
     * 从直接节点开始插入新节点
     * 递归实现
     * @param Node $node
     * @param $ele
     */
    private function addNode(?Node $node, $ele)
    {
        /*if ($node->data == $ele) {
            return true;
        } elseif ($ele < $node->data) {
            if ($node->left == null) {
                //如果参照节点的左节点为空,则直接将新元素设置为左节点
                $node->left = new Node($ele);
                $this->size ++;
                return true;
            } else {
                //继续取当前节点的左节点与新元素比较
                $this->addNode($node->left, $ele);
            }
        } elseif ($ele > $node->data) {
            if ($node->right == null) {
                //如果参照节点的右节点为空,则直接将新元素设置为右节点
                $node->right = new Node($ele);
                $this->size ++;
                return true;
            } else {
                //继续取当前节点的右节点与新元素比较
                $this->addNode($node->right, $ele);
            }
        }*/

        //重构代码
        if ($node == null) {
            $this->size++;
            return new Node($ele);
        }
        if ($ele < $node->data) {
            $node->left = $this->addNode($node->left, $ele);
        } elseif ($ele > $node->data) {
            $node->right = $this->addNode($node->right, $ele);
        }
        return $node;
    }

    /**
     * 从直接节点开始插入新节点
     * 非递归实现
     * @param Node $node
     * @param $ele
     */
    /*private function addNode(Node $node, $ele)
    {
        $curNode = $node;
        do {
            if ($curNode->data == $ele) {
                //如果新值已存在于树中,不处理
                break;
            }
            if ($curNode->left == null && $ele < $curNode->data) {
                //如果参照节点的左节点为空,则直接将新元素设置为左节点
                $node->left = new Node($ele);
                $this->size++;
                break;
            } elseif ($curNode->right == null && $ele > $curNode->data) {
                //如果参照节点的右节点为空,则直接将新元素设置为右节点
                $node->right = new Node($ele);
                $this->size++;
                break;
            } elseif ($curNode->left != null && $ele < $curNode->data) {
                $curNode = $curNode->left;
            } elseif ($curNode->right != null && $ele > $curNode->data) {
                $curNode = $curNode->right;
            }
        } while ($curNode->left == null && $curNode->right == null);
    }*/

    public function __toString():string
    {
        $str = '';

    }

    /**
     * 查找二分树中是否包含元素
     * @param int $ele
     * @return bool
     */
    public function contains($ele):bool
    {
        /*$curNode = $this->root;
        do {
            if ($curNode->data == $ele) {
                return true;
            }
            if ($ele < $curNode->data) {
                $curNode = $curNode->left;
            } elseif ($ele > $curNode->data) {
                $curNode = $curNode->right;
            }
        } while ($curNode != null);
        return false;*/

        //递归写法
        return $this->find($this->root, $ele);
    }


    /**
     * 递归查找二分搜索树中是否存在指定值的节点
     * @return bool
     */
    private function find(?Node $node, $ele):bool
    {
        if ($node == null) {
            return false;
        }
        if ($node->data == $ele) {
            return true;
        } elseif ($ele < $node->data) {
            return $this->find($node->left, $ele);
        } elseif ($ele > $node->data) {
            return $this->find($node->right, $ele);
        }
    }

    /**
     * 二叉树 前序遍历 ( 根 -> 左 -> 右 )
     */
    public function preOrder()
    {
        $this->preOrderTraverse($this->root);
    }

    /**
     * 前序遍历实际实现
     * @param \Datastruct\BinarySearchTree\Node|null $node
     */
    private function preOrderTraverse(?Node $node)
    {
        if ($node == null) {
            return null;
        }
        echo $node->data . '->';
        //分别遍历左树和右树
        $this->preOrderTraverse($node->left);
        $this->preOrderTraverse($node->right);
    }

    /**
     * 二叉树 中序遍历 ( 左 -> 根 -> 右 )
    */
    public function middleOrder()
    {
        $this->middleOrderTraverse($this->root);
    }

    private function middleOrderTraverse(?Node $node)
    {
        if ($node == null) {
            return null;
        }

        //先遍历左子树
        $this->middleOrderTraverse($node->left);
        //遍历根节点
        echo $node->data . '->';
        //最后遍历右子树
        $this->middleOrderTraverse($node->right);
    }

    /**
     * 二叉树 后序遍历 ( 左 -> 右 -> 根 )
     */
    public function rearOrder()
    {
        $this->rearOrderTraverse($this->root);
    }

    private function rearOrderTraverse(?Node $node)
    {
        if ($node == null) {
            return null;
        }

        //先遍历左子树
        $this->rearOrderTraverse($node->left);
        //然后遍历右子树
        $this->rearOrderTraverse($node->right);
        //最后遍历根节点
        echo $node->data . '->';
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

    private function findMin(?Node $node)
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

    private function findMax(?Node $node)
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
    private function removeMin(?Node $node):?Node
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
    private function removeMax(?Node $node):?Node
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

    /**
     * 删除树中值为 $ele 的节点-非递归写法
     * @param $ele 要删除的节点值
     */
    public function removeElement($ele)
    {
        if ($this->isEmpty()) {
            throw new \RuntimeException('Tree is Empty!');
        }
        $delNode = null;
        //首先找到值为ele的节点
        $curNode = $this->root;
        do {
            if ($ele == $curNode->data) {
                $delNode = $curNode;
                break;
            } elseif ($ele < $curNode->data) {
                $curNode = $curNode->left;
            } elseif ($ele > $curNode->data) {
                $curNode = $curNode->right;
            }
        } while ($curNode != null);
        if ($delNode == null) {
            echo "要删除的节点不存在啊!\n";
        } else {
            //保存要删除节点的左右子节点
            $delLeftChild = $delNode->left;
            $delRightChild = $delNode->right;
            //查找到右子节点中的最小值
            $newNodeData = $this->findMin($delRightChild);
            //删除右子节点中的最小值节点
            $newRightChild = $this->removeMin($delRightChild);

            /*//新建节点,左右子节点分别为已删除节点的左右子节点(右子节点中已删除最小值节点)
            $newNode = new Node($newNodeData);
            $newNode->left = $delLeftChild;
            $newNode->right = $newRightChild;*/

            //将新生成的树挂载为已删除节点的子节点
            $curNode->data = $newNodeData;
            $curNode->right = $newRightChild;
            return $delNode;
        }
    }

    /**
     * 删除树中值为 $ele 的节点-递归写法
     * @param $ele 要删除的节点值
     */
    public function remove($ele)
    {
        $this->root = $this->removeRecursion($this->root, $ele);
    }

    private function removeRecursion(?Node $node, $ele)
    {
        if ($node == null) {
            return null;
        }
        if ($ele < $node->data) {
            $node->left = $this->removeRecursion($node->left, $ele);
            return $node;
        } elseif ($ele > $node->data) {
            $node->right = $this->removeRecursion($node->right, $ele);
            return $node;
        } elseif ($ele == $node->data) {
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
}