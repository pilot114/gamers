<?php

/**
 * Запуск консольных команд.
 * 1 аргумент - имя класса
 * 2 аргумент - метод (run по умолчанию)
 */

require_once __DIR__ . "/vendor/autoload.php";

if (count($argv) < 2) {
    echo "Нужно передать имя класса\n";
    exit;
}
$class = '\\App\\Cli\\' . $argv[1];

if (isset($argv[2])) {
    echo (new $class)->$argv[2]();
} else {
    echo (new $class)->run();
}
