<?php
include 'connect.php';

// Retrieve current settings from database
$sql = "SELECT min_kilos, delivery_day FROM settings";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Fetch Delivery and Pick up prices from price table
$sqlServiceOption = "SELECT price FROM service_option_price WHERE service_option_type = 'Delivery'";
$resultDelivery = mysqli_query($conn, $sqlServiceOption);
$rowDelivery = mysqli_fetch_assoc($resultDelivery);
$delivery_charge = $rowDelivery['price'];

$sqlServiceOption = "SELECT price FROM service_option_price WHERE service_option_type = 'Pick up'";
$resultPickup = mysqli_query($conn, $sqlServiceOption);
$rowPickup = mysqli_fetch_assoc($resultPickup);
$pickup_charge = $rowPickup['price'];

$minimum_kilos = $row['min_kilos'];
$delivery_day = $row['delivery_day'];

// Update settings when form is submitted
if (isset($_POST['submit'])) {
    $minimum_kilos = $_POST['minimum_kilos'];
    $delivery_day = $_POST['delivery_day'];
    $delivery_charge = $_POST['delivery_charge'];
    $pickup_charge = $_POST['pickup_charge'];

    // Update settings
    $sql = "UPDATE settings SET min_kilos='$minimum_kilos', delivery_day='$delivery_day'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Settings updated successfully')</script>";
    } else {
        echo "Error updating settings: " . mysqli_error($conn) . "<br>";
    }

    // Update delivery charge
    $sql = "UPDATE service_option_price SET price='$delivery_charge' WHERE service_option_type='Delivery'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "
        <script>
            alert('Delivery charge updated successfully!');
        </script>
        ";
    } else {
        echo "Error updating delivery charge: " . mysqli_error($conn) . "<br>";
    }

    // Update pickup charge
    $sql = "UPDATE service_option_price SET price='$pickup_charge' WHERE service_option_type='Pick up'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo  "
             
        <script>
        alert('Pickup charge updated successfully!');
    </script>
        ";
    } else {
        echo "Error updating pickup charge: " . mysqli_error($conn) . "<br>";
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
    <link rel="stylesheet" href="setting.css">
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

        <div class="main-content">
            <nav>
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Settings</h1>
                </div>
            </nav>

            <div class="buttons">
                <div class="wdf_button">
                    <a href="categ1.php" class="button" id="wdfBtn">Wash/Dry/Fold</a>
                </div>
                    
                <div class="wdp_button">
                    <a href="categ2.php" class="button" id="wdpBtn">Wash/Dry/Press</a>
                </div>
                
                <div class="dry_button">
                    <a href="categ3.php" class="button" id="dryBtn">Dry only</a>
                </div>       
            </div> 

            <div class="form-settings" id="mainForm">
                <form class="form-container" method="POST">
                    <label for="min_kilos">Minimum Kilos: </label>
                    <input type="text" id="min_kilos" name="min_kilos" value="<?php echo $minimum_kilos ?>">

                    <label for="delivery_date">Delivery Date: </label>
                    <input type="date" id="delivery_date" name="delivery_date" value="<?php echo $delivery_day ?>">

                    <label for="delivery_charge">Delivery Charge:</label>
                    <input type="text" id="delivery_charge" name="delivery_charge" value="<?php echo $delivery_charge ?>">
                    
                    <label for="pickup_charge">Pickup Charge:</label>
                    <input type="text" id="pickup_charge" name="pickup_charge" value="<?php echo $pickup_charge ?>">

                    <button type="submit" class="btn btn-success" id="submit_btn" name="submit">Submit</button>
                </form>
            </div>
        </div> <!-- closing tag of main content -->

    </div>
</body>    

<script type="text/javascript" src="setting.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>