
<!DOCTYPE html>
<html>
<title>LDAP Demo Website</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/latin.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<style>

table, th, td {
    border: 1px solid black;
}

section:after {
    content: "";
    display: table;
    clear: both;
}

article{
    padding: 20px;
    float: left;
}
nav {
    float: left;
    width: 30%;
    height: 400px; /* only for demonstration, should be removed */
    background: #ccc;
    padding: 20px;
}

header {
    background-color: #666;
    padding: 30px;
    text-align: center;
    font-size: 35px;
    color: white;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #17a2b8;
}

</style>
<ul>
  <li><a href="admin_home.php">Home</a></li>
  <li><a href="edit.php">Edit</a></li>
  <li style="float:right"><a class="active" href="login.html">Logout</a></li>
</ul>
<!-- Header -->
<div class="w3-opacity">
<div class="w3-clear"></div>
<header class="w3-center w3-margin-bottom">

<?php
    //$ldap_dn = "cn=".$_POST['username'].",ou=groups,ou=users,dc=maxcrc,dc=com";

    session_start(); 
    if (isset( $_POST['username']) &&  $_POST['password']){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
    }
    // echo $_SESSION['username'];

    if (!empty($_SESSION['username'])) {
        # code...
        include 'config/ldap.php';
        $ldap_dn = "cn=".$_SESSION['username'].",ou=users,dc=maxcrc,dc=com";
        $ldap_password = $_SESSION['password'];
        $ldap = new Ldap();
        $conn = $ldap->getConnection();

        if(@ldap_bind($conn,$ldap_dn,$ldap_password)){

            //$filter = "(ou=users)";
            // $filter = "(&(objectclass=users)(objectcategory=person)(memberof=CN=users,dc=maxcrc,dc=com))";
            $filter = "cn=".$_SESSION['username'];
            $result = ldap_search($conn, "dc=maxcrc,dc=com", $filter) or die("failed");
            $entries = ldap_get_entries($conn, $result);
            echo "<h1><b>REPORTING</b></h1>";
            echo "<form action='grafana_login.php' method='post' accept-charset='UTF-8' >";
            echo "<p class='w3-padding-16'><button class='w3-button w3-black' type='submit'>Grafana Live Reporting</button></p>";
            


            // print "<pre>";
            // print_r($entries);
            // print "</pre>";
        }
        else{
            echo "failed";
        }
    }
    

    else{
        echo "<h1 style='color:red' ><b>ACCESS DENIED</b></h1>";
        echo "<p style='font-size:20px'>400</p>";
        echo "<form action='register.html' method='post' accept-charset='UTF-8' >";
        echo "<p class='w3-padding-16'><button class='w3-button w3-black' type='submit'>Create Account</button></p>";
    }
?>





       
  </form> 
</header>
</div>
<div class="container">
    <div class="row">
      <div class="col">
      
<!--section-->
        
        <?php 
            if (isset($entries)){
                //echo "<nav>";
                //echo "<div class='w3-medium w3-margin-bottom'>";
                echo "<div class='card' style='width:400px'>";
                if (!empty($entries[0]['jpegphoto'][0])) {
                    # code...
                    //echo "<div class='container'>";
                    
                    echo "<img class='card-img-top' src='data:image/jpeg;base64,".base64_encode($entries[0]['jpegphoto'][0])."' style='width:100%'/>";
                    
                }
                echo "<div class='card-body'>";
                echo "<h4 class='card-title'>".$entries[0]['cn']['0']."</h4>";
                //echo "<p><strong> Name: </strong>".  ."</p>" ;
                echo "<p class='card-text' ><strong> Role: </strong>".  $entries[0]['ou']['0']."</p>" ;
                echo "<p class='card-text' ><strong> Phone: </strong>". $entries[0]['telephonenumber']['0']."</p>";
                echo "<p class='card-text' ><strong> Email: </strong>". $entries[0]['mail']['0']."</p>";
                echo "</div>"; 
                
                
                echo "</div>"; 
                echo "</div>";    
                echo "<div class='col-sm-7'>"; 
                echo "<div class='card bg-light'>";
                echo "<div class='card-body text-center'>";
                if(!empty($entries[0]['displayname']['0']))
                { 
                    echo " <h1>".$entries[0]['displayname']['0']."</h1>";
                }
                if (!empty($entries[0]['description']['0'])) {
                    # code...
                    echo "<p>".$entries[0]['description']['0']."</p>";
                }
                if (!empty($entries[0]['homepostaladdress']['0'])) {
                    # code...
                    echo "<p>".$entries[0]['homepostaladdress']['0']."</p>";
                }
            }

            
            ?>
        <!--p> Address: <?php echo $entries[0]['homepostaladdress']['0']; ?></p-->
  
      



    <!--?php echo "<p>".$entries[0]['homepostaladdress']['0']."</p>"; ?-->
      </div>
  </div> 

    </div>
</div>
<!--/section-->
</div>

</html>
