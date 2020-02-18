<html>
<meta charset="UTF-8">
<title>Techofes 2020</title>
<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="icon" href="../../../title_logo.png" type="image/x-icon" style="border-radius: 100%;" />
<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<style>

.submit-red {
    border-radius: 10px;
    border-color: #FBD62A;
    border: none;
    border-width: 2px;
    border-style: solid;
    background-color: black;
    color: #FBD62A;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
    font-weight: 900;
    font-size: larger;
}
</style>
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
                                <img src="../../../Nav_bar_T_logo.jpg" alt="logo" style="width: 150px;height: 120px;" />
                            </p>
                            
<?php
	$mail=$_POST["mail"];
?>

<br/>
<br/>

<?php
    
    validate_phone_and_mail(trim($mail));
   
   
   
    function validate_phone_and_mail($mail){
        $servername = "localhost";
        $username = "priya";
        $password = "Priy@1998";
        $dbname = "techofesdb";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error)
        {
        echo "<center style=\"color:red\">Voting UnSuccessful</center><br/>";
        echo "<center> Connection error !</center>";
        die("");
        }

        
        
        $stmt = $conn->prepare("SELECT * FROM online_reg WHERE mail_id=?");
        $stmt->bind_param("s",$mail);
    
        if( !$stmt->execute()){
            echo "<center style=\"color:red\">Voting UnSuccessful</center><br/>";
            echo "<center> Error Occurred !(Err:3)</center>";
        }
        $result = $stmt->get_result();

        $reg_rec = $result->num_rows;


        $stmt = $conn->prepare("SELECT * FROM voting WHERE mail=?");
        $stmt->bind_param("s",$mail);
    
        if( !$stmt->execute()){
            echo "<center style=\"color:red\">Voting UnSuccessful</center><br/>";
            echo "<center> Error Occurred !(Err:3)</center>";
        }
        $result = $stmt->get_result();

        $vote_rec = $result->num_rows;



        if ($reg_rec == 0){
            echo "<center style=\"color:red\"><b>E-Mail ID not found !<br/>Register and try again !</b></center><br/>";
            $conn->close();
            return;
        }
        if($vote_rec >0){
            echo "<center style=\"color:red\">Dont try to vote again !</center><br/>";
            $conn->close();
            return;
        }else{
            
            $stmt1 = $conn->prepare("INSERT INTO voting (mail,actor,actress,music_director,film,director) VALUES (?,?,?,?,?,?)");
            $bind_str = 'ssssss';
            $stmt1->bind_param($bind_str,$mail,$actor,$actress,$music,$movie,$dir);
            $movie = $_POST['movie'];
            $actor = $_POST['actor'];
            $actress = $_POST['actress'];
            $dir = $_POST['dir'];
            $music = $_POST['music'];


            if ($stmt1->execute()) {

                echo "<center style=\"color:green;font-size:20px;\">Voted successfully</center><br/>";
                
            }
            $conn->close();
            return;


        }

    }
?>
<br/>
<center>
<button class="submit" onclick="window.location.href='../../../Proshows/index.html'">BOOK TICKETS FOR PROSHOWS</button>
</center>

<center>
<button class="submit-red" onclick="window.location.href='../../../index.html'">        GO TO HOME       </button>
</center>
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