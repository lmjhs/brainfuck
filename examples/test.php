<?php

error_reporting(E_ALL);

require_once realpath(__DIR__ . '/../vendor') . '/autoload.php';

$brainFuck = new BrainFuck;
$brainFuck->setInput("Codewars" . chr(0));
echo $brainFuck->run(",[.[-],]");