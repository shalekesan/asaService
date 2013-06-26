<?php

require_once($CFG->libdir .'/asaService/asaTypeTesting.php');

class asaSemesterWork
{
    private $fnumber;
    private $ftype_testing;
    
    public function get_number()
    {
        return $this->fnumber;
    }
    
    public function get_type_testing()
    {
        return $this->ftype_testing;
    }
    
    public function __construct($anumber, asaTypeTesting $atype_testing)
    {
        $this->fnumber = $anumber;
        $this->ftype_testing = $atype_testing;
    }
}
?>