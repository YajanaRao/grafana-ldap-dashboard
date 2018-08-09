<?php
include_once 'config/ldap.php';

$ldap = new Ldap();
$conn = $ldap->getConnection();

if ($conn) {
    // bind with appropriate dn to give update access
    $r = ldap_bind($conn, "cn=Manager,dc=maxcrc,dc=com", "secret");

    $newuser_plaintext_password = $_POST['password'];
    // prepare data

    $str = implode(' ', array($_POST['fname'], $_POST['lname']));
    echo $str;
    $info["cn"] = $str;
    $info["sn"] = $_POST['lname'];
    $info["objectclass"][1] = "person";
    $info['objectclass'][0] = "top";
    $info['objectclass'][2] = "inetOrgPerson";
    $info['givenName'] = $_POST['fname'];
    $info["mail"] = $_POST['email'];
    $info["ou"] = "viewer";
    $info["telephoneNumber"] = "8277649277";
    $info['userPassword'] = '{MD5}' . base64_encode(pack('H*',md5($newuser_plaintext_password)));

    var_dump($conn);

    // add data to directory
    $r = ldap_add($conn, "cn=".$str.",ou=users,dc=maxcrc,dc=com", $info);

    ldap_close($conn);
     header("Location:admin_home.php");
  exit();
} else {
    echo "Unable to connect to LDAP server";
}
?>