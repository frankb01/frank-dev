<?php
  $array = array('firstname' => "",'firstname' => "",'name' => "",'email' => "",'phone' => "",'message' => "",'firstnameError' => "",'nameError' => "",'emailError' => "",'phoneError' => "",'messageError' => "","isSuccess" => false );

  $emailTo = "frankbouchut@yahoo.fr";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $array["firstname"] = verifyInput($_POST["firstname"]);
    $array["name"] = verifyInput($_POST["name"]);
    $array["email"] = verifyInput($_POST["email"]);
    $array["phone"] = verifyInput($_POST["phone"]);
    $array["message"] = verifyInput($_POST["message"]);
    $array["isSuccess"] = true;
    $emailText = "";

    if(empty($array["firstname"])){
      $array["firstnameError"] = "Je veux connaitre ton prénom !";
      $array["isSuccess"] = false;
    }
    else {
      $emailText .= "FirstName: {$array["firstname"]}\n";
    }
    if(empty($array["name"])){
      $array["nameError"] = "Et oui, même ton nom m'intéresse !";
      $array["isSuccess"] = false;
    }
    else {
      $emailText .= "Name: {$array["name"]}\n";
    }
    if(!isEmail($array["email"])){
      $array["emailError"] = "C'est pas un Email, ça !";
      $array["isSuccess"] = false;
    }
    else {
      $emailText .= "Email: {$array["email"]}\n";
    }
    if(!isPhone($array["phone"])){
    $array["phoneError"] = "Uniquement des chiffres et des espaces, stp";
    $array["isSuccess"] = false;
    }
    else {
      $emailText .= "Phone: {$array["phone"]}\n";
    }
    if(empty($array["message"])){
      $array["messageError"] = "Donnes moi ton avis sur mon CV !";
      $array["isSuccess"] = false;
    }
    else {
      $emailText .= "Message: {$array["message"]}\n";
    }
    if($array["isSuccess"]){
      $headers = "from: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}";
      mail($emailTo, "Une réponse du site frank-dev", $emailText , $headers);
    }

    echo json_encode($array);

  }

  function isPhone($var){
    return preg_match("/^[0-9 ]*$/", $var);
  }

  function isEmail($var){
    return filter_var($var, FILTER_VALIDATE_EMAIL);
  }

  function verifyinput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
  }

 ?>
