<?php

function quadraticEquation(int $a, int $b, int $c)
{
    $d = $b * $b - 4 * $a * $c;
    $result = '';
    if ($d >= 0) {
        $x1 = (-$b + sqrt($d)) / (2 * $a);
        $x2 = (-$b - sqrt($d)) / (2 * $a);
        $result =
            "x1 = $x1, x2 = $x2";
    } else {
        $result = 'Roots are not found :(';
    }
    $equation = "{$a}x^2 " . ($b < 0 ? '- ' : '+ ')
        . ($b < 0 ? substr($b, 1) : $b) . "x" . ($c < 0 ? ' - ' : ' + ')
        . ($c < 0 ? substr($c, 1) : $c) . " = 0, ";
    file_put_contents('file.txt', $equation . $result . "\n", FILE_APPEND);
}

function input(string $prompt = null): string
{
    echo $prompt;
    $handle = fopen('php://stdin', 'r');
    $output = fgets($handle);
    return trim($output);
}

$a = 0;
$b = 0;
$c = 0;
if ($val = getopt('a:b:c:')) {
    $a = $val['a'];
    $b = $val['b'];
    $c = $val['c'];
} elseif (isset($argv[1]) && isset($argv[2]) && isset($argv[3])) {
    $a = $argv[1];
    $b = $argv[2];
    $c = $argv[3];
} else {
    $a = input('Enter an "a" coefficient: ');
    $b = input('Enter an "b" coefficient: ');
    $c = input('Enter an "c" coefficient: ');
}

try {
    quadraticEquation($a, $b, $c);
} catch (Throwable $th) {
    echo $th->getMessage() . "\n";
}
