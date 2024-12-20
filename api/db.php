<?php

function db_pdo(): PDO
{
    $host = 'ls-01a0b9b473f3c721b3dcc576f6306b11154b1879.cdym2mu2g0w1.ap-northeast-2.rds.amazonaws.com';
    $port = '3306';
    $dbname = 'palette';
    $charset = 'utf8';
    $username = 'xsorexia';
    $db_pw = "Nism0421!";
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $username, $db_pw);
    return $pdo;
}