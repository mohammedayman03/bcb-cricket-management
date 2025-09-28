<?php include "Connection.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Squad</title>
  <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            background: url('LORD.webp') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            color: #fff;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
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

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

  <h2>Create Squad</h2>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $batsmanCount = $_POST["batsman"];
      $bowlerCount = $_POST["bowler"];
      $wicketkeeperCount = $_POST["wicketkeeper"];
      $allrounderCount = $_POST["allrounder"];

      if ($batsmanCount + $bowlerCount + $wicketkeeperCount + $allrounderCount !== 11) {
          echo '<div class="error">Error: Total number of players must be 11.</div>';
      } else {
          
          $batsmanQuery = "SELECT * FROM batsman LIMIT $batsmanCount";
          $bowlerQuery = "SELECT * FROM bowler LIMIT $bowlerCount";
          $wicketkeeperQuery = "SELECT * FROM wicket_keeper LIMIT $wicketkeeperCount";
          $allrounderQuery = "SELECT * FROM allrounder LIMIT $allrounderCount";
          function insertPlayers($con, $query, $type)
          {
              $result = mysqli_query($con, $query);

              while ($row = mysqli_fetch_assoc($result)) {
                  $name = $row['name'];
                  $email = $row['email'];
                  $insertQuery = "INSERT INTO Squad (name, email, type) VALUES ('$name', '$email', '$type')";
                  mysqli_query($con, $insertQuery);
              }
          }
          
          insertPlayers($con, $batsmanQuery, 'Batsman');
          insertPlayers($con, $bowlerQuery, 'Bowler');
          insertPlayers($con, $wicketkeeperQuery, 'Wicketkeeper');
          insertPlayers($con, $allrounderQuery, 'Allrounder');

          $emptyBatsmanTable = "DELETE FROM batsman";
          $emptyBowlerTable = "DELETE FROM bowler";
          $emptyWicketkeeperTable = "DELETE FROM wicket_keeper";
          $emptyAllrounderTable = "DELETE FROM allrounder";

          mysqli_query($con, $emptyBatsmanTable);
          mysqli_query($con, $emptyBowlerTable);
          mysqli_query($con, $emptyWicketkeeperTable);
          mysqli_query($con, $emptyAllrounderTable);  

          $updateCoachTable = "UPDATE coach SET sflag = 0 WHERE sflag = 1";
          mysqli_query($con, $updateCoachTable);

          echo "Squad created successfully!";
      }
  }
  ?>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="batsman">Number of Batsmen:</label>
    <input type="number" name="batsman" required><br>

    <label for="bowler">Number of Bowlers:</label>
    <input type="number" name="bowler" required><br>

    <label for="wicketkeeper">Number of Wicketkeepers:</label>
    <input type="number" name="wicketkeeper" required><br>

    <label for="allrounder">Number of All-rounders:</label>
    <input type="number" name="allrounder" required><br>

    <input type="submit" value="Create Squad" >
    <a href="javascript:history.back()">Go Back</a>
  </form>

</body>
</html>