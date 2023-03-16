<?php

namespace classes;

class User {

	public function __construct(

		public string $email,
		public string $password,
		public string $name,
		public string $surname,
		public string $gender,
		public string $phone

	) {}

}