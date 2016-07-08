<?php 

namespace NationBuilder\Service{
	use \NationBuilder\Model\PersonModel;
	
	class PersonService extends NationBuilder{
		
		function getPeople($nation){
			$config = include("config/nationbuilder.php");
			$config = $config['nations'][$nation];
			$url = "https://{$nation}.nationbuilder.com/api/v1/people/?limit=100&access_token={$config['token']}";
			$response = $this->sendRequest($url);
			return $response->getData('body.results');
		}
		
		function getPerson($id, $nation){
			$config = include("config/nationbuilder.php");
			$config = $config['nations'][$nation];
			$url = "https://{$nation}.nationbuilder.com/api/v1/people/{$id}?limit=100&access_token={$config['token']}";
			return $response = $this->sendRequest($url);
		}
		
		function save(PersonModel $person){
			$person = $person->properties(1);
			if(!$person->first_name) return $this->response->setError('First name is required');
			if(!$person->email) return $this->response->setError('Email address is required');
			$config = include("config/nationbuilder.php");
			$config = $config['nations'][$person->nation];
			$url = "https://{$person->nation}.nationbuilder.com/api/v1/people/?access_token={$config['token']}";
			unset($person->nation);
			$payload = ['person'=>$person];
			$response = $this->sendRequest($url, json_encode($payload), ['Content-Type: application/json']);
			if($response->getData('header.Status') == '409 Conflict'){
				return $response->setError('A user with that email already exists');
			}else{
				return $response->setSuccess('Person has been created');
			}
		}
		
		function update(PersonModel $person){
			$person = $person->properties(1);
			if(!$person->first_name) return $this->response->setError('First name is required');
			if(!$person->email) return $this->response->setError('Email address is required');
			$config = include("config/nationbuilder.php");
			$config = $config['nations'][$person->nation];
			$url = "https://{$person->nation}.nationbuilder.com/api/v1/people/{$person->id}/?access_token={$config['token']}";
			unset($person->nation);
			$payload = ['person'=>$person];
			$response = $this->sendRequest($url, json_encode($payload), ['Content-Type: application/json'], 'put');
			if($response->getData('body.code') == 'not_found') return $response->setError('Person not found');
			return $response->setSuccess('Person has been updated');
		}
		
		public function delete(PersonModel $person){
			$person = $person->properties(1);
			if(!$person->id) return $this->response->setError('Person not found');
			$config = include("config/nationbuilder.php");
			$config = $config['nations'][$person->nation];
			$url = "https://{$person->nation}.nationbuilder.com/api/v1/people/{$person->id}/?access_token={$config['token']}";
			$response = $this->sendRequest($url, false, ['Content-Type: application/json'], 'delete');
			if($response->getData('header.Status') == '204 No Content') return $response->setSuccess('Person has been deleted.');
			return $response->setError('Failed to delete person');
		}
	}
}

?>