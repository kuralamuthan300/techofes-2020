<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="../title_logo.png" type="image/x-icon" style="border-radius: 100%;" />
    <title>ONLINE</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <center><h1><b>ONLINE</h1></b></center>
    
<div class="container">
  <form action="/Hospitality/online.php">
    <div class="form-group">
        <br>
        <br>
      <h3><b><center> PAY_AT_HOSPI ID :</center></b></h3>
      <input type="text" autocomplete="off" class="form-control" id="pay_hospi_id" placeholder="PAY_AT_HOSPI_ID" name="pay_hospi_id">
    </div>
    <center><button type="submit" class="btn btn-default"><b> GET DETAILS</b></button><center>
  </form>


  <?php
  if($_GET['pay_hospi_id'] != null){
      $filename = $_GET['pay_hospi_id'];
      runMyFunction($filename);
   }


  function runMyFunction($temp_phone) {
        $servername = "localhost";
        $username = "priya";
        $password = "Priy@1998";
        $dbname = "techofesdb";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error)
        {
        echo "<center style=\"color:red\">Fetch UnSuccessful</center><br/>";
        echo "<center> Connection error !</center>";
        die("");
        }

        
        $stmt = $conn->prepare("SELECT * FROM online_reg WHERE pay_at_hospi_id=?");
        $stmt->bind_param("s",$temp_phone);
    
        if( !$stmt->execute()){
            echo "<center style=\"color:red\">Fetch UnSuccessful</center><br/>";
            echo "<center> Error Occurred !(Err:3)</center>";
        }
        $result = $stmt->get_result();




        if ($result->num_rows == 0){
            echo "<br><br><center style=\"color:red\">Pay_at_Hospi_ID not found !</center><br/>";
            $conn->close();
        }else{
        while($row = $result->fetch_assoc()) {
            
        echo "<br><br><center style=\"color:green;font-size:20px;\">DATA RETRIEVED SUCCESSFULLY</center>";
        echo "<center><b style=\"color:white;text-align: center;color:black; \">";
        echo "Name                    : ".$row["name"]."<br />";
        echo "Phone                   : ".$row["phone"]."<br />";
        echo "E-Mail ID               : ".$row["mail_id"]."<br />";
        echo "College Roll no         : ".$row["college_id"]."<br />";
        echo "College name            : ".$row["college_name"]."<br />";
        echo "College city            : ".$row["college_place"]."<br />";
        echo "Pay_at_hospi_id         : ".$row["pay_at_hospi_id"]."<br>";
        if($row["t_id"] == null)
        {
            $tid = rand(10000,90000);
        echo("<form method=\"post\" class=\"form-group\" action=\"ack.php\">
        <input type=\"hidden\" name=\"phone\" value=".$row["phone"].">
          <input type=\"hidden\" name=\"tid\" value=".$tid.">
        <br><br>
        <h3><b><center>PASSCODE : </center></b></h3>
        <input style=\"display:none\">

        <input type=\"password\" autocomplete=\"off\" class=\"form-control\" id=\"passcode\" placeholder=\"PAYMENT PASSCODE\" name=\"passcode\">
        <br>
        <input type=\"submit\" class=\"btn btn-default\">
    </form>");
        }else
        {
        echo "<h2><div style=\"color:#FBD62A;font-weight: 900;\">Already paid !<br>T-ID             :".$row["t_id"]."</div></h2><br /><br />";
        }
        

            }
        }

    }

  
?>
</div>


</body>
</html>
