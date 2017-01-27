<?php
require_once __DIR__ . '/../bootstrap.php';

$t1 = microtime(true);

$di = new Zend\Di\Di;
for ($i = 0; $i < 10000; $i++) {
    $a = $di->newinstance('Tests\A');
}

$t2 = microtime(true);

$results = [
    'time' => $t2 - $t1,
    'files' => count(get_included_files()),
    'memory' => memory_get_peak_usage() / 1024 / 1024
];

echo json_encode($results);
