<?php

//define variable and set empty values

$name_error = $email_error = $phone_error =  "";
$name = $email = $phone = $message = $success =  "";

//form is submitted with POST

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty($_POST["name"])){
        $name_error = "Votre nom est requis.";
    }else{
        $name =  test_input($_POST["name"]);
        //check if name only contains letters and whitespace
    if(!preg_match("/^[a-zA-Z ]*$/", $name)){
        $name_error = "Seules les lettres sont acceptées.";
    }
}

if(empty($_POST["email"])){
    $email_error = "Email est requis.";
}else{
    $email = test_input($_POST["email"]);

    //check if email adress is well formed
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $email_error = "Format Email Incorrect.";
    }
}

if(empty($_POST["phone"])){
    $phone_error = "Téléphone requis.";
}else{
    $phone = test_input($_POST["phone"]);
    // check if phone format is correct

    if(!preg_match('/^[0-9]{10}+$/', $phone)){
        $phone_error = "Numéro de téléphone incorrect.";
    }
}


if (empty($_POST["message"])){
    $message = "";
}else{
    $message = test_input($_POST["message"]);
    }

    if($name_error == '' && $email_error == '' && $phone_error =='' ){
        $message_body = '';
        unset($_POST['submit']);
        foreach ($_POST as $key => $value){
            $message_body .= "$key: $value\n";
        }

        $to = 'ambroise.adanledji@outlook.com';
        $subject = "Formulaire envoyé.";
        if(mail($to, $subject, $message)){
            $success = "Votre message a été envoyé, merci de m'avoir contacté";
            $name = $email = $phone = $message = '';
        }

    }
}

function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    
    return $data;
};