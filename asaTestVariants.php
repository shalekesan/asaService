<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asaTestVariants
 *
 * @author Timur
 */
require_once($CFG->libdir .'/asaService/asaTestVariant.php');
require_once($CFG->libdir .'/asaService/asaArray.php');

class asaTestVariants extends asaArray{
    public function add_variant(asaTestVariant $s)
    {
        $this->add($s);
    }
    public function get_variant($inx)
    {
        return $this->get_value($inx);
    }
}

?>
