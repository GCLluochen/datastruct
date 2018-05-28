<?php
namespace Datastruct\Trie;

require_once('./../autoload.php');

use Datastruct\Map\BSTMap;
use Datastruct\Trie\Node;

/**
 * 字典树 / 前缀树
 * Class Trie
 * @package Datastruct\Trie
 */
class Trie
{
    //根节点 Node 实例
    public $root;
    //Trie 中存储的单词个数
    public $size;

    public function __construct()
    {
        $this->root = new Node();
        $this->size = 0;
    }

    public function getSize():int
    {
        return $this->size;
    }

    /**
     * 向Trie 中添加一个新的单词
     * 非递归实现
     * @param string $word
     */
    public function add(string $word)
    {
        $cur = $this->root;
        //分割字符串
        $arrWord = str_split($word, 1);
        for ($i = 0; $i < count($arrWord); $i++) {
            $curChar = strtolower($arrWord[$i]);
            //判断当前节点中是否包含 key 为 $curChar 的映射项
            if ($cur->next->get($curChar) == null) {
                $cur->next->add($curChar, new Node());
            }
            $cur = $cur->next->get($curChar);
        }
        //判断最后的节点是否为一个单词
        if (!$cur->isWord) {
            $cur->isWord = true;
            $this->size ++;
        }
    }

    /**
     * 查询Trie中是否存在单词$seWord
     * @param $seWord
     * @return bool
     */
    public function contains($seWord):bool
    {
        $cur = $this->root;
        //分割字符串
        $arrWord = str_split($seWord, 1);
        for ($i = 0; $i < count($arrWord); $i++) {
            $curChar = strtolower($arrWord[$i]);
            if ($cur->next->get($curChar) == null) {
                return false;
            }
            $cur = $cur->next->get($curChar);
        }
        //如果以要查找单词长度为最后一个节点的节点标识为一个单词,则表示Trie中包含要查找的单词
        return $cur->isWord;
    }

    /**
     * 在 Trie 中查找与 $searchWord 字符串或模式相匹配的单词是否存在
     * 如: bad 匹配 bad  b.. 匹配 bad b.d 匹配 bad
     * @param string $searchWord 要查找的单词或模式
     */
    public function search(string $searchWord)
    {
        return $this->match($this->root, $searchWord, 0);
    }

    /**
     * 递归模式匹配
     * @param \Datastruct\Trie\Node $curNode
     * @param $searchWord
     * @param int $index
     */
    private function match(Node $curNode, $searchWord, int $index)
    {
        //判断是否已匹配到字符末尾,已匹配到表示查找的单词或模式已找到,返回当前节点的单词标识
        if ($index == strlen($searchWord)) {
            return $curNode->isWord;
        }
        //获取单词当前索引处的字符
        $curWord = $searchWord[$index];
        //判断单词当前索引处是否为 '.'
        if ($curWord != '.') {
            // 如果不为 '.', 则判断当前节点字符是否为要查找的字符
            if ($curNode->next->get($curWord) == null) {
                return false;
            }
            //否则继续向下匹配
            return $this->match($curNode->next->get($curWord), $searchWord, $index + 1);
        } else {
            //为 '.',则匹配当前节点下面的全部节点
            $keyArr = [];
            foreach ($keyArr as $key) {
                //依次判断当前节点 next 的全部 key 中是否有要查找的字符
                if ($this->match($curNode->next->get($key), $searchWord, $index + 1)) {
                    return true;
                }
                //如果上一级 '.'后面的全部节点都不能匹配到.后面的第一个字符,则表示匹配失败
                return false;
            }
        }

    }

}