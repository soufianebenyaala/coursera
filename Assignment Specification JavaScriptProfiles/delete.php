<?php
session_start();

if (!isset($_SESSION['name'])) {
    die('Not logged in');
}

require_once "pdo.php";


if(isset($_POST['cancel'])){
    header('Location: index.php');
    return;
}

if ( isset($_POST['Delete']) && isset($_POST['profile_id']) ) {
    echo 23132;
    $sql = "DELETE FROM Profile WHERE profile_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['profile_id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['profile_id']) ) {
    $_SESSION['error'] = "Missing user_id";
    header('Location: index.php');
    return;
}

$stmt = $pdo->prepare("SELECT first_name, last_name FROM Profile where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for profile id';
    header('Location: index.php');
    return;
}
?>

<!DOCTYPE html>
<html>
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
    <p>First Name: <?php echo($row['first_name']); ?></p>
    <p>Last Name: <?php echo($row['last_name']); ?></p>
    <form method="post"><input type="hidden" name="profile_id" value="<?php echo $_GET['profile_id'] ?>">
        <input type="submit" name="Delete" value="Delete">
        <input type="submit" name="cancel" value="cancel">
    </form>
</div>
</body>