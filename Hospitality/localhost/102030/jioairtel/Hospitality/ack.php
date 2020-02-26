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
    <center><h1><b>ONLINE - ACKNOWLEDGEMENT</h1></b></center>
  


  <?php


$phone = $_POST['phone'];
$tid = $_POST['tid'];
$passcode = $_POST['passcode'];

if(validate_pass($passcode)){

    insert($phone,$tid);
}else{
    echo "<br><br><br><h1 style=\"color:red;\"><center>PASSWORD NOT VALID</center></h1>";
}

  function validate_pass($passcode)
  {
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



    
    $stmt = $conn->prepare("SELECT * FROM passcode WHERE passcode=?");
    $stmt->bind_param('s',$passcode);
   
    if(!$stmt->execute()){
        echo "<center style=\"color:red\">Registration UnSuccessfull</center><br/>";
        echo "<center >Error Occourred(Err:4)</center><br/>";
    }
    $result = $stmt->get_result();

    if ($result->num_rows == 1){
        $conn->close();
        return 1;
    }else return 0;

  }


  function insert($phone,$tid)
  {
  $servername = "localhost";
  $username = "priya";
  $password = "Priy@1998";
  $dbname = "techofesdb";


// Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  
  
// Check connection
  if (!$conn) {
      echo "<center style=\"color:red\">Registration Unsuccessful</center><br/>";
      echo "<center> Connection Error Occourred</center>";
      die("");
  }

  //$sql = "INSERT INTO online_reg (phone, name, college_id,college_name,college_place,mail_id,pay_at_hospi_id) VALUES ('".$phone."','".$fname." ".$lname."','".$college_id."','".$college_name."','".$college_city."','".$email."','".$pay_at_hospi."');" ;                                                      
//UPDATE Customers
//SET ContactName = 'Alfred Schmidt', City= 'Frankfurt'
//WHERE CustomerID = 1;
$stmt = $conn->prepare("UPDATE online_reg SET t_id=? WHERE phone=?");

  //$stmt = $conn->prepare("INSERT INTO online_reg (t_id) VALUES (?) WHERE phone=(?)");
  
  $stmt->bind_param("ss",$tid,$phone);
  
  if ($stmt->execute()) {
      echo "<br><br><br><br><br><br><center style=\"color:green;font-size:20px;\">Registration Successfull</center><br/>";
      echo "<h3 style=\"text-align: center;color:black;font-weight:bolder\"></h3></br>
      <center><b style=\"color:black;text-align: center;font-weight:bolder \">";
      echo "<h1 style=\"color:green;\"><b>T-ID                    : T-".$tid."</b></h1><br /><br><br>";
      echo "<a href=\"/Techofes%202020/Hospitality/online.php\" style=\"border-color:blue;border-style:solid;border-width:5px;\">CLICK HERE TO GO BACK!</a>";
     
  } else {
      echo "<center style=\"color:red\">Registration Unsuccessful(Err:2)</center><br/>";
      echo "Error occourred ! Try again later !";
      
  }

  mysqli_close($conn);
  
  }
  
  
?>
</div>


</body>
</html>