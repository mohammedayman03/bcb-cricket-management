<?php include 'Connection.php';
$sql = "SELECT email FROM admin";
$result = mysqli_query($con, $sql);

if (isset($_GET['email'])) {
    $user_email = $_GET['email'];
}

$adminEmails = array();
while ($row = mysqli_fetch_assoc($result)) {
    $adminEmails[] = $row['email'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $complaint = $_POST['complaint'];
    $subject = "User Complaint";
    $headers = $user_email;
    $message = "User Complaint:\n\n$complaint";

    foreach ($adminEmails as $adminEmail) {
        mail($adminEmail, $subject, $message, $headers);
    }

    $successMessage = "Complaint sent successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Complaint Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            background: url('Cricket Stadium.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 16px;
            color: #555;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .success-message {
            color: #4caf50;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Submit Your Complaint</h2>
        <?php if(isset($successMessage)): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <label for="complaint">Complaint:</label><br>
        <textarea id="complaint" name="complaint" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Submit">
    </form>
    <?php
    if (isset($_GET['email'])) {
    $coach_email = $_GET['email'];
}
?>
    <a href="Hcoach_home.php?email=<?= $coach_email ?>"><h4>Go Back to Home</h4></a>

</body>
</html>