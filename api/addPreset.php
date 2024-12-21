<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/api/db.php';
$pdo = db_pdo();

if (isset($_POST['preset-id']) and isset($_POST['preset-name']) and isset($_POST['preset-size']) and isset($_POST['preset-weight']) and isset($_POST['preset-font']) and isset($_POST['project-id'])) {
    $projectID = $_POST['project-id'];

    if ($_POST['preset-delete']) {
        $deleteQuery = $pdo->prepare("DELETE FROM presets WHERE presetID = ?");
        $deleteQuery->execute([$_POST['preset-id']]);
        echo "<body><script>window.location.href = '/pages/project.php?projectID=$projectID'</script></body>";
        return;
    }
    if ($_POST['preset-id'] == 0) { // then new preset
        $addQuery = $pdo->prepare("INSERT INTO presets (projectID, presetName, presetSize, presetWeight, fontID) VALUES (?, ?, ?, ?, ?)");
        $addQuery->execute([$_POST['project-id'], $_POST['preset-name'], $_POST['preset-size'], $_POST['preset-weight'], $_POST['preset-font']]);
    } else {
        $updateQuery = $pdo->prepare("UPDATE presets SET presetName = ?, presetSize = ?, presetWeight = ?, fontID = ? WHERE presetID = ?");
        $updateQuery->execute([$_POST['preset-name'], $_POST['preset-size'], $_POST['preset-weight'], $_POST['preset-font'], $_POST['preset-id']]);
    }

    echo "<body><script>window.location.href = '/pages/project.php?projectID=$projectID'</script></body>";
}