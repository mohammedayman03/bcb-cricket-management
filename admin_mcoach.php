<?php
include 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $action = $_POST['action'];
    
    if ($action == 'make_head_coach') {
        $update_query = "UPDATE coach SET hflag = 1 WHERE email = '$email'";
    } elseif ($action == 'make_normal_coach') {
        $update_query = "UPDATE coach SET hflag = 0 WHERE email = '$email'";
    } else {
        $delete_query = "DELETE FROM coach WHERE email = '$email'";
        $con->query($delete_query);
        header("Location: admin_mcoach.php?success=Coach deleted successfully");
        exit();
    }
    $con->query($update_query);
    header("Location: admin_mcoach.php?success=Coach updated successfully");
    exit();
}

$coachNames_query = "SELECT * FROM coach";
$coachNames_result = $con->query($coachNames_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Coach Role</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            background: url('LORD.webp') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            
        }

        h2 {
            color: #333;
            text-align: center;
            margin-top: 0;
            padding-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        select,
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        p {
            color: #4caf50;
            text-align: center;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_GET['success'])) {
        echo '<p style="color: green;">' . $_GET['success'] . '</p>';
    }
    ?>

    <form method="post" action="admin_mcoach.php">
        <label for="email">Select Coach:</label>
        <select name="email">
            <?php
            while ($row = $coachNames_result->fetch_assoc()) {
                echo '<option value="' . $row["email"] . '">' . $row["name"] . '</option>';
            }
            ?>
        </select>

        <label for="action">Select Action:</label>
        <select name="action">
            <option value="make_head_coach">Head Coach</option>
            <option value="make_normal_coach">Normal Coach</option>
            <option value="delete">Delete</option>
        </select>

        <input type="submit" value="Submit">
        <a href="javascript:history.back()">Go Back</a>
    </form>
    
</body>

</html>