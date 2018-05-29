<?php
namespace Datastruct\UnionFind;

/**
 * 并查集接口
 */
interface UFInterface
{
    /**
     * 获取并集元素个数
     * @return int
     */
    public function getSize():int;

    /**
     * 判断集合 p q 是否有连接
     * @param $p
     * @param $q
     * @return bool
     */
    public function isConnected($p, $q):bool;

    /**
     * 计算两个元素的并集
     * @return mixed
     */
    public function unionElements($p, $q);
}