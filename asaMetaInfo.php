<?php


class asaMetaInfo
{
    private $fOrganizationName;
    private $fSubdivisionName;
	private $fDirectionName;
	private $fSpecializationName;
	private $fDurationEducation;
	private $fQualificationEducation;
	private $fFormEducation;
	private $fBaseEducationRate;
    private $fMember;
	
    public function get_organization_name()
    {
        return $this->fOrganizationName;
    }
    
    public function get_subdivision_name()
    {
        return $this->fSubdivisionName;
    }
    
	public function get_direction_name()
    {
        return $this->fDirectionName;
    }
	
	public function get_specialization_name()
    {
        return $this->fSpecializationName;
    }
	
	public function get_duration_education()
    {
        return $this->fDurationEducation;
    }
	
	public function get_qualification_education()
    {
        return $this->fQualificationEducation;
    }
	
	public function get_form_education()
    {
        return $this->fFormEducation;
    }
	
	public function get_base_education_rate()
    {
        return $this->fBaseEducationRate;
    }
	
	public function get_member()
    {
        return $this->fMember;
    }
	
    public function __construct($aOrganizationName, $aSubdivisionName, 
		$aDirectionName, $aSpecializationName, $aDurationEducation, 
		$aQualificationEducation, $aFormEducation, 
		$aBaseEducationRate, $aMember)
    {
        $this->fOrganizationName = $aOrganizationName;
        $this->fSubdivisionName = $aSubdivisionName;
		$this->fDirectionName = $aDirectionName;
		$this->fSpecializationName = $aSpecializationName;
		$this->fDurationEducation = $aDurationEducation;
		$this->fQualificationEducation = $aQualificationEducation;
		$this->fFormEducation = $aFormEducation;
		$this->fBaseEducationRate = $aBaseEducationRate;
		$this->fMember = $aMember;
    }
}
?>