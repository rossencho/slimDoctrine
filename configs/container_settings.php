<?php


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use function DI\create;

require 'Config.php';

return [
    Config::class => create(Config::class)->constructor($_ENV),
    EntityManager::class => fn(Config $config) => EntityManager::create(
        $config->settings,
        ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/../src/Entity'])
    )
];