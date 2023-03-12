<?php

namespace Data_Structure;

class Stack
{
    public $stack;

    public function __construct(array $data = [])
    {
        $this->stack = $data;
    }

    public function pop()
    {
        $count = count($this->stack)-1;
    
        if($count>=0){
            $item = $this->stack[$count];
            unset($this->stack[$count]);
            $this->stack = array_values($this->stack);
            return $item;
        }
        return null;
    }

    public function push($item)
    {
        $this->stack[] = $item;
        
    }

    public function isEmpty()
    {
        return count($this->stack) ? false:true;
    }

    public function peek()
    {
        if(!$this->isEmpty())
            return $this->stack[count($this->stack)-1];
        else
            return null;
    }

    public function __toString()
    {
        $content = '';
        foreach($this->stack as $item)
            $content .= ' '.$item;
        return $content.'<br>';
    }

}

$stack = new Stack();
$exp = "((  a   +    b) * c ) - d ";
$exp = str_replace([' ','  '],['',''],$exp);
$res = '';
for($count = 0; $count <= (strlen($exp)-1); $count++)
{

    if($exp[$count] === '+' || $exp[$count] === '-' || $exp[$count] === '*' || $exp[$count] === '/'){
        if($count-1 >= 0 && $exp[$count-1] === ')' )
            $res = $exp[$count] . $res  . $stack->pop();
        else
            $res = $res . $exp[$count] . $stack->pop();
        
    }
    elseif($exp[$count] !== '(' && $exp[$count] !== ')'){
        $stack->push($exp[$count]);
    
    }
    

}

$res .= $stack->pop();
echo $res;

?>