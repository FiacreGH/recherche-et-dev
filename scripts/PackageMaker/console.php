<?php

require_once __DIR__.'/vendor/autoload.php';

use PackageMaker\Command\CoreUpdateCommand;
use PackageMaker\Command\GitStatusCommand;
use PackageMaker\Command\GitUpdateCommand;
use PackageMaker\Command\T3xUpdateCommand;
use PackageMaker\Command\DumpCommand;
use Symfony\Component\Console\Application;

$application = new Application('Package Maker for TYPO3 CMS', '1.0.0');
$application->add(new CoreUpdateCommand('core-update'));
$application->add(new T3xUpdateCommand('t3x-update'));
$application->add(new GitUpdateCommand('git-update'));
$application->add(new GitStatusCommand('git-status'));
$application->add(new DumpCommand('dump'));
$application->run();