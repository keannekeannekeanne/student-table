<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSNHS Clinic — Log in</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/VarDesign.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="javascript/jquery-4.0.0.min.js"></script>
</head>
<body>

<div class="login-wrap">
    <div class="sheet login-sheet">

        <div class="letterhead">
            <div class="brand">
                <div class="brand-mark" aria-hidden="true"></div>
                <div class="brand-text">
                    <div class="school-name">CSNHS Clinic</div>
                </div>
            </div>
        </div>

        <div class="title-row login-title-row">
            <div>
                <h1>Log in</h1>
                <p>Enter your LRN and name to pull up your student record.</p>
            </div>
        </div>

        <div class="content login-content">
            <form class="form-panel" id="loginForm" novalidate>

                <section class="card">
                    <div class="grid">
                        <div class="field span-full lrninput">
                            <label for="lrninput">LRN<span class="req">*</span></label>
                            <input type="number" id="lrninput" required placeholder="114500231092">
                        </div>
                        <div class="field firstname">
                            <label for="firstName">First Name<span class="req">*</span></label>
                            <input type="text" id="firstName" required placeholder="First Name">
                        </div>
                        <div class="field lastname">
                            <label for="lastName">Last Name<span class="req">*</span></label>
                            <input type="text" id="lastName" required placeholder="Last Name">
                        </div>
                    </div>
                </section>

                <div class="actions login-actions">
                    <p class="note">No record on file yet? Log in anyway and we'll take you straight to registration.</p>
                    <div class="btn-row form-actions">
                        <button type="button" class="btn-ghost" id="registerBtn">Register instead</button>
                        <button type="button" class="btn-primary btn-save" id="loginBtn">Log in</button>
                    </div>
                </div>
            </form>
        </div>

        <p class="foot-strip">CSNHS CLINIC · STUDENT RECORD SYSTEM</p>
    </div>
</div>

<script src="javascript/login.js"></script>
</body>
</html>