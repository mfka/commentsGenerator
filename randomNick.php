<?php

function __autoload($className)
{
    require_once(__DIR__ . '/api/' . $className . '.class.php');
}


$pre = array('ekstra_', 'super_', 'fit_', 'pre_', 'pro_', 'vege_', '', 'Mr');
$i = 0;
$content = array();
while ($i < 1400) {
    $nick = new Author();
    trim($nick->chooseAuthor()) == '' ? trim($nick->chooseAuthor()) : true;
    $p = array_rand($pre);
    if (!in_array($pre[$p] . $nick . "\n", $content)) {
        $content[] = $pre[$p] . $nick . "\n";
        $i++;
    }
}
file_put_contents(__DIR__ . '/nicks.txt', $content);
