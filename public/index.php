<?php
require_once '../autoload.php';

$app = new \app\Application();

try {
    $app->run();
} catch (\Exception $e) {
    echo "ERROR!";
    echo $e->getMessage();
}