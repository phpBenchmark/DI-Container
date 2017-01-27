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
$container['Tests\D'] = $container->factory(function ($container) {
    return new Tests\D($container['Tests\C']);
});

$container['Tests\E'] = $container->factory(function ($container) {
    return new Tests\E($container['Tests\D']);
});
$container['Tests\F'] = $container->factory(function ($container) {
    return new Tests\F($container['Tests\E']);
});
$container['Tests\G'] = $container->factory(function ($container) {
    return new Tests\G($container['Tests\F']);
});
$container['Tests\H'] = $container->factory(function ($container) {
    return new Tests\H($container['Tests\G']);
});
$container['Tests\I'] = $container->factory(function ($container) {
    return new Tests\I($container['Tests\H']);
});
$container['Tests\J'] = $container->factory(function ($container) {
    return new Tests\J($container['Tests\I']);
});

//trigger autoloader
$j = $container['Tests\J'];
unset($j);

$t1 = microtime(true);

for ($i = 0; $i < 10000; $i++) {
    $j = $container['Tests\J'];
}

$t2 = microtime(true);

$results = [
    'time' => $t2 - $t1,
    'files' => count(get_included_files()),
    'memory' => memory_get_peak_usage() / 1024 / 1024
];

echo json_encode($results);
