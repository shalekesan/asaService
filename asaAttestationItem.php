<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asaAttestationItem
 *
 * @author Timur
 */

require_once($CFG->libdir .'/asaService/asaTestVariants.php');

class asaAttestationItem {
    //put your code here
    private $Variants;
    private $AttestationID;
    private $Content;
    private $Number;
    private $UnitType;
    
    public function  get_attestation_id()
    {
        return $this->AttestationID;
    }
    
    public function  get_content()
    {
        return $this->Content;
    }
    
    public function  get_number()
    {
        return $this->Number;
    }
    
    public function  get_unit_type()
    {
        return $this->UnitType;
    }
    
    public function  get_variants()
    {
        return $this->Variants;
    }
    
    public function __construct($aAttestationID, $aContent, $aNumber, $aUnitType)
    {
        $this->Variants = new asaTestVariants();
        $this->AttestationID = $aAttestationID;
        $this->Content = $aContent;
        $this->Number = $aNumber;
        $this->UnitType = $aUnitType;
  
    }
    
    public function create_editable_response()
    {
        $result = new asaResponse($this->get_number(), -1);
        $filler = '0';
        if ($this->get_unit_type() == 'open') $filler='';
        foreach ($this->get_variants() as $val)
        {
            $result->add_response_item(new asaEditableResponseItem($val->get_order_num(),
                                                                   false,
                                                                   $filler));
        }
        return $result;
    }
}


class asaTestAttestationItem extends asaAttestationItem{
    
    private $Response;
    
    public function get_response()
    {
        return $this->Response;
    }
    
    public function __construct($aAttestationID, $aContent, $aNumber, $aUnitType, $aResponse)
    {
        parent::__construct($aAttestationID, $aContent, $aNumber, $aUnitType);
        $this->Response = $aResponse;  
    }
}

?>
