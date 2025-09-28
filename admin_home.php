<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="coach_css.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            position: relative;
        }

        img {
            width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .header {
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: right;
        }

        .button {
            background-color: #007BFF;
            border: 1px solid #007BFF;
            box-shadow: 0 4px 6px rgba(0, 123, 255, 0.1);
            color: #fff;
            font-size: 16px;
            padding: 12px 20px;
            margin: 5px;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s, transform 0.2s;
        }

        .button:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            transform: scale(1.05);
        }

        #logoutButton {
            position: fixed;
            bottom: 10px;
            right: 10px;
            background-color: #dc3545;
            border: 1px solid #dc3545;
            box-shadow: 0 4px 6px rgba(220, 53, 69, 0.1);
            color: #fff;
            font-size: 16px;
            padding: 12px 20px;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s, transform 0.2s;
        }

        #logoutButton:hover {
            background-color: #c82333;
            border-color: #c82333;
            transform: scale(1.05);
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

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content button {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            width: 100%;
            text-align: left;
        }

        .dropdown-content button:hover {
            background-color: #ddd;
            color: black;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    <img src="Cricket Stadium.jpg" alt="Background Image">
    <div class="header">
        <?php
        $email = $_GET['email'];
        echo '<button id="myProfile" class="button" onclick="redirectToProfile1(\'' . $email . '\')">My Profile</button>';
        echo '<button id="userapprove" class="button" onclick="redirectToProfile2(\'' . $email . '\')">User Approve</button>';
        echo '<button id="modifyplayer" class="button" onclick="redirectToProfile4(\'' . $email . '\')">Modify Player</button>';
        echo '<button id="modifycoach" class="button" onclick="redirectToProfile5(\'' . $email . '\')">Modify Coach</button>';
        ?>
        <div class="dropdown">
            <button class="button dropbtn">Statistic Update</button>
            <div class="dropdown-content">
                <button  onclick="window.location.href='odi.php?email=<?= $email ?>'">ODI</button>
                <button  onclick="window.location.href='twenty_twenty.php?email=<?= $email ?>'">T20</button>
                <button  onclick="window.location.href='test.php?email=<?= $email ?>'">Test</button>
            </div>
        </div>
    </div>
    
    <button id="logoutButton" class="button" onclick="redirectToLogin()">Logout</button>

    <script>
        function redirectToProfile1(email) {
            console.log("Redirecting to profile page");
            window.location.href = 'admin_pmod.php?email=' + email;
        }

        function redirectToProfile2(email) {
            console.log("Redirecting to profile page");
            window.location.href = 'admin_verify.php?email=' + email;
        }

        function redirectToProfile4(email) {
            console.log("Redirecting to profile page");
            window.location.href = 'admin_mplayer.php?email=' + email;
        }

        function redirectToProfile5(email) {
            console.log("Redirecting to profile page");
            window.location.href = 'admin_mcoach.php?email=' + email;
        }

        function redirectToStatistics(format, email) {
            console.log("Redirecting to statistics page for " + format);
            window.location.href = 'statistics.php?format=' + format + '&email=' + email;
        }

        function redirectToLogin() {
            console.log("Redirecting to login page");
            window.location.href = 'login.php';
        }
    </script>
</body>

</html>
