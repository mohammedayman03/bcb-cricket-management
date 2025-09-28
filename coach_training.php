<?php include 'Connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Training</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background: url('Cricket Stadium.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select,
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }


        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            display: inline-block;
            margin: 10px auto;
            padding: 8px 15px;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <h2>Assign Training</h2>
    
    <form method="post" action="coach_training.php">
        <label for="player">Select Player:</label>
        <select name="player" id="player" required>
        <option  value="">---Choose Player---</option>
            <?php
            $sql = "SELECT name, email FROM player";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<option  data-email='{$row['email']}'>{$row['name']}</option>";
                }
            }
            ?>
        </select>
        <input type="hidden" name="player_email" id="player_email">

        <br>

        <label for="training_date">Training Date:</label>
        <input type="date" name="training_date" required>

        <br>

        <label for="training_type">Training Type:</label>
        <input type="text" name="training_type" required>

        <br>

        <input type="submit" value="Assign Training">
    </form>
    <?php
    if (isset($_GET['email'])) {
    $coach_email = $_GET['email'];
}
?>
    <a href="javascript:history.back()">Go Back</a>

    <script>
        document.getElementById('player').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var playerEmail = selectedOption.getAttribute('data-email');
            document.getElementById('player_email').value = playerEmail;
        });
    </script>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $player_id = $_POST["player"];
        $training_date = $_POST["training_date"];
        $training_type = $_POST["training_type"];
        $player_email = $_POST["player_email"];
        $player_id = mysqli_real_escape_string($con, $player_id);
        $training_date = mysqli_real_escape_string($con, $training_date);
        $training_type = mysqli_real_escape_string($con, $training_type);
        $player_email = mysqli_real_escape_string($con, $player_email);
        $sql = "INSERT INTO training (name, training_date, type, player_email) 
                VALUES ('$player_id', '$training_date', '$training_type', '$player_email')";
        if (mysqli_query($con, $sql)) {
            echo "<p>Training assigned successfully.</p>";
            
        } else {
            $errorMessage = "Error: " . $sql . "<br>" . mysqli_error($con);
            echo "<p style='color: red;'>$errorMessage</p>";
        }
    }

    ?>

</body>
</html>