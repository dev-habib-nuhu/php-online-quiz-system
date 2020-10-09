$(document).ready(function(){
    $('#std_reg_form').bootstrapValidator({
        feedbackIcons:{
            valid: 'glyphicon glyphicon-okkk',
            invalid: 'glyphicon glyphicon-remove'
        },
        fields:{
            fname:{
            validators:{
                regexp:{
                    regexp: /^[A-Za-z]+$/i,
                    message:'Only alphabets are allowed'
                },
                stringLength:{
                    min:3,
                },
                    notEmpty: {
                        message: 'Please input your Firstname'
                    }
                }
             },
             lname:{
                validators:{
                    regexp:{
                    regexp: /^[A-Za-z]+$/i,
                    message:'Only alphabets are allowed'
                },
                    stringLength:{
                        min:3,
                    },
                        notEmpty:{
                            message:'Please input your Last name'
                        }
                }
             },
             user_name:{
                validators:{
                    regexp:{
                    regexp: /^[A-Za-z0-9]+$/i,
                    message:'Only alphabets are allowed'
                },
                    stringLength:{
                        min:4,
                    },
                        notEmpty: {
                            message:'The username field cant be left empty'
                        }
                    }
             },
             pass:{
                validators:{
                    identical:{
                        field:'cpass',
                        message:'The confirm password field has different pass'
                    },
                    notEmpty:{
                        message:"The passowrd field cant be left empty"
                    }
                }
             },
             cpass:{
                validators:{
                    identical:{
                        field:'pass',
                        message:'The passwords do not match!'
                    },
                    notEmpty:{
                        message:'This field cant be empty'
                    }
                }
             },
             dept:{
                validators:{
                     regexp:{
                    regexp: /^[a-z\s]+$/i,
                    message:'Only alphabets are allowed'
                     },
                        notEmpty: {
                            message:'This field cant be left empty'
                        }
                    }
             },
             level:{
                validators:{
                    digits:{
                        message:'Only numbers allowed'
                    },
                        notEmpty: {
                            message:'The field cant be left empty'
                        }
                    }
             },

        }

    });
});