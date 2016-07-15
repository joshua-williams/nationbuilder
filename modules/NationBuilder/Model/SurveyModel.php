<?php 

namespace NationBuilder\Model{
	use \JFrame\Vars;
	
	class SurveyModel extends \JFrame\Model{
		protected $id;
		protected $nation;
		protected $slug;
		protected $status;
		protected $tags;
		protected $name;
		protected $title;
		protected $headline;
		protected $excerpt;
		protected $questions = [];
		
		public function set($property, $val=null){
			if(is_object($property)) $property = (array) $property;
			if(is_string($property)){
				if($property === 'questions'){
					$this->addQuestions($val);
				}else{
					if(!property_exists($this, $property)) return;
					$this->$property = $val;
				}
				
			}elseif(is_array($property)){
				foreach($property as $key=>$_val){
					if($key == 'questions'){
						$this->addQuestions($_val);
					}else{
						//echo $key.'<br>';
						$this->set($key, $_val);
					}
				}
			}
		}
		
		public function addQuestions($questions){
			// Convert json string to php object
			if(is_string($questions) && (!$questions = json_decode($questions))) return;
			if(!is_array($questions)) return;
			//die('<xmp>'.print_r($questions,1));
			foreach($questions as $q){
				$question = [];
				if(!is_array($q) && !is_object($q)) continue;
				$q = (array) $q;
				$question['id'] = Vars::getFrom($q, 'id');
				if(!$question['prompt'] = Vars::getFrom($q, 'prompt')) continue;
				if(!$question['type'] = Vars::getFrom($q, 'type')) continue;
				if(!$question['status'] = Vars::getFrom($q, 'status')) continue;
				if(!$question['slug'] = Vars::getFrom($q, 'slug')) continue;
				$question['tags'] = Vars::getFrom($q, 'tags');
				if($question['type'] == 'multiple'){
					$question['choices'] = [];
					
					if(!$choices = Vars::getFrom($q, 'choices')) continue;
					if(!is_array($choices)) continue;
					
					foreach($choices as $choice){
						if(!is_array($choice) && !is_object($choice)) continue;
						$choice = (array) $choice;
						if(!in_array('name', array_keys($choice),1)) continue;
						$question['choices'][] = [
							'name' => $choice['name'],
							'tage' => Vars::getFrom($choice, 'tags'),
							'feedback' => Vars::getFrom($choice, 'feedback')
						];
					}
					if(!$question['choices']) continue;
				}
				$this->questions[] = $question;
			}
		}
		
	}
}

?>