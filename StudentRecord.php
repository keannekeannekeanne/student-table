<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/VarDesign.css">
    <link rel="icon" href="codenisir/king.jpg" type="jpeg">
    <script src="javascript/jquery-4.0.0.min.js"></script>
</head>
<body id="top">

<nav class="topbar">
    <div class="topbar-inner">
        <div class="topbar-brand">CSNHS Clinic</div>
        <div class="topbar-actions">
            <button type="button" class="btn-ghost btn-topbar" id="openLoginModal">Login</button>
            <button type="button" class="btn-primary btn-topbar" id="registerNavBtn">Register</button>

            <div class="user-chip" id="userChip" style="display:none;">
                <button type="button" class="user-chip-btn" id="userChipBtn">
                    <span class="user-avatar" id="userAvatarInitials"></span>
                    <span class="user-chip-name" id="userChipName"></span>
                    <span class="user-chip-caret" aria-hidden="true">&#9662;</span>
                </button>
                <div class="user-chip-menu" id="userChipMenu">
                    <a href="#" id="editInfoLink">Edit Info</a>
                    <a href="#" id="chipLogoutLink">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<nav class="page-nav" aria-label="Page navigation">
    <a href="#tablecontainer" class="page-nav-link" data-action="student-info">Student Info</a>
    <a href="#medicalProfilePanel" class="page-nav-link" data-action="medical-profile">Medical Profile</a>
    <a href="#checkupHistoryPanel" class="page-nav-link" data-action="checkup-history">Checkup History</a>
</nav>

<div class="modal-backdrop-custom" id="loginBackdrop"></div>
<div class="login-modal" id="loginModal" role="dialog" aria-modal="true" aria-labelledby="loginModalTitle">
    <div class="login-modal-dialog">
        <div class="login-modal-content">
            <div class="login-modal-header">
                <h5 id="loginModalTitle">Log in</h5>
                <button type="button" class="login-modal-close" id="closeLoginModal" aria-label="Close">&times;</button>
            </div>
            <div class="login-modal-body">
                <div class="grid">
                    <div class="field span-full lrninput">
                        <label for="modalLRN">LRN<span class="req">*</span></label>
                        <input type="number" id="modalLRN" required placeholder="114500231092">
                    </div>
                    <div class="field firstname">
                        <label for="modalFirstName">First Name<span class="req">*</span></label>
                        <input type="text" id="modalFirstName" required placeholder="First Name">
                    </div>
                    <div class="field lastname">
                        <label for="modalLastName">Last Name<span class="req">*</span></label>
                        <input type="text" id="modalLastName" required placeholder="Last Name">
                    </div>
                    <div class="field span-full">
                        <label for="modalPin">PIN Number<span class="req">*</span></label>
                        <input type="password" id="modalPin" required placeholder="4-6 digit PIN" inputmode="numeric" autocomplete="off">
                    </div>
                </div>
                <p class="note login-modal-note">No record yet? <a href="#" id="modalRegisterLink">Register instead</a>.</p>
            </div>
            <div class="login-modal-footer">
                <button type="button" class="btn-ghost" id="cancelLoginModal">Cancel</button>
                <button type="button" class="btn-primary" id="modalLoginBtn">Log in</button>
            </div>
        </div>
    </div>
</div>

<div class="modal-backdrop-custom" id="pinBackdrop"></div>
<div class="login-modal" id="pinModal" role="dialog" aria-modal="true" aria-labelledby="pinModalTitle">
    <div class="login-modal-dialog">
        <div class="login-modal-content">
            <div class="login-modal-header">
                <h5 id="pinModalTitle">Set your PIN</h5>
            </div>
            <div class="login-modal-body">
                <p class="note login-modal-note" style="margin-bottom:16px;">Choose a PIN you'll use to log in next time.</p>
                <div class="grid">
                    <div class="field span-full">
                        <label for="newPin">New PIN<span class="req">*</span></label>
                        <input type="password" id="newPin" required placeholder="4-6 digit PIN" inputmode="numeric" autocomplete="off">
                    </div>
                    <div class="field span-full">
                        <label for="confirmPin">Confirm PIN<span class="req">*</span></label>
                        <input type="password" id="confirmPin" required placeholder="Re-enter PIN" inputmode="numeric" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="login-modal-footer">
                <button type="button" class="btn-primary" id="savePinBtn">Save PIN</button>
            </div>
        </div>
    </div>
</div>

<div class="sheet" id="formContainer">

    <div class="letterhead">
        <div class="brand">
            <div class="brand-mark" aria-hidden="true"></div>
            <div class="brand-text">
                <div class="school-name">CSNHS Clinic</div>
            </div>
        </div>
    </div>

    <div class="title-row">
        <div>
            <h1>Student Information Form</h1>
            <p>Complete every required field to add this learner's record to the school system.</p>
        </div>
        <div class="legend">
            <span><b>*</b> required field</span>
        </div>
    </div>

    <div class="body-grid">
        <nav class="rail" aria-label="Form sections">
            <a href="#sec-student" data-tab="1"><span class="tab-chip"></span>Student</a>
            <a href="#sec-academic" data-tab="2"><span class="tab-chip"></span>Academic</a>
            <a href="#sec-contact" data-tab="3"><span class="tab-chip"></span>Contact</a>
        </nav>

        <div class="content" >
            <form class="form-panel" id="studentForm" novalidate>

                <section class="card" id="sec-student" data-tab="1">
                    <div class="card-head">
                        <span class="card-num">01</span>
                        <h2>Student Information</h2>
                    </div>
                    <p class="card-desc">Enter the learner's legal name and LRN exactly as recorded by DepEd.</p>
                    <div class="grid">
                        <div class="field span-2 lrninput">
                            <label for="LRN">LRN<span class="req">*</span></label>
                            <input type="number" required id="LRN" placeholder="114500231092">
                        </div>
                        <div class="field firstname">
                            <label for="firstName">First Name<span class="req">*</span></label>
                            <input type="text" required id="firstName" placeholder="First Name">
                        </div>
                        <div class="field middlename">
                            <label for="middleName">Middle Name</label>
                            <input type="text" id="middleName" placeholder="Middle Name">
                        </div>
                        <div class="field lastname">
                            <label for="lastName">Last Name<span class="req">*</span></label>
                            <input type="text" required id="lastName" placeholder="Last Name">
                        </div>
                        <div class="field span-full genderInput">
                            <label>Gender<span class="req">*</span></label>
                            <div id="gender" class="pillset">
                                <input type="radio" name="gender" id="male" class="mx-2" required>
                                <label for="male" class="mx-2">Male</label>
                                <input type="radio" name="gender" id="female" class="mx-2" required>
                                <label for="female" class="mx-2">Female</label>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="card" id="sec-academic" data-tab="2">
                    <div class="card-head">
                        <span class="card-num">02</span>
                        <h2>Academic Placement</h2>
                    </div>
                    <p class="card-desc">Where the learner is currently enrolled this school year.</p>
                    <div class="grid cols-3">
                        <div class="field gradelvl">
                            <label for="gradeLvl">Grade Level<span class="req">*</span></label>
                            <!-- <input type="text" required id="gradeLvl" placeholder="Grade Level"> -->
                            <select name="gradelevel" id="gradeLvl" required>
                                <option value="" disabled selected>--Grade Level--</option>
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                        </div>
                        <div class="field Section">
                            <label for="section">Section<span class="req">*</span></label>
                            <input type="text" id="section" required placeholder="Section">
                        </div>
                        <div class="field birthdate">
                            <label for="bday">Birthday<span class="req">*</span></label>
                            <input type="date" required id="bday" placeholder="Birthday">
                        </div>
                    </div>
                </section>

                <section class="card" id="sec-contact" data-tab="3">
                    <div class="card-head">
                        <span class="card-num">03</span>
                        <h2>Address &amp; Contact</h2>
                    </div>
                    <p class="card-desc">Numbers we can use to reach the learner's household directly.</p>
                    <div class="grid">
                        <div class="field span-full addressInput">
                            <label for="address">Address<span class="req">*</span></label>
                            <input type="text" required id="address" placeholder="Address">
                        </div>
                        <div class="field studentContact">
                            <label for="studentContactNo">Contact No.<span class="req">*</span></label>
                            <input type="number" required id="studentContactNo" placeholder="Student Contact No.">
                        </div>
                        <div class="field parentContact">
                            <label for="parentContactNo">Parent Contact No.<span class="req">*</span></label>
                            <input type="number" required id="parentContactNo" placeholder="Parent Contact No.">
                        </div>
                    </div>
                </section>

                <div class="actions">
                    <p class="note">Records are saved to the school's student database and can be edited later by the registrar.</p>
                    <div class="btn-row form-actions">
                        <button type="button" class="btn-ghost" id="clearBtn">Reset</button>
                        <button type="button" class="btn-primary btn-save" id="submitrecord">Save Record</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <p class="foot-strip">CSNHS CLINIC · STUDENT RECORD SYSTEM</p>
</div>

<div class="records-panel container" id="tablecontainer">
    <div class="records-head">
        <span class="card-num" id="enrolledLearners">04</span>
        <h2>Enrolled Learners</h2>
    </div>
    <table class="table table-success" id="lamesa">
        <thead>
            <tr>
                <th scope="col">LRN</th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Address</th>
                <th scope="col">Grade Level</th>
                <th scope="col">Section</th>
                <th scope="col">Birthday</th>
                <th scope="col">Parent Contact No.</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="records-panel container" id="medicalProfilePanel" style="display:none;">
    <div class="records-head">
        <h2>Medical Profile</h2>
    </div>
    <p class="note">Medical profile details aren't set up yet — check back soon.</p>
</div>

<div class="records-panel container" id="checkupHistoryPanel" style="display:none;">
    <div class="records-head">
        <h2>Checkup History</h2>
    </div>
    <p class="note">Checkup history isn't available yet — check back soon.</p>
</div>

<script src="javascript/VaruaJavascript.js"></script>
<script src="javascript/studentview.js"></script>
<script>
    
</script>
</body>
</html>