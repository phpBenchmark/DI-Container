<?php
require_once __DIR__ . '/../bootstrap.php';

$container = new \Pimple\Container();

$container['Tests\A'] = function ($c) {
    return new Tests\A();
};
$container['Tests\B'] = $container->factory(function ($c) {
    return new Tests\B($c['Tests\A']);
});

//trigger autoloader
$b = $container['Tests\B'];
unset($b);

$t1 = microtime(true);

for ($i = 0; $i < 10000; $i++) {
    $j = $container['Tests\B'];
}

$t2 = microtime(true);

$results = [
    'time' => $t2 - $t1,
    'files' => count(get_included_files()),
    'memory' => memory_get_peak_usage() / 1024 / 1024
];

echo json_encode($results);
