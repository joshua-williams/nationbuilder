<?php 

return [
	['uri'=>'people', 'controller'=>'MainController', 'callback'=>'people'],
	['uri'=>'person/:id', 'controller'=>'MainController', 'callback'=>'person', 'validate'=>'[0-9]+'],
	['uri'=>'person/:id/save', 'controller'=>'MainController', 'callback'=>'savePerson', 'validate'=>'[0-9]+'],
	['uri'=>'person/save', 'controller'=>'MainController', 'callback'=>'savePerson'],
	['uri'=>'webhook/people', 'controller'=>'WebhookController', 'callback'=>'people'],
	['uri'=>'webhook/donations', 'controller'=>'WebhookController', 'callback'=>'donations']
];

?>