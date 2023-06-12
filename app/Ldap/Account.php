<?php

namespace App\Ldap;

class Account
{
    public static function Memorial($searchUser, $password)
    {
        $retval = null;
        $ldap_server = env('LDAP_SERVER', '10.100.1.10');
        $ldap_port = env('LDAP_PORT', 389);
        $base_dn = env('LDAP_BASE_DN', 'DC=memorial,DC=com,DC=tr');
        $username = env('LDAP_USERNAME', 'intranet@memorial.com.tr');
        $pass = env('LDAP_PASS', 'lwstnss');
        $searchInfo = array($searchUser, $password);

        $ldap = ldap_connect($ldap_server, $ldap_port);
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        if ($bind = ldap_bind($ldap, $username, $pass)) {
            $filter = '(sAMAccountName=' . $searchInfo[0] . ')';
            $attributes = array("name", "mail", "sAMAccountName", "distinguishedName");

            $result = ldap_search($ldap, $base_dn, $filter, $attributes);
            $entries = ldap_get_entries($ldap, $result);

            //print_r($entries);
            $userDN = (isset($entries[0]["distinguishedname"][0]) && $entries[0]["distinguishedname"][0] != "" ? $entries[0]["distinguishedname"][0] : "");

            if ($userDN != "") {
                $ldapBindUser = @ldap_bind($ldap, $userDN, $searchInfo[1]);
                if ($ldapBindUser) {
                    //echo "<p style='color: green;'>Kullanıcı geçerli</p>";
                    $retval = true;
                } else {
                    $retval = false;
                    //echo "<p style='color: red;'>Hatalı kullanıcı adı yada şifre: $searchInfo[0]</p>";
                }
            } else {
                //echo "<p style='color: red;'>Hatalı kullanıcı adı: $searchInfo[0]</p>";
                $retval = false;
            }
            ldap_unbind($ldap);
        } else {
            die($bind_unsuccessful);
            $retval = false;
        }
        return $retval;
    }

    public static function Hizmet($searchUser, $password)
    {
        $retval = null;
        $ldap_server = env('LDAP_SERVER_2', '10.34.102.5');
        $ldap_port = env('LDAP_PORT_2', 389);
        $base_dn = env('LDAP_BASE_DN_2', 'DC=tbv,DC=corpnet');
        $username = env('LDAP_USERNAME_2', 'intranet');
        $pass = env('LDAP_PASS_2', 'intranet1234');
        $searchInfo = array($searchUser, $password);

        $ldap = ldap_connect($ldap_server, $ldap_port);
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

        if ($bind = ldap_bind($ldap, $username, $pass)) {
            $filter = '(sAMAccountName=' . $searchInfo[0] . ')';
            $attributes = array("name", "mail", "sAMAccountName", "distinguishedName");

            $result = ldap_search($ldap, $base_dn, $filter, $attributes);
            $entries = ldap_get_entries($ldap, $result);
            //userDN = (isset($entries[0]["name"][0]) && $entries[0]["name"][0] != "" ? $entries[0]["name"][0] : "");
            $userDN = (isset($entries[0]["distinguishedname"][0]) && $entries[0]["distinguishedname"][0] != "" ? $entries[0]["distinguishedname"][0] : "");

            if ($userDN != "") {
                $ldapBindUser = @ldap_bind($ldap, $userDN, $searchInfo[1]);
                if ($ldapBindUser) {
                    $retval = true;
                    //echo "<p style='color: green;'>Kullanıcı geçerli</p>";
                } else {
                    $retval = false;
                    // echo "<p style='color: red;'>Hatalı kullanıcı adı yada şifre: $searchInfo[0]</p>";
                }
            } else {
                $retval = false;
                //echo ("<p style='color: red;'>Hatalı kullanıcı adı: $searchInfo[0]</p>");
            }
            ldap_unbind($ldap);
        } else {
            die($bind_unsuccessful);
            $retval = false;
        }
        return $retval;
    }
}
