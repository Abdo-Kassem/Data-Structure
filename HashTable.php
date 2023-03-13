<?php

namespace Data_Structure;
require_once 'LinkedList.php';
class HashTable
{

    /*create hash table by using chining approach*/

    public $table;
    public $capacity;

    public function __construct($capacity,array $table = [])
    {
        $this->table = $table;
        $this->setCapacity($capacity);
    }

    public function setCapacity($size)
    {
        $this->capacity = $this->capacityPowerOf2($size)? ++$size : $size;
    }

    public function capacityPowerOf2($length) :bool
    {
        if($length === 0)
            return false;
        else {
            while(true) {
                if($length == 2)
                    return true;
                elseif($length % 2 > 0)
                    return false;
                $length /= 2;
            }
        }
    }

    public function hash($key) :int
    {
        $index = 0;
        if($this->capacity > 0){
            if(is_string($key)) {
                $strLength = strlen($key);
                for($count = 0 ; $count < $strLength ; $count++){
                    $index +=  ord($key[$count]) % $this->capacity;
                }
                return $index % $this->capacity;
            }elseif(is_int($key)) {
                return $index % $this->capacity;
            }
            return -1;
        }
        return -1;
    }

    public function insert($key,$value)
    {
        $index = $this->hash($key);
        if($index !== -1) {

            if(!isset($this->table[$index])) {
                $this->table[$index] = new linkedList();
            }
            $this->table[$index]->addLast($key,$value);
            return true;  
        }
        return null;
    }
    public function get($key) 
    {
        $index = $this->hash($key);
        if($index != -1 && isset($this->table[$index])) {
            return $this->table[$index]->getByKey($key);
        }
        return null;
    }

    public function traverse()
    {
        foreach($this->table as $cel) {
            $cel->traverse();
            echo '<br>*************************************<br>';
        }
    }
}

$hash = new HashTable(15,[]);
var_dump($hash->capacity);
/*
$hash->insert('1234567890','ahmed');
$hash->insert('1234567890','ahmed');
$hash->insert('1234567890','ahmed');
$hash->insert('1234567891','sayed');
$hash->insert('1234567891','mohamed');
$hash->insert('1234567892','mohsen');
$hash->traverse();*/
?>