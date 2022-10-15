<?php

include "init.php";

use App\Class;
use App\ClassRoster;
use App\Student;
use App\Teacher;

$faker = Faker\Factory::create();

$i = 0;
while ($i++ < 30) {
	$task = new Todo($faker->sentence(), rand(0, 1));
	$task->setConnection($connection);
	$task->save();
	var_dump($task);
}
	