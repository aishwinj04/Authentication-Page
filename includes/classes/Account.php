<?php

    class Account {
        
        private $errorArray; // for error messages in validation
        private $con;

        public function __construct($con){
            $this->errorArray = array();
            $this->con = $con; 
    
        }

        public function login($un, $pw){
            $pw = md5($pw);
            $query = mysqli_query($this->con, "SELECT * FROM users WHERE username= '$un' AND password= '$pw' ");
            if(mysqli_num_rows($query) == 1){
                return true;
            }else{
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }

        public function register($un, $fn, $ln, $em, $em2, $pw, $pw2){
            $this->validateUsername($un);
            $this->validateFirstName($fn); 
            $this->validateLastName($ln);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw, $pw2);

            // no error messages encountered = successful inputs -> add to database
            if(empty($this->errorArray)){
                return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
            }else{
                return false;
            }
        }


        public function getError($error){
            if(!in_array($error, $this->errorArray)){
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";

        }

        private function insertUserDetails($un, $fn, $ln, $em, $pw){
            $encryptedPw = md5($pw);
            $profilePic = "assets/images/profilepics/user.svg";
            $date = date("Y-m-d");

            $result = mysqli_query($this->con, "INSERT INTO users VALUES (NULL,'$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");
            return $result; // returns true if successful 
        }



        // functions below for validating input
        
        private function validateUsername($username){
            // length of username must be 8-25 characters
            if(strlen($username) < 8 || strlen($username) > 25){
                array_push($this->errorArray, Constants::$usernameLength);
                return;

            // check username already exsists in database
            $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username = '$username'");
            if(mysqli_num_rows($checkUsernameQuery) != 0){
                array_push($this->errorArray, Constants::$usernameTaken);
                return;
            }

            }
            
        }

        private function validateFirstName($firstName){

            // check length
            if(strlen($firstName) > 30 || strlen($firstName) < 2){
                array_push($this->errorArray, Constants::$firstNameLength);
                return;
            }

            // check for strictly letters
            if(preg_match('/[^A-Za-z]/', $firstName)){
                array_push($this->errorArray, Constants::$firstNameLetters);
                return;
            }



        }

        private function validateLastName($lastName){
            if(strlen($lastName) > 30 || strlen($lastName) < 2){
                array_push($this->errorArray, Constants::$lastNameLength);
                return;
            }

             if(preg_match('/[^A-Za-z]/', $lastName)){
                array_push($this->errorArray, Constants::$lastNameLetters);
                return;
            }

        }

        private function validateEmails($email, $email2){
            if($email != $email2){
                array_push($this->errorArray, Constants::$emailNotMatch);
                return;
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }


            // check email not in exisitence already
            $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email = '$email'");
            if(mysqli_num_rows($checkEmailQuery) != 0){
                array_push($this->errorArray, Constants::$emailTaken);


            }


        }

        private function validatePasswords($password, $password2){
            if($password != $password2){
                array_push($this->errorArray, Constants::$passwordsNotMatch);
                return;
            }

            if(strlen($password) < 8){
                array_push($this->errorArray, Constants::$passwordsLength);
                return;
            }

        }

    }


?>