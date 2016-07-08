<?php 

return [
	['uri'=>'people', 'controller'=>'MainController', 'callback'=>'people'],
	['uri'=>'person/:id', 'controller'=>'MainController', 'callback'=>'person', 'validate'=>'[0-9]+'],
	['uri'=>'person/:id/save', 'controller'=>'MainController', 'callback'=>'savePerson', 'validate'=>'[0-9]+'],
	['uri'=>'person/save', 'controller'=>'MainController', 'callback'=>'savePerson'],
		
	['uri'=>'surveys', 'controller'=>'MainController', 'callback'=>'surveys'],
	['uri'=>'survey/:id', 'controller'=>'MainController', 'callback'=>'survey'],
	['uri'=>'survey/:id/save', 'controller'=>'MainController', 'callback'=>'saveSurvey'],
	['uri'=>'survey/save', 'controller'=>'MainController', 'callback'=>'saveSurvey'],
	
	['uri'=>'webhook/people', 'controller'=>'WebhookController', 'callback'=>'people'],
	['uri'=>'webhook/donations', 'controller'=>'WebhookController', 'callback'=>'donations']
];

?>