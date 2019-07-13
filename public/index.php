<?php

/*2019-07-12*/ 

namespace 与光同尘的php框架，更小更快;

use core\register;




define('DIR', __DIR__.'/../');

require_once( DIR.'core/register.php' );

$ar = register::init()->default()->run();

