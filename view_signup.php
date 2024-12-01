<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        #err-msg {
            display: none;
        }
    </style>
</head>
<body class="bg-light">
    <div class="p-5"></div>
    <div class="p-5"></div>
    
    <div class="container w-50">
        <form action="/~w3jperkins/term-project/controller.php" method="post" class="needs-validation bg-white rounded-3 p-3 shadow" novalidate>
            <input type="hidden" name="page" value="SignUpPage">
            <input type="hidden" name="command" value="SignedUp">

            <p class="fs-3">Please Fill In The Form To Make An Account With Us</p>

            <div class="form-floating">
                <input type="text" class="form-control rounded-2" id="firstname" placeholder="Enter your first name" name="firstname" required>
                <label for="firstname" class="form-label">First Name:</label>
                <div class="invalid-feedback">
                    Please enter in your first name.
                </div>
            </div><br>

            <div class="form-floating">
                <input type="text" class="form-control rounded-2" id="lastname" placeholder="Enter your last name" name="lastname" required>
                <label for="lastname" class="form-label">Last Name:</label>
                <div class="invalid-feedback">
                    Please enter in your last name.
                </div>
            </div><br>

            <div class="form-floating">
                <input type="text" class="form-control rounded-2" id="username" placeholder="Enter username" name="username" required>
                <label for="username" class="form-label">Username:</label>
                <div class="invalid-feedback">
                    Please enter in your username.
                </div>
            </div><br>

            <div class="form-floating">
                <input type="password" class="form-control rounded-2" id="password" placeholder="Enter password" name="password" required>
                <label for="password" class="form-label">Password:</label>
                <div class="invalid-feedback">
                    Please enter in your password.
                </div>
            </div><br>

            <div class="form-floating">
                <input type="email" class="form-control rounded-2" id="email" placeholder="Enter email" name="email" required>
                <label for="email" class="form-label">Email:</label>
                <div class="invalid-feedback">
                    Please enter in your email.
                </div>
            </div><br>

            <button type="submit" class="btn btn-primary">Sign Up</button><br>

            <label class="fw-lighter bg-danger-subtle text-danger border border-danger p-1 mt-2 rounded-2" id="err-msg">That username already exists.</label>
        </form>
    </div>

    <div class="d-flex justify-content-center">
        <form action="/~w3jperkins/term-project/controller.php" method="post">
            <input type="hidden" name="page" value="SignUpPage">
            <input type="hidden" name="command" value="SignIn">

            <button type="submit" class="btn fw-lighter"><u>Already have an account? Click here to sign in</u></button>
        </form>
    </div>
</body>
</html>
<script defer>
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