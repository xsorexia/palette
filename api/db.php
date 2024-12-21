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

function getProjectInfo($projectID) {
    $pdo = db_pdo();
    $projectInfoQuery = $pdo->prepare("SELECT P.*, U.* FROM projects AS P INNER JOIN users AS U ON P.userID = U.userID WHERE projectID = ?");
    $projectInfoQuery -> execute([$projectID]);
    $projectInfo = $projectInfoQuery->fetch(PDO::FETCH_ASSOC);
    if ($projectInfoQuery->rowCount() == 0) {
        return -1; // no such project exists
    }
    return $projectInfo; // projectID, userID, projectName, isPublic, projectRegDate
}

function getFontList($projectID) {
    $pdo = db_pdo();
    $fontListQuery = $pdo->prepare("SELECT * FROM fonts WHERE projectID = ?");
    $fontListQuery->execute([$projectID]);
    $fontList = $fontListQuery->fetchAll(PDO::FETCH_ASSOC);
    return $fontList;
}