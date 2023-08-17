<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging in...</title>
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
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT email, password FROM users WHERE email='$email' AND password='$password'";

            $result = mysqli_query($conn, $sql);

            $row_number = mysqli_num_rows($result);

            // If email and password is correct, there should be a result
            if ($row_number >= 1) {
                session_start();
                $_SESSION['loggedIn'] = TRUE;
                
                $path = "../viewBlog.php";
                header("Location: $path", TRUE, 301); // Redirect to intended page
                exit();
            }
            else {
                $error_msg = "Unable to log you in <br/>";
                echo $error_msg;
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        mysqli_close($conn);
    ?>
</body>
</html>