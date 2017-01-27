<?php
use DI\Scope;
require_once __DIR__ . '/../bootstrap.php';

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
    'Tests\A' => \DI\object()
        ->scope(Scope::PROTOTYPE()),
    'Tests\B' => \DI\object()
        ->scope(Scope::PROTOTYPE()),
    'Tests\C' => \DI\object()
        ->scope(Scope::PROTOTYPE()),
    'Tests\D' => \DI\object()
        ->scope(Scope::PROTOTYPE()),
    'Tests\E' => \DI\object()
        ->scope(Scope::PROTOTYPE()),
    'Tests\F' => \DI\object()
        ->scope(Scope::PROTOTYPE()),
    'Tests\G' => \DI\object()
        ->scope(Scope::PROTOTYPE()),
    'Tests\H' => \DI\object()
        ->scope(Scope::PROTOTYPE()),
    'Tests\I' => \DI\object()
        ->scope(Scope::PROTOTYPE()),
    'Tests\J' => \DI\object()
        ->scope(Scope::PROTOTYPE()),
]);
$builder->setDefinitionCache(new \Doctrine\Common\Cache\ArrayCache());
$container = $builder->build();

//trigger autoloader
$j = $container->get('Tests\J');
unset ($j);

$t1 = microtime(true);

for ($i = 0; $i < 10000; $i++) {
    $j = $container->get('Tests\J');

}

$t2 = microtime(true);

$results = [
    'time' => $t2 - $t1,
    'files' => count(get_included_files()),
    'memory' => memory_get_peak_usage() / 1024 / 1024
];

echo json_encode($results);
