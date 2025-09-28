<?php
include 'Connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $query = "DELETE FROM newuser WHERE name = '$name' AND email = '$email' AND password = '$password' AND type = '$type' AND description = '$description'";
    $result = mysqli_query($con, $query);

    if ($result) {
        ?>
        <script type ='text/javascript'>alert('Deletion Successful'); 
        window.open('http://localhost/BCB2.0/admin_verify.php','_self');
        </script>
        <?php
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>