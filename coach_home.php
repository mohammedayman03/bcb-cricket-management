<?php include 'Connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="coach_css.css">
    <title>Coach Dashboard</title>
</head>
<body>
    <div class="content">
        <div id="buttonContainer">
            <?php
                $email = $_GET['email'];
                echo '<button id="myProfile" class="button" onclick="redirectToProfile1(\'' . $email . '\')">My Profile</button>';
                echo '<button id="approvetraining" class="button" onclick="redirectToProfile2(\'' . $email . '\')">Appoint Training</button>';
                echo '<button id="teststat" class="button" onclick="redirectToProfile5(\'' . $email . '\')">TEST Statistics</button>';
                echo '<button id="t20stat" class="button" onclick="redirectToProfile6(\'' . $email . '\')">T20 Statistics</button>';
                echo '<button id="odistat" class="button" onclick="redirectToProfile7(\'' . $email . '\')">ODI Statistics</button>';
                ?>
                <?php
                $sflagQuery = "SELECT sflag FROM coach WHERE email = '$email'";
                $sflagResult = mysqli_query($con, $sflagQuery);

                if ($sflagResult) {
                    $row = mysqli_fetch_assoc($sflagResult);
                    if ($row['sflag'] == 1) {
                        echo '<p>You already entered points</p>';
                    } else {
                        echo '<button id="givepoints" class="button" onclick="redirectToProfile3(\'' . $email . '\')">Give Points</button>';
                        $sflagQuery2 = "UPDATE coach SET sflag=1 WHERE email = '$email'";
                        $sflagResult2 = mysqli_query($con, $sflagQuery2);
                    }
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            ?>

        <a href="login.php" id="logoutButton" class="button">Logout</a>

        <h2>Squad</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php
                $squadQuery = "SELECT name, email FROM squad";
                $squadResult = mysqli_query($con, $squadQuery);

                if ($squadResult) {
                    while ($row = mysqli_fetch_assoc($squadResult)) {
                        echo "<tr>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            ?>
        </table>
    </div>

    <script src="coach_js.js"></script>
    <script>
        var email = '<?php echo $email; ?>';

        function redirectToProfile1() {
            window.location.href = 'coach_pmod.php?email=' + email;
        }

        function redirectToProfile2() {
            window.location.href = 'coach_training.php?email=' + email;
        }

        function redirectToProfile3() {
            window.location.href = 'coach_give.php?email=' + email;
        }

        function redirectToProfile5() {
            window.location.href = 'only_teststat.php?email=' + email;
        }

        function redirectToProfile6() {
            window.location.href = 't20_stat.php?email=' + email;
        }

        function redirectToProfile7() {
            window.location.href = 'odi_stat.php?email=' + email;
        }
    </script>

</body>
</html>
