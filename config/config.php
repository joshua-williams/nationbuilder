<?php 

return array(
	'debug' => false,
	'path' => rtrim(dirname(getcwd())),
	'application' => 'Nation Builder',
	'site_url' => 'dev.nationbuilder',
	'site_url_ssl' => false,
	'sesson_timeout' => 30,
	'form_timeout' => 10,
	'hash' => 'application_hash',
	'enc_key' => 'my_encryption_key',
	'template_engine' => 'jframe',
	'segment_offset' => 0,
	'modules' => ['Main','NationBuilder'],
	'default_module' => 'Main',
);
?>