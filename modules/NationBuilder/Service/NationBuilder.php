<?php 

namespace NationBuilder\Service{
	
	class NationBuilder extends \JFrame\Service{
		protected $config;
		
		public function __construct(){
			parent::__construct();
			$this->config = include('config/nationbuilder.php');
		}
		
		protected function sendRequest($url, $payload=false, Array $headers=[], $method=false){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
			if($payload){
				$payload = (is_array($payload)) ? http_build_query($payload) : $payload;
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			}
			if($headers) curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			if($method == 'put' || $method == 'delete'){
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
			}
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
			$response = curl_exec($ch);
			$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
			$header = substr($response, 0, $header_size);
			$headers = [];
			foreach(explode(chr(10), $header) as $head){
				$parts = explode(': ', $head);
				$headers[trim($parts[0])] = trim((count($parts) == 2) ? $parts[1] : '');
			}
			$body = substr($response, $header_size);
			$response = new \JFrame\Response();
			$response->setData('body', json_decode($body));
			$response->setData('header', $headers);
			curl_close($ch);
			return $response;
		}
	}
}

?>