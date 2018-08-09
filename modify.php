
<?php


include_once 'config/Ldap.php';

$ldap = new Ldap();
$conn = $ldap->getConnection();
if (isset($_GET['dname']) || isset($_POST['description']) || isset($_POST['company'])) {
    $ldap_password = "secret";
    $ldap_dn = "cn=Manager,dc=maxcrc,dc=com";
    if(@ldap_bind($conn,$ldap_dn,$ldap_password)){
        # code...
        //echo $_GET['edit'];
        $filter = "cn=".$_POST['entry'];
        $result = ldap_search($conn, "dc=maxcrc,dc=com", $filter) or die("failed");
        $entries = ldap_get_entries($conn, $result);
        //echo json_encode($entries);
        //echo json_encode($entries[0]['dn']);
        $modify = array(
            'displayname' => $_POST['dname'],
            'description' => $_POST['description'],
            'homepostaladdress' => $_POST['state']." ".$_POST['country']
        );

        if (!empty($_FILES['fileToUpload'])) {
            # code...
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            echo $target_file;  
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $modify['jpegphoto']  = file_get_contents($target_file);

            } else {
                echo "File is not an image.";
            }
        }
        echo json_encode($modify);
        echo json_encode($entries[0]['dn']);
        ldap_modify($conn, $entries[0]['dn'], $modify);
        header("Location: admin_home.php");
    }
}



?>
