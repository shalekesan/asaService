<?php

require_once($CFG->libdir .'/asaService/asaArray.php');
require_once($CFG->libdir .'/asaService/asaSemesterWork.php');

class asaSubject extends asaArray
{
    private $fid;
    private $fname;
    
    public function get_name()
    {
        return $this->fname;
    }
    
    public function get_id()
    {
        return $this->fid;
    }
    
    public function __construct($aid, $aname)
    {
        $this->fid = $aid;
        $this->fname = $aname;
    }
    
    public function add_semester_work(asaSemesterWork &$sw)
    {
        $this->add($sw);
    }
}
?>