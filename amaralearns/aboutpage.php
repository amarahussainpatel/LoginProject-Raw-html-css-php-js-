<?php
session_start();
$db = mysqli_connect("localhost","root","root","test") or die("couldnot connect");

    $rowww=0;
    $flag=false;
    $myquery=mysqli_query($db,"SELECT  About from description");
    $rowww=mysqli_num_rows($myquery);
    while($res=mysqli_fetch_assoc($myquery)){
        if($rowww%2==0){
        ?>
        <html>
            <div class="to">
            <br> 
            <ul>
            <li> <p> <?php echo $res['About']; ?> </p> </li>
            </ul>
            <br> <br>
            </div>
        </html>
        <?php   
        } 
            if($rowww%2!=0){  ?>
            <html>
                <div class="go"> 
                <br>
                <ul>
                <li> <p> <?php echo $res['About']; ?> </p> </li>
                </ul> 
                <br> <br> </html>
                <?php if(strlen($res['About'])>=300){
                    ?> <html> <br> <br> <br> </html>
             <?php   } 
              }  ?>
            <html>
                <style> 
                    .go li{
                        list-style-type: none;
                        position: absolute; 
                         /* display: block;   */
                        /* margin-bottom: 60px; */
                        line-height: 25px;
                        text-align: left;
                        left: 30px;
                        right: 56%;
                        margin-top: 20px; 
                        padding: 40px 40px;
                        border: 1px solid rgb(43, 104, 133);
                        background-color: rgb(102, 127, 135,0.830); 
                    } 
                    .to li{
                        list-style-type: none; 
                         position: absolute;  
                         /* display: block; */
                        /* margin-bottom: 60px;  */ 
                        line-height: 25px;
                        text-align: left;
                        left: 49%;
                        right: 5%;
                        padding: 40px 40px;
                        border: 1px solid rgb(43, 104, 133);
                        background-color: rgb(102, 127, 135,0.830);  
                        /* margin-top: 30px; */
                    }
                    .go{  
                        color: rgb(208, 207, 194); 
                    }  
                    .to{  
                        color: rgb(208, 207, 194);
                    } 
                    .go ul{
                        /* position: absolute; */
                        display: block;
                        margin-top: 4%;
                        /* margin: 7%; */
                    }
                    .to ul{
                        /* position: absolute; */
                        display: block;
                        margin-top: 4%;
                        /* margin: 5%; */
                    }
                      
                </style> 
                </div>
            </html>
    <?php
        $rowww=$rowww-1;
        }

        if(isset($_POST['description-submit'])) {
            $name = mysqli_real_escape_string($db,$_POST['uname']);
            $desc = mysqli_real_escape_string($db,$_POST['about']);

            $sql=mysqli_query($db,"SELECT UserID from users where Username like '$name'");
            $result=mysqli_fetch_assoc($sql); //store the data fetched from database in result variable 
            $rows=mysqli_num_rows($sql);
            if($rows==1){
                $userid=$result['UserID'];
                $try=mysqli_query($db,"SELECT UserID from description where UserID='$userid'");
                $resultt=mysqli_fetch_assoc($try); //store the data fetched from database in result variable 
                $tryrow=mysqli_num_rows($try);
                if($tryrow==0){
                    $query="INSERT INTO description(UserID,About) VALUES ('$userid','$desc')";
                    mysqli_query($db,$query);
                    $message = "Done.";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    $rows=0;
                }
            }
        else{
            $message = "Username incorrect.\\nTry again.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        }

        if(isset($_POST['searchuser'])){
            $user=mysqli_real_escape_string($db,$_POST['suser']);
            $sql=mysqli_query($db,"SELECT UserID from users where Username like '%$user%'"); //store the data fetched from database in result variable 
            $rowforsql=mysqli_num_rows($sql);
            if($rowforsql>0){
                $flag=true;
                while($results=mysqli_fetch_assoc($sql)){
                $usid=$results['UserID'];
                $mql=mysqli_query($db,"SELECT About from description where UserID='$usid'");
                $res=mysqli_fetch_assoc($mql);
                $resrow=mysqli_num_rows($mql);
                if($resrow>0){
                ?> <html> 
                    <div class="searchedf" id="searchedf">
                        <form method="POST" class="sea">
                            <input type="submit" value="BACK" class="gotoab" onclick="goToAboutForm()">
                            <ul>
                            <li> <?php echo $res['About']; ?> </li>
                            </ul>
                        </form>
                    </div>
                    <style>
                    .gotoab{
                        margin-top: 20px; 
                        width: 70px;
                        height: 20px;
                        margin-left: 28%;
                        color: rgb(246, 247, 246);
                        background-color: rgb(226, 185, 185);
                    } 
                        .searchedf ul li{
                            list-style-type: none;
                            position: absolute; 
                             display: block;  
                        /* margin-bottom: 60px; */
                            line-height: 25px;
                            text-align: left;
                            left: 30px;
                            right: 56%;
                        /* margin-top: 30px; */
                            padding: 40px 40px;
                            border: 1px solid rgb(43, 104, 133);
                            background-color: rgb(102, 127, 135,0.830); 
                        }
                        .searchedf ul{
                            display: block;
                            margin-top: 5%;
                            margin: 7%; 
                        }
                    </style>
                    </html>
                <?php
                $resrow=$resrow-1;
                }    
            }
        }
        if($flag==false){
            $message = "No such user";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>THE CURVED HEART</title>
        <link rel="stylesheet" type="text/css" href="amarahtmlcss.css">
    </head>
        
    <body>
        <div id="about" class="about">
            <div class="main">
                <ul>
                    <li><a href="homepage.php">Home</a></li>
                    <li class="active"><a href="#">About</a></li>
                    <li><a href="googleblog.php">GoogleBlog</a></li>
                    <li><a href="Gallery.php">Gallery</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="../index.php">Logout</a></li>
                </ul>
            </div>

            <div class="new">
            <button class="addnew" onclick="goToAddYourselfForm()"> Add Yourself </button> 
            </div>

             <div class="search">
                 <form class"searchform" method="POST">
                    <p class="et">Enter Username</p>
                    <input type="text" name="suser" class="suser">
                    <input type="submit" value="Search" class="s1" name="searchuser" onclick="gotosearchedform()">
                 </form>
             </div>


            <div class="wrap">
                <a href="https://www.instagram.com/thecurvedheart/?hl=en" target="_blank"> <img class="links1" src="instagram.png" height="15" width="40"> </a> 
                <a href="https://thecurvedheart.blogspot.com/" target="_blank"> <img class="links1"src="blogspot.png" height="15" width="40"> </a>
            </div>
            </div>

            <!-- <div class="abio">
                    <li>Hi! I am a learner.</li>
                    <li>    Amara Hussain Patel. </li>
                    <li>I started blogging back in 2018. </li>
                    <li>I never thought of writing till I discovered that I am not a good speaker. </li>
                    <li>I am also a CS Student.</li>
                    <li>I have keen interest in programming and web desgining.</li>
                    <li>I like writng and always want to be a good writer.</li> 
                    <li>I was a debator in my school but ended up leaving both.</li>
                    <li>I have many weaknesses.</li>
                    <li>I find it difficult to differentiate between fantasy and reality.</li>
                    <br>
                    <li> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  I am a mediocre!  </li>
            </div>

            <div class="sbio">
                <li>Hi! I am a learner.</li>
                <li>    Sarah Hussain Patel. </li>
                <li>I started blogging back in 2018. </li>
                <li>I never thought of writing till I discovered that I am not a good speaker. </li>
                <li>I am also a CS Student.</li>
                <li>I have keen interest in programming and web desgining.</li>
                <li>I like writng and always want to be a good writer.</li> 
                <li>I was a debator in my school but ended up leaving both.</li>
                <li>I have many weaknesses.</li>
                <li>I find it difficult to differentiate between fantasy and reality.</li>
                <br>
                <li> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  I am a mediocre!  </li>
        </div> -->
   

        <div id="my" class="my">
            <form method="POST" class="aboutform">
                Enter your Username(must be correct):    &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="text" name="uname" class="usert" required><br> 
                <br>  
                About yourself:  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="text" name="about" class="aboutyou" required value="Hi! My name is "><br> 
                <br>
                <!--  echo isset($_POST['about']) ? $_POST['about']: '' ?> -->
                <input type="submit" value="SUBMIT" class="donet" name="description-submit" onclick="goToAboutForm()">
                <input type="submit" value="BACK" class="goback" onclick="goToAboutForm()" onclick="reloadalert()">
                <br> 
                <br> 
                 <p> "If your description already exists, it will be updated if you type again."</p>
            </form>
        </div>
    </body>
    </html>

        <script>
            function goToAboutForm(){
                document.getElementById('about').style.display='block';
                document.getElementById('my').style.display='none';
            }

            function goToAddYourselfForm(){
                document.getElementById('about').style.display='none';
                document.getElementById('my').style.display='block';
            }

            function gotosearchedform(){
                 document.getElementById('searchedf').style.display='block';
                 document.getElementById('about').style.display='none';
                 document.getElementById('my').style.display='none';
                    }

            function reloadalert(){
                alert("Kindly reload");
            }
        </script>