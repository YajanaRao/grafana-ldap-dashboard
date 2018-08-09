<?php
include_once 'config/ldap.php';
$ldap = new Ldap();
$conn = $ldap->getConnection();
if (isset($_GET['delete'])){
    $delete_dn = "cn=".$_GET['delete'].",ou=users,dc=maxcrc,dc=com";
    $ldap_password = "secret";
    $ldap_dn = "cn=Manager,dc=maxcrc,dc=com";
    if(@ldap_bind($conn,$ldap_dn,$ldap_password)){
        myldap_delete( $conn,$delete_dn);
        header("Location: admin_home.php");
    }
}



else{
    echo "FAILED";
}
function myldap_delete($conn,$dn,$recursive=false){
// echo $conn;
    if($recursive == false){
        return(ldap_delete($conn,$dn));
    }else{
        //searching for sub entries
        $sr=ldap_list($conn,$dn,"ObjectClass=*",array(""));
        $info = ldap_get_entries($conn, $sr);
        for($i=0;$i<$info['count'];$i++){
            //deleting recursively sub entries
            $result=myldap_delete($conn,$info[$i]['dn'],$recursive);
            if(!$result){
                //return result code, if delete fails
                return($result);
            }
        }
        return(ldap_delete($conn,$dn));
    }
}
?>