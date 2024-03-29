<html>
<meta charset="UTF-8">
<title>Techofes 2020</title>
<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="icon" href="title_logo.png" type="image/x-icon" style="border-radius: 100%;" />
<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<body style="background-color:black;">
    <script src="./js/grid.js "></script>
    <script src="./js/script.js "></script>

<div id="form">
        <div class="container">

            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-md-8 col-md-offset-2">
                <div id="userform">

                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="signup">
                            <p style="text-align: center;font-family: 'Dosis', sans-serif;color: white;font-weight: 900;">
                                <img src="goldenlogo.png" alt="logo" style="width: 200px;height: 100px;" />
                            </p>
                            
<?php
	$fname=strtoupper($_POST["first_name"]);
	$lname=strtoupper($_POST["last_name"]);
 	$email=$_POST["email"];
	$phone=$_POST["phone"];
	$college_id=strtoupper($_POST["c_id"]);
    $college_name=strtoupper($_POST["c_name"]);
    $college_city=strtoupper($_POST["college_city"]);

?>

<br/>
<br/>

<?php
   

   if(!is_null($fname) && !is_null($lname) && !is_null($email) && !is_null($phone) && !is_null($college_city) && !is_null($college_id) && !is_null($college_name) && is_numeric($phone) && strlen($phone)==10 && validate_phone_and_mail($phone,$email))
   {
    insert($phone,$fname,$lname,$college_id,$college_name,$college_city,$email);
   }else{
       if(!is_numeric($phone) || strlen($phone)<10 || strlen($phone)>10 )
       {
        echo "<center style=\"color:red;font-size:20px;font-weight:bolder;\">Registration Unsuccessful</center><br/>";
        echo "<center>Phone number not valid</center><br/>";
        echo "<center>Enter <b style=\"color:'green'\">10 Digit</b> Phone number without country code(+91) and Try again.</center>";
       }else if(validate_phone_and_mail($phone,$email) == 0) {
        echo "<center style=\"color:red;font-size:20px;font-weight:bolder;\">Registration Unsuccessful</center><br/>";
        echo "<center>Email or Phone already exists </center>";
       }else if(is_null($fname) || is_null($lname) || is_null($email) || is_null($phone) || is_null($college_city) || is_null($college_id) || is_null($college_name))
       {
        echo "<center style=\"color:red;font-size:20px;font-weight:bolder;\">Registration Unsuccessful</center><br/>";
        echo "<center>Empty input detected.Fill all the details in registration page.</center>";
       }

        
   }

    function insert($phone,$fname,$lname,$college_id,$college_name,$college_city,$email)
    {
    $servername = "localhost";
    $username = "priya";
    $password = "Priy@1998";
    $dbname = "techofesdb";
    $rand_no = rand(10,100);
    $pay_at_hospi = substr($phone, 4,9 ).$rand_no;


// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    
    
// Check connection
    if (!$conn) {
        echo "<center style=\"color:red\">Registration Unsuccessful</center><br/>";
        echo "<center> Connection Error Occourred</center>";
        die("");
    }

    //$sql = "INSERT INTO online_reg (phone, name, college_id,college_name,college_place,mail_id,pay_at_hospi_id) VALUES ('".$phone."','".$fname." ".$lname."','".$college_id."','".$college_name."','".$college_city."','".$email."','".$pay_at_hospi."');" ;                                                      


    $stmt = $conn->prepare("INSERT INTO online_reg (phone, name, college_id,college_name,college_place,mail_id,pay_at_hospi_id) VALUES (?, ?, ?,?,?,?,?)");
    $fname=strtoupper($_POST["first_name"]);
	$lname=strtoupper($_POST["last_name"]);
 	$email=$_POST["email"];
	$phone=$_POST["phone"];
	$college_id=strtoupper($_POST["c_id"]);
    $college_name=strtoupper($_POST["c_name"]);
    $college_city=strtoupper($_POST["college_city"]);

    $bind_str = 'sssssss';
    $name = $fname." ".$lname;
    $stmt->bind_param($bind_str,$phone,$name,$college_id,$college_name,$college_city,$email,$pay_at_hospi);
    
    if ($stmt->execute()) {
        echo "<center style=\"color:green;font-size:20px;\">Registration Successfull</center><br/>";
        echo "<h3 style=\"text-align: center;color:white;font-weight:bolder\">TAKE A SCREENSHOT</h3></br>
        <center><b style=\"color:white;text-align: center; \">";
        echo "Name                    :".$fname." ".$lname."<br />";
        echo "Phone                   :".$phone."<br />";
        echo "E-Mail ID               :".$email."<br />";
        echo "College Roll no   :".$college_id."<br />";
        echo "College name            :".$college_name."<br />";
        echo "College city            :".$college_city."<br /><br/>";
        echo "</b></center>";
        echo ("<center><b style=\"font-weight:700;color:white;font-size:20px;color:green\">PAY_AT_HOSPI_ID :".$pay_at_hospi."</b><center><br/><br/>");
        echo ("<h4>Note : </h4>
        <ol>
          <li>Show the PAY_AT_HOSPI ID in the Hospitality desk and pay the entry fee during techofes.</li>
          <li>After paying entry fees at hospitality desk,Unique T-ID is given</li>
          <li>Using T-ID you can attend the respective events</li>
        </ol>");
    } else {
        echo "<center style=\"color:red\">Registration Unsuccessful(Err:2)</center><br/>";
        echo "Error occourred ! Try again later !";
        
    }

    mysqli_close($conn);
    
    }

    function validate_phone_and_mail($temp_phone, $temp_mail){
        $servername = "localhost";
        $username = "priya";
        $password = "Priy@1998";
        $dbname = "techofesdb";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error)
        {
        echo "<center style=\"color:red\">Registration Unsuccessful</center><br/>";
        echo "<center> Connection Error Occourred</center>";
        die("");
        //die("DB Connection failed: " . $conn->connect_error);
        }



        
        $stmt = $conn->prepare("SELECT * FROM online_reg WHERE phone=? or mail_id=?");
        $stmt->bind_param('ss',$phone,$email);
       
 	    $email=$_POST["email"];
	    $phone=$_POST["phone"];
	
        if(!$stmt->execute()){
            echo "<center style=\"color:red\">Registration UnSuccessfull</center><br/>";
            echo "<center >Error Occourred(Err:4)</center><br/>";
        }
        $result = $stmt->get_result();

        if ($result->num_rows == 0){
            $conn->close();
            return 1;
        }else return 0;

    }
?>

                            <div class="mrgn-30-top">
                                <button class="btn btn-larger btn-red btn-block" style="color: yellow;border-color: yellow;font-weight: bolder;" onclick="window.location.href='../index.html'" /> GO BACK
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