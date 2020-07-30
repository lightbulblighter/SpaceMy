<?php
    /* 
        >>> Project

        PROJECT["NAME"] => The project's name.
        PROJECT["DISCORD"] => Discord invite to this project.
        PROJECT["DEBUGGING"] => Whether to show error messages or not, regardless of user identity. Only turn this on in a local debugging environment
        PROJECT["REFERRAL"] => Whether to not the project is on "invite-only" mode.
        PROJECT["VALID_EMAIL_DOMAINS"] => An array containing the valid E-Mail domains that a user can sign up with (for example, with john@gmail.com, gmail.com is the E-Mail domain)
    */
    
    define("PROJECT", [
        "NAME" => "SpaceMy",
        "DISCORD" => "",
        "DEBUGGING" => true,
        "REFERRAL" => false,
        "VALID_EMAIL_DOMAINS" => ["google.com", "protonmail.ch", "googlemail.com", "gmail.com", "yahoo.com", "yahoomail.com", "protonmail.com", "outlook.com", "hotmail.com", "microsoft.com", "inbox.com", "mail.com", "zoho.com"]
    ]);
?>