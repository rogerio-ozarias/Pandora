<?php
namespace App\services;

class Request
{	
	protected $_headers = array();
	protected $_response = array();
	protected $_requestCode;
	
	public function __construct(Array $headers)
	{
		$this->_headers = $headers;
	}
	
	public function getResponse()
	{

		try{
			switch($this->_requestCode){
				case '200':
				case '201':
					return json_decode($this->_response,true);
				break;				
				default:
					return json_decode($this->_response,true);
				break;
			}
		}catch(Exception $e){
			return false;
		}
	} 
	
	public function setRequest($url, $method="GET", $data=array())
	{
		try{
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_HTTPHEADER, $this->_headers);
			curl_setopt($curl, CURLOPT_TIMEOUT, 120);
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
			
			switch ($method){
				case 'PUT':
				case 'POST':
					curl_setopt($curl, CURLOPT_URL, $url);
					curl_setopt($curl, CURLOPT_POST, 1);
					curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($data));
				break;					
				case 'GET':
				case 'DELETE':
					if($data){
						curl_setopt($curl, CURLOPT_URL, $url);
					}else{
						curl_setopt($curl, CURLOPT_URL, $url);
					}
				break;
			}
			$this->_response = curl_exec($curl);
			$this->_requestCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);			
			curl_close($curl);
			return $this;			
		}catch(Exception $e){
			return false;
		}
	}
}