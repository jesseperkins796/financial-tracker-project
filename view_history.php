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

                    <button class="btn btn-primary fs-5 w-100" type="submit">History</button>
                </form>
            </li>

            <li class="nav-item rounded-3">
                <form action="/~w3jperkins/term-project/controller.php" method="post">
                    <input type="hidden" name="page" value="MainPage">
                    <input type="hidden" name="command" value="Profile">

                    <button class="btn btn-secondary fs-5 w-100" type="submit">Profile</button>
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

    <div class="d-flex flex-column vh-100" id="content">
        <!--  Greeting Card -->
        <div id="greeting" class="d-flex border border-2 bg-light rounded-3 m-2">
            <div class="fs-2 fw-medium p-3">
                Here are all your past transactions.
            </div>
        </div>
        
        <!-- Search Bar -->
        <div id="searchBar" class="m-2">
            <div class="input-group">
                <div class="form-floating">
                    <input type="search" class="form-control" id="search" placeholder="Search" onkeyup="searchTransactions(this.value)">
                    <label for="search">Search</label>
                </div>
            </div>
        </div>

        <!--  History Transactions  -->
        <div id="history" class="flex-fill shadow-sm border border-2 bg-light rounded-3 m-2">
            <table id="tbl" class="table table-striped-columns table-light align-middle table-hover">
                <thead>
                    <tr">
                        <th class="fs-4">Amount</th>
                        <th class="fs-4">Category</th>
                        <th class="fs-4">Account</th>
                        <th class="fs-4">Date</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>

        <!--  Modal  -->
        <div class="modal fade" id="transactionModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Transaction Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/~w3jperkins/term-project/controller.php" method="post" class="needs-validation" novalidate>
                            <input type="hidden" name="page" value="History">
                            <input type="hidden" name="command" value="EditTransaction">
                            <input type="hidden" id="editId" name="Id" value="">

                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="amount" name="amount" step=".01" placeholder="Amount" required>
                                    <label for="amount">Amount</label>
                                </div>
                                <div class="invalid-feedback">
                                    Please input an amount.
                                </div>
                            </div><br>
                            <div class="form-floating">
                                <select id="category" class="form-select" name="category" required>
                                    <option value="">Choose...</option>
                                    <option>Income</option>
                                    <option>Savings</option>
                                    <option>Rent</option>
                                    <option>Utilities</option>
                                    <option>Groceries</option>
                                    <option>Transport</option>
                                    <option>Entertainment</option>
                                    <option>Hobbies</option>
                                    <option>Travel Fund</option>
                                    <option>Emergency Fund</option>
                                </select>
                                <label for="category">Category</label>
                                <div class="invalid-feedback">
                                    Please choose a valid option.
                                </div>
                            </div><br>
                            <div class="form-floating">
                                <select id="account" class="form-select" name="account" required>
                                    <option value="">Choose...</option>
                                    <option>Chequing</option>
                                    <option>Savings</option>
                                    <option>Credit Card</option>
                                </select>
                                <label for="account">Account</label>
                                <div class="invalid-feedback">
                                    Please choose a valid option.
                                </div>
                            </div><br>
                            <div class="form-floating">
                                <input type="date" class="form-control" id="date" name="date" required>
                                <label for="date">Date</label>
                                <div class="invalid-feedback">
                                    Please choose a valid date.
                                </div>
                            </div><br>
                            <div class="w-100 d-flex flex-row-reverse gap-2">
                                <button type="submit" class="btn btn-primary" id="submitTransaction">Save Transaction</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
    
    //----- Contruct Transaction Table -----
    function makeTable(data) {
        let str = "";

        str = "<table id='tbl' class='table table-striped-columns table-light align-middle table-hover h-100'>";

        str += "<thead>";
        str += "<tr>";
        for (let i in data[0]) {
            if (i != "Id")
                str += "<th class='fs-4'>" + i + "</th>";
        }
        str += "</tr>";
        str += "</thead>";

        for (let i = 0; i < data.length; i++) {
            str += "<tbody class='table-group-divider'>";
            str += "<tr id='rows'>";
            
            for (let j in data[i]) {
                if (j != "Id") {
                    if (j == "Amount") {
                        if (data[i]["Category"] == "Income") {
                            str += "<td class='fs-5 text-success'>$" + data[i][j] + "</td>";
                        } else {
                            str += "<td class='fs-5 text-danger'>$" + data[i][j] + "</td>";
                        }
                    } else {
                        str += "<td class='fs-5'>" + data[i][j] + "</td>";
                    }
                }
                    
            }
            str += "<td class='fit-btn-content text-center' id='buttons'>" + "<button data-id='" + data[i]["Id"] + "' class='btn btn-secondary w-75 fs-5 mb-2' data-label='edit' data-bs-toggle='modal' data-bs-target='#transactionModal'>Edit</button>" + "<button data-label='delete' data-id='" + data[i]["Id"] + "' class='btn btn-danger w-75 fs-5'>Delete</button>" + "</td>";
            

            str += "</tr>";
            str += "</tbody>";
        }
        
        str += "</table>";

        document.getElementById("history").innerHTML = str;

        document.querySelectorAll("button[data-id]").forEach(function(eobj) {
            eobj.addEventListener("click", function() {
                let xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let newData = JSON.parse(this.responseText);
                        makeTable(newData);
                    }
                };
                let id = this.getAttribute("data-id");
                if (this.getAttribute("data-label") == "delete") {
                    let query = "page=History&command=RefreshTable&DeleteId=" + id;
                    xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send(query);
                } else if (this.getAttribute("data-label") == "edit") {
                    let id = this.getAttribute("data-id");
                    console.log("ID: " + id);
                    document.getElementById("editId").value = id;
                }
            });
        });

        return str;
    }

    var purchases =
        <?php
            $transactions = getTopTransactions($_SESSION["username"]);
            echo $transactions;
        ?>;

    window.onload = function() {
        makeTable(purchases);
    }

    //----- Search Bar AJAX Request
    function searchTransactions(string) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let newData = JSON.parse(this.responseText);
                makeTable(newData);
            }
        };
        let query = "page=History&command=UpdateSearch&SearchStr=" + string;
        xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }
</script>