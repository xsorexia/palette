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
}

function closeColorInput() {
    document.querySelector("#project-cancel-button-color").style.display = "none";
}

function submitColorInput() {
    document.querySelector('#project-section-color-form').submit();
}

function deleteColorInput() {
    document.querySelector("#color-input-delete").value = "1";
    submitColorInput();
}