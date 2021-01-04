
<?php // Do not put any HTML above this line
session_start();
require_once "pdo.php";
$stmt = $pdo->query("SELECT profile_id, first_name,last_name , headline from users join Profile on users.user_id = Profile.user_id");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Soufiane Ben Yaala</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
        integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h1>Chuck Severance's Resume Registry</h1>
        <?php
    if (isset($_SESSION['name'])) {
        echo '<p><a href="logout.php">Logout</a></p>';
        echo '<p><a href="add.php">Add New Entry</a></p>';
    }
    ?>
    <?php
    if (isset($_SESSION['success'])) {
        echo('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
        unset($_SESSION['success']);
    }
    ?>
  <ul>

<?php
if (!isset($_SESSION['name'])) {
    echo "<p><a href='login.php'>Please log in</a></p>";
}
if (true) {
    if (true) {
        echo "<table border='1'>";
        echo " <thead><tr>";
        echo "<th>Name</th>";
        echo " <th>Headline</th>";
        if (isset($_SESSION['name'])) {
            echo("<th>Action</th>");
        }
        echo " </tr></thead>";
        foreach ($rows as $row) {
            echo "<tr><td>";
            echo("<a href='view.php?profile_id=" . $row['profile_id'] . "'>" . $row['first_name'] . $row['last_name']  . "</a>");
            echo("</td><td>");
            echo($row['headline']);
            echo("</td>");
            if (isset($_SESSION['name'])) {
                echo("<td>");
                echo('<a href="edit.php?profile_id=' . $row['profile_id'] . '">Edit</a> / <a href="delete.php?profile_id=' . $row['profile_id'] . '">Delete</a>');
            }
            echo("</td></tr>\n");
        }
        echo "</table>";
    } else {
        echo 'No rows found';
    }
}
echo '</li></ul>';
?>

        <p>
            <b>Note:</b> Your implementation should retain data across multiple
            logout/login sessions. This sample implementation clears all its
            data periodically - which you should not do in your implementation.
        </p>
    </div>
</body>

</html>