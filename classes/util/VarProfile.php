<?php

function compareChildren($child1, $child2)
{
    return $child1->getTotalSize() < $child2->getTotalSize() ? 1 : -1;
}

/**
 * VarProfile can be used to profile the in-memory footprint of any scalar
 * or array variable (note: objects are not supported yet).
 * 
 * Simply instantiate an instance of VarProfile, passing the to-be-profiled
 * variable to the constructor and call the VarProfile methods to get an idea
 * of the memory consumption of the variable's contents.
 * 
 * @author deniz
 */
class VarProfile
{
    private $var;
    private $name;
    private $type;
    private $ownSize;
    
    private $children;
    private $totalSize;
    private $totalNumElements;
    
    /**
     * Creates a VarProfile instance that profiles the given variable.
     * 
     * Note that the constructor does all the profiling work, while the accessor
     * methods simply return the data of the profile generated by the
     * constructor.
     * This means that the constructor may take some time to execute, for large
     * array, for example.
     * 
     * @param unknown_type $var
     * @param unknown_type $name
     */
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
    
    /**
     * Returns the name of the profiled data, 'root' for the top-level variable
     * and, for array elements ('children'), the key against which the array
     * element is stored.
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Returns the size that the profiled variable consumes by itself, not
     * counting the memory consumed by any children (in the case of an array).
     */
    public function getOwnSize()
    {
        return $this->ownSize;
    }
    
    /**
     * Returns a reference to the VarProfile array that represents the profiles
     * of the children of the variable that is profiled by this instance.
     */
    public function &getChildren()
    {
        return $this->children;
    }
    
    /**
     * Returns the total size that the profiled variable consumes, including
     * the memory consumed by any children (in the case of an array).
     */
    public function getTotalSize()
    {
        return $this->totalSize;
    }
    
    /**
     * Returns the total number of elements that is profiled - this is always
     * 1 for scalar variables, and > 1 for (non-empty) arrays.
     */
    public function getTotalNumElements()
    {
        return $this->totalNumElements;
    }
    
    /**
     * Returns a human-readable string representation of this VarProfile.
     */
    public function __toString()
    {
        return "VarProfile[name={$this->name},size={$this->ownSize},total={$this->totalSize},type={$this->type}]";
    }
}
