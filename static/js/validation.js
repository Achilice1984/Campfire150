//http://formvalidation.io/getting-started/
$(document).ready(function() {
    $('form').formValidation({
        framework: 'bootstrap',
        //err: { container: "#errorMessageSection"},
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            FirstName: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    }
                }
            },
            LastName: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required'
                    }
                }
            },
            Email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            Password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                }
            },
            PostalCode: {
                validators: {
                    zipCode: {
                        country: 'CA',
                        // %s will be replaced with "US zipcode", "Italian postal code", and so on
                        // when you choose the country as US, IT, etc.
                        message: 'The value is not valid postal code'
                    },
                    notEmpty: {
                        message: 'The postal code is required'
                    },
                }
            },
            PhoneNumber: {
                validators: {
                    phone: {
					    country: "CA",
					    message: 'Please enter a valid phone number'
					}
                }
            },
            RePassword: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                }
            },
            Gender: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
                    }
                }
            },
            Birthday: {
                validators: {
                    notEmpty: {
                        message: 'The date of birth is required'
                    },
                    date: {
                        format: 'YYYY/MM/DD',
                        message: 'The date of birth is not valid'
                    }
                }
            }
        }
    });
});