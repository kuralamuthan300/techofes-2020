<html>
<meta charset="UTF-8">
<title>Get details</title>
<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="icon" href="title_logo.png" type="image/x-icon" style="border-radius: 100%;" />
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
                            
<?php
	$phone=$_POST["phone"];
?>

<br/>
<br/>

<?php
   
   validate_phone_and_mail($phone);
   
    function validate_phone_and_mail($temp_phone){
        $servername = "localhost";
        $username = "priya";
        $password = "Priy@1998";
        $dbname = "techofesdb";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error)
        {
        echo "<center style=\"color:red\">Fetch Unuccessfull</center><br/>";
        echo "<center> DB error</center>";
        die("DB Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM online_reg where phone='".$temp_phone."';";
        $result = $conn->query($sql);
        if ($result->num_rows == 0){
            echo "<center style=\"color:red\">Phone number not found !</center><br/>";
            $conn->close();
        }else{
            while($row = $result->fetch_assoc()) {
                echo "<center style=\"color:green;font-size:20px;\">DATA RETRIEVED SUCCESSFULLY</center><br/>";
        echo "<h3 style=\"text-align: center;color:white;font-weight:bolder\">TAKE A SCREENSHOT</h3></br>
        <center><b style=\"color:white;text-align: center; \">";
        echo "Name                    : ".$row["name"]."<br />";
        echo "Phone                   : ".$row["phone"]."<br />";
        echo "E-Mail ID               : ".$row["mail_id"]."<br />";
        echo "College Roll no         : ".$row["college_id"]."<br />";
        echo "College name            : ".$row["college_name"]."<br />";
        echo "College city            : ".$row["college_place"]."<br />";
        if($row["t_id"] == null)
        {
        echo "T-ID             : Not generated<br /><br />";
        }else
        {
        echo "T-ID             :".$row["t_id"]."<br /><br />";
        }
        
        echo "</b></center>";
        echo ("<center><b style=\"font-weight:700;color:white;font-size:20px;color:green\">PAY_AT_HOSPI_ID :".$row["pay_at_hospi_id"]."</b><center><br/><br/>");
        echo ("<h4>Note : </h4>
        <ol>
          <li>Show the PAY_AT_HOSPI ID in the Hospitality desk and pay the entry fee during techofes.</li>
          <li>After paying entry fees at hospitality desk,Unique T-ID is given.</li>
          <li>Using T-ID you can attend the respective events.</li>
          <li>If you already paid ,T-ID will appear here.</li>
        </ol>");

            }
        }

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