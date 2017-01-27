<?php
require_once __DIR__ . '/../bootstrap.php';

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
    'Tests\B' => \DI\object()
        ->scope(\DI\Scope::PROTOTYPE())
]);
$builder->setDefinitionCache(new \Doctrine\Common\Cache\ArrayCache());
$container = $builder->build();

//trigger autoloader
$a = $container->get('Tests\B');
unset ($a);

$t1 = microtime(true);

for ($i = 0; $i < 10000; $i++) {
    $a = $container->get('Tests\B');
}

$t2 = microtime(true);

$results = [
    'time' => $t2 - $t1,
    'files' => count(get_included_files()),
    'memory' => memory_get_peak_usage() / 1024 / 1024
];

echo json_encode($results);
