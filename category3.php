<?php
include 'connect.php';

$sql = "SELECT scp.price, c.laundry_category_option 
        FROM service_category_price scp
        JOIN category c ON scp.category_id = c.category_id
        WHERE scp.service_id = 3";
$result = mysqli_query($conn, $sql);
$prices = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $prices[] = $row;
    }
}

$sql2 = "SELECT service_id, laundry_service_option FROM service WHERE service_id = 1";
$result2 = mysqli_query($conn, $sql2);
$service = mysqli_fetch_assoc($result2);

if(isset($_POST['submit'])){
    $service_id = $row['service_id'];    
    $laundry_category_option = $_POST['laundry_category_option'];
    $prices = $_POST['prices'];

    $sql = "UPDATE `service_category_price` 
            SET price = '$price' 
            WHERE laundry_category_option = '$laundry_category_option' 
            AND service_id = 1";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $showSuccessPopup = true;
    } else {
        $showErrorPopup = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="settings.css">
</head>

<body>
    <div class="progress"></div>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button id="toggle-btn" type="button">
                    <i class="bx bx-menu-alt-left"></i>
                </button>

                <div class="sidebar-logo">
                    <a href="#">Azia Skye</a>
                </div>
            </div>

            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="/laundry_system/dashboard/dashboard.php" class="sidebar-link">
                        <i class="lni lni-grid-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="/laundry_system/profile/profile.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="/laundry_system/users/user.php" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>Users</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="/laundry_system/records/customer.php" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                        data-bs-target="#records" aria-expanded="false" aria-controls="records">
                        <i class="lni lni-files"></i>
                        <span>Records</span>
                    </a>

                    <ul id="records" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/laundry_system/records/customer.php" class="sidebar-link">Customer</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="/laundry_system/records/service.php" class="sidebar-link">Service</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="/laundry_system/records/category.php" class="sidebar-link">Category</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="/laundry_system/transaction/transaction.php" class="sidebar-link">
                        <i class="lni lni-coin"></i>
                        <span>Transaction</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="/laundry_system/sales_report/report.php" class="sidebar-link">
                        <i class='bx bx-line-chart'></i>
                        <span>Sales Report</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="/laundry_system/settings/settings.php" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>

                <hr style="border: 1px solid #b8c1ec; margin: 8px">

                <li class="sidebar-item">
                    <a href="/laundry_system/archived/archived.php" class="sidebar-link">
                        <i class='bx bxs-archive-in'></i>
                        <span class="nav-item">Archived</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <div class="main p-3">
        <div class="text"><h1> Settings</h1></div>
        <div style="text-align:center;" class="text" name="cat"><h2> Wash/Dry/Fold</h2></div>
        <button class="btn-primary" onclick="window.location.href='edit3.php'">Update Price</button>

        <div class="form-popup" id="myForm">
            <form class="form-container" method="post">
            <input type="hidden" id="service_id" name="service_id">
            <label for="laundry_category_option">Category Option:</label>
            <input type="text" id="laundry_category_option" name="laundry_category_option"><br><br>

            <label for="prices">Price:</label>
            <input type="text" id="prices" name="prices"><br><br>

            <button type="submit" class="btn" name="submit" onclick="openPopup()">Submit</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>

            <script>
            function openForm() {
            document.getElementById("myForm").style.display = "block";
            }

            function closeForm() {
            document.getElementById("myForm").style.display = "none";
            }
            </script>

                        <table style="width:90%; height:50%; color:black;"class="table table-bordered text-center">
                <thead>
                    <tr>
                    <th scope="col">Category Option</th>
                    <th scope="col">Service Option</th>
                    <th scope="col">Prices</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($prices as $row) {
                        $laundry_category_option = $row['laundry_category_option'];
                        $price = $row['price'];
                        $laundry_service_option = $service['laundry_service_option'];

                        echo '<tr>
                                <th scope="row">' . $laundry_category_option . '</th>
                                <td>' . $laundry_service_option . '</td>
                                <td>' . $price . '</td>
                             </tr>'; 
                    }
                    ?>
                </tbody>
                </table>
                </thead>
                <div class="popup" id="success">
                    <div class="popup-content">
                    <div class="imgbox">
                        <img src="checked.png" alt="" class="img">
                    </div>
                    <div class="title">
                        <h3>Success!</h3>
                    </div>
                    <p class="para">Your price has been updated successfully</p>
                    <form action="">
                        <button type="button" class="button" id="s_button" onclick="closePopup()">OKAY</a>
                    </form>
                    </div>
                    </div>

                <div class="popup" id="error">
                    <div class="popup-content">
                    <div class="imgbox">
                        <img src="cancel.png" alt="" class="img">
                    </div>
                    <div class="title">
                        <h3>Sorry...</h3>
                    </div>
                    <p class="para">Something went wrong, please try again.</p>
                    <form action="">
                        <button type="button" class="button" id="e_button" onclick="closePopup()">TRY AGAIN</a>
                    </form>
                    </div>
                    </div>
                    <script src="settings.js"></script>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="settings.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>