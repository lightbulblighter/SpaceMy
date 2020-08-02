<?php
    // Notes:
    //
    // "if (empty($message))" trees get declared every so often whether in the registration or signing in process
    // because usually preceding it, there is a check to verify the content type.
    //
    // Some checks, like extracting the E-Mail provider from an E-Mail address, will cause a fatal error
    // if the submitted E-Mail address itself is not a proper E-Mail address.
    //
    // This is a very rudimentary way of checking multiple pieces of user-submitted information, but for the time
    // being, I cannot think of any better solutions that would accomplish the same goals I am setting out
    // for such registration process.
    //
    // This API is more or less a stripped down version of the Rboxlo API. In doing so, I have replaced the
    // presence of $error for a global process-error-checker with the simple "empty($message)". This is less obvious
    // of a """global process-error-checker""" than a variable named "error" with its only two values being true
    // or false, but I believe this will do for now.
    //
    // This API has a lot more checks here and is exponentially more secure than the copycat SpaceMy. Perhaps the
    // owner of it could learn a thing of two from this. I know he's stalking me anyway :-)
    //
    // The fundamental rule of this API is to never trust user input. Hopefully I have accomplished that.
    //

    function create_account(&$message, &$sql, &$statement, $info)
    {
        $statement = null;
        $message = "";

        if ((!isset($info) || empty($info)) && empty($message))
        {
            $message = "Nothing was sent.";
        }

        if (isset($_SESSION["user"]) && empty($message))
        {
            $message = "You cannot create new accounts while logged in!";
        }

        if (empty($message))
        {
            if ($_SESSION["csrf"] !== $info["csrf"])
            {
                $message = "Invalid CSRF token.";
            }
            
            if (empty($message))
            {
                $username = $info["username"];
                $password = $info["password"];
                $confirmed_password = $info["confirmed_password"];
                $email = $info["email"];

                // Username validation
                if ((strlen($username) == 0 || empty($username)) && empty($message))
                {
                    $message = "In order to create an account on ". PROJECT["NAME"] .", you must enter a username.";
                }
                
                if (!ctype_alnum($username) && empty($message))
                {
                    $message = "You cannot create an account with a username that contains special characters.";
                }
                
                if (strlen($username) < 3 && empty($message))
                {
                    $message = "Your username has to be at least 3 characters or more.";
                }
                
                if (strlen($username) > 20 && empty($message))
                {
                    $message = "Your username is too long (more than 20 characters.)";
                }
                
                if ((strlen($email) == 0 || empty($email)) && empty($message))
                {
                    $message = "In order to create an account on ". PROJECT["NAME"] .", you must enter an E-Mail.";
                }
                
                if (empty($message))
                {
                    $email = str_replace(str_replace(strstr($email, "@"), "", strstr($email, "+")), "", $email); // strip the tag from address, e.g john+alt@gmail.com -> john@gmail.com
                    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
                
                    if ((!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) && empty($message))
                    {
                         $message = "Invalid E-Mail address.";
                    }
                    
                    if (empty($message))
                    {
                        $domain_name = substr(strrchr($email, "@"), 1);
                    
                        if (!in_array($domain_name, PROJECT["VALID_EMAIL_DOMAINS"]) && empty($message))
                        {
                            $message = "Please register using a known E-Mail provider.";
                        }
                        
                        if (strlen($email) > 128 && empty($message))
                        {
                            $message = "Your E-Mail address cannot exceed 128 characters.";
                        }
                    
                        // Password validation
                        if ((strlen($password) == 0 || empty($password)) && empty($message))
                        {
                            $message = "In order to create an account on ". PROJECT["NAME"] .", you must enter a password.";
                        }
                        
                        if ((strlen($confirmed_password) == 0 || empty($confirmed_password)) && empty($message))
                        {
                            $message = "You must confirm your password.";
                        }
                        
                        if ($confirmed_password !== $password && empty($message))
                        {
                            $message = "Passwords do not match.";
                        }
                        
                        if (strlen($password) < 8 && empty($message))
                        {
                            $message = "Your password must be longer than 8 characters.";
                        }
                        
                        // Validate stuff using DB such as if the username is taken, the E-mail is already taken, >3 accounts per IP, etc.
                        if (empty($message))
                        {
                            $statement = $sql->prepare("SELECT * FROM `users` WHERE `username` = ?");
                            $statement->execute([$username]);
                            $result = $statement->fetch(PDO::FETCH_ASSOC);
                            
                            if ($result)
                            {
                                $message = "The username you have chosen is taken. Please try another one.";
                            }
                            
                            if (empty($message))
                            {
                                $email = _crypt($email);

                                $statement = $sql->prepare("SELECT * FROM `users` WHERE `email` = ?");
                                $statement->execute([$email]);
                                $result = $statement->fetch(PDO::FETCH_ASSOC);
                                
                                if ($result)
                                {
                                    $message = "There already exists an account with this E-Mail.";
                                }
                                
                                if (empty($message))
                                {
                                    $ip = _crypt(get_user_ip());
                                    
                                    $statement = $sql->prepare("SELECT * FROM `users` WHERE `register_ip` = ? OR `last_ip` = ?");
                                    $statement->execute([$username]);
                                    
                                    if ($statement->rowCount() > 3)
                                    {
                                        $message = "You can only have 3 accounts per IP address.";
                                    }
                                    
                                    // Invite only code
                                    if (PROJECT["REFERRAL"] && empty($message))
                                    {
                                        if ((empty($info["key"]) || !isset($info["key"])) && empty($message))
                                        {
                                            $message = "You need an invite key to register on ". PROJECT["NAME"] .".";
                                        }
                                        
                                        if (!ctype_alnum($info["key"]) && empty($message))
                                        {
                                            $message = "Invalid invite key.";
                                        }

                                        if (empty($message))
                                        {
                                            $statement = $sql->prepare("SELECT `uses`, `max_uses` FROM `invite_keys` WHERE `key` = ?");
                                            $statement->execute([$info["invite_key"]]);
                                            $result = $statement->fetch(PDO::FETCH_ASSOC);
                                            
                                            if (!$result && empty($message))
                                            {
                                                $message = "That invite key doesn't exist.";
                                            }
                                            
                                            if (empty($message))
                                            {
                                                if (($result["uses"] >= $result["max_uses"]) && empty($message))
                                                {
                                                    $message = "That invite key has already been used.";
                                                }
                                                
                                                if (empty($message))
                                                {
                                                    // Mark key as used
                                                    $statement = $sql->prepare("UPDATE `invite_keys` SET `uses` = `uses` + 1 WHERE `key` = ?");
                                                    $statement->execute([$info["key"]]);
                                                }
                                            }
                                        }
                                    }

                                    if (empty($message))
                                    {
                                        $password = _crypt(password_hash($password, PASSWORD_ARGON2ID)); // Plaintext password gets hashed using Argon2id, and then further gets encrypted.

                                        // Create user
                                        $statement = $sql->prepare("INSERT INTO `users` (`username`, `password`, `email`, `register_ip`, `last_ip`, `created`) VALUES (?, ?, ?, ?, ?, ?)");
                                        $statement->execute([$username, $email, $password, $ip, $ip, time()]);

                                        // Get user
                                        $statement = $sql->prepare("SELECT * FROM `users` WHERE `username` = ?");
                                        $statement->execute([$username]);
                                        $result = $statement->fetch(PDO::FETCH_ASSOC);

                                        // Set session
                                        $_SESSION["user"] = $result;
                                        $_SESSION["user"]["password"] = ""; // dont keep the hash in session just in case

                                        // We've finished!
                                        // The lack of a registration_message should tell them that we successfully registered
                                    }
                                }
                            }
                        }
                    }
                }                                   // LADDER
            }
        }
    }
?>