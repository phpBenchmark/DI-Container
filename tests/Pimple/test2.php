<?php
require_once __DIR__ . '/../bootstrap.php';

$container = new \Pimple\Container();
$container['Tests\A'] = $container->factory(function ($c) {
    return new Tests\A();
});

//trigger autoloaders
$a = $container['Tests\A'];
unset($a);

$t1 = microtime(true);

for ($i = 0; $i < 10000; $i++) {
    $j = $container['Tests\A'];
}

$t2 = microtime(true);

$results = [
    'time' => $t2 - $t1,
    'files' => count(get_included_files()),
    'memory' => memory_get_peak_usage() / 1024 / 1024
];

echo json_encode($results);
