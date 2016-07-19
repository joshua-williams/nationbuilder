<?php 

namespace NationBuilder\Service{
	use \NationBuilder\Model\ContactModel;
	
	class ContactService extends NationBuilder{
		protected $config;
		
		function getTypes($nation){
			$config = include("config/nationbuilder.php");
			$config = $config['nations'][$nation];
			$url = "https://{$nation}.nationbuilder.com/api/v1/settings/contact_types/?access_token={$config['token']}";
			$response = $this->sendRequest($url, [], ["Content-Type: application/json"]);
			return $response->getData('body.results');
		}
		
		function getMethods($nation){
			$config = include("config/nationbuilder.php");
			$config = $config['nations'][$nation];
			$url = "https://{$nation}.nationbuilder.com/api/v1/settings/contact_methods/?access_token={$config['token']}";
			$response = $this->sendRequest($url, [], ["Content-Type: application/json"]);
			return $response->getData('body.results');
		}
		
		function getStatuses($nation){
			$config = include("config/nationbuilder.php");
			$config = $config['nations'][$nation];
			$url = "https://{$nation}.nationbuilder.com/api/v1/settings/contact_statuses/?access_token={$config['token']}";
			$response = $this->sendRequest($url, [], ["Content-Type: application/json"]);
			return $response->getData('body.results');
		}
		
	}
}

?>