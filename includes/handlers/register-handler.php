 <?php

   

    // functions below to gather filtered input 
    function sanitizeFormUsername($inputText){
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        return $inputText;

    }

    function sanitizeFormString($inputText){
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        $inputText = ucfirst(strtolower($inputText));
        return $inputText;
    }

    // only want to strip html tags, don't want to change contents
    function sanitizeFormPassword($inputText){
        $inputText = strip_tags($inputText);
        return $inputText;

    }

   



    if(isset($_POST['RegisterBtn'])){
        // register button was pressed
        // echo "Form Submitted";

        $registerUsername = sanitizeFormUsername($_POST['registerUsername']);
        $firstName = sanitizeFormString($_POST['firstName']);
        $lastName = sanitizeFormString($_POST['lastName']);
        $email = sanitizeFormString($_POST['email']);
        $email2 = sanitizeFormString($_POST['email2']);
        $registerPassword = sanitizeFormPassword($_POST['registerPassword']);
        $registerPassword2 = sanitizeFormPassword($_POST['registerPassword2']);


        #register returns true or false based on errorArray
        $wasSuccessful = $account->register($registerUsername, $firstName, $lastName, $email, $email2, $registerPassword, $registerPassword2);
        
        // successful sign up -> return to index page
        if($wasSuccessful){
            $_SESSION['userLoggedIn'] = $registerUsername;
            header("Location: index.php");

        }

    
      
        
    
    }

?>