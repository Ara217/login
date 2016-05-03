
$(document).ready(function(){
    $("#loginForm").validate({
        rules:{
            email:{
                required: true,
                email: true,
                minlength: 3,
                maxlength: 16,
            },

            pass:{
                required: true,
                minlength: 3,
                maxlength: 16,
            },
        },
        messages:{
            email:{
                required: "Enter you email",
            },

            pass:{
                required: "Enter your password",
            },

        }

    });

    $("#registerForm").validate({
        rules:{
            name: {
                required: true,
                minlength: 3,
            },

            lastname: {
                required: true,
                minlength: 6,
            },

            email:{
                required: true,
                email: true,
                minlength: 8,
                maxlength: 16,
            },

            password:{
                required: true,
                minlength: 3,
                maxlength: 16,
            },
            confirm: {
                required: true,
                equalTo: "#password",
            },
            upfile: {
                required: true,
                /*extension: "png|jpeg|gif",*/
            }

        },
        messages:{
            name: {
                required: "Enter your name",
                minlength: "minlength 3",
            },


            lastname: {
                required: "Enter your lasname",
                minlength: "minlength 6",
            },

            email:{
                required: "Enter your email",
                minlength: "minlength 8",
                maxlength: "maxlength 16",
            },

            password:{
                required: "Enter your password",
                minlength: "minlength 3",
                maxlength: "maxlength 16",
            },
            confirm: {
                equalTo: "Confirm is wrong"
            }

        }
        
    })

});