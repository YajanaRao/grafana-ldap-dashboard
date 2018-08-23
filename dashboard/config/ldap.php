

<?php
/**
 * 
 */
class Ldap 
{
	
	function getConnection()
	{
		# code...
		$this->ldap = ldap_connect("ldap://localhost:389");  // assuming the LDAP server is on this host
		ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($this->ldap, LDAP_OPT_REFERRALS, 0);
		return $this->ldap;
	}
}

?>
