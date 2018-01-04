<?php

require_once "lib/animal.php";

$cat = new Animal(11, 2);
$cat->comeToMe();

$snake = new Snake(5);
$snake->run();

$snake = new Robot(5, 5);
$snake->run();