<?php

namespace classes;

class User {

	public function __construct(

		public string $mail,
		public string $password,
		public string $name,
		public string $surname,
		public string $phone

	) {}

}