<?php include 'Connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    if(isset($_POST['type']) && $_POST['type'] == 'coach'){
        $query = "INSERT INTO coach (name, email, password, type, description) VALUES ('$name', '$email', '$password', '$type', '$description')";
        $result = mysqli_query($con, $query);
        if ($result) {
            ?>
            <script type ='text/javascript'>alert('Insert Successful'); 
            window.open('http://localhost/BCB2.0/admin_verify.php','_self');
            </script>
            <?php
            $query = "DELETE FROM newuser WHERE name = '$name' AND email = '$email' AND password = '$password' AND type = '$type' AND description = '$description'";
            $result = mysqli_query($con, $query);
    
        } 
    }
    else{
        $query = "INSERT INTO player (name, email, password, type, description) VALUES ('$name', '$email', '$password', '$type', '$description')";
        $result = mysqli_query($con, $query);

        if ($result) {
            ?>
            <script type ='text/javascript'>alert('Insert Successful'); 
            window.open('http://localhost/BCB2.0/admin_verify.php','_self');
            </script>
            <?php
            $query = "DELETE FROM newuser WHERE name = '$name' AND email = '$email' AND password = '$password' AND type = '$type' AND description = '$description'";
            $result = mysqli_query($con, $query);

        } 
        else {
            
            echo "Error: " . mysqli_error($con);
    }
}
}
?>