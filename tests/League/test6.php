<?php
require_once __DIR__ . '/../bootstrap.php';

$container = new League\Container\Container;
$container->add('Tests\A');
$container->add('Tests\B')->withArgument('Tests\A');
$container->add('Tests\C')->withArgument('Tests\B');
$container->add('Tests\D')->withArgument('Tests\C');
$container->add('Tests\E')->withArgument('Tests\D');
$container->add('Tests\F')->withArgument('Tests\E');
$container->add('Tests\G')->withArgument('Tests\F');
$container->add('Tests\H')->withArgument('Tests\G');
$container->add('Tests\I')->withArgument('Tests\H');
$container->add('Tests\J')->withArgument('Tests\I');

//Trigger all autoloaders
$a = $container->get('Tests\J');
unset($a);

$t1 = microtime(true);

for ($i = 0; $i < 10000; $i++) {
    $a = $container->get('Tests\J');
}

$t2 = microtime(true);

$results = [
    'time' => $t2 - $t1,
    'files' => count(get_included_files()),
    'memory' => memory_get_peak_usage() / 1024 / 1024
];

echo json_encode($results);
