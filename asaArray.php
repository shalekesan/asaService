<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asaArray
 *
 * @author Timur
 */
class asaArray implements Iterator{
    private $position = 0;
    private $container;
    
    public function __construct()
    {
        $this->position = 0;
    }
    
    function rewind() {
        $this->position = 0;
    }

    function current() {
        return $this->container[$this->position];
    }

    function key() {
        return $this->position;
    }

    function next() {
        ++$this->position;
    }

    function valid() {
        return isset($this->container[$this->position]);
    }
    
    protected function add(&$sw)
    {
        $this->container[] = $sw;
    }
    public function get_count()
    {
        return count($this->container);
    }
	
	protected function get_value($inx)
	{
		return $this->container[$inx];
	}
}

?>
