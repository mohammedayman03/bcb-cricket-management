<?php
include 'Connection.php';
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $query = "SELECT * FROM coach WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $playerData = mysqli_fetch_assoc($result);
        if (isset($_POST['modify'])) {
            $modifiedName = $_POST['modified_name'];
            $modifiedEmail = $_POST['modified_email'];
            $modifiedPassword = $_POST['modified_password'];
            $modifiedType = $_POST['modified_type'];
            $checkEmailQuery = "SELECT * FROM coach WHERE email = '$modifiedEmail' AND email != '$email'";
            $checkEmailResult = mysqli_query($con, $checkEmailQuery);

            if (mysqli_num_rows($checkEmailResult) > 0) {
                ?>
                <script type="text/javascript">
                    alert('Another user with this email already exists. Please choose another email.');
                </script>
                <?php
            } else {
                $updateQuery = "UPDATE coach SET 
                                name = '$modifiedName', 
                                email = '$modifiedEmail', 
                                password = '$modifiedPassword', 
                                WHERE email = '$email'";

                $updateResult = mysqli_query($con, $updateQuery);

                if ($updateResult) {
                    echo '<script type="text/javascript">
                            alert("Coach information updated successfully");
                            window.location.href = "coach_home.php?email=' . $modifiedEmail . '";
                          </script>';
                } else {
                    echo "Error updating player information: " . mysqli_error($con);
                }
            }
        }
    } else {
        echo "Error retrieving player data: " . mysqli_error($con);
    }
} else {
    echo "Email not provided in the URL";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2, h3 {
            color: #333;
        }

        label {
            color: #333;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        input[type="submit"],
        button,
        a {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: #d9534f;
        }

        button {
            background-color: #d9534f;
        }

        a {
            background-color: #5bc0de;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            color: #333;
        }

        .container form,
        .container h3,
        .container p {
            margin-bottom: 20px;
        }
    </style>

</head>
<body>

    <h2>Coach Profile</h2>

    <form action="" method="POST">
        <label>Name:</label>
        <input type="text" name="modified_name" value="<?= $playerData['name'] ?>" required><br>

        <label>Email:</label>
        <input type="text" name="modified_email" value="<?= $playerData['email'] ?>" required><br>

        <label>Password:</label>
        <input type="password" name="modified_password" value="<?= $playerData['password'] ?>" required><br>

        <label>Type:</label>
        <br>

        <input type="submit" name="modify" value="Modify">
    </form>

    <h3>Coach Information:</h3>
    <p>Name: <?= $playerData['name'] ?></p>
    <p>Email: <?= $playerData['email'] ?></p>
    <p>Password: <?= $playerData['password'] ?></p>

    <br>


    <a href="javascript:history.back()">Go Back to Home</a>

</body>
</html>