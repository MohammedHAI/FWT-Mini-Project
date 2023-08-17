// Opens dialog to confirm whether to clear or not
// If yes, fields are cleared, otherwise left as-is
function confirmClear(e) {
    e.preventDefault();

    if (confirm("Do you want to clear the form?") == true) {
        titleField = document.getElementById("title");
        contentField = document.getElementById("content");
        titleField.value = "";
        contentField.value = "";
        titleField.style.backgroundColor = "#ffffff";
        contentField.style.backgroundColor = "#ffffff";
    }
}

// Submits form to preview page
function goPreview(e) {
    e.preventDefault();

    form.action = "previewEntry.php";
    form.submit();
}

// Submits form to be posted
function goPost(e) {
    e.preventDefault();

    form.action = "backend/createPost.php";
    checkFormValidation(e);
}

// Checks for empty fields and highlights them
function checkFormValidation(e) {
    e.preventDefault();
    titleField = document.getElementById("title");
    contentField = document.getElementById("content");
    
    // Is title empty?
    if (titleField.value == "") {
        titleField.style.backgroundColor = "#ff9966";
    }
    else {
        titleField.style.backgroundColor = "#ffffff";
    }

    // Is content empty?
    if (contentField.value == "") {
        contentField.style.backgroundColor = "#ff9966";
    }
    else {
        contentField.style.backgroundColor = "#ffffff";
    }

    // Are both empty?
    if ((titleField.value == "" || contentField.value == "")) {
        return false;
    }
    else {
        form.submit();
    }
}

clearButton = document.getElementById("clear");
clearButton.addEventListener("click", confirmClear);
previewButton = document.getElementById("preview");
previewButton.addEventListener("click", goPreview);
postButton = document.getElementById("post");
postButton.addEventListener("click", goPost);
form = document.getElementById("add-blog-form");