//http://formvalidation.io/getting-started/
$(document).ready(function() {
    init_validation();
});

function init_validation()
{
    $('form').not("#AboutForm").not("#ActionStatementForm").not("#ActionTakenForm").formValidation({
        locale: $("#LanguagePreference").val(),
        framework: 'bootstrap',
        trigger: 'blur',
        excluded: [':hidden:not(select)'],
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
            ProfilePrivacyType_PrivacyTypeId: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            Gender_GenderId: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            SecurityQuestionId: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            SecurityAnswer: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            ActionStatement: {
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
                        format: 'YYYY-MM-DD'
                    }
                }
            },
            //Story Add
            'QuestionAnswers[1][]': {
                validators: {
                    notEmpty: {
                    }
                }
            },
            'QuestionAnswers[2][]': {
                validators: {
                    notEmpty: {
                    }
                }
            },
            'QuestionAnswers[3][]': {
                validators: {
                    notEmpty: {
                    }
                }
            },
            'QuestionAnswers[4][]': {
                validators: {
                    notEmpty: {
                    }
                }
            },
            'QuestionAnswers[5][]': {
                validators: {
                    notEmpty: {
                    }
                }
            },
            'QuestionAnswers[6][]': {
                validators: {
                    notEmpty: {
                    }
                }
            },
            'QuestionAnswers[7][]': {
                validators: {
                    notEmpty: {
                    }
                }
            },
            'QuestionAnswers[8][]': {
                validators: {
                    notEmpty: {
                    }
                }
            },
            StoryTitle: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            YearsInCanada: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            StoryPrivacyType_StoryPrivacyTypeId: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            'Tags[]': {
                validators: {
                    notEmpty: {
                    }
                }
            },
        }
    });
}