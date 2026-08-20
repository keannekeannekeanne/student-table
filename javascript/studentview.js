// studentview.js
//
// Handles how a student ends up seeing their own record:
//   1. URL params from login.php:  ?mode=view&lrn=..&first=..&last=..&pin=..
//                                   ?mode=register&lrn=..&first=..&last=..
//   2. The top navbar "Login" button -> opens the in-page login modal
//      (LRN + first + last + PIN).
//   3. The top navbar "Register" button -> reveals a blank form.
//   4. A saved session in localStorage, re-verified against the server.
//
// While logged in:
//   - Login/Register in the top navbar are swapped for a user chip
//     (avatar + name) with a dropdown: Edit Info / Logout.
//   - The registration form is fully hidden so only the left-nav panels show:
//     Student Info (their record), Medical Profile, Checkup History.
//   - After finishing registration (or editing, if no PIN is on file yet),
//     a modal asks them to set a PIN, which is then required to log in.
//
// Backend contract (javascript/php/dbstudent.php):
//   func_name = "CheckStudent", LRN, first_name, last_name, pin_number
//   -> JSON array: one row if it matches, [] if not.
//   func_name = "SetPin", LRN, pin_number
//   -> "1" on success, "0" on failure.
//
// NOTE: staff/"see all records" login is intentionally not wired up yet.

$(function(){
    const form = document.getElementById("studentForm");
    
    const formPanel = document.querySelector(".form-panel");
    const recordsHeading = document.querySelector(".records-head h2");

    const loginModal = document.getElementById("loginModal");
    const loginBackdrop = document.getElementById("loginBackdrop");

    const pinModal = document.getElementById("pinModal");
    const pinBackdrop = document.getElementById("pinBackdrop");

    const pageNav = document.querySelector(".page-nav");
    const openLoginModalBtn = document.getElementById("openLoginModal");
    const registerNavBtn = document.getElementById("registerNavBtn");

    const userChip = document.getElementById("userChip");
    const userChipBtn = document.getElementById("userChipBtn");
    const userChipMenu = document.getElementById("userChipMenu");
    const userChipName = document.getElementById("userChipName");
    const userAvatarInitials = document.getElementById("userAvatarInitials");

    let loggedInStudent = null; // set once CheckStudent succeeds
    let pendingPinIdentity = null; // { LRN, first_name, last_name } captured right before save

    // ---------- section visibility helpers ----------
    function hiderecord(){ $("#tablecontainer").hide(); }
    function showrecord(){ $("#tablecontainer").show(); }
    function showForm(){ $("#formContainer").show(); }
    function hideForm(){ $("#formContainer").hide(); }
    function ClearForm(){
        hideForm();
        showrecord();
        form.reset();
    }
    hiderecord();

    function showPanel(action){
        hiderecord();
        $("#medicalProfilePanel").hide();
        $("#checkupHistoryPanel").hide();

        if(action === "medical-profile"){
            $("#medicalProfilePanel").show();
        }else if(action === "checkup-history"){
            $("#checkupHistoryPanel").show();
        }else{
            showrecord();
        }
    }

    // ---------- persisted session (survives closing the tab/browser) ----------
    const SESSION_KEY = "csnhsStudentSession";

    function saveSession(values){
        try{
            localStorage.setItem(SESSION_KEY, JSON.stringify(values));
        }catch(e){ /* localStorage unavailable — session just won't persist */ }
    }
    function loadSession(){
        try{
            const raw = localStorage.getItem(SESSION_KEY);
            return raw ? JSON.parse(raw) : null;
        }catch(e){
            return null;
        }
    }
    function clearSession(){
        try{
            localStorage.removeItem(SESSION_KEY);
        }catch(e){ /* ignore */ }
    }

    // ---------- single source of truth for logged-in vs logged-out UI ----------
    function setLoggedIn(student){
        loggedInStudent = student;

        if(student){
            pageNav.classList.add("is-visible");

            openLoginModalBtn.style.display = "none";
            registerNavBtn.style.display = "none";
            userChip.style.display = "";

            const fullName = ((student.first_name || "") + " " + (student.last_name || "")).trim();
            userChipName.textContent = fullName || "Student";
            userAvatarInitials.textContent = (
                (student.first_name ? student.first_name.charAt(0) : "") +
                (student.last_name ? student.last_name.charAt(0) : "")
            ).toUpperCase();

            hideForm();
            if(formPanel) formPanel.style.display = "none";
            showPanel("student-info");
            $("#enrolledLearners").hide();
            if(recordsHeading) recordsHeading.textContent = "Your Info";
        }else{
            pageNav.classList.remove("is-visible");

            openLoginModalBtn.style.display = "";
            registerNavBtn.style.display = "";
            userChip.style.display = "none";
            userChipMenu.classList.remove("show");

            showForm();
            if(formPanel) formPanel.style.display = "";
            hiderecord();
            $("#medicalProfilePanel").hide();
            $("#checkupHistoryPanel").hide();
            if(recordsHeading) recordsHeading.textContent = "Enrolled Learners";
        }
    }

    // ---------- login modal open/close ----------
    function openLoginModal(){
        loginModal.classList.add("show");
        loginBackdrop.classList.add("show");
    }
    function closeLoginModal(){
        loginModal.classList.remove("show");
        loginBackdrop.classList.remove("show");
    }

    openLoginModalBtn.addEventListener("click", openLoginModal);
    document.getElementById("closeLoginModal").addEventListener("click", closeLoginModal);
    document.getElementById("cancelLoginModal").addEventListener("click", closeLoginModal);
    loginBackdrop.addEventListener("click", closeLoginModal);

    document.getElementById("modalRegisterLink").addEventListener("click", function(e){
        e.preventDefault();
        closeLoginModal();
        showRegisterForm();
    });

    // ---------- register (navbar button) ----------
    function showRegisterForm(){
        closeLoginModal();
        setLoggedIn(null);
        clearSession();
        clearRecordTable();

        window.location.hash = "studentForm";
    }

    registerNavBtn.addEventListener("click", showRegisterForm);

    // ---------- logout ----------
    function logout(){
        userChipMenu.classList.remove("show");
        setLoggedIn(null);
        clearSession();
        clearRecordTable();
        window.location.hash = "top";
    }

    // ---------- user chip dropdown ----------
    userChipBtn.addEventListener("click", function(e){
        e.stopPropagation();
        userChipMenu.classList.toggle("show");
    });
    document.addEventListener("click", function(){
        userChipMenu.classList.remove("show");
    });
    userChipMenu.addEventListener("click", function(e){
        e.stopPropagation();
    });

    document.getElementById("chipLogoutLink").addEventListener("click", function(e){
        e.preventDefault();
        logout();
    });
    
    document.getElementById("editInfoLink").addEventListener("click", function(e){
        e.preventDefault();
        $("#clearBtn").text("Cancel");
        $("#clearBtn").click(function(){
            ClearForm();
            alert("Edit Cancelled");
        });
        userChipMenu.classList.remove("show");
        if(!loggedInStudent) return;

        populateFormFromStudent(loggedInStudent);
        showForm();
        if(formPanel) formPanel.style.display = "";
        hiderecord();
        $("#medicalProfilePanel").hide();
        $("#checkupHistoryPanel").hide();

        window.location.hash = "studentForm";
    });

    function populateFormFromStudent(student){
        $("#LRN").val(student.LRN || "");
        $("#firstName").val(student.first_name || "");
        $("#middleName").val(student.middle_name || "");
        $("#lastName").val(student.last_name || "");

        const gender = (student.gender || "").toLowerCase();
        $("#male").prop("checked", gender === "male");
        $("#female").prop("checked", gender === "female");

        $("#gradeLvl").val(student.grade_level || "");
        $("#section").val(student.section || "");
        $("#bday").val(student.birthday || "");
        $("#address").val(student.address || "");
        $("#studentContactNo").val(student.student_contact_no || "");
        $("#parentContactNo").val(student.parent_contact_no || "");
    }

    document.querySelectorAll(".page-nav-link").forEach(function(link){
        link.addEventListener("click", function(e){
            if(!loggedInStudent){
                e.preventDefault();
                openLoginModal();
                return;
            }
            hideForm();
            showPanel(this.getAttribute("data-action"));
        });
    });

    // ---------- modal login submit ----------
    document.getElementById("modalLoginBtn").addEventListener("click", function(){
        const values = {
            LRN: $("#modalLRN").val().trim(),
            first_name: $("#modalFirstName").val().trim(),
            last_name: $("#modalLastName").val().trim(),
            pin_number: $("#modalPin").val().trim()
        };

        if(!values.LRN || !values.first_name || !values.last_name || !values.pin_number){
            alert("Please fill out LRN, first name, last name, and your PIN.");
            return;
        }

        checkStudent(values, function(student){
            if(!student){
                alert("We couldn't match that LRN, name, and PIN. If you don't have a record yet, register instead.");
                return;
            }

            setLoggedIn(student);
            saveSession(values);
            closeLoginModal();
            renderRecordRow(student);

            window.location.hash = "tablecontainer";
        });
    });

    // ---------- shared AJAX calls ----------
    function checkStudent(values, callback){
        $.post("javascript/php/dbstudent.php", {
            func_name: "CheckStudent",
            LRN: values.LRN,
            first_name: values.first_name,
            last_name: values.last_name,
            pin_number: values.pin_number || ""
        }, function(response){
            let records = [];
            try{
                records = JSON.parse(response);
            }catch(e){
                records = [];
            }
            callback(Array.isArray(records) ? records[0] : null);
        }).fail(function(){
            alert("Could not reach the server. Please try again.");
        });
    }

    function setPin(lrn, pin, callback){
        $.post("javascript/php/dbstudent.php", {
            func_name: "SetPin",
            LRN: lrn,
            pin_number: pin
        }, function(response){
            callback((response || "").toString().trim() === "1");
        }).fail(function(){
            callback(false);
        });
    }

    // ---------- table rendering: always just the logged-in student's row ----------
    function clearRecordTable(){
        const tbody = document.querySelector("#lamesa tbody");
        if(tbody) tbody.innerHTML = "";
    }

    function renderRecordRow(student){
        const tbody = document.querySelector("#lamesa tbody");
        if(!tbody) return;

        // Column order matches the existing #lamesa <thead> exactly:
        // LRN, First Name, Middle Name, Last Name, Gender, Address,
        // Grade Level, Section, Birthday, Parent Contact No., (actions)
        const cells = [
            student.LRN,
            student.first_name,
            student.middle_name,
            student.last_name,
            student.gender,
            student.address,
            student.grade_level,
            student.section,
            student.birthday,
            student.parent_contact_no
        ];

        const tr = document.createElement("tr");
        cells.forEach(function(value){
            const td = document.createElement("td");
            td.textContent = value || "\u2014";
            tr.appendChild(td);
        });
        tr.appendChild(document.createElement("td")); // actions column, left blank

        clearRecordTable();
        tbody.appendChild(tr);
    }

    // ---------- post-registration / post-edit PIN setup ----------
    function openPinModal(){
        pinModal.classList.add("show");
        pinBackdrop.classList.add("show");
        $("#newPin").val("");
        $("#confirmPin").val("");
    }
    function closePinModal(){
        pinModal.classList.remove("show");
        pinBackdrop.classList.remove("show");
    }
    pinBackdrop.addEventListener("click", closePinModal);

    // Capture-phase listener on the document so we read the form's values
    // before any existing save handler on #submitrecord has a chance to
    // reset the form.
    document.addEventListener("click", function(e){
        if(!e.target || e.target.id !== "submitrecord") return;

        const identity = {
            LRN: $("#LRN").val().trim(),
            first_name: $("#firstName").val().trim(),
            last_name: $("#lastName").val().trim()
        };

        if(loggedInStudent && loggedInStudent.pin_number){
            // Editing info that already has a PIN — no need to set one again.
            // Once the save has had time to finish, re-fetch the (possibly
            // updated) record and bring the "only their own record" table
            // back to the screen.
            const pin = loggedInStudent.pin_number;

            setTimeout(function(){
                const values = {
                    LRN: identity.LRN,
                    first_name: identity.first_name,
                    last_name: identity.last_name,
                    pin_number: pin
                };

                checkStudent(values, function(student){
                    if(!student) return;
                    setLoggedIn(student);
                    saveSession(values);
                    renderRecordRow(student);
                    window.location.hash = "tablecontainer";
                });
            }, 500);

            return;
        }

        pendingPinIdentity = identity;

        // Small delay so the existing save request has time to finish
        // before we prompt for a PIN.
        setTimeout(openPinModal, 500);
    }, true);

    document.getElementById("savePinBtn").addEventListener("click", function(){
        const newPin = $("#newPin").val().trim();
        const confirmPin = $("#confirmPin").val().trim();

        if(!newPin || !confirmPin){
            alert("Please fill out both PIN fields.");
            return;
        }
        if(newPin !== confirmPin){
            alert("Those PINs don't match. Please try again.");
            return;
        }
        if(!pendingPinIdentity || !pendingPinIdentity.LRN){
            alert("We lost track of your LRN — please try saving your info again.");
            closePinModal();
            return;
        }

        setPin(pendingPinIdentity.LRN, newPin, function(success){
            if(!success){
                alert("Could not save your PIN. Please try again.");
                return;
            }

            closePinModal();

            if(loggedInStudent){
                // Editing existing info: just update what we're holding in memory.
                loggedInStudent.pin_number = newPin;
                saveSession({
                    LRN: pendingPinIdentity.LRN,
                    first_name: pendingPinIdentity.first_name,
                    last_name: pendingPinIdentity.last_name,
                    pin_number: newPin
                });
            }else{
                // Fresh registration: log them straight in with the PIN they just set.
                const values = {
                    LRN: pendingPinIdentity.LRN,
                    first_name: pendingPinIdentity.first_name,
                    last_name: pendingPinIdentity.last_name,
                    pin_number: newPin
                };

                checkStudent(values, function(student){
                    if(!student) return;
                    setLoggedIn(student);
                    saveSession(values);
                    renderRecordRow(student);
                    window.location.hash = "tablecontainer";
                });
            }
        });
    });

    // ---------- incoming links from login.php ----------
    const params = new URLSearchParams(window.location.search);
    const mode = params.get("mode");
    const lrn = params.get("lrn");
    const first = params.get("first");
    const last = params.get("last");
    const pin = params.get("pin");

    if(mode === "register"){
        if(lrn) $("#LRN").val(lrn);
        if(first) $("#firstName").val(first);
        if(last) $("#lastName").val(last);
        clearRecordTable();
    }

    if(mode === "view" && lrn){
        const values = { LRN: lrn, first_name: first || "", last_name: last || "", pin_number: pin || "" };

        checkStudent(values, function(student){
            if(!student){
                alert("We couldn't match that record. Let's get you registered.");
                window.location.href = "StudentRecord.php?mode=register&lrn=" + encodeURIComponent(lrn)
                    + "&first=" + encodeURIComponent(first || "")
                    + "&last=" + encodeURIComponent(last || "");
                return;
            }

            setLoggedIn(student);
            saveSession(values);
            renderRecordRow(student);
        });
    }

    // No explicit mode in the URL -> try restoring a previously saved session
    // (re-verified against the server, in case the record or PIN changed)
    if(!mode){
        const session = loadSession();

        if(session && session.LRN){
            checkStudent(session, function(student){
                if(student){
                    setLoggedIn(student);
                    renderRecordRow(student);
                }else{
                    clearSession();
                }
            });
        }
    }
});