<?php
 

 if(isset($_POST['LoginBtn'])){
        // login button was pressed

        $loginUsername=$_POST['loginUsername'];
        $loginPassword=$_POST['loginPassword'];

        // call login function
        $result = $account->login($loginUsername, $loginPassword);
        if($result){
            $_SESSION['userLoggedIn'] = $loginUsername; // keep track of the user across page
            header("Location: index.php");
        }

    }


?>