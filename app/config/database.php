<?php

$sql = file_get_contents(__DIR__.'/schema.sql');
try {
    $pdo = \App\Model\Pdo::getInstance()->getDb();
    $exec = $pdo->prepare("CREATE DATABASE `$db_name`;USE `$db_name`;".$sql);
    $exec->execute();

} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}
