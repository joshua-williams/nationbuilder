<?php 

namespace NationBuilder\Form{
	use \JFrame\Vars;
	
	class PersonForm extends \JFrame\Form{
		
		function __construct(){
			
			$this->prop('type','div');
			
			$this->addFields([
				['name'=>'id', 'type'=>'hidden'],
				['name'=>'nation', 'type'=>'hidden'],
				['name'=>'first_name', 'type'=>'text', 'label'=>'First Name', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-4']],
				['name'=>'last_name', 'type'=>'text', 'label'=>'Last Name', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-4']],
				['name'=>'email', 'type'=>'text', 'label'=>'Email Address', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-4']],
				['name'=>'phone', 'type'=>'text', 'label'=>'Phone', 'class'=>'form-control', 'parent'=>['class'=>'col-sm-4']],
				[
					'name'=>'sex', 
					'type'=>'dropdown', 
					'label'=>'Gender',
					'class'=>'form-control',
					'options'=>[
						['label'=>'Male', 'value'=>'M'],
						['label'=>'Female', 'value'=>'F']
					],
					'parent'=>['class'=>'col-sm-4']
				],
				['type'=>'submit', 'name'=>'submit', 'value'=>'Save', 'class'=>'btn btn-primary pull-right', 'parent'=>['class'=>'col-sm-12 mt20']]
					
			]);
		}
		
		function action(){
			$model = new \NationBuilder\Model\PersonModel($_POST);
			$svc = new \NationBuilder\Service\PersonService();
			if(Vars::get('submit') === 'Delete'){
				$response = $svc->delete($model);
			}else{
				$response = ($model->prop('id')) ? $svc->update($model) : $svc->save($model);
			}
			return $response;
		}
	}
}

?>