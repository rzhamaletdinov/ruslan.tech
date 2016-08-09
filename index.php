<?php
require_once(__DIR__.'/core/common.php');
/*!!!Disable on PRODUCTION!!!*/

Config::devEnvironment(true);
Application::run();
