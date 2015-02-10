//http://formvalidation.io/getting-started/
$(document).ready(function() {
    $('form').not("#loginForm").formValidation({
    	locale: $("#LanguagePreference").val(),
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
                    }
                }
            },
            LastName: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            Email: {
                validators: {
                    notEmpty: {
                    },
                    emailAddress: {                        
                    }
                }
            },
            Password: {
                validators: {
                	stringLength: {
                        min: 6,
                    },
                    notEmpty: {
                    }                    
                }
            },
            RePassword: {
                validators: {
                	stringLength: {
	                    min: 6,
	                },
	                notEmpty: {
	                }
                }                
            },
            PostalCode: {
                validators: {
                    zipCode: {
                        country: 'CA',
                        // %s will be replaced with "US zipcode", "Italian postal code", and so on
                        // when you choose the country as US, IT, etc.
                    },
                    notEmpty: {
                    },
                }
            },
            PhoneNumber: {
                validators: {
                    phone: {
					    country: "CA",
					}
                }
            },            
            Gender: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            Birthday: {
                validators: {
                    notEmpty: {
                    },
                    date: {
                        format: 'YYYY/MM/DD',
                    }
                }
            }
        }
    });
});