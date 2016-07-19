<?php 

namespace NationBuilder\Service{
	use \JFrame\Vars;
	
	class SurveyResponseService extends NationBuilder{
		
		public function save(Array $response, $nation){
			$config = include("config/nationbuilder.php");
			$config = $config['nations'][$nation];
			if(!$survey_id = Vars::getFrom($response, 'survey_id')) return $this->response->setError('Survey ID required');
			if(!$person_id = Vars::getFrom($response, 'person_id')) return $this->response->setError('Persion ID is required');
			if(!$questions = Vars::getFrom($response, 'question')) return $this->response->setError('Questions are required');
			$url = "https://{$nation}.nationbuilder.com/api/v1/survey_responses/?access_token={$config['token']}";
			
			$payload = [
				'survey_response' => [
					'survey_id' => $survey_id,
					'person_id' => $person_id,
					'question_responses' => [],
				]
			];
			foreach($questions as $question_id => $value){
				$payload['survey_response']['question_responses'][] = [
					'question_id' => $question_id,
					'response' => $value
				];
			}
			$response = $this->sendRequest($url, json_encode($payload), ['Content-Type: application/json']);
			return $response;
		}
	}
}

?>