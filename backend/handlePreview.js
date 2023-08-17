// Submits form back to editing page (addEntry)
function goEdit(e) {
    e.preventDefault();

    form.action = "addEntry.php";
    form.submit();
}

// Submits form to be posted
function goPost(e) {
    e.preventDefault();

    form.action = "backend/createPost.php";
    checkFormValidation(e);
}

// Checks for empty fields before deciding to post
function checkFormValidation(e) {
    e.preventDefault();
    titleField = document.getElementById("title");
    contentField = document.getElementById("content");
    
    // Are both empty?
    if ((titleField.value == "" || contentField.value == "")) {
        return false;
    }
    else {
        form.submit();
    }
}

editButton = document.getElementById("edit");
editButton.addEventListener("click", goEdit);
postButton = document.getElementById("post");
postButton.addEventListener("click", goPost);
form = document.getElementById("preview-blog-form");