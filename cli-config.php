<?php

require_once __DIR__ . "/vendor/autoload.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(\App\Kernel::getORM());
