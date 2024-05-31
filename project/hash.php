<?php

// Проверяем, передана ли строка в аргументах командной строки
if ($argc < 2) {
    echo "Пожалуйста, введите строку для хеширования.\n";
    exit(1);
}

// Получаем строку из аргументов командной строки
$string = $argv[1];

// Хешируем строку с использованием bcrypt
$hashedString = password_hash($string, PASSWORD_BCRYPT);

// Выводим хеш
echo "Хеш для строки '$string': $hashedString\n";
