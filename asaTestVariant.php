<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asaTestVariant
 *
 * @author Timur
 */
class asaTestVariant {
    private $OrderNum;
    private $Sequence;
    private $Tag;
    private $IsRight;
    private $ItemText;
    
    public function __construct($aOrderNum, $aSequence, $aTag, $aIsRight, 
            $aItemText)
    {
        $this->OrderNum = $aOrderNum;
        $this->Sequence = $aSequence;
        $this->Tag = $aTag;
        $this->IsRight = $aIsRight;
        $this->ItemText = $aItemText;
    }
    
    public function get_order_num ()
    {
        return $this->OrderNum;
    }
    
    public function get_sequence ()
    {
        return $this->Sequence;
    }
    
    public function get_tag ()
    {
        return $this->Tag;
    }
    
    public function get_is_right ()
    {
        return $this->IsRight;
    }
    
    public function get_item_text()
    {
        return $this->ItemText;
    }
 
}

?>
