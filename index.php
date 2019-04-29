<?php

require_once __DIR__ . '/vendor/autoload.php';

define("PATH", __DIR__);
define("FILES", __DIR__.'/files/');

$new = new \App\Controller\NavigationController();
$new->index();