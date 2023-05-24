<?php
// crossmile @ LXSX file:www-html/oauth2/OAuth2simple.php

abstract class OAuth2simple
{
	protected $clientId;
	protected $clientSecret;
	protected $clientState;
	protected $redirectUri;
	protected $scope_arr;
	protected $accessToken;

	protected $lastError;

	protected $_authUrl;
	protected $_tokenUrl;
	protected $_userUrl;

	private $_config;
	private $_db;

	public function __construct($config, PDO $db) 
	{
		$this->_config = $config;
		$this->_db = $db;

		$this->lastError = 'Unknown';
	}

	public function createAuthUrl()
	{
		if (empty($this->clientId)) {
			$this->lastError = 'Empty Client ID';
			return (false);
		}
		if (empty($this->redirectUri)) {
			$this->lastError = 'Empty Redirect URI';
			return (false);
		}
		if (empty($this->scope_arr)) {
			$this->lastError = 'Empty Scope';
			return (false);
		}
		$url = $this->_authUrl .
			'?redirect_uri=' . $this->redirectUri .
			'&client_id=' . $this->clientId .
			'&scope=' . implode('%20', $this->scope_arr);
		if (!empty($this->clientState))
			$url .= '&state=' . $this->clientState;
		return ($url);
	}

	public function fetchToken($code)
	{
		if (empty($this->clientId)) {
			$this->lastError = 'Empty Client ID';
			return (false);
		}
		if (empty($this->clientSecret)) {
			$this->lastError = 'Empty Client Secret';
			return (false);
		}
		if (empty($this->redirectUri)) {
			$this->lastError = 'Empty Redirect URI';
			return (false);
		}
		$post = 'client_id=' . $this->clientId .
			'&client_secret=' . $this->clientSecret .
			'&code=' . $code .
			'&redirect_uri=' . $this->redirectUri;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->_tokenUrl);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		if (empty($output)) {
			$this->lastError = 'Empty token server output';
			return (false);
		}
		if (($json = json_decode($output, true)) === null) {
			$this->lastError = 'Cannot decode token JSON';
			return (false);
		}
		return ($json);
	}

	protected function _getUser()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->_userUrl);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Cross Mile PHP UA');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $this->accessToken));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		if (empty($output)) {
			$this->lastError = 'Empty user server output';
			return (false);
		}
		if (($json = json_decode($output, true)) === null) {
			$this->lastError = 'Cannot decode user JSON';
			return (false);
		}
		return ($json);
	}

	public function setClientId($clientId)
	{
		$this->clientId = $clientId;
	}

	public function setClientSecret($clientSecret)
	{
		$this->clientSecret = $clientSecret;
	}

	public function setRedirectUri($redirectUri)
	{
		$this->redirectUri = $redirectUri;
	}

	public function setClientState($clientState)
	{
		$this->clientState = $clientState;
	}

	public function addScope($scope)
	{
		$this->scope_arr[] = $scope;
	}

	public function setAccessToken($accessToken)
	{
		$this->accessToken = $accessToken;
	}
}

class GithubOAuth2 extends OAuth2simple
{
	public function __construct() 
	{
		$this->_authUrl = 'https://github.com/login/oauth/authorize';
		$this->_tokenUrl = 'https://github.com/login/oauth/access_token';
		$this->_userUrl = 'https://api.github.com/user';
	}

	public function getUser()
	{
		$userTemp = $this->_getUser();
		if (empty($userTemp)) {
			$this->lastError = 'Empty user';
			return (false);
		}
		if (empty($userTemp['id'])) {
			$this->lastError = 'Empty user ID';
			return (false);
		}
		$user['id'] = $userTemp['id'];
		if (empty($userTemp['email'])) {
			$this->lastError = 'Empty user e-mail';
			return (false);
		}
		$user['email'] = $userTemp['email'];
		if (!empty($userTemp['name'])) {
			$user['name'] = $userTemp['name'];
			$name_arr = explode(' ', $userTemp['name']);
			if (!empty($name_arr[0]))
				$user['first_name'] = $name_arr[0];
			if (!empty($name_arr[1]))
				$user['last_name'] = $name_arr[1];
		}
		return ($user);
	}
}

class SkmileOAuth2 extends OAuth2simple
{
	public function __construct() 
	{
		$this->_authUrl = 'https://www.skmile.cz/api/oauth2/authorize/';
		$this->_tokenUrl = 'https://www.skmile.cz/api/oauth2/access_token';
		$this->_userUrl = 'https://www.skmile.cz/api/oauth2/user';
	}

	public function getUser()
	{
		$user = $this->_getUser();
		if (empty($user)) {
			$this->lastError = 'Empty user';
			return (false);
		}
		if (empty($user['id'])) {
			$this->lastError = 'Empty user ID';
			return (false);
		}
		if (empty($user['email'])) {
			$this->lastError = 'Empty user e-mail';
			return (false);
		}
		return ($user);
	}
}
?>