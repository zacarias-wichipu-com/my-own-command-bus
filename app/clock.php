<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Clock;

$clock = new Clock(
    awakeAt: 6,
    sleepAt: 23
);

($clock)();
