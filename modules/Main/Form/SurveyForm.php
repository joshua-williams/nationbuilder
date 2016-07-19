<?php 

namespace Main\Form{
	use \JFrame\Loader;
	
	class SurveyForm extends \JFrame\Form{
		
		
		function action(){
			$nation = (isset($_POST['nation'])) ? $_POST['nation'] : false;
			$response = Loader::get('NationBuilder\Service\SurveyResponseService')->save($_POST, $nation);
			$response_id = $response->getData('body.survey_response.id');
			$person_id = $response->getData('body.survey_response.person_id');
			$config = include("config/nationbuilder.php");
			$nation = array_keys($config['nations'])[0];
			// log contact
			if($response_id && $person_id){
				$svc = new \NationBuilder\Service\PersonService();
				$contact = new \NationBuilder\Model\ContactModel([
					'type_id' => 3,
					'method' => 'other',
					'sender_id' => 2,
					'recipient_id' => $person_id,
					'status' => 'other',
					'note' => 'Survey has been submitted'
				]);
				$svc->saveContact($contact, $nation);
			}
			return $response;
		}
	}
}

?>