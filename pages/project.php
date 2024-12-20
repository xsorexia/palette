<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/api/db.php';
$pdo = db_pdo();
$projectID = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/project.css">
</head>
<body>
    <div id="project-body">
        <div id="project-body-top">
            Project Name
        </div>
        <div id="project-body-bottom">
            <div id="project-body-bottom-left">
                <div id="project-navbar">
                    <div class="project-navbar-item" onclick="scrollToDiv('project-section-color')"># Color</div>
                    <div class="project-navbar-item" onclick="scrollToDiv('project-section-color')"># Fonts</div>
                    <div class="project-navbar-item" onclick="scrollToDiv('project-section-color')"># Text Presets</div>

                </div>
            </div>
            <div id="project-body-bottom-right">
                <div class="project-section" id="project-section-color">
                    <div class="project-section-list">
                        <div class="project-section-title"># Color</div>
                        <div class="project-section-item-list">
                            <div class="project-section-item">
                                <div class="project-section-item-desc" onclick="colorInput(this, true)">+ Add color</div>
                            </div>
                            <?php
                                $colorQuery = $pdo->prepare("SELECT * FROM colors WHERE projectID = ?");
                                $colorQuery -> execute([$projectID]);
                                $colorRes = $colorQuery -> fetchAll(PDO::FETCH_ASSOC);
                                foreach ($colorRes as $row) {
                                    $colorID = $row['colorID'];
                                    $colorName = $row['colorName'];
                                    $colorForeground = $row['foregroundColor'];
                                    $colorBackground = $row['backgroundColor'];
                                    echo "
                                    <div class='project-section-item project-section-item-color'>
                                        <div class='project-section-item-color-cat'  style='background-color: $colorBackground; color: $colorForeground;'>
                                            Palette
                                        </div>
                                        <div class='project-section-item-desc' onclick='colorInput(this, false)' colorID='$colorID' colorName='$colorName' colorFg='$colorForeground' colorBg='$colorBackground'>$colorName</div>
                                    </div>
                                    ";
                                }
                            ?>


                        </div>
                    </div>
                    <div class="project-section-input" id="project-section-input-color" style="display: none;">
                        <div class="project-section-preview">
                            <div class="project-section-item project-section-item-color">
                                <div class="project-section-item-color-cat" style="background-color: orange; color: white;">
                                    Palette
                                </div>
                            </div>
                        </div>
                        <form class="project-section-right" id="project-section-color-form" method="POST" action="/api/addColor.php">
                            <input type="hidden" name="project-id" value="<?=$projectID?>">
                            <input type="hidden" name="color-id" id="color-input-id" value="0">
                            <input type="text" name="color-name" id="color-input-name" class="project-input-field" placeholder="Color Name">
                            <input type="text" name="color-fg" id="color-input-fg" class="project-input-field" placeholder="Foreground Color">
                            <input type="text" name="color-bg" id="color-input-bg" class="project-input-field" placeholder="Background Color">
                            <div class="project-section-right-submit">
                                <div class="project-submit-button" onclick="document.querySelector('#project-section-color-form').submit();">Save</div>
                                <div class="project-cancel-button" onclick="closeColorInput()">Cancel</div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/project.js"></script>
</body>
</html>