<?php

require_once($CFG->libdir .'/asaService/asaCycles.php');
require_once($CFG->libdir .'/asaService/asaAttestationInfo.php');
require_once($CFG->libdir .'/asaService/asaAttestationItem.php');
require_once($CFG->libdir .'/asaService/asaResponseUtils.php');
require_once($CFG->libdir .'/php_fast_cache.php');

define("empty_guid", "00000000-0000-0000-0000-000000000000");
define("form_attestation_test", "Тест");
define("form_attestation_writen_work", "Письменная аттестационная работа");

class asaFactory
{
    private static $client;
    
    //ww - Задание на ПАР, open - открытй вопрос, 
        //closed_single - закрытый вопрос с одним вариантом,
        //closed_multi - закрытый вопрос с множественным выбором,
        //seq - последовательность; corr - соответствие.

    
    public static $test_unit_type = array("open", "closed_single", "closed_multi", "seq", "corr");
    
    public static function singleton()
    {
        if (!isset(self::$client)) {
            
            ini_set('soap.wsdl_cache_enabled', '0');
            //ini_set('soap.wsdl_cache_ttl', '10');
            self::$client = new SoapClient('http://asa.insto.ru:3989/Service1.svc?wsdl');
        }
        return self::$client;
    }
    
    private static function parse_type_testing($response)
    {
        return new asaTypeTesting($response->FID, $response->FName);
    }
    
    private static function parse_dictionary_value($response)
    {
        $res = new stdClass();
        $res->ID = $response->FID;
        $res->Name = $response->FName;
        $res->ShortName = $response->FShortName;
        $res->FullName = $response->FFullName;
        $res->Abbreviation = $response->FAbbreviation;
        $res->Comment = $response->FComment;
        $res->DictionaryName = $response->FDictionaryName;
        return $res;
    }
    
    private static function parse_semester_work($response)
    {
        $res = new asaSemesterWork($response->Number, self::parse_type_testing($response->TypeTesting), $response->Hours);
        return $res;
    }
    
    private static function parse_subject($response)
    {
        $res = new asaSubject($response->Subject->FID, $response->Subject->FName, $response->Code);
        $sw = $response->SemesterWorks;
	    if (count($sw) == 1) 
		{
			$sw_val = self::parse_semester_work($sw->asaSemesterWork);
			$res->add_semester_work($sw_val);
		}
		else
		{
			foreach($sw as $value) {
				$sw_val = self::parse_semester_work($value->asaSemesterWork);
				$res->add_semester_work($sw_val);
			}
		}
		//print $res->get_name();
        return $res;
    }
    
    private static function parse_subject_group($response)
    {
        $res = new asaSubjectGroup($response->GrouNumber);
        foreach($response->Subjects->asaSubject as $value)
	{
            $res->add_subject(self::parse_subject($value));
        };
        return $res;
    }
	
    private static function parse_cycle($response)
    {
	$c_id = $response->ID;
	$c_name = $response->Name;
	$c_shortname = $response->ShortName;
        $res = new asaCycle($c_id, $c_name, $c_shortname);
        
        if (is_array($response->SubjectGroups)){
            foreach($response->SubjectGroups as $value)
            {
                $c_sg = self::parse_subject_group($value);
                $res->add_subjects_group($c_sg);
            }
        }
        else{
            $c_sg = self::parse_subject_group($response->SubjectGroups->asaSubjectGroup);
            $res->add_subjects_group($c_sg);
        }
        return $res;
    }
	
	private static function parse_cycles($response)
    {
        $res = new asaCycles();
        foreach($response->Cycles as $value)
	{
            $res->add_subject(self::parse_cycle($value));
        };
        return $res;
    }
    
    public static function parse_test_variant($data)
    {
        return new asaTestVariant($data->OrderNum, $data->Sequence, 
                $data->Tag, $data->IsRight, $data->ItemText);
    }
    
    public static function get_curriculum()
    {
        $res = self::singleton()->GetCurriculum();
        $result = self::parse_cycles($res->GetCurriculumResult);
        return $result;
    }
    
    public static function get_user_curriculum($un)
    {
        $res = self::singleton()->GetUserCurriculum(array('Login'=>$un));
        $result = self::parse_cycles($res->GetUserCurriculumResult);
        return $result;
    }
    
    protected static function parse_attestation_info($buff)
    {
        return  new asaAttestationInfo($buff->AttestationID,
                $buff->CanTesting,
                $buff->FormAttestation,
                $buff->ItemCount,
                $buff->Semester,
                $buff->SerialNumber,
                $buff->SubjectID,
                $buff->SubjectName,
                $buff->TimeToTest,
                $buff->TypeTesting,
                $buff->InError, $buff->ErrorMessage);
    }


    public static function get_attestation_info($user_name, $subject_name)
    {
        $res = self::singleton()->GetAttestationInfo(
                array('Login'=>$user_name, 
                        'Token'=>asa_key, 
                    'SubjectName'=>$subject_name));
        $result = self::parse_attestation_info($res->GetAttestationInfoResult);
        
        return $result;
    }
    
    public static function begin_attestation($user_name, $subject_name)
    {
        $res = self::singleton()->BeginAttestation(
                array('Login'=>$user_name, 
                        'Token'=>asa_key, 
                    'SubjectName'=>$subject_name));
        $result = self::parse_attestation_info($res->BeginAttestationResult);
        return $result;
    }
    
    
    
    public static function get_attestation_item ($user_name, $attestation_id, 
            $number)
    {
        $res = self::singleton()->GetAttestationItem (
                array('Login'=>$user_name, 
                        'Token'=>asa_key, 
                    'AttestationID'=>$attestation_id,
                    'ItemNumber'=>$number));
        
        $unit_type = $res->GetAttestationItemResult->UnitType;
        if (in_array($unit_type, self::$test_unit_type))
        {
            $result = new asaTestAttestationItem($res->GetAttestationItemResult->AttestationID, 
                $res->GetAttestationItemResult->Content, 
                $res->GetAttestationItemResult->Number, 
                $unit_type, self::parse_response($res->GetAttestationItemResult->Response));
        }
        else
        {
            
            $result = new asaAttestationItem($res->GetAttestationItemResult->AttestationID, 
                $res->GetAttestationItemResult->Content, 
                $res->GetAttestationItemResult->Number, 
                $unit_type);
        }
        if (is_array($res->GetAttestationItemResult->Variants->asaTestItem)){
            foreach($res->GetAttestationItemResult->Variants->asaTestItem as $value)
            {
                $c_sg = self::parse_test_variant($value);
                $result->get_variants()->add_variant($c_sg);
            }
        }
        else{
            $c_sg = self::parse_subject_group($response->SubjectGroups->asaSubjectGroup);
            $result->get_variants().add_variant($c_sg);
        }
        return $result;
    }
    
    protected static function parse_response_item($buff)
    {
        $result = null;
        
        if (isset($buff))
        {
            $result = new asaResponseItem($buff->AnswerOrder, $buff->IsRight, 
                    $buff->Value);
        }
        return $result;
    }
    
    
    protected static function parse_response($buff)
    {
        $result = null;
        if (isset($buff))
        {
            $result = new asaResponse($buff->ItemNumber, $buff->State);
            if (isset($buff->Items->asaResponseItem))
            {
                if (is_array($buff->Items->asaResponseItem))
                {
                    foreach ($buff->Items->asaResponseItem as $value)
                    {
                        $tmp = self::parse_response_item($value);
                        $result->add_response_item($tmp);
                    }
                }
                else
                {
                    $tmp = self::parse_response_item($buff->Items->asaResponseItem);
                    $result->add_response_item($tmp);
                }
            }
        }
        return $result;
    }
    
    protected static function parse_responses($buff)
    {
        $result = NULL;
        if (isset($buff))
        {
            $result = new asaResponseSet();
            if (is_array($buff->Items->asaResponse))
            {
                foreach ($buff->Items->asaResponse as $value)
                {
                    $tmp = self::parse_response($value);
                    $result->add_response($tmp);
                }
            }
        }
        return $result;
    }
    
    public static function get_all_responses($user_name, $attestation_id)
    {
        $res = self::singleton()->GetAttestationAllResponses (
                array('Login'=>$user_name, 
                        'Token'=>asa_key, 
                    'AttestationID'=>$attestation_id));
        $result = self::parse_responses($res->GetAttestationAllResponsesResult);
        return $result;
    }
    
    //Генерация параметра Response для SOAP запроса
    public static function create_response_as_param(asaResponse $res)
    {
        $items = array();
        foreach ($res as $item)
        {
            $items[] = array("AnswerOrder"=>$item->get_answer_order(),
                             "IsRight"=>$item->get_is_right(), "Value"=>$item->get_value());
        }
        $result = array("ItemNumber"=>$res->get_item_number(), "Pass"=>$res->get_state()==1, "Items"=>$items);
        return $result;
    }
    
    public static function set_responses($user_name, $attestation_id, asaResponse $response)
    {
        $res = self::singleton()->SetAttestationResponse(
                array('Login'=>$user_name, 
                        'Token'=>asa_key, 
                    'AttestationID'=>$attestation_id,
                    'Response'=>self::create_response_as_param($response)));
        //$result = self::parse_responses($res->GetAttestationAllResponsesResult);
        //return $result;
    }
}

?>