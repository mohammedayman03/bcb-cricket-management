<?php include 'Connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            background: url('Cricket Stadium.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td {
            background-color: #fff;
        }

        td.actions {
            display: flex;
            gap: 5px;
        }

        form {
            margin: 0;
        }

        input[type="submit"] {
            padding: 5px 10px;
            cursor: pointer;
            border: none;
            color: #fff;
            border-radius: 3px;
        }

        input[type="submit"].verify {
            background-color: #5bc0de;
        }

        input[type="submit"].delete {
            background-color: #d9534f;
        }
        a {
            display: inline-block;
            margin: 8px auto;
            padding: 3px 10px;
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
        <?php
          $email = $_GET['email'];
          echo '<button id="myProfile" class="button" onclick="redirectToProfile1(\'' . $email . '\')">Go Back</button>';
        ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Type</th>
            <th>Description</th>
            <th colspan='2'>Actions</th>
        </tr>
        <?php 
            $query = 'SELECT * FROM newuser';
            $data = mysqli_query($con, $query);
            $result = mysqli_num_rows($data);

            if ($result) {
                while ($row = mysqli_fetch_array($data)) {
        ?>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['password'] ?></td>
                        <td><?php echo $row['type'] ?></td>
                        <td><?php echo $row['description'] ?></td>
                        <td class="actions">
                            <form action="verify_nuser.php" method="POST">
                                <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
                                <input type="hidden" name="email" value="<?php echo $row['email'] ?>">
                                <input type="hidden" name="password" value="<?php echo $row['password'] ?>">
                                <input type="hidden" name="type" value="<?php echo $row['type'] ?>">
                                <input type="hidden" name="description" value="<?php echo $row['description'] ?>">
                                <input type="submit" name="submit" class="verify" value="Verify">
                            </form>
                            <form action="delete_nuser.php" method="POST">
                                <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
                                <input type="hidden" name="email" value="<?php echo $row['email'] ?>">
                                <input type="hidden" name="password" value="<?php echo $row['password'] ?>">
                                <input type="hidden" name="type" value="<?php echo $row['type'] ?>">
                                <input type="hidden" name="description" value="<?php echo $row['description'] ?>">
                                <input type="submit" name="submit" class="delete" value="Delete">
                            </form>
                            
                        </td>
                    </tr>
        <?php
                }
            }
        ?>
    </table>
    <script>
        var email = '<?php echo $email; ?>';

        function redirectToProfile1(email) {
            window.location.href = 'admin_home.php?email=' + email;
        }
    </script>
</body>

</html>
