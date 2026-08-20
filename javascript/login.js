const LRNInput = document.getElementById("lrninput");
const firstNameInput = document.getElementById("firstName");
const lastNameInput = document.getElementById("lastName");

const loginBtn = document.getElementById("loginBtn");
const registerBtn = document.getElementById("registerBtn");

function getValues(){
    return {
        LRN: LRNInput.value.trim(),
        first_name: firstNameInput.value.trim(),
        last_name: lastNameInput.value.trim()
    };
}

function valuesAreFilled(values){
    return values.LRN && values.first_name && values.last_name;
}

function goToRegister(values){
    const params = new URLSearchParams({
        mode: "register",
        lrn: values.LRN,
        first: values.first_name,
        last: values.last_name
    });
    window.location.href = "StudentRecord.php?" + params.toString();
}

function goToView(values){
    const params = new URLSearchParams({
        mode: "view",
        lrn: values.LRN,
        first: values.first_name,
        last: values.last_name
    });
    window.location.href = "StudentRecord.php?" + params.toString();
}

function login(){
    const values = getValues();

    if(!valuesAreFilled(values)){
        alert("Please fill out LRN, first name, and last name.");
        return;
    }

    // dbstudent.php -> func_name = "CheckStudent"
    // Returns a JSON array: one row if LRN + first_name + last_name match, [] if not.
    $.post("javascript/php/dbstudent.php", {
        func_name: "CheckStudent",
        LRN: values.LRN,
        first_name: values.first_name,
        last_name: values.last_name
    }, function(response){
        let records = [];
        try{
            records = JSON.parse(response);
        }catch(e){
            records = [];
        }

        if(Array.isArray(records) && records.length > 0){
            goToView(values);
        }else{
            goToRegister(values);
        }
    }).fail(function(){
        alert("Could not reach the server. Please try again.");
    });
}

function register(){
    const values = getValues();

    if(!values.LRN){
        alert("Enter your LRN first so we can start your registration.");
        return;
    }

    goToRegister(values);
}

loginBtn.addEventListener("click", login);
registerBtn.addEventListener("click", register);