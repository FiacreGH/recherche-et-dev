<?php

require_once __DIR__.'/vendor/autoload.php';

use PackageMaker\Command\CoreUpdateCommand;
use PackageMaker\Command\FileDistributionUpdateCommand;
use PackageMaker\Command\FileIntroductionUpdateCommand;
use PackageMaker\Command\GitStatusCommand;
use PackageMaker\Command\GitPullCommand;
use PackageMaker\Command\PackageCommand;
use PackageMaker\Command\T3xBundleCommand;
use PackageMaker\Command\DumpCommand;
use Symfony\Component\Console\Application;

$application = new Application('Package Maker for TYPO3 CMS', '1.0.0');
$application->add(new CoreUpdateCommand('core-update'));
$application->add(new T3xBundleCommand('t3x-bundle'));
$application->add(new GitPullCommand('git-pull'));
$application->add(new GitStatusCommand('git-status'));
$application->add(new DumpCommand('dump'));
$application->add(new FileDistributionUpdateCommand('file-distribution-update'));
$application->add(new FileIntroductionUpdateCommand('file-introduction-update'));
$application->add(new PackageCommand('package'));
$application->run();