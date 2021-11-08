

const form     = document.getElementById("signup-form");
const username = document.getElementById("username");
const email    = document.getElementById("email");
const mobile   = document.getElementById("mobile");     
const password = document.getElementById("password");
const conf_psw = document.getElementById("conf_psw");

const errors = [];



// Show input error message
function showError(input,message){
    errors[input.id] = message;
    const formControl = input.parentElement;    
    const small = formControl.querySelector('small');
    formControl.classList.add("error");    
    small.innerText = message;
    
}

// Show success outline
function showSuccess(input){
    input.parentElement.classList.add("success");
}

// Email validation
function checkEmail(input) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if( !re.test(input.value.trim()) ){
        showError(input,`Please enter a valid email`)
    }else{
        showSuccess(input);
    }
}

// Mobile phone number validation
function checkMobile(input) {
    const regex = /^(?:\+?(?:36|\(36\)))[ -\/]?(?:(?:(?:(?!1|20|21|30|31|70|90)[2-9][0-9])[ -\/]?\d{3}[ -\/]?\d{3})|(?:(?:1|20|21|30|31|70|90)[ -\/]?\d{3}[ -\/]?\d{2}[ -\/]?\d{2}))$/;
    if( !regex.test(input.value.trim()) ){
        showError(input,`Please enter a valid mobile number`)
    }else{
        showSuccess(input);
    }
}

// getting the field name
function getFieldName(input){
    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}

// Check required fields
function checkRequired(inputArr){
    inputArr.forEach(input => {
        if(input.value.trim() === ''){
            showError(input,`${getFieldName(input)} is required`);
        }else{
            showSuccess(input);
        }
    });
}

// Check input lenght   
function checkLength(input,min,max){
    if(input.value.length < min  || input.value.length > max ){
        showError(input,`${input.id} must be between ${min} and ${max} characters`)
    }else{
        showSuccess(input);
    }
}

function checkPasswordMatch(input1, input2){
    if(input1.value !== input2.value){
        showError(input2, `${input1.id} and ${input2.id} are not mathc`);
    }
}

form.addEventListener("submit", e =>{

    // lets prevent the submit event of the form
    e.preventDefault();

    checkRequired([username,email,mobile,password,conf_psw]); 

    checkLength(username,3,15);

    checkMobile(mobile);

    checkLength(password,6,25);

    checkEmail(email);

    checkPasswordMatch(password, conf_psw);

    // checking for errors
    console.log(errors);
    
    // lets submit the form if the validation went well
    if(errors.length == 0){
        form.submit();
    }     

});


