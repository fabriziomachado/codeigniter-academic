<?php

include_once dirname(__FILE__) . '/../application/third_party/CIUnit/bootstrap_phpunit.php';

require_once 'Mockery/Loader.php';
require_once 'Hamcrest/hamcrest.php';
$loader = new \Mockery\Loader;
$loader->register();

