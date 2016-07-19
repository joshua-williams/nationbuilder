<?php 

namespace NationBuilder\Form{
	use \JFrame\Loader;
	use \JFrame\Vars;
	
	class SurveyForm extends \JFrame\Form{
		
		function __construct(){
			$this->prop('type', 'div');
			
			$this->addFields([
				['name'=>'id', 'type'=>'hidden'],
				['name'=>'nation', 'type'=>'hidden'],
				['name'=>'questions', 'type'=>'hidden'],
				['name'=>'slug', 'label'=>'Slug', 'type'=>'text', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-6']],
				['name'=>'status', 'label'=>'Status', 'type'=>'dropdown', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-6'], 'options'=>[
					['label'=>'Published', 'value'=>'published'],
					['label'=>'Unlisted', 'value'=>'unlisted'],
					['label'=>'Hidden', 'value'=>'hidden']
				]],
				['name'=>'name', 'label'=>'Name', 'type'=>'text', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-6']],
				['name'=>'title', 'label'=>'Title', 'type'=>'text', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-6']],
				['name'=>'headline', 'label'=>'Headline', 'type'=>'text', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-12']],
				['name'=>'excerpt', 'label'=>'Excerpt', 'type'=>'textarea', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-12']],
				
				['name'=>'addQuestion', 'type'=>'submit', 'value'=>'Add Question', 'class'=>'btn btn-primary', 'parent'=>['class'=>'pull-left m10']],
				['type'=>'submit', 'value'=>'Save Survey', 'class'=>'btn btn-primary', 'parent'=>['class'=>'pull-right m10']],
			]);
		}
		
		public function action(){
			$survey = new \NationBuilder\Model\SurveyModel($_POST);
			$response = Loader::get('NationBuilder\Service\SurveyService')->save($survey, Vars::getFrom($_POST, 'nation'));
			return $response;
		}
	}
}

?>