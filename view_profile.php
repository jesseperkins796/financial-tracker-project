<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        #nav-bar {
            width: 15vw;
            min-width: 162px;
        }

        #content {
            margin-left: 15vw;
        }
        #buttons {
            width: 10vw;
        }
        #searchBar {
            height: 5vh;
        }
        #amount-filter, #category-filter, #account-filter, #date-filter {
            display: none;
        }
        #submit-btn {
            margin-top: 25vh;
        }
        #clearBtn, #lockBtn, #deleteBtn {
            width: 27%;
        }

    </style>
</head>
<body class="bg-light">

    <!--  Nav Bar -->
    <div class="position-absolute h-100 border-end border-2 shadow-sm bg-light d-flex align-items-center" id="nav-bar">
        <ul class="nav flex-column w-100 p-3 gap-4">
            <li class="nav-item rounded-3">
                <form action="/~w3jperkins/term-project/controller.php" method="post">
                    <input type="hidden" name="page" value="MainPage">
                    <input type="hidden" name="command" value="Dashboard">

                    <button class="btn btn-secondary fs-5 w-100" type="submit">Dashboard</button>
                </form>
            </li>

            <li class="nav-item rounded-3">
                <form action="/~w3jperkins/term-project/controller.php" method="post">
                    <input type="hidden" name="page" value="MainPage">
                    <input type="hidden" name="command" value="History">

                    <button class="btn btn-secondary fs-5 w-100" type="submit">History</button>
                </form>
            </li>

            <li class="nav-item rounded-3">
                <form action="/~w3jperkins/term-project/controller.php" method="post">
                    <input type="hidden" name="page" value="MainPage">
                    <input type="hidden" name="command" value="Profile">

                    <button class="btn btn-primary fs-5 w-100" type="submit">Profile</button>
                </form>
            </li>

            <li class="nav-item rounded-3">
                <form action="/~w3jperkins/term-project/controller.php" method="post">
                    <input type="hidden" name="page" value="MainPage">
                    <input type="hidden" name="command" value="SignOut">

                    <button class="btn btn-danger fs-5 w-100" type="submit">Sign Out</button>
                </form>
            </li>
        </ul>
    </div>
    
    <!-- Content Area -->
    <div class="d-flex flex-column vh-100" id="content">
        <!--  Greeting Card -->
        <div id="greeting" class="d-flex border border-2 bg-light rounded-3 m-2">
            <div class="fs-2 fw-medium p-3">
                Here is your profile information.
            </div>
        </div>

        <!-- Profile Area -->
        <div id="profile" class="d-flex border border-2 bg-light rounded-3 m-2 h-100">
            <div id="general-info" class="text-center w-50 m-2 border border-2 bg-light rounded-3">
                <h1 class="m-2">General Information</h1>
                <form action="/~w3jperkins/term-project/controller.php" method="post" class="needs-validation m-4" novalidate>
                    <input type="hidden" name="page" value="Profile">
                    <input type="hidden" name="command" value="GeneralInfo">

                    <div id="profileName" class="input-group mt-4">
                        <span class="input-group-text fs-4">Full Name</span>
                        <input type="text" class="form-control fs-4" id="firstName" name="firstName" value="">
                        <input type="text" class="form-control fs-4" id="lastName" name="lastName" value="">
                    </div>

                    <div id="profileUsername" class="input-group mt-4">
                        <span class="input-group-text fs-4">Username</span>
                        <input type="text" class="form-control fs-4" id="profileUser" name="profileUser" value="">
                    </div>

                    <div id="profilePassword" class="input-group mt-4">
                        <span class="input-group-text fs-4">Password</span>
                        <input type="text" class="form-control fs-4" id="profilePass" name="profilePass" value="">
                    </div>

                    <div id="profileEmail" class="input-group mt-4">
                        <span class="input-group-text fs-4">Email</span>
                        <input type="text" class="form-control fs-4" id="profilEm" name="profilEm" value="">
                    </div>

                    <div id="profileCountry" class="input-group mt-4">
                        <span class="input-group-text fs-4">Country</span>
                        <input type="text" class="form-control fs-4" id="profileC" name="profileC" value="" placeholder="Canada">
                    </div>

                    <div id="profilePhone" class="input-group mt-4">
                        <span class="input-group-text fs-4">Phone Number</span>
                        <input type="tel" class="form-control fs-4" id="profileP" name="profileP" value="" placeholder="123-456-7890">
                    </div>

                    <div id="submit-btn" class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary fs-4">Save</button>
                    </div>                
                </form>
            </div>

            <div class="d-flex flex-column flex-grow-1">
                <div id="account-summary" class="text-center border border-2 m-2 bg-light rounded-3">
                    <h1 class="m-2">Account Summary</h1>
                    
                    <div class="d-flex flex-column gap-4 m-4">
                        <div id="amountSaved" class="input-group mt-4">
                            <span class="input-group-text fs-4">Amount Saved</span>
                            <input type="text" class="form-control fs-4" id="savedA" name="saved" value="" readonly>
                        </div>

                        <div id="emergencyFund" class="input-group mt-4">
                            <span class="input-group-text fs-4">Emergency Fund</span>
                            <input type="text" class="form-control fs-4" id="emergencyA" name="emergency" value="$0" readonly>
                        </div>

                        <div id="travelFund" class="input-group mt-4">
                            <span class="input-group-text fs-4">Travel Fund</span>
                            <input type="text" class="form-control fs-4" id="travelA" name="travel" value="$0" readonly>
                        </div>
                    </div>
                    
                    <div id="" class="d-flex justify-content-end gap-3 m-4">
                        <button id="editAccounts" class="btn btn-secondary fs-4" data-bs-toggle="modal" data-bs-target="#transactionModal">Edit</button>
                    </div> 
                </div>
                
                <!-- Edit Modal -->
                <div class="modal fade" id="transactionModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Accounts</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/~w3jperkins/term-project/controller.php" method="post" class="needs-validation" novalidate>
                                    <input type="hidden" name="page" value="Profile">
                                    <input type="hidden" name="command" value="UpdateAccounts">
                                    
                                    <p>Get started on tracking your progress by entering the amount you already saved up.</p>
                                    
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="saved" name="saved" step=".01" placeholder="Chequing" required>
                                        <label for="saved">Amount Saved</label>
                                        <div class="invalid-feedback">
                                            Please input an amount.
                                        </div>
                                    </div><br>
            
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="emergency" name="emergency" step=".01" placeholder="Savings" required>
                                        <label for="emergency">Emergency Fund</label>
                                        <div class="invalid-feedback">
                                            Please input an amount.
                                        </div>
                                    </div><br>
            
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="travel" name="travel" step=".01" placeholder="credit" required>
                                        <label for="travel">Travel Fund</label>
                                        <div class="invalid-feedback">
                                            Please input an amount.
                                        </div>
                                    </div><br>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="other" class="text-center border m-2 border-2 bg-light rounded-3">
                    <h1 class="m-2">Profile Administration</h1>
                    
                    <div class="d-flex flex-column gap-4 m-4">
                        <div class="input-group">
                            <button id="clearBtn" class="btn btn-warning fs-4" data-bs-toggle="modal" data-bs-target="#clearModal">Clear Account</button>
                            <input id="clearAccount" class="form-control fs-5" type="text" value="This will clear all data related to your account." readonly>
                        </div>
                        
                        <div class="input-group">
                            <button id="deleteBtn" class="btn btn-danger fs-4" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Account</button>
                            <input id="deleteAccount" class="form-control fs-5" type="text" value="This will delete your account permenantly." readonly>
                        </div>
                    
                    </div>
                </div>
            </div>

            <!-- Clear Modal -->
            <div class="modal fade" id="clearModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="/~w3jperkins/term-project/controller.php" method="post" class="needs-validation" novalidate>
                                <input type="hidden" name="page" value="Profile">
                                <input type="hidden" name="command" value="ClearAccount">
                                
                                <p>All of your transactions and funds will be permanently erased if you continue. <br><br>Are you sure?</p>
                                
                                <div class="d-flex justify-content-start">
                                    <button type="submit" class="btn btn-danger">Yes, I Understand</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="/~w3jperkins/term-project/controller.php" method="post" class="needs-validation" novalidate>
                                <input type="hidden" name="page" value="Profile">
                                <input type="hidden" name="command" value="DeleteAccount">
                                
                                <p>Your account and all related information will be permanently deleted, and recovering your data will not be possible if you continue. <br><br>Are you sure?</p>
                                
                                <div class="d-flex justify-content-start">
                                    <button type="submit" class="btn btn-danger">Yes, I Understand</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<script defer>
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
    
    function getUserData() {
        let data =
        <?php
            $data = getUserData($_SESSION["username"]);
            echo $data;
        ?>;
        document.getElementById("firstName").value = data[0]["firstName"];
        document.getElementById("lastName").value = data[0]["lastName"];
        document.getElementById("profileUser").value = data[0]["Username"];
        document.getElementById("profilePass").value = data[0]["Password"];
        document.getElementById("profilEm").value = data[0]["Email"];
    }
    getUserData();

    function getUserDetails() {
        let data =
            <?php
                $data = getUserDetails($_SESSION["username"]);
                echo $data;
            ?>;
        if (data[0]["Country"] == "")
            document.getElementById("profileC").value = "";
        else
            document.getElementById("profileC").value = data[0]["Country"];

        if (data[0]["Phone"] == "")
            document.getElementById("profileP").value = "";
        else
            document.getElementById("profileP").value = data[0]["Phone"];
    }
    getUserDetails();

    function getAmountSaved() {
        let totalSavings = 
            <?php 
                $income = getIncome($_SESSION["username"]);
                if (empty($income)) {
                    $income = 0;
                }
                $needs = getTotalNeeds($_SESSION["username"]);
                if (empty($needs)) {
                    $needs = 0;
                }
                $wants = getTotalWants($_SESSION["username"]);
                if (empty($wants)) {
                    $wants = 0;
                }
                $result = $income - ($needs + $wants);
                echo $result;
            ?>;
        let funds =
            <?php
                $funds = getUserFunds($_SESSION["username"]);
                if (empty($funds)) {
                    $funds = 0;
                }
                echo $funds;
            ?>;

        let data = totalSavings + funds;
        data = data.toFixed(2);
        document.getElementById("savedA").value = "$" + Intl.NumberFormat().format(data);
    }
    getAmountSaved();

    function getEmergencyFund() {
        let data =
            <?php
                $funds = getUserEmergencyFunds($_SESSION["username"]);
                $transactions = getUserEmergencyTransactions($_SESSION["username"]);
                $total = $funds + $transactions;
                echo $total;
            ?>;
        
        document.getElementById("emergencyA").value = "$" + Intl.NumberFormat().format(data);
    }
    getEmergencyFund();

    function getTravelFund() {
        let data =
            <?php
                $funds = getUserTravelFunds($_SESSION["username"]);
                $transactions = getUserTravelTransactions($_SESSION["username"]);
                $total = $funds + $transactions;
                echo $total;
            ?>;
        
        document.getElementById("travelA").value = "$" + Intl.NumberFormat().format(data);
    }
    getTravelFund();
</script>