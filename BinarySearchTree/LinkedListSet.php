<?php
namespace Datastruct\BinarySearchTree;

require_once("./../autoload.php");
//require_once("./../autoload.php");
/*require_once("./../LinkedList.php");
require_once("./SetInterface.php");*/

use Datastruct\LinkedList;
use Datastruct\BinarySearchTree\SetInterface;

class LinkedListSet implements SetInterface
{
    //LinkedList
    protected $list;

    public function __construct()
    {
        $this->list = new LinkedList();
    }

    public function add($ele)
    {
        if (!$this->list->contains($ele)) {
            $this->list->addFirst($ele);
        }
    }

    public function remove($ele)
    {
        return $this->list->remove($ele);
    }

    public function contains($ele):bool
    {
        return $this->list->contains($ele);
    }

    public function isEmpty():bool
    {
        return $this->list->isEmpty();
    }

    public function getSize():int
    {
        return $this->list->getSize();
    }
}