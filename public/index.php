<?php

/*2019-07-12*/ 

namespace 与光同尘的php框架;

use core\register;

define('DIR', __DIR__.'/../');

require_once( DIR.'core/register.php' );
require_once( DIR.'vendor/autoload.php' );

$ar = register::init()->default()->run();

