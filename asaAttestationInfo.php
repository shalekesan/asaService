<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asaAttestationInfo
 *
 * @author Timur
 */
class asaAttestationInfo {
    private $fAttestationID;
    private $fCanTesting;
    private $fFormAttestation;
    private $fItemCount;
    private $fSemester;
    private $fSerialNumber;
    private $fSubjectID;
    private $fSubjectName;
    private $fTimeToTest;
    private $fTypeTesting;
    
    private $fError;
    private $fErrorMessage;
    
    public function get_can_testing()
    {
        return $this->fCanTesting;
    }
    
    public function get_form_attestation()
    {
        return $this->fFormAttestation;
    }
    
    public function get_id()
    {
        return $this->fAttestationID;
    }
    
    public function get_item_count()
    {
        return $this->fItemCount;
    }
    
    public function get_semester()
    {
        return $this->fSemester;
    }
    
    public function get_serial_number()
    {
        return $this->fSerialNumber;
    }
    
    public function get_subject_id()
    {
        return $this->fSubjectID;
    }
    
    public function get_subject_name()
    {
        return $this->fSubjectName;
    }
    
    public function get_time_to_test()
    {
        return $this->fTimeToTest;
    }
    
    public function get_type_testing()
    {
        return $this->fTypeTesting;
    }
    
    public function in_error()
    {
        return $this->fError;
    }
    
    public function get_error_message()
    {
        return $this->fErrorMessage;
    }
    
    public function __construct($AttestationID, $CanTesting, $FormAttestation,
            $ItemCount, $Semester, $SerialNumber, $SubjectID, $SubjectName,
            $TimeToTest, $TypeTesting, $Error, $ErrorMessage)
    {
        $this->fAttestationID = $AttestationID;
        $this->fCanTesting = $CanTesting;
        $this->fFormAttestation = $FormAttestation;
        $this->fItemCount = $ItemCount;
        $this->fSemester = $Semester;
        $this->fSerialNumber = $SerialNumber;
        $this->fSubjectID = $SubjectID;
        $this->fSubjectName = $SubjectName;
        $this->fTimeToTest = $TimeToTest;
        $this->fTypeTesting = $TypeTesting;
        
        $this->fError = $Error;
        $this->fErrorMessage = $ErrorMessage;
    }
}

?>
