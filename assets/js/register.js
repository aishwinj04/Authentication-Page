$(document).ready(function(){
    console.log("Document Ready");

    // span tag id (hideLogin) is clicked execute this:
    $("#hideLogin").click(function(){
        console.log("Sign up clicked");
        $("#loginForm").hide(); // id of first form is the login (hidden)
        $("#registerForm").show();          // id of second form is register (visible)

    });

    // span tag id (hideRegister) is clicked execture this:
     $("#hideSignUp").click(function(){
        console.log("Login clicked");
        $("#loginForm").show();
        $("#registerForm").hide(); 

    });

});