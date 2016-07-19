<?php
namespace Main\Controller{
	use \JFrame\Vars;
	use \JFrame\Loader;
	
	class MainController extends \JFrame\Controller{
		private $nation;
		
		public function __construct(){
			parent::__construct();
			$this->view->config('templateEngine', 'jframe');
			$config = $this->app->getConfig('nationbuilder');
			if(!$config) die('Please create nationbuilder config file');
			$this->nation = array_keys($this->app->getConfig('nationbuilder')['nations'])[0];
		}
		
		public function index(){
			echo $this->view->render('index.phtml');
		}
		
		public function people(){
			$svc = new \NationBuilder\Service\PersonService();
			$people = $svc->getPeople($this->nation);
			echo $this->view->render('person/people.phtml', [
				'people' => $people,
			]);
		}
		
		public function person(){
			$id = Vars::get('id');
			$svc = new \NationBuilder\Service\PersonService();
			$response = $svc->getPerson($id, $this->nation);
			$person = $response->getData('body.person');
			echo $this->view->render('person/person.phtml', [
				'person' => $person
			]);
		}
		
		public function savePerson(){
			$form = new \NationBuilder\Form\PersonForm();
			$form->getField('nation')->attr('value', $this->nation);
			if($id = Vars::get('id')){
				$svc = new \NationBuilder\Service\PersonService();
				$response = $svc->getPerson($id, $this->nation);
				$person = $response->getData('body.person');
				if($person){
					foreach(['id','first_name','last_name','email','phone','sex'] as $prop){
						$field = $form->getField($prop);
						$field->attr('value', strval($person->$prop));
					}
				}
			}
			$this->view->vars('page_title', 'New Person');
			echo $this->view->render('person/save.phtml', [
				'form' => $form,
			]);
		}
		
		public function surveys(){
			$response = Loader::get('NationBuilder\Service\SurveyService')->getSurveys($this->nation);
			$surveys = $response->getData('body.results');
			echo $this->view->render('survey/surveys.phtml', [
				'surveys' => $surveys,
			]);
		}
		
		public function survey(){
			/*
			$svc = new \NationBuilder\Service\PersonService();
			$csvc = new \NationBuilder\Service\ContactService();
			$types = $csvc->getTypes($this->nation);			// #3 Question
			$methods = $csvc->getMethods($this->nation);		// #16 other
			$statuses = $csvc->getStatuses($this->nation);	// #9 Other
			die('<xmp>'.print_r($statuses,1));
			$contact = new \NationBuilder\Model\ContactModel([
				'type_id' => 3,
				'method' => 'other',
				'sender_id' => 2,
				'recipient_id' => 6,
				'note' => 'This is an api test contact',
				
			]);
			$response = $svc->saveContact($contact, $this->nation);
			echo '<xmp>';
			//print_r($types); 
			//print_r($methods);
			//print_r($statuses);
			print_r($response);
			exit;
			/////////////////////////////////////////
			
			*/
			$form = Loader::get('Main\Form\SurveyForm');
			$form->prop('type', 'div');
			
			$surveyId = Vars::get('id');
			$response = Loader::get('NationBuilder\Service\SurveyService')->getSurvey($surveyId, $this->nation);
			$survey = $response->getData('body.survey');
			$form->addField(['name'=>'survey_id', 'type'=>'hidden', 'value'=>$surveyId]);
			$form->addField(['name'=>'nation', 'type'=>'hidden', 'value'=>$this->nation]);
			$form->addField(['name'=>'person_id', 'type'=>'hidden', 'value'=> 6]);
			//die('<xmp>'.print_r($form,1));
			foreach($survey->questions as $question){
				$field = [
					'type' => $this->type2type($question->type),
					'name' => "question[$question->id]",
					'label' => $question->prompt,
					'class' => 'form-control',
				];
				if($field['type'] == 'dropdown'){
					$options = [];
					//die('<xmp>'.print_r($question,1));
					foreach($question->choices as $choice){
						$options[] = [
							'label' => $choice->name,
							'value' => $choice->name
						];
					}
					$field['options'] = $options;
					
				}
				$form->addField($field);
			}
			$form->addField(['type'=>'submit', 'class'=>'btn btn-primary mt10', 'value'=>'Submit']);
			echo $this->view->render('survey/survey.phtml', [
				'survey' => $survey,
				'form' => $form
			]);
		}
		
		public function saveSurvey(){
			$form = new \NationBuilder\Form\SurveyForm();
			$form->getField('nation')->attr('value', $this->nation);
			$form->prop('return', $this->app->config('site_url') . '/surveys');
			$questionForm = new \NationBuilder\Form\SurveyQuestionForm();
			
			echo $this->view->render("survey/save.phtml", [
				'form' => $form,
				'questionForm' => $questionForm,
			]);
		}
		
		private function type2type($type){
			switch($type){
				case 'text': case 'yes_no': return 'text'; break;
				case 'multiple': return 'dropdown'; break;
			}
		}
	}
}
?>