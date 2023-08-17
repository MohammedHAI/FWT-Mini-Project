<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posting...</title>
</head>

<body>
    <?php
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "ecs417";

        // Creates connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Checks connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        else {
            echo "Connection sucessful<br/>";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dateTime = date('Y-m-d H:i:s');
            $title = $_POST['title'];
            $content = $_POST['content'];

            $sql = "INSERT INTO blog (datetime, title, content) VALUES ('$dateTime', '$title', '$content')";
            
            $result = mysqli_query($conn, $sql);

            if ($result === true) {
                echo "Successfully added post<br/>";
                $path = "../viewBlog.php";
                header("Location: $path", TRUE, 301); // Redirect to intended page
                exit();
            }
            else {
                $error_msg = "Unable to add post<br/>";
                echo $error_msg;
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        mysqli_close($conn);
    ?>
</body>
</html>