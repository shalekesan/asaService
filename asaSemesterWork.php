<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/bitrix/Lib/asaService/asaTypeTesting.php');

class asaMatriculaRecord
{
	public $Pass;
	public $DateAttestation;
	public $Est;
	public $Ball;
}

class asaSemesterWork
{
    private $fnumber;
    private $ftype_testing;
    private $fHours;
	private $fMatriculaRecord;
	
	public function get_matricula_record()
	{
		return $this->fMatriculaRecord;
	}
	
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
	
    public function __construct($anumber, asaTypeTesting $atype_testing, asaMatriculaRecord $rec, $ahours)
    {
        $this->fnumber = $anumber;
        $this->ftype_testing = $atype_testing;
		$this->fMatriculaRecord = $rec;
		$this->fHours = $ahours;
    }
}
?>