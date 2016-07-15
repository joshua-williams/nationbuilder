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
			///die('<xmp>'.print_r($surveys,1));
			echo $this->view->render('survey/surveys.phtml', [
				'surveys' => $surveys,
			]);
		}
		
		public function survey(){
			$surveyId = Vars::get('id');
			$response = Loader::get('NationBuilder\Service\SurveyService')->getSurvey($surveyId, $this->nation);
			$survey = $response->getData('body.survey');
			echo $this->view->render('survey/survey.phtml', [
					'survey' => $survey
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
	}
}
?>