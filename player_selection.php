<?php include 'Connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        alert {
            display: block;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $email = $_GET['email'];

        if (!isset($_POST['yes']) && !isset($_POST['no'])) {
        ?>
            <!-- Display the availability prompt -->
            <alert>Are you available to play for the upcoming series?</alert>
            <form action='' method="POST">
                <input type="submit" name='yes' value='Yes'>
                <br><br>
                <input type="submit" name='no' value='No'>
            </form><br><br>
        <?php
        }
        ?>

        <?php
        if (isset($_POST['yes'])) {
            if (isset($_GET['email'])) {
                $checkQuery = "SELECT email FROM batsman WHERE email = '$email'
                               UNION ALL
                               SELECT email FROM bowler WHERE email = '$email'
                               UNION ALL
                               SELECT email FROM wicket_keeper WHERE email = '$email'
                               UNION ALL
                               SELECT email FROM allrounder WHERE email = '$email'";

                $checkResult = mysqli_query($con, $checkQuery);

                if (mysqli_num_rows($checkResult) > 0) {
        ?>
                    <script type="text/javascript">
                        alert('You are already available for selection');
                        window.open('http://localhost/BCB2.0/player_home.php?email=<?= $email ?>', '_self');
                    </script>
                <?php
                } else {
                    $query = "SELECT * FROM player WHERE email = '$email'";
                    $data = mysqli_query($con, $query);
                    $row = mysqli_fetch_assoc($data);

                    $name = $row['name'];
                    $id = $row['id'];
                    $type = $row['type'];
                    $email1 = $row['email'];
                    switch ($type) {
                        case 'Batsman':
                            $insertQuery = "INSERT INTO batsman (name, email) VALUES ('$name', '$email1')";
                            echo"batsman";
                            break;
                        case 'Bowler':
                            $insertQuery = "INSERT INTO bowler (name, email) VALUES ('$name', '$email1')";
                            echo"bowler";
                            break;
                        case 'Wicket-Keeper':
                            $insertQuery = "INSERT INTO wicket_keeper (name, email) VALUES ('$name', '$email1')";
                            break;
                        case 'Allrounder':
                            $insertQuery = "INSERT INTO allrounder (name, email) VALUES ('$name', '$email1')";
                            break;
                        default:
                            echo "Invalid type.";
                            break;
                    }

                    if (isset($insertQuery)) {
                        $result1 = mysqli_query($con, $insertQuery);
                        if ($result1) {
                            ?>
                            <script type='text/javascript'>
                                alert('You are now Available for Selection');
                                window.open('http://localhost/BCB2.0/player_home.php?email=<?= $email ?>', '_self');
                            </script>
                        <?php
                        } else {
                            echo "Error inserting data into the appropriate table: " . mysqli_error($con);
                        }
                    }
                }
            }
        } elseif (isset($_POST['no'])) {
            $deleteQuery = "DELETE FROM batsman WHERE email = '$email';
                            DELETE FROM bowler WHERE email = '$email';
                            DELETE FROM wicket_keeper WHERE email = '$email';
                            DELETE FROM allrounder WHERE email = '$email'";
            $deleteResult = mysqli_multi_query($con, $deleteQuery);

            if ($deleteResult) {
                ?>
                <script type='text/javascript'>
                    alert('You have opted out from selection');
                    window.open('http://localhost/BCB2.0/player_home.php?email=<?= $email ?>', '_self');
                </script>
            <?php
            } else {
                echo "Error deleting data from the appropriate table: " . mysqli_error($con);
            }
        }
        ?>
        <button onclick="window.open('http://localhost/BCB2.0/player_home.php?email=<?= $email ?>', '_self')">Go Back</button>
    </div>
</body>
</html>