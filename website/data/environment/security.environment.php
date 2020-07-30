<?php
    /* 
        >>> Security

        SECURITY["CRYPT"]["KEY"] => The private cryption key that will be used to protect user details.
                                    ** DO NOT LET THIS LEAK . ** If you make this information public, should your database get compromised, the protection becomes useless.
        SECURITY["CRPYT"]["HASH"] => The default hashing algorithm for user information encryption. The default is sha512. Change it if you want.
    */

    define("SECURITY", [
        "CRYPT" => [
            "HASHING" => "sha512",
            "ENCRYPTION" => "aes-256-cbc",
            "KEY" => ""
        ]
    ]);
?>