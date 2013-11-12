<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/bitrix/Lib/asaService/asaCycle.php');
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
	
	public function add_cycles(asaCycles $s)
    {
		foreach ($s as $cycle){
			$this->add($cycle);
		}
    }
	
	public function get_cycle($inx)
	{
		return $this->get_value($inx);
	}
}

?>
