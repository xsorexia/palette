<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/api/db.php';
$pdo = db_pdo();

if (isset($_POST['font-id']) and isset($_POST['font-name']) and isset($_POST['project-id'])) {
    $projectID = $_POST['project-id'];

    if ($_POST['font-delete']) {
        $deleteQuery = $pdo->prepare("DELETE FROM fonts WHERE fontID = ?");
        $deleteQuery->execute([$_POST['font-id']]);
        echo "<body><script>window.location.href = '/pages/project.php?projectID=$projectID'</script></body>";
        return;
    }
    if ($_POST['font-id'] == 0) { // then new font
        $addQuery = $pdo->prepare("INSERT INTO fonts (projectID, fontName) VALUES (?, ?)");
        $addQuery->execute([$_POST['project-id'], $_POST['font-name']]);
    } else {
        $updateQuery = $pdo->prepare("UPDATE fonts SET fontName = ? WHERE fontID = ?");
        $updateQuery->execute([$_POST['font-name'], $_POST['font-id']]);
    }

    echo "<body><script>window.location.href = '/pages/project.php?projectID=$projectID'</script></body>";
}