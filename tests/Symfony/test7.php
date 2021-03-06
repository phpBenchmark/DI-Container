<?php
require_once __DIR__ . '/../bootstrap.php';


$file = __DIR__ . '/container_test7.php';

if (file_exists($file)) {
    require_once $file;
    $container = new ProjectServiceContainer();
} else {
    $container = new Symfony\Component\DependencyInjection\ContainerBuilder;
    $definition = new Symfony\Component\DependencyInjection\Definition('Tests\A', []);
    $container->setDefinition('Tests\A', $definition);
    $container->compile();
    $dumper = new Symfony\Component\DependencyInjection\Dumper\PhpDumper($container);
    file_put_contents($file, $dumper->dump());
}

$container->get('Tests\A');
unset($a);

$t1 = microtime(true);

for ($i = 0; $i < 10000; $i++) {
    $a = $container->get('Tests\A');
}

$t2 = microtime(true);

$results = [
    'time' => $t2 - $t1,
    'files' => count(get_included_files()),
    'memory' => memory_get_peak_usage() / 1024 / 1024
];

echo json_encode($results);