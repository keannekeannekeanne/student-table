//main form
const form = document.getElementById("studentForm");
//input forms
const lrn = document.getElementById("LRN");
const firstName = document.getElementById("firstName");
const middleName = document.getElementById("middleName");
const lastName = document.getElementById("lastName");

const maleBtn = document.getElementById("male");
const femaleBtn = document.getElementById("female");

const address = document.getElementById("address");
const gradeLvl = document.getElementById("gradeLvl");
const section = document.getElementById("section")
const birthday = document.getElementById("bday");
const studentContact = document.getElementById("studentContactNo");
const parentContact = document.getElementById("parentContactNo");
//submit btn
const submit = document.getElementById("submitrecord");
const clear = document.getElementById("clearBtn");
let genderAnswer;

if(maleBtn.checked){
    genderAnswer = "Male";
}
else if(femaleBtn.checked){
    genderAnswer = "Female";
}

submit.addEventListener("click", function(event){
    event.preventDefault();
}, submitData)
function submitData(){
    
    if(!form.checkValidity()){
        console.log(1)
        form.reportValidity();
        return;
    }
}

displayData();

function displayData(){
    $.post("javascript/php/dbstudent.php",{
        func_name: "GetStudentInput",
    }, function(data){
        students = JSON.parse(data);
        $("#lamesa > tbody").empty();
        students.forEach((student, index) =>{
            let row = `<tr>
                            <td>${student.LRN}</td>
                            <td>${student.first_name}</td>
                            <td>${student.middle_name}</td>
                            <td>${student.last_name}</td>
                            <td>${student.gender}</td>
                            <td>${student.address}</td>
                            <td class="text-center">${student.grade_level}</td>
                            <td>${student.section}</td>
                            <td>${student.birthday}</td>
                            <td>${student.parent_contact_no}</td>

                        <td>
                            <button class="btn btn-success btn-sm"
                            onclick="editInput(${index})"><a href="#studentForm" class="text-white text-decoration-none">
                            Edit</a>
                            </button>

                            <button type="button" class="btn btn-danger btn-sm"
                            onclick="deleteInput(${index})">
                            Delete
                            </button>
                        </td>
                    </tr>`;
            $("#lamesa > tbody").append(row);
        });
    })
    // GetNewNumber();
}

function deleteInput(index){
    let name = students[index].first_name + " " + (students[index].last_name);
    let result = confirm("Do you want to delete " + name + "?");

       if (result) {
           $.post("javascript/php/dbstudent.php", {
               func_name: "DeleteRecord",
               LRN: students[index].LRN
           }, function() {
                displayData();
           });

       }   

}

function editInput(index){
    let student = students[index];
    $("#clearBtn").text("Cancel");
    $("#submitrecord").text("Edit Record");
    $("#LRN").prop("disabled", true);

    $("#LRN").val(student.LRN);
    $("#firstName").val(student.first_name);
    $("#middleName").val(student.middle_name);
    $("#lastName").val(student.last_name);
    //radiobuttons
    // --- Radio buttons (Gender) ---
    $("#male, #female").prop("checked", false);

     if (student.gender === "Male") {
        $("#male").prop("checked", true);
    } else if (student.gender === "Female") {
        $("#female").prop("checked", true);
    }

    genderAnswer = student.gender;

    $("#address").val(student.address);
    $("#gradeLvl").val(student.grade_level);
    $("#section").val(student.section);
    $("#bday").val(student.birthday);
    $("#studentContactNo").val(student.student_contact_no);
    $("#parentContactNo").val(student.parent_contact_no);
}

//submit boy
$("#submitrecord").click(function(){
if (!form.checkValidity()) {
    form.reportValidity();
    return;
}
if(maleBtn.checked){
    genderAnswer = "Male";
}
else if(femaleBtn.checked){
    genderAnswer = "Female";
}
    $("#LRN").prop("disabled", false);

$.post("javascript/php/dbstudent.php",{
    func_name: "SaveRecord",

    LRN: $("#LRN").val(),
    first_name: $("#firstName").val(),
    middle_name: $("#middleName").val(),
    last_name: $("#lastName").val(),
    gender: genderAnswer,
    address: $("#address").val(),
    grade_level:$("#gradeLvl").val(),
    section: $("#section").val(),
    birthday:$("#bday").val(),
    student_contact_no:$("#studentContactNo").val(),
    parent_contact_no:$("#parentContactNo").val()

}, function(response){  
    console.log(response);
    displayData();
    clearForm();
    // GetNewNumber();
})
    
})


function clearForm(){
    $("#clearBtn").text("Clear");
    $("#submitrecord").text("Save Record");
    $("#LRN").prop("disabled", false);
    form.reset();
}
clear.addEventListener("click", clearForm)