<?php


class asaTypeTesting
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
}
?>