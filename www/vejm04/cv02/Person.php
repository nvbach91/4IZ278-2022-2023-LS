<?php 

class Person {

    public function __construct(
        public $name, 
        public $surname, 
        public $birth,
        public $job
    ) {}

    public function getAge() {
        $birth = explode("/", $this->birth);
        $age = (date("md", date("U", mktime(0, 0, 0, $birth[0], $birth[1], $birth[2]))) > date("md")
            ? ((date("Y") - $birth[2]) - 1)
            : (date("Y") - $birth[2]));
        return $age;
    }
};

?>