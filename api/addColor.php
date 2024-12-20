<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/api/db.php';
$pdo = db_pdo();

if (isset($_POST['color-id']) and isset($_POST['color-name']) and isset($_POST['color-fg']) and isset($_POST['color-bg']) and isset($_POST['project-id'])) {
    if ($_POST['color-delete']) {
        $deleteQuery = $pdo->prepare("DELETE FROM colors WHERE colorID = ?");
        $deleteQuery->execute([$_POST['color-id']]);
        echo "<body><script>window.location.href = '/pages/project.php?projectID=$projectID'</script></body>";
        return;
    }
    $projectID = $_POST['project-id'];
    if ($_POST['color-id'] == 0) { // then new color
        $addQuery = $pdo->prepare("INSERT INTO colors (projectID, colorName, foregroundColor, backgroundColor) VALUES (?, ?, ?, ?)");
        $addQuery->execute([$_POST['project-id'], $_POST['color-name'], $_POST['color-fg'], $_POST['color-bg']]);
    } else {
        $updateQuery = $pdo->prepare("UPDATE colors SET colorName = ?, foregroundColor = ?, backgroundColor = ? WHERE colorID = ?");
        $updateQuery->execute([$_POST['color-name'], $_POST['color-fg'], $_POST['color-bg'], $_POST['color-id']]);
    }

    echo "<body><script>window.location.href = '/pages/project.php?projectID=$projectID'</script></body>";
}