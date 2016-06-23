<?php
namespace Main\Controller{
	use \JFrame\Vars;
	
	class MainController extends \JFrame\Controller{
		
		public function __construct(){
			parent::__construct();
			$this->view->config('templateEngine', 'jframe');
			
		}
		public function index(){
			echo $this->view->render('index.phtml');
		}
		
		public function people(){
			$svc = new \NationBuilder\Service\PersonService();
			$people = $svc->getPeople('robbinskerstendev');
			//die('<xmp>'.print_r($people,1));
			echo $this->view->render('person/people.phtml', [
				'people' => $people,
			]);
		}
		
		public function person(){
			$id = Vars::get('id');
			$svc = new \NationBuilder\Service\PersonService();
			$response = $svc->getPerson($id, 'robbinskerstendev');
			$person = $response->getData('body.person');
			echo $this->view->render('person/person.phtml', [
				'person' => $person
			]);
		}
		
		public function savePerson(){
			$form = new \NationBuilder\Form\PersonForm();
			$form->getField('nation')->attr('value','robbinskerstendev');
			if($id = Vars::get('id')){
				$svc = new \NationBuilder\Service\PersonService();
				$response = $svc->getPerson($id, 'robbinskerstendev');
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
	}
}
?>