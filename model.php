<?php
$conn = mysqli_connect('localhost', 'w3jperkins', 'w3jperkins136', 'C354_w3jperkins');

function isLoginValid($u, $p) {
    global $conn;
    $sql = "SELECT * FROM Users WHERE (Username = '$u') AND (Password = '$p')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function registerNewUser($fn, $ln, $u, $p, $e) {
    global $conn;
    $current_date = date("Ymd");
    $sql = "INSERT INTO Users(Id, firstName, lastName, Username, Password, Email, Date) VALUE (NULL, '$fn', '$ln', '$u', '$p', '$e', '$current_date')";
    $result = mysqli_query($conn, $sql);
}

function userExists($u) {
    global $conn;
    $sql = "SELECT * FROM Users WHERE (Username = '$u')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function getFirstName($u) {
    global $conn;
    $sql = "SELECT firstName FROM Users WHERE (Username = '$u')";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $firstName = $row["firstName"];
    }
    return $firstName;
}

function getIncome($u) {
    global $conn;
    $sql = "SELECT SUM(Amount) AS Income FROM Transactions WHERE (Username = '$u') AND (Category = 'Income')";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $income = $row["Income"];
    }
    return $income;
}

function getSpending($u) {
    global $conn;
    $sql = "SELECT SUM(Amount) AS Spending FROM Transactions WHERE (Username = '$u') AND (Category != 'Income')";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $spending = $row["Spending"];
    }
    return $spending;
}

function getMonthIncome($u) {
    global $conn;
    $current_day = date("Ymd");
    $beg_of_month = date("Ym") . "01";

    $sql = "SELECT SUM(Amount) AS Income FROM Transactions WHERE (Username = '$u') AND (Category = 'Income') AND (Date BETWEEN '$beg_of_month' AND '$current_day')";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $monthlyIncome = $row["Income"];
    }
    return $monthlyIncome;
}

function getMonthSpending($u) {
    global $conn;
    $current_day = date("Ymd");
    $beg_of_month = date("Ym") . "01";

    $sql = "SELECT SUM(Amount) AS Spending FROM Transactions WHERE (Username = '$u') AND (Category != 'Income') AND (Date BETWEEN '$beg_of_month' AND '$current_day')";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $monthlySpending = $row["Spending"];
    }
    return $monthlySpending;
}

function addTransaction($u, $amount, $category, $account, $date) {
    global $conn;
    $corrected_date = date("Y-m-d", strtotime(str_replace('-', '/', $date)));
    $sql = "INSERT INTO Transactions(Id, Username, Amount, Category, Account, Date) VALUE (NULL, '$u', '$amount', '$category', '$account', '$corrected_date')";
    $result = mysqli_query($conn, $sql);
}

function editTransaction($u, $id, $amount, $category, $account, $date) {
    global $conn;
    $corrected_date = date("Y-m-d", strtotime(str_replace('-', '/', $date)));
    $sql = "UPDATE Transactions SET Amount = '$amount', Username = '$u', Category = '$category', Account = '$account', Date = '$corrected_date' WHERE Id = '$id'";
    $result = mysqli_query($conn, $sql);
}

function getRecentTransactions($u) {
    global $conn;
    $current_date = date("Ymd");
    $sql = "SELECT Id, Amount, Category, Account, Date FROM Transactions WHERE (Username = '$u') AND (Date <= '$current_date') ORDER BY Date DESC, Id DESC LIMIT 3";
    $result = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            "Id" => $row["Id"],
            "Amount" => $row["Amount"],
            "Category" => $row["Category"],
            "Account" => $row["Account"],
            "Date" => $row["Date"]
        );
    }
    return json_encode($data);
}

function getTopTransactions($u) {
    global $conn;
    $current_date = date("Ymd");
    $sql = "SELECT Id, Amount, Category, Account, Date FROM Transactions WHERE (Username = '$u') AND (Date <= '$current_date') ORDER BY Date DESC, Id DESC";
    $result = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            "Id" => $row["Id"],
            "Amount" => $row["Amount"],
            "Category" => $row["Category"],
            "Account" => $row["Account"],
            "Date" => $row["Date"]
        );
    }
    return json_encode($data);
}

function deleteTransaction($u, $id) {
    global $conn;
    $current_date = date("Ymd");
    $sql = "DELETE FROM Transactions WHERE (Username = '$u') AND (Id = '$id')";
    $result = mysqli_query($conn, $sql);
}

function searchTransactions($u, $str) {
    global $conn;
    $current_date = date("Ymd");
    $sql = "SELECT Id, Amount, Category, Account, Date FROM Transactions WHERE (Username = '$u') AND (Date <= '$current_date') AND ((Amount LIKE '$str%') OR (Category LIKE '$str%') OR (Account LIKE '$str%') OR (Date LIKE '$str%')) ORDER BY Date DESC, Id DESC";
    $result = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            "Id" => $row["Id"],
            "Amount" => $row["Amount"],
            "Category" => $row["Category"],
            "Account" => $row["Account"],
            "Date" => $row["Date"]
        );
    }
    return json_encode($data);
}

function getThisMonthIncome($u) {
    global $conn;
    $current_month = date("Y-m");
    $sql = "SELECT SUM(Amount) AS MonthTotal FROM Transactions WHERE (Username = '$u') AND (Category = 'Income') AND (Date LIKE '$current_month%')";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $monthTotal = $row["MonthTotal"];
    }
    return $monthTotal;
}

function getNeeds($u) {
    global $conn;
    $current_month = date("Y-m");
    $sql = "SELECT SUM(Amount) AS Needs FROM Transactions WHERE (Username = '$u') AND ((Category = 'Rent') OR (Category = 'Utilities') OR (Category = 'Groceries') OR (Category = 'Transport')) AND (Date LIKE '%$current_month%')";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $needs = $row["Needs"];
    }
    return $needs;
}

function getWants($u) {
    global $conn;
    $current_month = date("Y-m");
    $sql = "SELECT SUM(Amount) AS Wants FROM Transactions WHERE (Username = '$u') AND ((Category = 'Entertainment') OR (Category = 'Hobbies')) AND (Date LIKE '%$current_month%')";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $wants = $row["Wants"];
    }
    return $wants;
}

function getTotalNeeds($u) {
    global $conn;
    $sql = "SELECT SUM(Amount) AS Needs FROM Transactions WHERE (Username = '$u') AND ((Category = 'Rent') OR (Category = 'Utilities') OR (Category = 'Groceries') OR (Category = 'Transport'))";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $needs = $row["Needs"];
    }
    return $needs;
}

function getTotalWants($u) {
    global $conn;
    $sql = "SELECT SUM(Amount) AS Wants FROM Transactions WHERE (Username = '$u') AND ((Category = 'Entertainment') OR (Category = 'Hobbies'))";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $wants = $row["Wants"];
    }
    return $wants;
}

function getSavings($u) {
    global $conn;
    $current_month = date("Y-m");
    $sql = "SELECT SUM(Amount) AS Wants FROM Transactions WHERE (Username = '$u') AND ((Category = 'Savings') OR (Category = 'Emergency Fund') OR (Category = 'Travel Fund')) AND (Date LIKE '%$current_month%')";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $savings = $row["Wants"];
    }
    return $savings;
}

function getUserData($u) {
    global $conn;
    $sql = "SELECT firstName, lastName, Username, Password, Email FROM Users WHERE (Username = '$u')";
    $result = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            "firstName" => $row["firstName"],
            "lastName" => $row["lastName"],
            "Username" => $row["Username"],
            "Password" => $row["Password"],
            "Email" => $row["Email"]
        );
    }
    return json_encode($data);
}

function addDetails($u, $c, $p) {
    global $conn;
    $sql = "INSERT INTO UserDetails(Id, Username, Country, Phone) VALUE (NULL, '$u', '$c', '$p')";
    $result = mysqli_query($conn, $sql);
}

function changeDetails($u, $c, $p) {
    global $conn;
    $sql = "UPDATE UserDetails SET Country = '$c', Phone = '$p' WHERE Username = '$u'";
    $result = mysqli_query($conn, $sql);
}

function getUserDetails($u) {
    global $conn;
    $sql = "SELECT Country, Phone FROM UserDetails WHERE (Username = '$u')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) != 0) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = array(
                "Country" => $row["Country"],
                "Phone" => $row["Phone"],
            );
        }
        return json_encode($data);
    } else {
        $data[] = array(
            "Country" => "",
            "Phone" => "",
        );
        return json_encode($data);
    }
}

function deleteDetails($u) {
    global $conn;
    $current_date = date("Ymd");
    $sql = "DELETE FROM UserDetails WHERE (Username = '$u')";
    $result = mysqli_query($conn, $sql);
}

function userDetailsExists($u) {
    global $conn;
    $sql = "SELECT * FROM UserDetails WHERE (Username = '$u')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function userFundsExists($u) {
    global $conn;
    $sql = "SELECT * FROM UserFunds WHERE (Username = '$u')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function addFunds($u, $saved, $emerg, $travel) {
    global $conn;
    $sql = "INSERT INTO UserFunds(Id, Username, AmountSaved, EmergencyFund, TravelFund) VALUE (NULL, '$u', '$saved', '$emerg', '$travel')";
    $result = mysqli_query($conn, $sql);
}

function updateFunds($u, $saved, $emerg, $travel) {
    global $conn;
    $sql = "UPDATE UserFunds SET AmountSaved = '$saved', EmergencyFund = '$emerg', TravelFund = '$travel' WHERE Username = '$u'";
    $result = mysqli_query($conn, $sql);
}

function getUserFunds($u) {
    global $conn;
    $sql = "SELECT SUM(AmountSaved) AS Saved FROM UserFunds WHERE Username = '$u'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $savings = $row["Saved"];
    }
    return $savings;
}

function getUserEmergencyFunds($u) {
    global $conn;
    $sql = "SELECT SUM(EmergencyFund) AS Emerg FROM UserFunds WHERE Username = '$u'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $emerg = $row["Emerg"];
    }
    return $emerg;
}

function getUserEmergencyTransactions($u) {
    global $conn;
    $sql = "SELECT SUM(Amount) AS Emerg FROM Transactions WHERE (Username = '$u') AND (Category = 'Emergency Fund')";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $emerg = $row["Emerg"];
    }
    return $emerg;
}

function getUserTravelFunds($u) {
    global $conn;
    $sql = "SELECT SUM(TravelFund) AS Travel FROM UserFunds WHERE Username = '$u'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $travel = $row["Travel"];
    }
    return $travel;
}

function getUserTravelTransactions($u) {
    global $conn;
    $sql = "SELECT SUM(Amount) AS Travel FROM Transactions WHERE (Username = '$u') AND (Category = 'Travel Fund')";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $travel = $row["Travel"];
    }
    return $travel;
}

function clearUserTransactions($u) {
    global $conn;
    $sql = "DELETE FROM Transactions WHERE (Username = '$u')";
    $result = mysqli_query($conn, $sql);
}

function clearUserDetails($u) {
    global $conn;
    $sql = "DELETE FROM UserDetails WHERE (Username = '$u')";
    $result = mysqli_query($conn, $sql);
}

function clearUserFunds($u) {
    global $conn;
    $sql = "DELETE FROM UserFunds WHERE (Username = '$u')";
    $result = mysqli_query($conn, $sql);
}

function clearUser($u) {
    global $conn;
    $sql = "DELETE FROM Users WHERE (Username = '$u')";
    $result = mysqli_query($conn, $sql);
}

?>