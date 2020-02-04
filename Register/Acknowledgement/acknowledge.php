<html>
<meta charset="UTF-8">
<title>Acknowledge</title>
<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="icon" href="./title_logo.png" type="image/x-icon" style="border-radius: 100%;" />
<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<body style="background-color:black;">

<div id="form">
        <div class="container">

            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-md-8 col-md-offset-2">
                <div id="userform">

                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="signup">
                            <p style="text-align: center;font-family: 'Dosis', sans-serif;color: white;font-weight: 900;">
                                <img src="goldenlogo.png" alt="logo" style="width: 200px;height: 100px;" />
                            </p>
<br/>
<br/>

<?php
   

   if(strlen($phone)>=10 && validate_phone_and_mail($phone,$email))
   {
    insert($phone,$fname,$lname,$college_id,$college_name,$college_city,$email);
   }else{
       if(strlen($phone)<10)
       {
           echo "<center>Phone number not valid</center>";
       }else echo "<center>Email or Phone already exists </center>";
        
   }

    function insert($phone,$fname,$lname,$college_id,$college_name,$college_city,$email)
    {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "techofesdb";
    $rand_no = rand(10,100);
    $pay_at_hospi = substr($phone, 4,9 ).$rand_no;


// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
    if (!$conn) {
        die("DB Connection failed: ");
    }

    $sql = "INSERT INTO online_reg (phone, name, college_id,college_name,college_place,mail_id,pay_at_hospi_id) VALUES ('".$phone."','".$fname." ".$lname."','".$college_id."','".$college_name."','".$college_city."','".$email."','".$pay_at_hospi."');" ;                                                      

    if (mysqli_query($conn, $sql)) {
        echo "<center>Registration Successfull</center><br/>";
        echo ("<center><b style=\"font-weight:900;color:white;font-size:30px;color:green\">PAY AT HOSPI ID :".$pay_at_hospi."</b><center>");
    } else {
        echo "Error occoured ! Try again later !";
    }

    mysqli_close($conn);
    
    }

    function validate_phone_and_mail($temp_phone, $temp_mail){
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "techofesdb";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error)
        {
        die("DB Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM online_reg where phone='".$temp_phone."' or mail_id='".$temp_mail."';";
        $result = $conn->query($sql);
        if ($result->num_rows == 0){
            $conn->close();
            return 1;
        }else return 0;

    }
?>

                            <div class="mrgn-30-top">
                                <button class="btn btn-larger btn-red btn-block" style="color: yellow;border-color: yellow;font-weight: bolder;" onclick="window.location.href='../index.html'" /> GO TO HOME
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>
</html>