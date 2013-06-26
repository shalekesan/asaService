<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asaResponseUtils
 *
 * @author Timur
 */
class asaResponseItem {
    //put your code here
    private $AnswerOrder;
    private $IsRight;
    protected $Value;
    
    public function __construct($AnswerOrder_, $IsRight_, $Value_) {
        $this->AnswerOrder = $AnswerOrder_;
        $this->IsRight = $IsRight_;
        $this->Value = $Value_;
    }
    public function get_answer_order()
    {
        return $this->AnswerOrder;
    }
    
    public function get_is_right()
    {
        return $this->IsRight;
    }
    
    public function get_value()
    {
        return $this->Value;
    }
}

class asaEditableResponseItem extends asaResponseItem{
    public function set_value($val)
    {
        $this->Value = $val;
    }
}


class asaResponse extends asaArray{
    private $ItemNumber;
    private $State;
    
    public function __construct($ItemNumber_, $State_)
    {
        $this->ItemNumber = $ItemNumber_;
        $this->State = $State_;
    }
    
    public function get_item_number()
    {
        return $this->ItemNumber;
    }
    
    public function get_state()
    {
        return $this->State;
    }
    
    public function add_response_item(asaResponseItem $s)
    {
        $this->add($s);
    }
    public function get_item($inx)
    {
        return $this->get_value($inx);
    }
    
    public function get_response_item($inx)
    {
        return $this->get_value($inx);
    }
    
    public function get_editable_response()
    {
        $result = new asaResponse($this->get_item_number(), $this->get_state());
        foreach ($this as $val)
        {
            $result->add_response_item(new asaEditableResponseItem($val->get_answer_order(),
                                                                   $val->get_is_right(),
                                                                   $val->get_value()));
        }
        return $result;
    }
}

class asaResponseSet extends asaArray{
    public function add_response(asaResponse $s)
    {
        $this->add($s);
    }
    
    public function get_response($inx)
    {
        return $this->get_value($inx);
    }
}
?>
