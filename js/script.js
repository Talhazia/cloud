$('document').ready(function()
{
     /* validation */
  $("#register-form").validate({
      rules:
   {
   username: {
      required: true,
   minlength: 3
   },
   password: {
   required: true,
   minlength: 8,
   maxlength: 15
   },
   cpassword: {
   required: true,
   equalTo: '#password'
   },
   useremail: {
            required: true,
            email: true
            },
    },
       messages:
    {
            username: "please enter user name",
            password:{
                      required: "please provide a password",
                      minlength: "password at least have 8 characters"
                     },
            useremail: "please enter a valid email address",
   cpassword:{
      required: "please retype your password",
      equalTo: "passwords do not match."
       }
       },
    submitHandler: submitForm
       });
    /* validation */

    /* form submit */
    function submitForm()
    {
    var data = $("#register-form").serialize();

    $.ajax({

    type : 'POST',
    url  : 'register.php',
    data : data,
    beforeSend: function()
    {
     $("#error").fadeOut();
     $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
    },
    success :  function(data)
         {
        if(data==1){

         $("#error").fadeIn(1000, function(){


           $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Sorry email already taken !</div>');

           $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');

         });

        }
        else if(data=="registered")
        {

         $("#btn-submit").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing Up ...');
         setTimeout(function() {
           window.location.href = "login.php";
         }, 2000);

        }
        else{

         $("#error").fadeIn(1000, function(){

      $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');

         $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; `Create` Account');

         });

        }
         }
    });
    return false;
  }
    /* form submit */

});
