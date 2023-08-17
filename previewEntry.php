<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/previewEntry.css" type="text/css" title="Default">
    <link rel="alternative stylsheet" href="css/reset.css" type="text/css" title="No styling">
    <script defer src="backend/handlePreview.js"></script>
    <title>Preview blog entry</title>
</head>
<body>
    <?php
        // Preview only if there is a post to show
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];

            if ($title == "" || $content == "") {
                echo "<p>No entry details available to preview</p>";
            }
            else {
                echo '
                <article>
                    <section>
                        <pre>Posted: ' . date('Y-m-d H:i:s') . '</pre>
                        <h3>' . $title . '</h3>
                        <p>' . $content . '</p>
                    </section>
                </article>';
            }
        }
    ?>

    <form id="preview-blog-form" action="backend/handlePost.php" method="post">
        <legend>Blog post preview</legend>
        <p>Please choose what you would like to do.</p>
        <button id="edit">Edit</button>
        <button id="post">Post</button>

        <?php
            // To make sure the details are sent back for editing.
            echo '<input type="hidden" name="title" value="' . $title . '">';
            echo '<input type="hidden" name="content" value="' . $content . '">';
        ?>
    </form>
</body>
</html>