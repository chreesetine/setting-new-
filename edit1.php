<?php
include 'connect.php';

$sql = "SELECT s.service_id, c.laundry_category_option, scp.price 
        FROM service s
        JOIN service_category_price scp ON s.service_id = scp.service_id
        JOIN category c ON scp.category_id = c.category_id
        WHERE s.service_id = 1";

$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Now you can safely access $row
        $service_id = $row['service_id'];
        $laundry_category_option = $row['laundry_category_option'];
        $prices = $row['price'];
    } else {
        echo "No records found.";
        // Optionally set $service_id and other variables to null or a default value
        $service_id = null;
        $laundry_category_option = null;
        $prices = null;
    }
} else {
    die("Query Failed: " . mysqli_error($conn));
}

/* 1st gawa pero okay naman  
if (isset($_POST['submit'])) {
    $service_id = $_POST['service_id'];    
    if(isset($_POST['laundry_category_option'])) {
        $laundry_category_option = $_POST['laundry_category_option'];
    } else {
        $laundry_category_option = null;
    }
    $prices = $_POST['prices'];

    $sql = "UPDATE service_category_price scp
            JOIN category c ON scp.category_id = c.category_id
            SET scp.price = '$prices' 
            WHERE c.laundry_category_option = '$laundry_category_option' 
            AND scp.service_id='$service_id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $showSuccessPopup = true;
    } else {
        $showErrorPopup = true;
    }
} */

if (isset($_POST['submit'])) {
    $service_id = $_POST['service_id'];    
    $laundry_category_option = isset($_POST['laundry_category_option']) ? $_POST['laundry_category_option'] : null;
    $prices = $_POST['prices'];

    // Update price in the database
    $sql = "UPDATE service_category_price scp
            JOIN category c ON scp.category_id = c.category_id
            SET scp.price = '$prices' 
            WHERE c.laundry_category_option = '$laundry_category_option' 
            AND scp.service_id='$service_id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>console.log('Update successful'); var showSuccessModal = true;</script>"; // Show success popup if update is successful
    } else {
        echo "<script>console.log('Update failed');  var showErrorModal = true;</script>"; // Show error popup if update fails
    }
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Configuration of Wash/Dry/Fold</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="edit1.css">
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
                    <a href="/laundry_system/settings/setting.php" class="sidebar-link">
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

                <div class="text" style="text-align: center;" name="category">
                    <h2>Update Price</h2>
                </div>
            </nav>

            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                        <th scope="col">Category Option</th>
                        <th scope="col">Service Option</th>
                        <th scope="col">Prices</th>
                        <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT c.laundry_category_option, s.laundry_service_option, scp.price, s.service_id
                                FROM service_category_price scp
                                JOIN service s ON scp.service_id = s.service_id
                                JOIN category c ON scp.category_id = c.category_id
                                WHERE scp.service_id = 1";

                        $result = mysqli_query($conn, $sql);
                        if (!$result) {
                            die("Query Failed: " . mysqli_error($conn));
                        }

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row["laundry_category_option"]; ?></td>
                                <td><?php echo $row["laundry_service_option"]; ?></td>
                                <td><?php echo $row["price"]; ?></td>
                                <td>
                                    <a href="javascript:void(0);" onclick="openForm()" class="edit-btn" 
                                        data-id="<?php echo $row['service_id']; ?>" 
                                        data-option="<?php echo $row['laundry_category_option']; ?>"
                                        data-price="<?php echo $row['price']; ?>">
                                        <i class="bx bxs-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- edit form -->
            <div class="form-popup" id="editForm" style="display:none;">
                <form method="POST" action="edit1.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Edit Category Option</h3>
                            <span class="close">&times;</span>
                        </div>   

                        <div class="modal-body">
                            <div class="form-group">
                            <input type="hidden" id="service_id" name="service_id">
                            </div>
                            
                            <div class="form-group">
                                <label for="laundry_category_option">Category Option:</label>
                                <input type="text" class="form-control" id="laundry_category_option" name="laundry_category_option" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" name="prices"><br>
                            </div>
                            
                            <div class="button-container">
                                <button type="submit" class="btn btn-success" name="submit">Submit</button>
                                <button type="button" class="btn btn-danger" id="cancelButton">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>    
            </div> 

            <!-- try sa success pop-up -->
            <div class="popup" id="successModal>
                <div class="modal-cnt">
                    <span class="close" id="closeSuccessModal">&times;</span>
                    <h1>Success!</h1>
                    <p>Price has been updated successfully!</p>
                    <button id="closeSuccessButton" class="btn btn-primary">OK</button>
                </div>
            </div>

            <!-- try sa error pop-up -->
             <div class="popup" id="errorModal">
                <div class="modal-cnt">
                    <span class="close" id="closeErrorModal">&times;</span>
                    <h1>An error occured</h1>
                    <p>Something went wrong, please try again.</p>
                    <button id="closeErrorButton" class="btn btn-light">OK</button>
                </div>
             </div>


        </div> <!-- closing tag of main content -->
    </div> <!-- closing tag of wrapper -->
</body> 

<script type="text/javascript" src="edit1.js" defer></script>
</html>