<?php

  session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
      //something was posted
      $user_name = $_POST['user_name'];
      $password = $_POST['password'];

      if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
      {
          //read from database
        $query = "select * from users where user_name = '$user_name' limit 1";
        
        $result = mysqli_query($con, $query);
        
        if($result)
        {
          if($result && mysqli_num_rows($result) > 0)
          {
      
            $user_data = mysqli_fetch_assoc($result);

            if($user_data['password'] === $password)
            {

              $_SESSION['user_id'] = $user_data['user_id'];
              header("Location: index.php");
              die;
            }
          }
        }
        
          echo '<script>alert("Wrong Username or Password")</script>';
      }else
      {
        
        echo '<script>alert("Please enter some valid information!")</script>';
      }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="logins.css">                
    <title>Log in</title>
</head>
<body>

    <div class="box">
        <form method="post">
            <img class="login-logo" src="https://www.logolynx.com/images/logolynx/5c/5c5fbe66daa900ad13c9a0046596c465.png"/>
        <br><br><br>
        <input type="email" id="user_name" name="user_name" placeholder="Email ID"></input>
        <input class="design-password" type="password" id="password" name="password" placeholder="Password"></input>
        <br><br>
        <a href="signup.php">Signup</a> <button type="submit" id="submit" name="submit" value="Login">LOGIN</button>
        
      </form>
               
        
    </div>
</body>
</html>