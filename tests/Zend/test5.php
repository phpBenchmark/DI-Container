<?php
require_once __DIR__ . '/../bootstrap.php';

$di = new Zend\Di\Di;

//trigger autoloader for all required files
$a1 = $di->get('Tests\A');
$a2 = $di->get('Tests\B');

$t1 = microtime(true);

for ($i = 0; $i < 10000; $i++) {
    $a = $di->newinstance('Tests\B');
}

$t2 = microtime(true);

$results = [
    'time' => $t2 - $t1,
    'files' => count(get_included_files()),
    'memory' => memory_get_peak_usage()/1024/1024
];

echo json_encode($results);
