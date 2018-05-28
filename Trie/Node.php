<?php
namespace Datastruct\Trie;

require_once("./../autoload.php");

use Datastruct\Map\BSTMap;

/**
 * 字典树的节点 类
 * Class Node
 * @package Datastruct\Trie
 */
class Node
{
    //boolean 表示当前节点是否和之前的节点字符构成一个单词
    public $isWord;
    //BSTMap 表示当前节点的下一级节点的 map 集合
    public $next;

    /**
     * Node constructor.
     * @param bool $isWord 标识当前节点是否构成一个完整的单词
     */
    public function __construct($isWord = null)
    {
        if (isset($isWord)) {
            $this->isWord = $isWord;
        }
        $this->next = new BSTMap();
    }
}