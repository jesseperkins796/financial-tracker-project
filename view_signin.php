<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        #err {
            display: none;
        }
    </style>
</head>
<body class="bg-light">
    <div class="p-5"></div>
    <div class="p-5"></div>
    
    <div class="container w-50">
        <form id="loginForm" action="/~w3jperkins/term-project/controller.php" method="post" class="needs-validation bg-white rounded-2 p-3 shadow" novalidate>
            <input type="hidden" name="page" value="SignInPage">
            <input type="hidden" name="command" value="SignIn">

            <p class="fs-3">Welcome! Please Sign In to View Your Account</p>

            <div class="form-floating">
                <input type="text" class="form-control rounded-2" id="username" placeholder="Username" name="username" autocomplete="new-username" required>
                <label for="username" class="form-label">Username:</label>
            </div><br>

            <div class="form-floating">
                <input type="password" class="form-control rounded-2" id="password" placeholder="Enter password" autocomplete="new-password" name="password" required>
                <label for="password" class="form-label">Password:</label>
                <div class="invalid-feedback">
                    Incorrect username or password.
                </div>
            </div><br>

            <button type="submit" class="btn btn-primary mr-2">Sign In</button><br><br>

            <span id="err" class="container text-bg-danger rounded-3 p-2">User doesn't exist.</span>
        </form>
    </div>
    
    <div class="d-flex justify-content-center">
        <form action="/~w3jperkins/term-project/controller.php" method="post">
            <input type="hidden" name="page" value="SignInPage">
            <input type="hidden" name="command" value="SignUp">

            <button type="submit" class="btn fw-lighter"><u>Don't have an account? Click here to sign up</u></button>
        </form>
    </div>
</body>
</html>
<script defer>
    let wrongUser = 
        <?php 
            if (empty($wrong_user)) {
                $wrong_user = "false";
            } 
            echo $wrong_user; 
        ?>;

    if (wrongUser) {
        document.getElementById("err").style.display = "inline";
    }
    
    //----- Form Validation -----
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
        })
    })()
</script>