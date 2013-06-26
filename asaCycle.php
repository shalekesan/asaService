<?php
require_once($CFG->libdir .'/asaService/asaSubjectGroup.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asaCycle
 *
 * @author Timur
 */
class asaCycle  extends asaArray{
    private $fid;
    private $fname;
    private $fshortname;
   // private $fsubs;
    
    public function get_id()
    {
        return $this->fid;
    }
    
    public function get_name()
    {
        return $this->fname;
    }
    
    public function get_short_name()
    {
        return $this->fshortname;
    }
    
    public function __construct($aid, $aname, $shortname)
    {
        $this->fid = $aid;
        $this->fname = $aname;
        $this->fshortname = $shortname;
        //$this->fsubs = //$subs;
    }
    
    public function get_subjects_groups()
    {
        return $this->fsubs;
    }
    
    public function add_subjects_group(asaSubjectGroup &$subs)
    {
        $this->add($subs);
    }
}

?>
