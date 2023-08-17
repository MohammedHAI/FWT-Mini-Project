<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addEntry.css" type="text/css" title="Default">
    <link rel="alternative stylsheet" href="css/reset.css" type="text/css" title="No styling">
    <script defer src="backend/handlePost.js"></script>
    <title>Add blog entry</title>
</head>
<body>
    <form id="add-blog-form" action="" method="post">
        <legend>Add blog entry</legend>
        <?php
            // Show different text inputs based on whether the post is being edited or not
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = $_POST['title'];
                $content = $_POST['content'];

                echo '
                <input type="text" id="title" name="title" placeholder="Title" value="' . $title . '">
                <br/>
                <textarea id="content" name="content" placeholder="Enter text">' . $content . '</textarea>
                <br/>';
            }
            else {
                echo '
                <input type="text" id="title" name="title" placeholder="Title">
                <br/>
                <textarea id="content" name="content" placeholder="Enter text"></textarea>
                <br/>';
            }
        ?>
        
        <button id="preview">Preview</button>
        <button id="clear">Clear</button>
        <button id="post">Post</button>
    </form>
</body>
</html>