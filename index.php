<?php  
 
//Taking some variables

        //for showing errors
        $nameErr = $emailErr = $mobilenoErr = $msgErr = $subErr= "";  

        //for storing data of input fields
        $forname = $foremail = $formobile = "";  
        $name= $mobileno= $email= $msg= $subject="";


        //Validation
  
//Post values validation  
        if ($_SERVER["REQUEST_METHOD"] == "POST") {  
            
        //Name Validation  
            if (empty($_POST["name"])) {  
                $nameErr = "Name is required";  
            } else {  
                $forname = input_data($_POST["name"]);  
                    // check if name only contains letters and whitespace  
                    if (!preg_match("/^[a-zA-Z ]*$/",$forname)) {  
                        $nameErr = "Only alphabets and white space are allowed";  
                    }  
                    else{
                        $name=$forname;
                    }
            }  
      
    //Email Validation   
        if (empty($_POST["email"])) {  
                $emailErr = "Email is required";  
        } else {  
                $foremail = input_data($_POST["email"]);  
                // check that the e-mail address is well-formed  or not
                if (!filter_var($foremail, FILTER_VALIDATE_EMAIL)) {  
                    $emailErr = "Invalid email format";  
                }  
                else{
                    $email=$foremail;
                }
        }  
    
    //Number Validation  
    if (empty($_POST["mobileno"])) {  
            $mobilenoErr = "Mobile no is required";  
    } else {  
            $formobile = input_data($_POST["mobileno"]);  
            // check if mobile no is well-formed  
            if (!preg_match ("/^[0-9]*$/", $formobile) ) {  
            $mobilenoErr = "Only numeric value is allowed.";  
            }  
        //check mobile no length should not be less and greator than 10  
        else if (strlen ($formobile) != 10) {  
            $mobilenoErr = "Mobile no must contain 10 digits.";  
            }  
            else {
                $mobileno=$formobile;
            }
    }  


    //Subject Validation
    if (empty($_POST["subject"])) {  
        $subErr = "subject is required";  
    } else { 
    $subject=$_POST["subject"];

    }
      

    //message validation  
    if (empty($_POST["message"])) {  
            $msgErr = "Message is required";  
    } else { 
      $msg=$_POST["message"];

    }
}  
function input_data($data) {  
  $data = trim($data);  
  $data = stripslashes($data);  
  $data = htmlspecialchars($data);  
  

  return $data;  
}  


//Now sending data to another page to store data in the Database

if($name && $mobileno && $subject && $email && $msg){

$content = array (
    'name' => $name,
    'mobileno' => $mobileno,
    'email' => $email,
    'subject' => $subject,
    'message' => $msg
    );
header("Location: mailsend.php?" . http_build_query($content));
}
?>  
  


                     <!-- form -->


<!DOCTYPE html>  
<html>  
<head>  
<style>  
.error {color: #FF0001;} 
.container{
    /* align-items:center; */
    position: relative;
    left:35%;
    width:50%;
} 
input{
    width:50%;
    /* float: right; */
}
/* label{
    width:90%;
} */
h2{
    padding-left:100px;
}
</style>  
</head>  

<body>   
    <div class="container">

  
<h2>Beauty Saloon</h2>  
<br>
<h3>Contact Us</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >  
 
    <div for="" >Name:</div>
    <input type="text" name="name" <?php if (!empty($_POST['name'])) {echo "value=\"" . $_POST["name"] . "\"";} ?> >  
    <span class="error">* <?php echo $nameErr; ?> </span>  
    <br><br>  
    <div for="">Email:</div> 
    <input type="text" name="email" size="40" <?php if (!empty($_POST['email'])) {echo "value=\"" . $_POST["email"] . "\"";} ?> >  
    <span class="error">* <?php echo $emailErr; ?> </span>  
    <br><br>  
    <div for="">Mobile No:</div> 
    <input type="text" name="mobileno"  <?php if (!empty($_POST['mobileno'])) {echo "value=\"" . $_POST["mobileno"] . "\"";} ?>>  
    <span class="error">* <?php echo $mobilenoErr; ?> </span>  
    <br><br>  
    <div for="">Subject:</div>   
    <input type="text" name="subject" size="40" <?php if (!empty($_POST['subject'])) {echo "value=\"" . $_POST["subject"] . "\"";} ?>>  
    <span class="error">* <?php echo $subErr; ?> </span>  

    <br><br>
     <div>
  <label for="message">  Message: </label><br>
    
    <textarea type="text" name="message"  rows="4" cols="45" <?php if (!empty($_POST['message'])) {echo "value=\"" . $_POST["message"] . "\"";} ?>></textarea>
    <span class="error">* <?php echo $msgErr; ?> </span> 
    </div><br><br>  
                              
    <input type="submit" name="submit" value="Submit">   
    <br><br>                             
</form>  
  
 
</div>
</body>  
</html>  