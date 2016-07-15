<?php 

namespace NationBuilder\Form{
	
	class SurveyQuestionForm extends \JFrame\Form{
		
		function __construct(){
			$this->prop('type', 'div');
			$this->attr('name', 'survey-question');
			
			$this->addFields([
					['name'=>'id', 'type'=>'hidden'],
					['name'=>'slug', 'type'=>'text', 'class'=>'form-control'],
					['name'=>'prompt', 'label'=>'Prompt', 'type'=>'text', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-6']],
					['name'=>'tags', 'label'=>'Tags', 'type'=>'text', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-6']],
					['name'=>'type', 'label'=>'Type', 'type'=>'dropdown', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-12'], 'options'=>[
						['label'=>'Text', 'value'=>'text'],
						['label'=>'Multiple', 'value'=>'multiple'],
						['label'=>'Yes/No', 'value'=>'yes_no'],
					]],
					['name'=>'status', 'type'=>'dropdown', 'label'=>'Status', 'class'=>'form-control', 'options'=>[
						['label'=>'Published', 'value'=>'published'],
						['label'=>'Unlisted', 'value'=>'unlisted'],
						['label'=>'Hidden', 'value'=>'hidden']
					]],
					['name'=>'choices', 'label'=>'Choices', 'class'=>'form-control', 'options'=>[]],
					['type'=>'submit', 'value'=>'Save Question', 'class'=>'btn btn-primary mt10 pull-right', 'parent'=>['class'=>'col-sm-12']]
			]);
		}
	}
}

?>