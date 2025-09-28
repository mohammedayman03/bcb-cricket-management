<?php include "Connection.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your HTML Page with GIF Background</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('Cricket Stadium.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .header {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .button, .dropbtn {
            --b: 3px;
            --s: .45em; 
            --color: #373B44;
        
            padding: calc(.5em + var(--s)) calc(.9em + var(--s));
            color: var(--color);
            --_p: var(--s);
            background:
            conic-gradient(from 90deg at var(--b) var(--b), #0000 90deg, var(--color) 0)
            var(--_p) var(--_p)/calc(100% - var(--b) - 2*var(--_p)) calc(100% - var(--b) - 2*var(--_p));
            transition: .3s linear, color 0s, background-color 0s;
            outline: var(--b) solid #0000;
            outline-offset: .6em;
            font-size: 16px;
        
            border: 0;
        
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        
            margin-right: 40px; 
        }
        
        .button:hover, .button:focus-visible, .dropbtn:hover, .dropbtn:focus-visible {
            --_p: 0px;
            outline-color: var(--color);
            outline-offset: .05em;
        }
        
        .button:active, .dropbtn:active {
            background: var(--color);
            color: #fff;
        }

        .content {
            position: relative;
            text-align: center;
            padding: 50px;
            color: white;
            margin-top: 50px;
        }

        img {
            width: 100%;
            height: 100%;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 5px;
        }

        .coach-image {
            position: absolute;
            top: 10px; 
            right: 10px; 
            width: 50px; 
            height: 50px; 
            border-radius: 50%; 
        }

        .button-50, .dropbtn {
            appearance: button;
            background-color: #000;
            background-image: none;
            border: 1px solid #000;
            border-radius: 4px;
            box-shadow: #fff 4px 4px 0 0, #000 4px 4px 0 1px;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-family: ITCAvantGardeStd-Bk, Arial, sans-serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            margin: 0 5px 10px 0;
            overflow: visible;
            padding: 12px 40px;
            text-align: center;
            text-transform: none;
            touch-action: manipulation;
            user-select: none;
            -webkit-user-select: none;
            vertical-align: middle;
            white-space: nowrap;
        }

        .button-50:focus, .dropbtn:focus {
            text-decoration: none;
        }

        .button-50:hover, .dropbtn:hover {
            text-decoration: none;
        }

        .button-50:active, .button-50:not([disabled]):active, .dropbtn:active, .dropbtn:not([disabled]):active {
            box-shadow: rgba(0, 0, 0, .125) 0 3px 5px inset;
            outline: 0;
        }

        @media (min-width: 768px) {
            .button-50 {
                padding: 12px 50px;
            }
        }
        #logoutButton {
            position: fixed;
            bottom: 10px;
            right: 10px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            min-width: 160px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content button {
            display: block;
            width: 100%;
            padding: 12px;
            text-align: left;
            border: none;
            background: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #000;
            color: #fff;
        }

        tr {
            background-color: #f5f5f5;
            color: #000;
        }
    </style>
</head>
<body>

    <?php
    $email = $_GET['email'];
    ?>

    <nav>
        <button class="button-50" onclick="window.location.href='player_profile.php?email=<?= $email ?>'">Profile</button>
        <span style="float: right;">
            <button class="button-50" onclick="window.location.href='player_training.php?email=<?= $email ?>'">Training</button>
            <button class="button-50" onclick="window.location.href='player_selection.php?email=<?= $email ?>'">Selection</button>
            <button class="button-50" onclick="window.location.href='login.php'">Logout</button>
            <div class="dropdown">
                <button class="button-50 dropbtn">Statistics</button>
                    <div class="dropdown-content">
                            <button  onclick="window.location.href='odi.php?email=<?= $email ?>'">ODI</button>
                            <button  onclick="window.location.href='t20.php?email=<?= $email ?>'">T20</button>
                            <button  onclick="window.location.href='test.php?email=<?= $email ?>'">Test</button>
                    </div>
            </div>
        </span>
    </nav>

    <div class="content">
        <h2>Squad</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php
            $query = "SELECT name, email FROM squad";
            $result = mysqli_query($con, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "</tr>";
                }
                mysqli_free_result($result);
            } else {
                echo "Error: " . mysqli_error($connection);
            }

            ?>
        </table>
    </div>

</body>
</html>
