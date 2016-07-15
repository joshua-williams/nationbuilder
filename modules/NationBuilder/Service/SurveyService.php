<?php 

namespace NationBuilder\Service{
	use \NationBuilder\Model\SurveyModel;
	
	class SurveyService extends NationBuilder{
		
		function getSurvey($id, $nation){
			$config = include("config/nationbuilder.php");
			$config = $config['nations'][$nation];
			$url = "https://{$nation}.nationbuilder.com/api/v1/sites/{$nation}/pages/surveys/{$id}?access_token={$config['token']}";
			return $this->sendRequest($url);
		}
		
		function getSurveys($nation){
			$config = include("config/nationbuilder.php");
			$config = $config['nations'][$nation];
			$url = "https://{$nation}.nationbuilder.com/api/v1/sites/{$nation}/pages/surveys?access_token={$config['token']}";
			return $this->sendRequest($url);
		}
		
		public function save(SurveyModel $survey, $nation){
			$config = include("config/nationbuilder.php");
			$config = $config['nations'][$nation];
			$url = "https://{$nation}.nationbuilder.com/api/v1/sites/{$nation}/pages/surveys?access_token={$config['token']}";
			$payload = $survey->properties();
			unset($payload['id']);
			unset($payload['nation']);
			unset($payload['tags']);
			foreach($payload['questions'] as &$q){unset($q['id']);}
			$payload = ['survey'=>$payload];
			$response = $this->sendRequest($url,json_encode($payload), ['Content-Type: application/json']);
			if(!$response->getData('body.survey.id')){
				$response->setData('survey', $survey->properties(1));
			}
			return $response;
		}
	}
}

?>