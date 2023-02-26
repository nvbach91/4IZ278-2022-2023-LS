<?php

function calculateAge($birthYear) {
  $age = date('Y') - $birthYear;
  return $age;
};
