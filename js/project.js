function scrollToDiv(divName) {
    div = document.getElementById(divName)
    div.scrollIntoView({
        behavior: "smooth", // Smooth scrolling
        block: "start"      // Align to the top of the viewport
    });
}

function colorInput(div, isNew) {
    var colorID = div.getAttribute("colorid");
    var colorName = div.getAttribute("colorname");
    var colorFg = div.getAttribute("colorFg");
    var colorBg = div.getAttribute("colorBg");

    document.querySelector("#project-section-input-color").style.display = "flex";

    if (!isNew) {
        document.querySelector("#color-input-id").value = colorID;
        document.querySelector("#color-input-name").value = colorName;
        document.querySelector("#color-input-fg").value = colorFg;
        document.querySelector("#color-input-bg").value = colorBg;
        document.querySelector("#project-cancel-button-color").style.display = "block";

    } else {
        document.querySelector("#color-input-id").value = "0";
        document.querySelector("#color-input-name").value = "";
        document.querySelector("#color-input-fg").value = "";
        document.querySelector("#color-input-bg").value = "";
        document.querySelector("#project-cancel-button-color").style.display = "none";

    }

    document.querySelector("#project-color-preview").style.color = document.querySelector("#color-input-fg").value;
    document.querySelector("#project-color-preview").style.backgroundColor = document.querySelector("#color-input-bg").value;

}

function closeColorInput() {
    document.querySelector("#project-section-input-color").style.display = "none";
}

function submitColorInput() {
    document.querySelector('#project-section-color-form').submit();
}

function deleteColorInput() {
    document.querySelector("#color-input-delete").value = "1";
    submitColorInput();
}

document.querySelector("#color-input-fg").addEventListener("change", function () {
    document.querySelector("#project-color-preview").style.color = document.querySelector("#color-input-fg").value;
})

document.querySelector("#color-input-bg").addEventListener("change", function () {
    document.querySelector("#project-color-preview").style.backgroundColor = document.querySelector("#color-input-bg").value;
})



function fontInput(div, isNew) {
    var fontID = div.getAttribute("fontid");
    var fontName = div.getAttribute("fontname");

    document.querySelector("#project-section-input-font").style.display = "flex";

    if (!isNew) {
        document.querySelector("#font-input-id").value = fontID;
        document.querySelector("#font-input-name").value = fontName;
        document.querySelector("#project-cancel-button-font").style.display = "block";
        document.querySelector("#project-font-preview").style.fontFamily = fontName;

    } else {
        document.querySelector("#font-input-id").value = "0";
        document.querySelector("#font-input-name").value = "";
        document.querySelector("#project-cancel-button-font").style.display = "none";
        document.querySelector("#project-font-preview").style.fontFamily = 'Arial';
    }
}

function closeFontInput() {
    document.querySelector("#project-section-input-font").style.display = "none";
}

function submitFontInput() {
    document.querySelector('#project-section-font-form').submit();
}

function deleteFontInput() {
    document.querySelector("#font-input-delete").value = "1";
    submitFontInput();
}

document.querySelector("#font-input-name").addEventListener("change", function () {
    var fontName = document.querySelector("#font-input-name").value;
    document.querySelector("#project-font-preview-style").innerHTML = `@import url('https://fonts.googleapis.com/css2?family=${fontName.replaceAll(" ", "+")}&display=swap')`;
    document.querySelector("#project-font-preview").style.fontFamily = fontName;
})






function presetInput(div, isNew) {
    var presetID = div.getAttribute("presetid");
    var presetName = div.getAttribute("presetname");
    var presetWeight = div.getAttribute("presetweight");
    var presetSize = div.getAttribute("presetsize");
    var presetFont = div.getAttribute("presetfont");
    var presetFontName = div.getAttribute("presetfontname");

    document.querySelector("#project-section-input-preset").style.display = "flex";

    if (!isNew) {
        document.querySelector("#preset-input-id").value = presetID;
        document.querySelector("#preset-input-name").value = presetName;
        document.querySelector("#preset-input-weight").value = presetWeight;
        document.querySelector("#preset-input-size").value = presetSize;
        document.querySelector("#preset-input-font").value = presetFont;
        document.querySelector("#project-cancel-button-preset").style.display = "block";
        document.querySelector("#project-preset-preview").style.fontFamily = presetFontName;
        document.querySelector("#project-preset-preview").style.fontSize = presetSize;
        document.querySelector("#project-preset-preview").style.fontWeight = presetWeight;

    } else {
        document.querySelector("#preset-input-id").value = "0";
        document.querySelector("#preset-input-name").value = "";
        document.querySelector("#preset-input-weight").value = "";
        document.querySelector("#preset-input-size").value = "";
        document.querySelector("#preset-input-font").value = "0";
        document.querySelector("#project-cancel-button-preset").style.display = "none";
        document.querySelector("#project-preset-preview").style.fontFamily = 'Arial';
        document.querySelector("#project-preset-preview").style.fontSize = '15px';
        document.querySelector("#project-preset-preview").style.fontWeight = '300';
    }
}

function closePresetInput() {
    document.querySelector("#project-section-input-preset").style.display = "none";
}

function submitPresetInput() {
    document.querySelector('#project-section-preset-form').submit();
}

function deletePresetInput() {
    document.querySelector("#preset-input-delete").value = "1";
    submitPresetInput();
}

document.querySelector("#preset-input-font").addEventListener("change", function () {
    var fontName = document.querySelector("#preset-input-font").options[document.querySelector("#preset-input-font").selectedIndex].innerHTML;
    document.querySelector("#project-preset-preview").style.fontFamily = fontName;
})

document.querySelector("#preset-input-size").addEventListener("change", function () {
    document.querySelector("#project-preset-preview").style.fontSize = document.querySelector("#preset-input-size").value;
})

document.querySelector("#preset-input-weight").addEventListener("change", function () {
    document.querySelector("#project-preset-preview").style.fontWeight = document.querySelector("#preset-input-weight").value;
})