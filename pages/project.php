<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/api/db.php';
$pdo = db_pdo();
if (isset($_GET['projectID'])) {
    $projectID = $_GET['projectID'];
    $projectInfo = getProjectInfo($projectID);
} else {
    echo "<body><script>alert('Not a valid project.');window.location.href='/index.html'</script></body>";
}
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
            <div id="project-body-top-info">
                <div id="project-body-top-info-title"><?=$projectInfo['projectName']?></div>
                <div id="project-body-top-info-desc">@<?=$projectInfo['username']?> | <?=$projectInfo['projectRegDate']?></div>
            </div>
            <div id="project-body-top-options">
                <div class="project-genCss-button">Generate CSS</div>
                <div class="project-exit-button" onclick="window.location.href = '/pages/projectList.php'">Exit</div>
            </div>
        </div>
        <div id="project-body-bottom">
            <div id="project-body-bottom-left">
                <div id="project-navbar">
                    <div class="project-navbar-item" onclick="scrollToDiv('project-section-color')"># Color</div>
                    <div class="project-navbar-item" onclick="scrollToDiv('project-section-font')"># Font</div>
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
                                <div id="project-color-preview" class="project-section-item-color-cat" style="background-color: orange; color: white;">
                                    Palette
                                </div>
                            </div>
                        </div>
                        <form class="project-section-right" id="project-section-color-form" method="POST" action="/api/addColor.php">
                            <input type="hidden" name="project-id" value="<?=$projectID?>">
                            <input type="hidden" name="color-delete" id="color-input-delete" value="0">
                            <input type="hidden" name="color-id" id="color-input-id" value="0">
                            <input type="text" name="color-name" id="color-input-name" class="project-input-field" placeholder="Color Name">
                            <input type="text" name="color-fg" id="color-input-fg" class="project-input-field" placeholder="Foreground Color">
                            <input type="text" name="color-bg" id="color-input-bg" class="project-input-field" placeholder="Background Color">
                            <div class="project-section-right-submit">
                                <div class="project-submit-button" onclick="submitColorInput()">Save</div>
                                <div class="project-cancel-button" id="project-cancel-button-color" onclick="deleteColorInput()">Delete</div>
                                <div class="project-cancel-button" onclick="closeColorInput()">Cancel</div>

                            </div>
                        </form>
                    </div>
                </div>



                <div class="project-section" id="project-section-font">
                    <div class="project-section-list">
                        <div class="project-section-title"># Font</div>
                        <div class="project-section-item-list">
                            <div class="project-section-item">
                                <div class="project-section-item-desc" onclick="fontInput(this, true)">+ Add font</div>
                            </div>
                            <?php
                                $fontQuery = $pdo->prepare("SELECT * FROM fonts WHERE projectID = ?");
                                $fontQuery -> execute([$projectID]);
                                $fontRes = $fontQuery -> fetchAll(PDO::FETCH_ASSOC);
                                foreach ($fontRes as $row) {
                                    $fontID = $row['fontID'];
                                    $fontName = $row['fontName'];
                                    $fontNameFormatted = str_replace(" ", "+", $fontName);
                                    echo "
                                    <div class='project-section-item project-section-item-font'>
                                        <style>@import url('https://fonts.googleapis.com/css2?family=$fontNameFormatted:wght@100;200;300;400;500;600;700;800;900&display=swap'); </style>
                                        <div class='project-section-item-font-cat'  style='font-family: $fontName;'>
                                            The quick brown fox
                                        </div>
                                        <div class='project-section-item-desc' onclick='fontInput(this, false)' fontID='$fontID' fontName='$fontName'>$fontName</div>
                                    </div>
                                    ";
                                }
                            ?>


                        </div>
                    </div>
                    <div class="project-section-input" id="project-section-input-font" style="display: none;">
                        <div class="project-section-preview">
                            <div class="project-section-item project-section-item-font">
                                <style id="project-font-preview-style">
                                    @import url('');
                                </style>
                                <div id="project-font-preview" class="project-section-item-font-cat">
                                    The quick brown fox
                                </div>
                            </div>
                        </div>
                        <form class="project-section-right" id="project-section-font-form" method="POST" action="/api/addFont.php">
                            <input type="hidden" name="project-id" value="<?=$projectID?>">
                            <input type="hidden" name="font-delete" id="font-input-delete" value="0">
                            <input type="hidden" name="font-id" id="font-input-id" value="0">
                            <input type="text" name="font-name" id="font-input-name" class="project-input-field" placeholder="Font Name (Google Fonts)">
                            <div class="project-section-right-submit">
                                <div class="project-submit-button" onclick="submitFontInput()">Save</div>
                                <div class="project-cancel-button" id="project-cancel-button-font" onclick="deleteFontInput()">Delete</div>
                                <div class="project-cancel-button" onclick="closeFontInput()">Cancel</div>

                            </div>
                        </form>
                    </div>
                </div>





                <div class="project-section" id="project-section-preset">
                    <div class="project-section-list">
                        <div class="project-section-title"># Text Presets</div>
                        <div class="project-section-item-list">
                            <div class="project-section-item">
                                <div class="project-section-item-desc" onclick="presetInput(this, true)">+ Add preset</div>
                            </div>
                            <?php
                                $presetQuery = $pdo->prepare("SELECT P.*, F.fontName FROM presets AS P INNER JOIN fonts as F ON P.fontID = F.fontID WHERE P.projectID = ?");
                                $presetQuery -> execute([$projectID]);
                                $presetRes = $presetQuery -> fetchAll(PDO::FETCH_ASSOC);
                                foreach ($presetRes as $row) {
                                    $presetID = $row['presetID'];
                                    $presetName = $row['presetName'];
                                    $presetSize = $row['presetSize'];
                                    $presetWeight = $row['presetWeight'];
                                    $presetFont = $row['fontID'];
                                    $presetFontName = $row['fontName'];
                                    echo "
                                    <div class='project-section-item project-section-item-preset'>
                                        <div class='project-section-item-preset-cat' style='font-family: \"$presetFontName\"; font-size: $presetSize; font-weight: $presetWeight;'>
                                            The quick brown fox
                                        </div>
                                        <div class='project-section-item-desc' onclick='presetInput(this, false)' presetID='$presetID' presetName='$presetName' presetWeight='$presetWeight' presetSize='$presetSize' presetFont='$presetFont' presetFontName='$presetFontName'>$presetName</div>
                                    </div>
                                    ";
                                }
                            ?>


                        </div>
                    </div>
                    <div class="project-section-input" id="project-section-input-preset" style="display: none;">
                        <div class="project-section-preview">
                            <div class="project-section-item project-section-item-preset">
                                <div id="project-preset-preview" class="project-section-item-preset-cat">
                                    The quick brown fox
                                </div>
                            </div>
                        </div>
                        <form class="project-section-right" id="project-section-preset-form" method="POST" action="/api/addPreset.php">
                            <input type="hidden" name="project-id" value="<?=$projectID?>">
                            <input type="hidden" name="preset-delete" id="preset-input-delete" value="0">
                            <input type="hidden" name="preset-id" id="preset-input-id" value="0">
                            <input type="text" name="preset-name" id="preset-input-name" class="project-input-field" placeholder="Font Name (Google Fonts)">
                            <select name="preset-font" class="project-input-field" id="preset-input-font">
                                <option value="0" disabled selected>Please select a font</option>
                                <?php
                                $fontList = getFontList($projectID);
                                foreach ($fontList as $row) {
                                    $fontID = $row['fontID'];
                                    $fontName = $row['fontName'];
                                    echo "<option value='$fontID'>$fontName</option>";
                                }
                                ?>
                            </select>
                            <input type="text" name="preset-size" id="preset-input-size" class="project-input-field" placeholder="Font Size">
                            <input type="text" name="preset-weight" id="preset-input-weight" class="project-input-field" placeholder="Font weight">

                            <div class="project-section-right-submit">
                                <div class="project-submit-button" onclick="submitPresetInput()">Save</div>
                                <div class="project-cancel-button" id="project-cancel-button-preset" onclick="deletePresetInput()">Delete</div>
                                <div class="project-cancel-button" onclick="closePresetInput()">Cancel</div>

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