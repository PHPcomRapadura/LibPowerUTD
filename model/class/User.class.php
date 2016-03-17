<?php
	class User{
		private $data = array();
	
		public function __construct($name, $email, $password){
			$this->data['user_name'] = $name;
			$this->data['user_email'] = $email;
			$this->data['user_password'] = $password;
		}

		public function __set($name, $value){
			$this->data[$name] = $value;
		}

		public function __get($name){
			return $this->data[$name];
		}
	}
?>