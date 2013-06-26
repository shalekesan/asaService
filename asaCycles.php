<?php
require_once($CFG->libdir .'/asaService/asaCycle.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asaCycles
 *
 * @author Timur
 */
class asaCycles extends asaArray{
    
    public function add_subject(asaCycle $s)
    {
        $this->add($s);
    }
	public function get_cycle($inx)
	{
		return $this->get_value($inx);
	}
}

?>
