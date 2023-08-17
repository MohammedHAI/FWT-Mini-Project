<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css" type="text/css" title="Default">
    <link rel="alternative stylsheet" href="css/reset.css" type="text/css" title="No styling">
    <title>Mohammed Al-Islam | Blog</title>
</head>

<header>
    <nav>
        <h1>Mohammed Al-Islam</h1>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="skills_and_experience.html">Skills & Experience</a></li>
            <li><a href="education.html">Education</a></li>
            <li><a href="portfolio.html">Portfolio</a></li>
            <li><p>View Blog</p></li>
        </ul>
    </nav>
</header>

<body>
    <?php

    session_start();

    // Only show add entry button if user is logged in
    if (isset($_SESSION['loggedIn'])) {
        if ($_SESSION['loggedIn'] == true) {
            echo '<a id="add-entry-button" href="addEntry.php">Add Entry</a>';
        }
    }

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

    $sql = "SELECT * FROM blog";
    
    $result = mysqli_query($conn, $sql);
    $row_number = mysqli_num_rows($result);

    // Takes entries from the blog and sorts them by newest first
    function sortEntries($result) {
        $sortedEntries = array();

        // Gather all entries
        while ($row = $result->fetch_assoc()) {
            $sortedEntries[] = $row;
        }

        // Bubble sort algorithm
        for ($j = 0; $j < count($sortedEntries); $j++) {
            for ($i = 0; $i < count($sortedEntries) - 1 - $j; $i++) {
                $current = $i;
                $next = $i + 1;
    
                // Compare dates of current and next entry
                if ($sortedEntries[$next]['datetime'] > $sortedEntries[$current]['datetime']) {
                    // Swap positions if wrong order
                    $temp = $sortedEntries[$next];
                    $sortedEntries[$next] = $sortedEntries[$current];
                    $sortedEntries[$current] = $temp;
                }
            }
        }
        
        return $sortedEntries;
    }

    // Display each entry if there are some available
    if ($row_number > 0) {
        $sortedEntries = sortEntries($result);
        
        echo "<article>";
        foreach ($sortedEntries as $key => $value) {
            echo '
            <section>
                <pre>Posted: ' . $value['datetime'] . '</pre>
                <h3>' . $value['title'] . '</h3>
                <p>' . $value['content'] . '</p>
            </section>';
        }
        echo "</article>";
    }
    else {
        echo "<p>No entries to show</p>";
    }

    mysqli_close($conn);
    ?>

    <aside id="blog">
        <?php
            // Show log in/log out based on session variable
            if (isset($_SESSION['loggedIn'])) {
                if ($_SESSION['loggedIn'] == true) {
                    echo '<a href="backend/logout.php">Log out</a>';
                }
            }
            else {
                echo '<a href="login.html">Log in</a>';
            }
        ?>
    </aside>

    <footer id="contact">
        <h3>How to contact me</h3>
        <p>
        email: <a href="mailto:m.al-islam@se21.qmul.ac.uk">m.al-islam@se21.qmul.ac.uk</a>
        </p>
    </footer>
</body>
</html>