<?php

namespace Data_Structure;

class MinHeap
{

    public array $heap;

    public function __construct()
    {
        $this->heap = array();
    }

    public function getParent($key) 
    {
        if($key === 0)
            return -1;
        return floor(($key-1)/2);
    }

    public function getLeftChield($parentKey)
    {
        $left = 1+($parentKey*2);
        if($left <$this->size())
            return $left;
        return -1;
    }

    public function getRightChield($parentKey)
    {
        $right = 2+($parentKey*2);
        if($right < $this->size())
            return $right;
        return -1;
    }

    public function size()
    {
        return count($this->heap);
    }

    public function deleteFirst() 
    {
        if($this->size()) {
            $this->heap[0] = $this->heap[$this->size()-1];
            unset($this->heap[$this->size()-1]);
            $this->heapifyDown($this->heap[0],0);
        }
    }

    private function heapifyDown($item,$key)
    {
        $leftChield = $this->getLeftChield($key);

        if($leftChield === -1) //if left not exist then right not exist
            return;

        $rightChield = $this->getRightChield($key);

        if ($rightChield !== -1 && $this->heap[$leftChield] > $this->heap[$rightChield]) {
            $this->heap[$key] =  $this->heap[$rightChield];
            $this->heap[$rightChield] = $item;
            $key = $rightChield;
        }
            
        $this->heap[$key] = $this->heap[$leftChield];
        $this->heap[$leftChield] = $item;
        $key = $leftChield;
        
        $this->heapifyDown($item,$key);
        
    }


    public function insert($item)
    {
        $this->heap[$this->size()] = $item;
        $this->heapifyUp($this->size()-1,$item);
    }
    
    private function heapifyUp($key , $item)
    {
        if($key <= 0 )
            return;
        $parentValue = $this->heap[$this->getParent($key)];
        if($parentValue > $item) {
            $this->heap[$this->getParent($key)] = $item;
            $this->heap[$key] = $parentValue;
        }
        $this->heapifyUp($this->getParent($key),$item);
    }

}
$heap = new MinHeap();
$heap->insert(5);
$heap->insert(6);
$heap->insert(8);
$heap->insert(7);
$heap->insert(10);
$heap->insert(15);
$heap->insert(20);
$heap->insert(4);
$heap->deleteFirst();
var_dump($heap->heap);
?>