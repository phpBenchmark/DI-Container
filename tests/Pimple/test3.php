<?php
require_once __DIR__ . '/../bootstrap.php';

$container = new \Pimple\Container();
$container['Tests\A'] = $container->factory(function ($container) {
    return new Tests\A();
});
$container['Tests\B'] = $container->factory(function ($container) {
    return new Tests\B($container['Tests\A']);
});
$container['Tests\C'] = $container->factory(function ($container) {
    return new Tests\C($container['Tests\B']);
});

//trigger autoloader
$j = $container['Tests\C'];
unset($j);

$t1 = microtime(true);

for ($i = 0; $i < 10000; $i++) {
    $j = $container['Tests\C'];
}

$t2 = microtime(true);

$results = [
    'time' => $t2 - $t1,
    'files' => count(get_included_files()),
    'memory' => memory_get_peak_usage() / 1024 / 1024
];

echo json_encode($results);
