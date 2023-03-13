<?php

namespace Data_Structure;

class Node
{
    private $key;
    private $value;
    private ?Node $next;
    private ?Node $prev;

    public function __construct($key,$value,$next = null,$prev)
    {
        $this->key = $key;
        $this->value = $value;
        $this->next = $next;
        $this->prev = $prev;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function setNext($next)
    {
        $this->next = $next;
    }

    public function getPrev()
    {
        return $this->prev;
    }

    public function setPrev($prev)
    {
        $this->prev = $prev;
    }

}

class linkedList
{

    public ?Node $head ;
    public ?Node $last;

    public function __construct()
    {
        $this->head = null;
        $this->last = null;
    }  

    public function addLast($key,$value)  
    {
        if($this->isEmpty()) {
            $node = new Node($key,$value,null,null);
            $this->head = $node;
            $this->last = $node;
        }else {
            $node = new Node($key,$value,null,$this->last);
            $this->last->setNext($node);
            $this->last = $node;
        }
    }

    public function addfirst($key,$value)  
    {
        if($this->isEmpty()) {
            $node = new Node($key,$value,null,null);
            $this->head = $node;
            $this->last = $node;
        }else {
            $node = new Node($key,$value,$this->head,null);
            $this->head = $node;
        }
    }

    public function add($key,$value,int $position)
    {
        if($this->isEmpty()) {
            $node = new Node($key,$value,null,null);
            $this->head = $node;
            $this->last = $node;
        }else {
            $cursor = $this->head;
            if($position <= 0) {
                $this->addfirst($key,$value);
            }else {
                $count = 0;
                while($cursor !== null) {
                    $cursor = $cursor->getNext();
                    $count++;
                    if($position === $count) {
                        $node = new Node($key,$value,$cursor,$cursor->getPrev());
                        $cursor->getPrev()->setNext($node);
                        $cursor->setPrev($node);
                        break;
                    }
                }
                if($cursor === null){
                    $this->addLast($key,$value);
                }
            }
        }
    }

    /*
    *get value by key if not exist will not return null
    */
    public function getByKey($key)
    {
        $cursor = $this->head;
        while($cursor !== null) {
            if($cursor->getKey() === $key)
                return $cursor->getValue();
            $cursor = $cursor->getNext();
        }
        return null;
    }

    public function exist($key) :bool
    {
        $cursor = $this->head;
        while($cursor !== null) {
            if($cursor->getKey() === $key)
                return true;
            $cursor = $cursor->getNext();
        }
        return false;
    }

    public function delete($key) :bool
    {
        $cursor = $this->head;
        while($cursor !== null) {
            if($cursor->getKey() === $key){
                $cursor->getPrev()->setNext($cursor->getNext());
                $cursor->setPrev(null);
                $cursor->setNext(null);
                return true;
            }
            $cursor = $cursor->getNext();
        }
        return false;
    }

    public function count() :int
    {
        $count = 0;
        $cursor = $this->head;
        while($cursor !== null){
            $count++;
            $cursor = $cursor->getNext();
        }
        return $count;
    }

    public function isEmpty()
    {
        return $this->head === null;
    }

    public function traverse()
    {
        $cursor = $this->head;
        while($cursor !== null) {
            echo $cursor->getKey().' => '.$cursor->getValue().'<br>';
            $cursor = $cursor->getNext();
        }
    }
    
}

/*$linkedList = new linkedList();
$linkedList->addLast('age',30);
$linkedList->addLast('name','sayed');
$linkedList->addLast('salary',30000);
$linkedList->addfirst('length',195);
$linkedList->add('weight',70,2);
$linkedList->add('weight',70,10);
$linkedList->traverse();
echo $linkedList->getByKey('name').'<br>';
echo $linkedList->count().'<br>';
$linkedList->delete('name');
echo $linkedList->count().'<br>';
$linkedList->traverse();
echo $linkedList->exist('salary')?'yes':'no';*/

?>