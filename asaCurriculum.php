<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/bitrix/Lib/asaService/asaCycles.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/bitrix/Lib/asaService/asaMetaInfo.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asaCurriculum
 *
 * @author Timur
 */
class asaCurriculum {
    private $fcycles;
    private $fmetainfo;
    public function __construct($aMetaInfo)
    {
        $this->fcycles = new asaCycles();
		$this->fmetainfo = $aMetaInfo;
    }
    
    public function get_cycles()
    {
        return $this->fcycles;
    }
	
	public function get_meta_info()
    {
        return $this->fmetainfo;
    }
}

?>
