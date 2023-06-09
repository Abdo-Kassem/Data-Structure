<?php

namespace Data_Structure;

class TreeNode
{
    public $data;
    public ?TreeNode $left;
    public ?TreeNode $right;

    public function __construct($data)
    {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}

//order binary tree
class BinaryTree
{
    public ?TreeNode $root;

    public function __construct(array $data = null)
    {
        $this->root = null;
    }

    public function add($item)
    {
        if($this->root === null) {
            $this->root = new TreeNode($item);
        }else {

            $this->addItemRecursive($item,$this->root);
        }
    }

    public function delete($item) :bool
    {
        return $this->deleteRecursive(null,$this->root,$item);
    }

    private function deleteRecursive(?TreeNode $prev , ?TreeNode $current , $item)
    {
        if($current === null)
            return false;

        if($current->data === $item) {
            if($prev === null){
                if($current->left  === null && $current->right === null) {
                    $this->root = null;
                }else if($current->left === null) {
                    $this->root->right = $current->right;
                    $current->right = null;
                }else if($current->right === null) {
                    $this->root->left = $current->left;
                    $current->left = null;
                }
                
            }else {
                if($current->left  === null && $current->right === null) {
                    $prev->left = $prev->left === $current? null : $prev->left;
                    $prev->right = $prev->right === $current? null : $prev->right;
                }else if($current->left === null) {
                    $prev->right = $current->right;
                    $current->right = null;
                }else if($current->right === null) {
                    $prev->left = $current->left;
                    $current->left = null;
                }
            }
            if($current->left !== null && $current->right !== null) {
                //get smallest value in right 
                $smallestValue = $this->smalestItemRecursive($current->right);
                $current->data = $smallestValue;
                $this->deleteRecursive($current,$current->right,$smallestValue);
            }
            return true;

        }else if($item > $current->data) {
            return  $this->deleteRecursive($current ,$current->right,$item);
        }else {
            return $this->deleteRecursive($current,$current->left,$item);
        }
    }

    private function smalestItemRecursive(TreeNode $current)
    {
        return $current->left === null ? $current->data : $this->smalestItemRecursive($current->left);
    }

    private function addItemRecursive($item,?TreeNode $current)
    {
        
        if($current === null)
            return new TreeNode($item);

        if($item > $current->data) 
        {
           $current->right = $this->addItemRecursive($item,$current->right);
        }elseif($item < $current->data) {
            $current->left = $this->addItemRecursive($item,$current->left);
        }else {
            return -1;
        }
        
        return $current;

    }

    public function preOrderTraverse()
    {
        $arr = [];
        $this->preOrderRecursive($this->root,$arr);
        var_dump($arr);
    }

    private function preOrderRecursive(?TreeNode $current,array &$arr)
    {
        if($current === null)
            return;

        $arr[] = $current->data;
        $this->preOrderRecursive($current->left,$arr);
        $this->preOrderRecursive($current->right,$arr);
    }

    public function inOrderTraverse()
    {
        $arr = [];
        $this->inOrderRecursive($this->root,$arr);
        var_dump($arr);
    }

    private function inOrderRecursive(?TreeNode $current,array &$arr)
    {
        if($current === null)
            return;

        $this->inOrderRecursive($current->left,$arr);
        $arr[] = $current->data;
        $this->inOrderRecursive($current->right,$arr);
    }

    public function getHeight($item) 
    {
        $current = $this->getNode($item,$this->root);
        return $this->heightRecursive($current);
    }

    private function getNode($item,?TreeNode $current)
    {
        if($current === null)
            return null;
        if($current->data === $item) {
            return $current;
        }
        $left = $this->getNode($item,$current->left);
        $right = $this->getNode($item,$current->right);

        if($left === null && $right === null)
            return null;
        elseif($left === null)
            return $right;
        else
            return $left;
    }

    private function heightRecursive(?TreeNode $current)
    {
        if($current === null)
            return -1;
        $leftHeight = $this->heightRecursive($current->left);
        $rightHeight = $this->heightRecursive($current->right);
        return 1+max($leftHeight,$rightHeight);
    }

}
//date_default_timezone_set('Africa/Cairo');
//echo date('Y-m-d H:i:s');
$tree = new BinaryTree();
$tree->add(8);
$tree->add(7);
$tree->add(10);
$tree->add(6);
$tree->add(9);
$tree->add(11);
$tree->add(13);
echo $tree->getHeight(0);
//$tree->preOrderTraverse();
//echo '<br>';
//$tree->inOrderTraverse();
//$tree->delete(10);
//var_dump($tree->root);

?>