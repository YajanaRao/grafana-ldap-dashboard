
<?php

    
    # https://stackoverflow.com/questions/830074/can-a-username-and-password-be-sent-safely-over-https-via-url-parameters
    // $username = "anthony";
    // $password = "password";
    // $credencials = $username.':'.$password;
    // echo $credencials;
    // $cred = base64_encode($credencials);
    // echo $cred;
    // $url = "http://$credencials@192.168.99.100/";
    // echo $url;
    // header( "Location: $url" ) ;
    session_start(); 
    if (isset($_SESSION['username']) && isset($_SESSION['password'])) 
    {
    
        $username = trim($_SESSION['username']);
        $password = trim($_SESSION['password']);
        
        $credencials = $username.':'.$password;
        $cred = base64_encode($credencials);
        $url = "http://$credencials@localhost/grafana/";
        // echo $cred;
        // echo $url;
        // $url = "http://localhost/grafana/";
        // header("Authorization: Basic ".$cred);
        header("Location: $url");
    }

    else{
        echo json_encode("no credencials found");
    }

?>
