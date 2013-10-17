<?php

require_once($CFG->libdir .'/asaService/asaTypeTesting.php');

class asaSemesterWork
{
    private $fnumber;
    private $ftype_testing;
    private $fHours;
	
    public function get_number()
    {
        return $this->fnumber;
    }
    
    public function get_type_testing()
    {
        return $this->ftype_testing;
    }
    public function get_hours()
    {
        return $this->fHours;
    }
	
    public function __construct($anumber, asaTypeTesting $atype_testing, $ahours)
    {
        $this->fnumber = $anumber;
        $this->ftype_testing = $atype_testing;
		$this->fHours = $ahours;
    }
}
?>