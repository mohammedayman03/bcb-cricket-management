<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selected Player</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Selected Player: <?php echo $name; ?></h1>
    <form method="POST" action="">
        <label for="series_name">Series Name (all lowercase, no spaces/hyphens/special characters):</label>
        <input type="text" name="series_name" pattern="[a-z0-9]+" title="Series name must be in lowercase and contain only letters and numbers" required><br>

        <label for="wickets_taken">Wickets Taken:</label>
        <input type="number" name="wickets_taken" required><br>

        <label for="runs_scored">Runs Scored:</label>
        <input type="number" name="runs_scored" required><br>

        <input type="submit" value="Submit">
    </form>
    <a href="javascript:history.back()">Go Back</a>
</body>

</html>
