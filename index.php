<script>
       function goToRegisterForm(){
           document.getElementById('registerform').style.display = 'block';
           document.getElementById('loginform').style.display = 'none';
       }
       function goToLogin(){
           document.getElementById('registerform').style.display = 'none';
           document.getElementById('loginform').style.display = 'block';
       }
       function showRegAlert(){
           alert("Registered Successfully!");
       }
       function showLogAlert(){
           alert("Login Successfully!");
       }

       function displayt1(){
           document.getElementById('t1').style.display='block';
           document.getElementById('t2').style.display='none';
       }

       function displayt2(){
           document.getElementById('t1').style.display='none';
           document.getElementById('t2').style.display='block';
       }
    </script>
   
    <?php
    session_start();
    $row=0;
    $flag=true;

    $db = mysqli_connect("localhost","root","root","test") or die("couldnot connect");
    if(isset($_POST['sign-submit'])) {
        $name = mysqli_real_escape_string($db,$_POST['uname']);
        $age = mysqli_real_escape_string($db,$_POST['age']);
        $gender = mysqli_real_escape_string($db,$_POST['gender']);
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $password1 = mysqli_real_escape_string($db,$_POST['psw']);

        $password=md5($password1);
        $try=mysqli_query($db,"SELECT username FROM users where Username='$username'");
        $row=mysqli_num_rows($try);

        if($row==0){
            $sql = "INSERT INTO users(Uname , Age, Gender, Username, Userpassword) VALUES ('$name','$age','$gender','$username','$password')";
            mysqli_query($db,$sql);
            $_SESSION['username']=$username;
            $messs = "Registered Succesfully.";
            echo "<script type='text/javascript'>alert('$messs');</script>";
            header("Location: index.php");
            $flag=false;
        }
        else{
                $msg="USERNAME ALREADY EXISTS";
                echo "<span style='color: red; font-size=80px;' > Username already exsits. </span> <script type='text/javascript'> gotoRegisterForm(); </script> ";
        }
    }

    if(isset($_POST['login-submit'])) {
     $logusername = mysqli_real_escape_string($db,$_POST['username']);
     $logpassword = mysqli_real_escape_string($db,$_POST['psw']);
     $logpassword=md5($logpassword);

       $query=mysqli_query($db,"SELECT UserID FROM users WHERE Username='$logusername' AND Userpassword='$logpassword' ");
       $rows=mysqli_num_rows($query); //mysqli_num_rows counts the number of rows in the typed query
       if($rows==1){
        //    S_SESSION['userid']=
           header("Location: amaralearns\homepage.php");
       }
       else{
        $message = "Username and/or Password incorrect.\\nTry again.";
        echo "<script type='text/javascript'>alert('$message');</script>";
       }
    }

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title> ADD YOURSELF </title>
        <link rel= "stylesheet" type="text/css" href="registerlogin.css">
    </head>
    <body>

        <div class="titlegal">
            <h1> THE CURVED HEARTღ </h1>
        </div>

        <div class="title2gal">
            <h2> By Samara</h2>
        </div>

        <div class= "loginform" id = "loginform" >
        <form method="POST" >
            USERNAME: &nbsp;    
            <input type="text" name="username" id="username" class="usert" required>
               <!--      echo isset($_POST['uname']) ? $_POST['uname']:  -->
             <br>
            <br>
            <br>
            PASSWORD: &nbsp;    
            <input type="password" name="psw" id="psw" class="usert" required> <br>
            <br>
            <br>
            <br>
            <input type="submit" value="LOGIN" class="logt" name="login-submit" >  
            <span> <?php $error; ?> </span>
        </form>
        <div class="register">
            <button class="regbut" onclick="goToRegisterForm()"> Not a user? Register </button> 
        </div>
    </div>

    <div id= "registerform" class="registerform">
            <form  method="POST">
                NAME: &nbsp; &nbsp;   &nbsp; &nbsp; &nbsp; 
                <input type="text" name="uname" class="usert" required value="<?php if($row>0){ echo $_POST["uname"]; } ?>" > <br>
                <br>
                <br>
                AGE: &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; 
                <input type="number" name="age" class="usert" required value="<?php if($row>0){ echo $_POST["age"]; } ?>"> <br>
                <br>
                <br>
                GENDER: &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="radio" name="gender" value="male" required value="<?php if($row>0){ echo $_POST["gender"]; } ?>" >Male &nbsp; &nbsp;
                <input type="radio" name="gender" value="female" required value="<?php if($row>0){ echo $_POST["gender"]; } ?>" >Female &nbsp;
                <br>
                <br>
                <br>
                USERNAME: &nbsp;    
                <input type="text" name="username" class="usert" required ><br>
                <br>
                <br>
                PASSWORD: &nbsp;    
                <input type="password" name="psw" class="usert" required> <br>
                <br>
                <br>
                <input type="submit" value="REGISTER" class="logt" name="sign-submit" >
            </form>
            <div class="register">
                <button class="regbut" onclick="goToLogin()">Already a user? Login</button> 
            </div>
        </div>
    </body>

    <script>
       function goToRegisterForm(){
           document.getElementById('registerform').style.display = 'block';
           document.getElementById('loginform').style.display = 'none';
       }
       function goToLogin(){
           document.getElementById('registerform').style.display = 'none';
           document.getElementById('loginform').style.display = 'block';
       }
       function showRegAlert(){
           alert("Registered Successfully!");
       }
       function showLogAlert(){
           alert("Login Successfully!");
       }

       function displayt1(){
           document.getElementById('t1').style.display='block';
           document.getElementById('t2').style.display='none';
       }

       function displayt2(){
           document.getElementById('t1').style.display='none';
           document.getElementById('t2').style.display='block';
       }

       
    </script>
</html>
