<?php

require __DIR__ . '/../vendor/autoload.php';

define("APP_DIR", __DIR__);
define("WWW_DIR", APP_DIR . "/../www");

$configurator = new Irvekon\Application\Configurator;

$configurator->setDebugMode(true);
$configurator->enableDebugger(__DIR__ . '/../var/log');

$configurator->setTimeZone('Europe/Prague');
$configurator->setTempDirectory(__DIR__ . '/../var/temp');
$configurator->setAppModulePath(__DIR__);
$configurator->setLibModulePath(__DIR__ . "/../vendor/irvekon");

$configurator->createRobotLoader()
		->addDirectory(__DIR__)
		->register();

$configurator->addModules("common", "admin", "invoicing", "calendar");

$container = $configurator->createContainer();

return $container;