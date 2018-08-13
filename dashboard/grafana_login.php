
<?php
    session_start(); 
    if (isset($_SESSION['username']) && isset($_SESSION['password'])) 
    {
    
        $username = trim($_SESSION['username']);
        $password = trim($_SESSION['password']);
        
        $credencials = $username.':'.$password;
        $cred = base64_encode($credencials);
        $url = "http://$credencials@localhost/grafana/";
        header("Location: $url");
    }

    else{
        echo json_encode("no credencials found");
    }

?>
