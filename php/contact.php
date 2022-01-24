<?php
    
    $array = array("firstname" => "","name" => "","phone" => "","message" => "","email" => "","firstnameError" => "","nameError" => "","phoneError" => "","messageError" => "","emailError" => "", "isSuccess" => false);
        
    
    $emailTo = "arnaudggirard@gmail.com";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $array["firstname"] = verifyInput($_POST["firstname"]);
        $array["name"] = verifyInput($_POST["name"]);
        $array["email"] = verifyInput($_POST["email"]);
        $array["phone"] = verifyInput($_POST["phone"]);
        $array["message"] = verifyInput($_POST["message"]);
        $array["isSuccess"] = true;
        $emailText= "";
        
         if(empty( $array["firstname"]))
        {
            $array["firstnameError"] = "Je veux conntaitre ton prénom !";
            $array["isSuccess"] = false;
        }
        else
            $emailText.= "firstname: {$array["firstname"]}\n";
        
        if(empty( $array["name"]))
        {
            $array["nameError"]= "Je veux conntaitre ton nom !";
            $array["isSuccess"] = false;
        }
        else
            $emailText.="name: {$array["name"]}\n";
        
        if(empty($array["message"]))
        {
            $array["messageError"] = "Je veux conntaitre ton numéro !";
            $array["isSuccess"] = false;
        }
        else
            $emailText.="message: {$array["message"]}\n";
        
        if(!isEmail($array["email"]))
        {
            $array["emailError"] = "Je veux conntaitre ton adresse !";
            $array["isSuccess"] = false;
        }
        else
            $emailText.="email {$array["email"]}\n";
        
        if(!isPhone($array["phone"]))
        {
           $array["phoneError"] =  "Je veux conntaitre ton numéro !";
           $array["isSuccess"] = false;
        }
        else
            $emailText.="phone: {$array["phone"]}\n";
        
            
        if($array["isSuccess"])
        {
            $headers = "From: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReply-To: {$array["firstname"]}";
            mail($emailTo, "un message de votre site", $emailText, $headers);
            
        }
        
         echo json_encode($array);
        
    }
    function isPhone($var)
    {
        return preg_match("/^[0-9 ]*$/", $var);
    }
    function isEmail($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
    
    function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var =htmlspecialchars($var);
        return $var;
    }
    
?>