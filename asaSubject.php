<?php

require_once($CFG->libdir .'/asaService/asaArray.php');
require_once($CFG->libdir .'/asaService/asaSemesterWork.php');

class asaSubject extends asaArray
{
    private $fid;
    private $fname;
    private $fcode;
	
    public function get_name()
    {
        return $this->fname;
    }
    
    public function get_id()
    {
        return $this->fid;
    }
    
	public function get_code()
    {
        return $this->fcode;
    }
	
    public function __construct($aid, $aname, $acode)
    {
        $this->fid = $aid;
        $this->fname = $aname;
		$this->fcode = $acode;
    }
    
    public function add_semester_work(asaSemesterWork &$sw)
    {
        $this->add($sw);
    }
}
?>