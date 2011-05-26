<?php

function compareChildren($child1, $child2)
{
    return $child1->getTotalSize() < $child2->getTotalSize() ? 1 : -1;
}

class VarProfile
{
    private $var;
    private $name;
    private $type;
    private $ownSize;
    
    private $children;
    private $totalSize;
    private $totalNumElements;
    
    public function __construct(&$var, $name = '[root]')
    {
        $this->var  = &$var;
        $this->name = $name;
        
        // Initialise recursively
        $this->children = array();
        if (is_array($var)) {
            $this->type = 'array';
            $this->ownSize = 8;
            $this->totalSize = 8;
            $this->totalNumElements = 1;
            foreach($var as $arrayChildKey => $arrayChildValue) {
                $newChildProfile = new VarProfile($arrayChildValue, $arrayChildKey);
                $this->children[] = $newChildProfile;
                $this->totalSize += $newChildProfile->getTotalSize();
                $this->totalNumElements += $newChildProfile->getTotalNumElements();
            }
            usort($this->children, 'compareChildren');
        } elseif (is_string($var)) {
            $this->type = 'string';
            $this->ownSize = $this->totalSize = strlen($var);
            $this->totalNumElements = 1;
        } elseif (is_bool($var)) {
            $this->type = 'bool';
            $this->ownSize = $this->totalSize = 4;
            $this->totalNumElements = 1;
        } elseif (is_int($var)) {
            $this->type = 'int';
            $this->ownSize = $this->totalSize = 4;
            $this->totalNumElements = 1;
        } elseif (is_float($var)) {
            $this->type = 'float';
            $this->ownSize = $this->totalSize = 16;
            $this->totalNumElements = 1;
        } else {
            // TODO - Think of a better way to handle this the else (right now, we're counting this as size 0
            $this->type = gettype($var);
            $this->ownSize = $this->totalSize = 0;
            $this->totalNumElements = 1;
        }
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getOwnSize()
    {
        return $this->ownSize;
    }
    
    public function &getChildren()
    {
        return $this->children;
    }
    
    public function getTotalSize()
    {
        return $this->totalSize;
    }
    
    public function getTotalNumElements()
    {
        return $this->totalNumElements;
    }
    
    public function __toString()
    {
        return "VarProfile[name={$this->name},size={$this->ownSize},total={$this->totalSize},type={$this->type}]";
    }
}
