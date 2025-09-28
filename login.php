<?php include 'Connection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="login_css.css">
    <title>Login Page</title>
</head>

<body>

    <div class="container" id="container">
            <div class="form-container sign-up">
                <form method="POST">
                    <h1>Create Account</h1>
                    <div class="social-icons">
                        <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                    <span>Use your email for registration</span>
                    <input type="text" placeholder="Name" name="name">
                    <input type="email" placeholder="Email" name="email">
                    <input type="password" placeholder="Password" name="password">
                    <input type="text" placeholder="Description" name="description">
                    <label for="image"><span>Choose Profile Image:</span></label>
                    <input type="file" name="image" accept="image/*">
                    <label for="Category"><span>Select Your Category:</span></label>
                    <select id="Category" name="type">
                        <option value="Batsman">Batsman</option>
                        <option value="Bowler">Bowler</option>
                        <option value="Wicket-Keeper">Wicket-Keeper</option>
                        <option value="All- Rounder">All- Rounder</option>
                        <option value="Coach">Coach</option>
                    </select>

                    <button type='submit' name='submit'>Sign Up</button>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $name = mysqli_real_escape_string($con, $_POST['name']);
                    $email = mysqli_real_escape_string($con, $_POST['email']);
                    $password = mysqli_real_escape_string($con, $_POST['password']);
                    $type = mysqli_real_escape_string($con, $_POST['type']);
                    $description = mysqli_real_escape_string($con, $_POST['description']);
                    
                    
                    

                    $query = "INSERT INTO newuser(name,email,password,description,type) values ('$name','$email','$password','$description','$type')";
                    $data = mysqli_query($con, $query);
                    ?>
                    <script type='text/javascript'>
                        alert('Please wait for Admin verification');
                        window.open('http://localhost/BCB2.0/login.php', '_self');
                    </script>
                <?php
                }
                ?>
            </div>
            <div class="form-container sign-in">
                <form method="POST">
                    <h1>Sign In</h1>
                    <div class="social-icons">
                        <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                        <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your email password</span>
                    <input type="email" placeholder="Email" name="email">
                    <input type="password" placeholder="Password" name="password">
                    <a href="#">Forget Your Password?</a>
                    <button class='hidden' name='signin' value='signin'> <h4>Sign In</h4></button>
                    <?php
                        if (isset($_POST['signin'])) {
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            $result1 = mysqli_query($con, "SELECT email, password FROM player WHERE email = '$email' AND password ='$password'");
                            $result2 = mysqli_query($con, "SELECT email, password FROM coach WHERE email = '$email' AND password ='$password'");
                            $result4 = mysqli_query($con, "SELECT email, password FROM admin WHERE email = '$email' AND password ='$password'");
                            $result3 = mysqli_query($con, "SELECT hflag FROM coach WHERE email = '$email' AND password ='$password' AND hflag = 1");
                            if ($result1 && mysqli_num_rows($result1) > 0) {
                                header("Location: player_home.php?email=$email");
                                exit();
                            } elseif ($result2 && mysqli_num_rows($result2) > 0) {
                                if ($result3 && mysqli_num_rows($result3) > 0) {
                                    header("Location: Hcoach_home.php?email=$email");
                                    exit();
                                }
                                else{
                                    header("Location: coach_home.php?email=$email");
                                    exit();
                                }
                            
                            }elseif ($result4 && mysqli_num_rows($result4) > 0){
                                header("Location: admin_home.php?email=$email");
                                exit();
                            }
                             
                            else {
                                echo 'Username or Password is wrong';
                            }
                            
                        }

                        
                    ?>

                </form>
            </div>
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h1>Welcome Back!</h1>
                        <p>Enter your personal details to use all of site features</p>
                        <button class="hidden" id="login"><h4>Sign In</h4></button>
                        <button class="hidden" id="Contact us">Contact us</button>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h1>Hello, Friend!</h1>
                        <p>Register with your personal details to use all of site features</p>
                        <button class="hidden" id="register"><h4>Sign Up</h4></button>
                    </div>
                </div>
            </div>
        </div>

        <script src="login_js.js"></script>
</body>

</html>