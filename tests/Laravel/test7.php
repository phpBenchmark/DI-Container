<?php
require_once __DIR__ . '/../bootstrap.php';

$container = new \Illuminate\Container\Container;

$container->bind('Tests\A', 'Tests\A', true);

//Trigger autoloader
$a = $container->make('Tests\A');
unset($a);

$t1 = microtime(true);

for ($i = 0; $i < 10000; $i++) {
    $j = $container->make('Tests\A');
}

$t2 = microtime(true);

$results = [
    'time' => $t2 - $t1,
    'files' => count(get_included_files()),
    'memory' => memory_get_peak_usage() / 1024 / 1024
];

echo json_encode($results);