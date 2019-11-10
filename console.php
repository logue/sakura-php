#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Logue\SakuraPhp\MetaParser;
use Logue\SakuraPhp\KeywordParser;

///$app = new Application();
$meta = new Logue\SakuraPhp\MetaParser();
$keyword = new Logue\SakuraPhp\KeywordParser();
echo $meta . $keyword;
//$app->run();
