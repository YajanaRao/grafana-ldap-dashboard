<!DOCTYPE html>
<html>
<head>
    <title>Home | Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style>
    

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

    button {
        margin-bottom: 5px;
    }
    </style>
</head>
<body>

<ul>
  <li><a href="admin_home.php">Home</a></li>
  <li><a href="user_home.php">Profile</a></li>
  <li style="float:right"><a class="active" href="login.html">Login</a></li>
</ul>
<br>
<div class="container">
<div class="card">
<?php
include_once 'config/ldap.php';
    //$ldap_dn = "cn=".$_POST['username'].",ou=groups,ou=users,dc=maxcrc,dc=com";

    $ldap_dn = "cn=deepak naik,ou=users,dc=maxcrc,dc=com";
    //$ldap_password = $_POST['password'];
    $ldap_password = "deepak";
    $ldap = new Ldap();
    $conn =  $ldap->getConnection();
    //echo $conn;
    if(@ldap_bind($conn,$ldap_dn,$ldap_password)){
        //echo "authenticated";
        //$filter = "(ou=users)";
        // $filter = "(&(objectclass=users)(objectcategory=person)(memberof=CN=users,dc=maxcrc,dc=com))";
        $filter = "cn=*";
        $result = ldap_search($conn, "dc=maxcrc,dc=com", $filter) or die("failed");
        $entries = ldap_get_entries($conn, $result);

        // $data = array();

        // for ($i=1; $i < $entries['count']; $i++) { 
        //     # code...
        //     $array = array(
        //     'User' => $entries[$i]['givenname']['0'],
        //     'Fullname' => $entries[$i]['cn']['0'],
        //     'Role' => $entries[$i]['ou']['0']

        //  );
        //     $data[$i] = $array;
        // }

        // echo json_encode($data);
        echo "<table style='width:100%' class='table'>";
        echo "<thead>";
        //echo "<th> Photo </td>";
        echo "<th> User</td>";
        //echo "<th>Fullname</th>";
        echo "<th>Role</th>";
        //echo "<th>description</th>";
        echo "<th>Email</th>";
        echo "<th>Phone Number</th>";
        echo "<th>Action</th>";
        echo "</thead>";

        echo "<tbody>";
        for ($i=1; $i < $entries['count']; $i++) { 
            # code...
            echo "<tr>";
            //echo "<td><img src='data:image/jpeg;base64,".base64_encode($entries[$i]['jpegphoto'][0])."' style='width:100px;height:100px;'/></td>";
            //echo "<td>".$entries[$i]['givenname']['0']."</td>";
            echo "<td>".$entries[$i]['cn']['0']."</td>";
            echo "<td>".$entries[$i]['ou']['0']."</td>";
            //echo "<td>".$entries[$i]['description']['0']."</td>";
            echo "<td>".$entries[$i]['mail']['0']."</td>";
            echo "<td>".$entries[$i]['telephonenumber']['0']."</td>";
            //echo "<td>".$entries[$i]['homepostaladdress']['0']."</td>";
            echo "<td><form name='delete_entry' action='delete.php' method='get' >";
            echo "<button id='delete' type='submit' class='btn btn-info' name='delete' value='".$entries[$i]['cn']['0']."'>DELETE</button></form>";
            echo "<form name='edit' action='edit.php'><button id='edit' type='submit' class='btn btn-info' name='edit' value='".$entries[$i]['cn']['0']."'>EDIT</button>";
            echo "</form></td>";
            echo "</tr>";
    
        }
        echo "</tbody>";
        echo "</table>";

        // print "<pre>";
        // print_r($entries);
        // print "</pre>";
    }
    else{
        echo "Acess denaid";
        echo $ldap_dn;
    }


?>

</div>
</div>
</body>
</html>


