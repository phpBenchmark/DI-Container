<?php
//You shouldn't have max_exectution_time set high enough to run these benchmarks 
ini_set('max_execution_time', 90000);
opcache_reset();
$isCli = php_sapi_name() == 'cli';
function cliPrint($text, $newLine = true)
{
    $isCli = php_sapi_name() == 'cli';
    if ($isCli) {
        echo $text;
        if ($newLine) echo "\n";
    }
}

cliPrint("Starting benchmarks", true);

$html = '';

//Number of times to run each test before taking an average 
$runs = 10;

cliPrint('Running each test ' . $runs . ' times');

//Containers to be tested (dir names)
$containers = ['Laravel', 'Symfony', 'PHP-DI', 'League'];

//The number of tests
$numTests = 5;
cliPrint('Running tests 1 - ' . $numTests);

function average($array, $dp = 4)
{
    sort($array, SORT_NUMERIC);

    $smallest = $array[0];
    $num = 0;
    $total = 0;

    //Discard any values that were over 20% slower than the smallest as something likely happened to cause a blip in speed. A single
    //slow result would skew the results using a standard mean.
    foreach ($array as $val) {
        if ($val <= $smallest * 1.2) {
            $num++;
            $total += $val;
        }
    }

    return round($total / $num, $dp);
}

//Run a PHP script via exec, using the specified php.ini 
function runScript($file, $args = [])
{
    exec('php ' . $file . ' ' . implode(' ', $args), $output, $exitCode);
    return $output;
}

$version = phpversion();
//Some very basic styling
$html .= "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bulma/0.3.1/css/bulma.min.css'>";
$html .= <<<HEAD
<section class="hero is-medium is-primary is-bold">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        PHP DI Containers Benchmarks
      </h1>
      <h2 class="subtitle">
        PHP {$version}
      </h2>
    </div>
  </div>
</section>
HEAD;
$html .= '<div class="section"><div class=".container">';
$testdescriptions = [
    1 => 'Create single object (incl autoload time)',
    2 => 'Create single object (excl autoload time)',
    3 => 'Create deep object graph',
    4 => 'Fetch the same instance (service) from the container repeatedly',
    5 => 'Inject a service into a new object repeatedly'
];

for ($test = 1; $test <= $numTests; $test++) {
    $html .= '<h2 class="title is-2">Test ' . $test . ' - ' . $testdescriptions[$test] . '</h2>';
    $html .= '<table class="table is-striped">';
    cliPrint("\nStarting test: " . $test);

    $containerInfo = [];

    $html .= '<thead><tr><th>Container</th><th>Time</th><th>Memory</th><th>Files</th></thead>';

    foreach ($containers as $container) {
        cliPrint('');
        cliPrint('Benchmarking container:' . $container);
        $memory = [];
        $time = [];
        $files = [];
        $output = [];

        for ($i = 0; $i < $runs; $i++) {
            cliPrint($container . ' test' . $test . ' : ' . ($i + 1) . '/' . $runs);
            $output = runScript('./tests/' . $container . '/test' . $test . '.php');
            $result = json_decode($output[0]);
            if (!is_object($result)) echo $container . $test . '<br />';
            $time[] = $result->time;
            $memory[] = $result->memory;
            $files[] = $result->files;
        }


        $containerInfo[] = ['name' => $container, 'time' => average($time), 'memory' => average($memory), 'files' => average($files)];
    }

    //Sort the results by time
    usort($containerInfo, function ($a, $b) {
        if ($a['time'] == $b['time']) return ($a['memory'] < $b['memory']) ? -1 : 1;

        return ($a['time'] < $b['time']) ? -1 : 1;
    });

    foreach ($containerInfo as $containerDetail) {
        $html .= '<tr>';
        $html .= '<td>' . $containerDetail['name'] . '</td>';
        $html .= '<td>' . $containerDetail['time'] . '</td>';
        $html .= '<td>' . $containerDetail['memory'] . '</td>';
        $html .= '<td>' . $containerDetail['files'] . '</td>';
        $html .= '</tr>';

    }
    $html .= '</table>';
}
$today = date('H:i:s m.d.y');
$html .= '</div></div>';
$html .= <<<HTML
<footer class="footer">
  <div class="container">
    <div class="content has-text-centered">
      <p>
        <strong><a href='https://github.com/phpBenchmark/DI-Container'>phpBenchmark/DI-Container</a></strong>
      </p>
      <p>
        Generated {$today}
      </p>
    </div>
  </div>
</footer>
HTML;
if (!$isCli) echo $html;
else file_put_contents('test-results.html', $html);