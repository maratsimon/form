<?php
$NameError="";
$EmailError="";
$GenderError="";
$WebsiteError="";
$succses="Thank you your form submitted";

use PHPMailer\PHPMailer\PHPMailer;
require './vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer(true);


if(isset($_POST["Submit"])){
    
    
   if(empty($_POST["Name"])){
       $NameError="Name is requaried";
       
   }else{
       $Name=Test_User_Input($_POST["Name"]);
       if(!preg_match("/^[A-Za-z. ]*$/",$Name)){
           
          $NameError="only letters and white spaces are allowed"; 
       }
       
   }
  if(empty($_POST["Email"])){
       $EmailError="Email is requaried";
    
  }else{
      
     $Email=Test_User_Input($_POST["Email"]); 
        if(!preg_match("/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/",$Email)){
           
         $EmailError="Wrong type"; 
       }
  }
     if(empty($_POST["Gender"])){
       $GenderError="Gender is requaried";
    
  }else{
      
     $Gender=Test_User_Input($_POST["Gender"]); 
      
  }
     if(empty($_POST["Website"])){
       $WebsiteError="Website url  is requaried";
    
  }else{
      
     $Website=Test_User_Input($_POST["Website"]);
        if(!preg_match("#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#iS",$Website)){
           
         $WebsiteError="Wrong url,try again"; 
       }      
  }
    if(!empty($_POST["Name"]) && !empty($_POST["Email"]) && !empty($_POST["Gender"])&& !empty( $_POST["Website"])){
        if(preg_match("/^[A-Za-z\. ]*$/",$Name) && preg_match("/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/",$Email)&& preg_match("#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#iS",$Website))
         {
            
          echo"<h2> Your Submit information</h2> <br>";  
          echo "Name is :".ucwords($_POST["Name"])."<br>"; 
          echo "Email is : {$_POST["Email"]}<br>"; 
          echo "Gender is : {$_POST["Gender"]}<br>"; 
          echo "Website is : {$_POST["Website"]}<br>"; 
          echo "Comments is : {$_POST["Comment"]}<br>"; 
 
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
//$mail->SMTPDebug = 2;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "maratsimon@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "IRAgetman19471947";
//Set who the message is to be sent from
$mail->setFrom('maratsimon@gmail.com', 'First Last ');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('maratsimon@yahoo.com', 'Marat Sherman');
//Set the subject linecomposer require phpmailer/phpmailer;
$mail->Subject = ' Form data from new customer';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->Body="Name of customer :  {$_POST['Name']}<br> Gender : {$_POST['Gender']} <br>Email is: {$_POST['Email']}<br> Website is : {$_POST['Website']}<br> Comment is : {$_POST['Comment']}";
//Replace the plain text body with one created manually
$mail->AltBody= "this is test";
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo" <span class='Succses'>$succses</span><br>";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
       }
    }
        
  }
}
  function Test_User_Input($Data){
     return $Data;   
        
    }

//echo "<meta http-equiv='refresh' content='0'>";

//End************************************************************
?>
 


 
<!DOCTYPE>
 
<html>
    <head>
        <title>Form Validation Project</title>
    </head>
<style type="text/css">
input[type="text"],input[type="email"],textarea{
    border:  1px solid dashed;
    background-color: rgb(221,216,212);
    width: 600px;
    padding: 10px;
    font-size: 1.0em;
}
.Error{
    color: red;
}
.Succses{
    color:#94ef19;
        
}    
.ClearSubmit{
        
    margin-left:50px;  
}
    
</style>
    
    <body >
        
<?php ?>
        
 <h2>Form Validation with PHP.</h2>

<form  action="FormValidationProject.php" method="post"> 
<legend>* Please Fill Out the following Fields.</legend>            
<fieldset>
Name:<br>
<input class="input" type="text" Name="Name"  value="">
<span class="Error">*<?php echo $NameError;  ?></span><br>   
E-mail:<br>
<input class="input" type="text" Name="Email" value="">
<span class="Error">*<?php echo $EmailError; ?></span><br>
Gender:<br>
<input class="radio" type="radio" Name="Gender" value="Female">Female
<input class="radio" type="radio" Name="Gender" value="Male">Male
<span class="Error">*<?php echo $GenderError; ?></span><br>        
Website:<br>
<input class="input" type="text" Name="Website" value="">
<span class="Error">*<?php echo $WebsiteError; ?></span><br>
Comment:<br>
<textarea Name="Comment" rows="5" cols="25"></textarea>
<br>
<br>
<input type="Submit" Name="Submit" value="Submit Your Information">
<input type="Submit" class="ClearSubmit" Name="Clear" value="Clear Your Information">
    
   </fieldset>
</form>
        
      </body>
</html>