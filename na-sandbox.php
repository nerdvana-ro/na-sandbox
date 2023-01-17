#!/usr/bin/php
<?php

require_once 'lib/Opt.php';
require_once 'lib/Str.php';
require_once 'lib/Util.php';

Opt::parse($argv);
Util::spawnJail();
$out = Util::wait();
print_r($out);
