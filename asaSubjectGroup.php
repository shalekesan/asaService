<?php
require_once($CFG->libdir .'/asaService/asaArray.php');
require_once($CFG->libdir .'/asaService/asaSubject.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asaSubjectGroup
 *
 * @author Timur
 */
class asaSubjectGroup extends asaArray{
    private $fnumber;
    
    public function get_number()
    {
        return $this->fnumber;
    }
    
    public function __construct($anumber)
    {
        $this->fnumber = $anumber;
    }
    
    public function add_subject(asaSubject $s)
    {
        $this->add($s);
    }
}

?>
