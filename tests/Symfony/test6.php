<?php
require_once __DIR__ . '/../bootstrap.php';

$file = __DIR__ . '/container_test6.php';

if (file_exists($file)) {
    require_once $file;
    $container = new ProjectServiceContainer();
} else {
    $container = new Symfony\Component\DependencyInjection\ContainerBuilder;

    $classes = [
        'Tests\A',
        'Tests\B',
        'Tests\C',
        'Tests\D',
        'Tests\E',
        'Tests\F',
        'Tests\G',
        'Tests\H',
        'Tests\I',
        'Tests\J'
    ];
    for ($i = 0; $i < count($classes); $i++) {
        if (isset($classes[$i - 1])) {
            $ref = [new Symfony\Component\DependencyInjection\Reference($classes[$i - 1])];
        } else $ref = [];

        $definition = new Symfony\Component\DependencyInjection\Definition($classes[$i], $ref);
        $container->setDefinition($classes[$i], $definition);
    }

    $container->compile();

    $dumper = new Symfony\Component\DependencyInjection\Dumper\PhpDumper($container);
    file_put_contents($file, $dumper->dump());
}

//Trigger autoloader
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