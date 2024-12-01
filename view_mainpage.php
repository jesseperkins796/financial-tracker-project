<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <style>
        #nav-bar {
            width: 15vw;
            min-width: 162px;
        }

        #content {
            margin-left: 15vw;
        }

        #new {
            width: 8vw;
        }

        #dash-container {
            min-width: 100%;
        }
        
    </style>
</head>
<body class="bg-light">
    <!--  Nav Bar  -->
    <div class="position-absolute h-100 border-end border-2 shadow-sm bg-light d-flex align-items-center" id="nav-bar">
        <ul class="nav flex-column w-100 p-3 gap-4">
            <li class="nav-item rounded-3">
                <form action="/~w3jperkins/term-project/controller.php" method="post">
                    <input type="hidden" name="page" value="MainPage">
                    <input type="hidden" name="command" value="Dashboard">

                    <button class="btn btn-primary fs-5 w-100" type="submit">Dashboard</button>
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
                Hello 
                <span class="text-capitalize" id="name"><?php echo getFirstName($_SESSION["username"]);?></span>!&#128075
                Here is your dashboard where you can see all of your stats and recent transactions.
            </div>
        </div>

        <!--  Dashboard  -->
        <div id="dash" class="shadow-sm border border-2 bg-light rounded-3 m-2 p-3">
            <div id="dash-container" class="container text-center">
                <div class="row gap-4">
                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">
                        <h3>Total Balance</h3>
                        <span id="totalBalance"></span>
                    </div>
                    
                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">
                        <h3>Total Income</h3>
                        <span id="totalIncome"></span>
                    </div>
                    
                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">
                        <h3>Total Spending</h3>
                        <span id="totalSpending"></span>
                    </div>
                </div>

                <br>
                
                <div class="row gap-4">
                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">
                        <h3>Monthly Balance</h3>
                        <span id="monthlyBalance"></span>
                    </div>
                    
                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">
                        <h3>Monthly Income</h3>
                        <span id="monthlyIncome"></span>
                    </div>
                    
                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">
                        <h3>Monthly Spending</h3>
                        <span id="monthlySpending"></span>
                    </div>
                </div><br>
                
                <div class="row gap-4">
                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">
                        <h3>Avg. Savings Rate</h3>
                        <span id="avgRate">20%</span>
                    </div>
                    
                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">
                        <h3 id="monthNeeds">Needs</h3>
                        <span id="monthNeedsRate">10%</span>
                    </div>
                    
                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">
                        <h3 id="monthWants">Wants</h3>
                        <span id="monthWantsRate">5%</span>
                    </div>
                    <div class="col border p-2 rounded-3 bg-light fs-2 shadow">
                        <h3 id="monthSavings">Savings</h3>
                        <span id="monthSavingsRate">5%</span>
                    </div>
                </div><br>
            </div>
            
        </div>

        <!--  Add Transaction Button  -->
        <div class="d-flex justify-content-end m-2">
            <button id="newTransaction" class="btn btn-primary fs-5" data-bs-toggle="modal" data-bs-target="#transactionModal">+ New Transaction</button>
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
                            <input type="hidden" name="page" value="MainPage">
                            <input type="hidden" name="command" value="AddTransaction">
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="amount" name="amount" step=".01" placeholder="Amount" required>
                                    <label for="amount">Amount</label>
                                </div>
                                <div class="invalid-feedback">
                                    Please enter a number.
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

        <!--  Recent Transactions  -->
        <div id="recent" class="flex-fill shadow-sm border border-2 bg-light rounded-3 m-2">
            <table id="tbl" class="table table-striped-columns table-light align-middle table-hover">
                <thead>
                    <tr>
                        <th class="fs-4">Amount</th>
                        <th class="fs-4">Category</th>
                        <th class="fs-4">Account</th>
                        <th class="fs-4">Date</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
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

    //----- Total Balance Calculation -----
    function setTotalBalance() {
        let totalBalance = 
            <?php 
                $income = getIncome($_SESSION["username"]);
                $spending = getSpending($_SESSION["username"]);
                $total = $income - $spending;
                echo $total;
            ?>;
        document.getElementById("totalBalance").innerText = "$" + Intl.NumberFormat().format(Math.abs(totalBalance));
        if (totalBalance > 0) {
            document.getElementById("totalBalance").style.color = "green";
        } else if (totalBalance < 0) {
            document.getElementById("totalBalance").innerText = "($" + Intl.NumberFormat().format(Math.abs(totalBalance)) + ")";
            document.getElementById("totalBalance").style.color = "red";
        } else if (totalBalance == 0) {
            document.getElementById("totalBalance").style.color = "grey";
        }
    }
    setTotalBalance();

    //----- Total Income Calculation -----
    function setTotalIncome() {
        let totalIncome = 
            <?php 
                $income = getIncome($_SESSION["username"]);
                if (empty($income)) {
                    $income = 0;
                }
                echo $income;
            ?>;
        document.getElementById("totalIncome").innerText = "$" + Intl.NumberFormat().format(totalIncome);
        document.getElementById("totalIncome").style.color = "green";
    }
    setTotalIncome();

    //----- Total Spending Calculation -----
    function setTotalSpending() {
        let totalSpending = 
            <?php 
                $spending = getSpending($_SESSION["username"]);
                if (empty($spending)) {
                    $spending = 0;
                }
                echo $spending;
            ?>;
        document.getElementById("totalSpending").innerText = "($" + Intl.NumberFormat().format(totalSpending) + ")";
        document.getElementById("totalSpending").style.color = "red";
    }
    setTotalSpending();

    //----- Monthly Balance Calculation -----
    function setMonthlyBalance() {
        let monthlyBalance = 
            <?php 
                $income = getMonthIncome($_SESSION["username"]);
                $spending = getMonthSpending($_SESSION["username"]);
                $total = $income - $spending;
                echo $total;
            ?>;
        document.getElementById("monthlyBalance").innerText = "$" + Intl.NumberFormat().format(Math.abs(monthlyBalance));
        if (monthlyBalance > 0) {
            document.getElementById("monthlyBalance").style.color = "green";
        } else if (monthlyBalance < 0) {
            document.getElementById("monthlyBalance").innerText = "($" + Intl.NumberFormat().format(Math.abs(monthlyBalance)) + ")";
            document.getElementById("monthlyBalance").style.color = "red";
        } else if (monthlyBalance == 0) {
            document.getElementById("monthlyBalance").style.color = "grey";
        }
    }
    setMonthlyBalance();

    //----- Monthly Income Calculation -----
    function setMonthlyIncome() {
        let monthlyIncome = 
            <?php 
                $income = getMonthIncome($_SESSION["username"]);
                if (empty($income)) {
                    $income = 0;
                }
                echo $income;
            ?>;
        document.getElementById("monthlyIncome").innerText = "$" + Intl.NumberFormat().format(monthlyIncome);
        document.getElementById("monthlyIncome").style.color = "green";
    }
    setMonthlyIncome();
    

    //----- Monthly Spending Calculation -----
    function setMonthlySpending() {
        let monthlySpending = 
            <?php 
                $spending = getMonthSpending($_SESSION["username"]);
                if (empty($spending)) {
                    $spending = 0;
                }
                echo $spending;
            ?>;
        document.getElementById("monthlySpending").innerText = "($" + Intl.NumberFormat().format(monthlySpending) + ")";
        document.getElementById("monthlySpending").style.color = "red";
    }
    setMonthlySpending();
    
    //----- Average Savings Calculation -----
    function setAvgSavingsRate() {
        let income = 
            <?php 
                $result = getIncome($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
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
        let result = 0;
        if (income != 0) {
            result = ((totalSavings) / income) * 100;
        }
        let r = result.toFixed(2);

        document.getElementById("avgRate").innerText = r + "%";
    }
    setAvgSavingsRate();

    //----- Needs Calculation -----
    function setNeedsRate() {
        let needs = 
            <?php 
                $result = getNeeds($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let total = 
            <?php 
                $result = getThisMonthIncome($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let rate = 0;
        if (total != 0) {
            rate = (needs / total) * 100;
        }
        let r = rate.toFixed(2);
        
        document.getElementById("monthNeedsRate").innerText = r + "%";
    }
    setNeedsRate();
    
    //----- Wants Calculation -----
    function setWantsRate() {
        let wants = 
            <?php 
                $result = getWants($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let total = 
            <?php 
                $result = getThisMonthIncome($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let rate = 0;
        if (total != 0) {
            rate = (wants / total) * 100;
        }
        let r = rate.toFixed(2);
        
        document.getElementById("monthWantsRate").innerText = r + "%";
    }
    setWantsRate();

    //----- Savings Rate -----
    function setSavingsRate() {
        let savings = 
            <?php 
                $result = getSavings($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let total = 
            <?php 
                $result = getThisMonthIncome($_SESSION["username"]);
                if (empty($result)) {
                    $result = 0;
                }
                echo $result;
            ?>;
        let rate = 0;
        if (total != 0) {
            rate = (savings / total) * 100;
        }
        let r = rate.toFixed(2);
        
        document.getElementById("monthSavingsRate").innerText = r + "%";
    }
    setSavingsRate();

    let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    let thisMonth = new Date();
    document.getElementById("monthNeeds").innerText = months[thisMonth.getMonth()] + " Needs";
    document.getElementById("monthWants").innerText = months[thisMonth.getMonth()] + " Wants";
    document.getElementById("monthSavings").innerText = months[thisMonth.getMonth()] + " Savings";
    document.getElementById("date").max = "";

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
            str += "<tr>";
            
            for (let j in data[i]) {
                if (j != "Id") {
                    if (j == "Amount") {
                        if (data[i]["Category"] == "Income") {
                            str += "<td class='fs-5 text-success'>$" + Intl.NumberFormat().format(data[i][j]) + "</td>";
                        } else {
                            str += "<td class='fs-5 text-danger'>$" + Intl.NumberFormat().format(data[i][j]) + "</td>";
                        }
                    } else {
                        str += "<td class='fs-5'>" + data[i][j] + "</td>";
                    }
                }
                    
            }
            str += "<td data-id='" + data[i]["Id"] + "' class='fit-btn-content text-center'><button class='btn btn-danger w-75 fs-5'>Delete</button>" + "</td>";

            str += "</tr>";
            str += "</tbody>";
        }
        
        str += "</table>";

        document.getElementById("recent").innerHTML = str;

        document.querySelectorAll("td[data-id]").forEach(function(eobj) {
            eobj.addEventListener("click", function() {
                let xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let newData = JSON.parse(this.responseText);
                        makeTable(newData);
                        updateTotalBalance();
                        updateTotalIncome();
                        updateTotalSpending();
                        updateMonthlyBalance();
                        updateMonthlyIncome();
                        updateMonthlySpending();
                        updateAvgSavingsRate();
                        updateNeedsRate();
                        updateWantsRate();
                        updateSavingsRate();
                    }
                };
                let id = this.getAttribute("data-id");
                let query = "page=MainPage&command=RefreshTable&DeleteId=" + id;
                xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(query);
            })
        });
        return str;
    }

    var purchases =
        <?php
            $transactions = getRecentTransactions($_SESSION["username"]);
            echo $transactions;
        ?>;

    window.onload = function() {
        makeTable(purchases);
    }


    //----- Update Dashboard Functions -----
    function updateTotalBalance() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let totalBalance = this.responseText;

                document.getElementById("totalBalance").innerText = "$" + Intl.NumberFormat().format(Math.abs(totalBalance));
                if (totalBalance > 0) {
                    document.getElementById("totalBalance").style.color = "green";
                } else if (totalBalance < 0) {
                    document.getElementById("totalBalance").innerText = "($" + Intl.NumberFormat().format(Math.abs(totalBalance)) + ")";
                    document.getElementById("totalBalance").style.color = "red";
                } else if (totalBalance == 0) {
                    document.getElementById("totalBalance").style.color = "grey";
                }
            }
        };
        let query = "page=MainPage&command=UpdateTotalBalance";
        xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateTotalIncome() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let totalIncome = this.responseText;
                
                document.getElementById("totalIncome").innerText = "$" + Intl.NumberFormat().format(totalIncome);
                document.getElementById("totalIncome").style.color = "green";
            }
        };
        let query = "page=MainPage&command=UpdateTotalIncome";
        xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateTotalSpending() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let totalSpending = this.responseText;
                
                document.getElementById("totalSpending").innerText = "($" + Intl.NumberFormat().format(totalSpending) + ")";
                document.getElementById("totalSpending").style.color = "red";
            }
        };
        let query = "page=MainPage&command=UpdateTotalSpending";
        xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateMonthlyBalance() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let monthlyBalance = this.responseText;

                document.getElementById("monthlyBalance").innerText = "$" + Intl.NumberFormat().format(Math.abs(monthlyBalance));
                if (monthlyBalance > 0) {
                    document.getElementById("monthlyBalance").style.color = "green";
                } else if (monthlyBalance < 0) {
                    document.getElementById("monthlyBalance").innerText = "($" + Intl.NumberFormat().format(Math.abs(monthlyBalance)) + ")";
                    document.getElementById("monthlyBalance").style.color = "red";
                } else if (monthlyBalance == 0) {
                    document.getElementById("monthlyBalance").style.color = "grey";
                }
            }
        };
        let query = "page=MainPage&command=UpdateMonthlyBalance";
        xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateMonthlyIncome() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let monthlyIncome = this.responseText;
                
                document.getElementById("monthlyIncome").innerText = "$" + Intl.NumberFormat().format(monthlyIncome);
                document.getElementById("monthlyIncome").style.color = "green";
            }
        };
        let query = "page=MainPage&command=UpdateMonthlyIncome";
        xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateMonthlySpending() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let monthlySpending = this.responseText;
                
                document.getElementById("monthlySpending").innerText = "($" + Intl.NumberFormat().format(monthlySpending) + ")";
                document.getElementById("monthlySpending").style.color = "red";
            }
        };
        let query = "page=MainPage&command=UpdateMonthlySpending";
        xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }
    
    function updateAvgSavingsRate() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let result = parseFloat(this.responseText);
                if (isNaN(result)) {
                    result = 0;
                }

                let r = result.toFixed(2);
                document.getElementById("avgRate").innerText = r + "%";
            }
        };
        let query = "page=MainPage&command=UpdateAvgSavingsRate";
        xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateNeedsRate() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let result = parseFloat(this.responseText);
                if (isNaN(result)) {
                    result = 0;
                }

                let r = result.toFixed(2);
                document.getElementById("monthNeedsRate").innerText = r + "%";
            }
        };
        let query = "page=MainPage&command=UpdateNeedsRate";
        xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateWantsRate() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let result = parseFloat(this.responseText);
                if (isNaN(result)) {
                    result = 0;
                }

                let r = result.toFixed(2);
                document.getElementById("monthWantsRate").innerText = r + "%";
            }
        };
        let query = "page=MainPage&command=UpdateWantsRate";
        xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function updateSavingsRate() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let result = parseFloat(this.responseText);
                if (isNaN(result)) {
                    result = 0;
                }

                let r = result.toFixed(2);
                document.getElementById("monthSavingsRate").innerText = r + "%";
            }
        };
        let query = "page=MainPage&command=UpdateSavingsRate";
        xhttp.open("POST", "/~w3jperkins/term-project/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

</script>
</html>
