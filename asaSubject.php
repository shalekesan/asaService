<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/bitrix/Lib/asaService/asaArray.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/bitrix/Lib/asaService/asaSemesterWork.php');

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
	
	public function work_count_in_semester($sem)
	{
		$pres = 0;
		foreach($this as $sw)
		{
			if ($sw->get_number()==$sem)
			{
				$pres = $pres + 1;
			}
		}
		return $pres;
	}
	
	public function passed()
	{
		foreach($this as $sw)
		{
			if (! $sw->get_matricula_record()->Pass)
			{
				return false;
			}
		}
		return true;
	}
	
	public function semester_present($sem)
	{
		$pres = false;
		foreach($this as $sw)
		{
			if ($sw->get_number()==$sem)
			{
				$pres = true;
			}
		}
		return $pres;
	}
}
?>