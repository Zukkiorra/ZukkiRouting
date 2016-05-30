<?php

/**
* Handling routing system of application
*/
class Route
{
	private $uri = [];
	private $class = [];
	private $method = [];

	/**
	* Adding urls to be looked for
	*@param $url
	**/
	public function add($uri, $class, $method)
	{
		$this->uri[] = $uri;
		$this->class[] = $class;
		$this->method[] = $method;
	}

	/**
	* Checking requested route
	*
	**/
	public function submit()
	{
		$requestUri = $_SERVER['REQUEST_URI'];
		
		if ($_SERVER['REQUEST_METHOD']=='GET') {
			$this->handleGet($requestUri);
		} elseif ($_SERVER['REQUEST_METHOD']=='POST') {
			$this->handlePost($requestUri);
		}
	}
	

	/**
	*Checking if passed route exists
	*@param $urToCheck
	**/
	private function checkUri($urToCheck)
	{
		foreach ($this->uri as $key => $value) {
			if (preg_match("#^$value$#", $urToCheck)) {
				$userObject['class'] =  $this->class[$key];
				$userObject['method'] = $this->method[$key];
				return $userObject;
			}
		}
			
		return false;
	}


	/**
	* handles get request by getting request uri
	*@param $requestUri
	**/
	private function handleGet($requestUri)
	{
		$chkuserObject = $this->checkUri($requestUri);

		if ($chkuserObject) {
			$userObject = new $chkuserObject['class']();
			$userObject->$chkuserObject['method']();
		} else {
			trigger_error("ROUTE <strong>".$uriGetParam."</strong> does not exist.", E_USER_ERROR);
			die();
		}
	}


	/**
	* handles post request by getting request uri
	*@param $requestUri
	**/
	private function handlePost($requestUri)
	{
		$chkuserObject = $this->checkUri($requestUri);

		if ($chkuserObject) {
			$uriPostParam = [];
			foreach ($_POST as $param_name => $param_val) {
				$uriPostParam[$param_name] = $param_val;
			}

			$userObject = new $chkuserObject['class']();
			$userObject->$chkuserObject['method']($uriPostParam);
		} else {
			trigger_error("ROUTE <strong>".$requestUri."</strong> does not exist.", E_USER_ERROR);
			die();
		}
	}
}
