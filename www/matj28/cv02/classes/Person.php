<?php
class Person {
    public function __construct(
        public $name,
        public $surname,
        public $born,
        public $job,
    ) {}

    public function ageInYears($born): string {
        $bornDate = new DateTime($born);
        $current_date = new DateTime();
        $age = $bornDate->diff($current_date);
        return $age->format('%Y years');
    }
}
?>