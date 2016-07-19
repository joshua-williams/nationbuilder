<?php 

namespace NationBuilder\Model{
	
	class ContactModel extends \JFrame\Model{
		protected $type_id;
		protected $method;
		protected $sender_id;
		protected $recipient_id;
		protected $status;
		protected $broadcaster_id;
		protected $note;
		protected $created_at;
		protected $capital_in_cents;
	}
}

?>