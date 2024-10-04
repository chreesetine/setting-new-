<?php
include 'connect.php';

$sql = "SELECT service_id, laundry_category_option, prices FROM price WHERE service_id = 2";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$service_id = $row['service_id'];
$laundry_category_option = $row['laundry_category_option'];
$prices = $row['prices'];

if(isset($_POST['submit'])){
    $service_id = $_POST['service_id'];    
    $laundry_category_option=$_POST['laundry_category_option'];
    $prices=$_POST['prices'];

    $sql="update `price` set prices='$prices' where laundry_category_option='$laundry_category_option'
    and service_id = 2 ";
    $result=mysqli_query($conn,$sql);

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
        <div style="text-align:center;" class="text"><h2>UPDATE PRICE</h2></div>
            <table style="margin-top:5%;width:90%; height:50%; color:black;"class="table table-bordered text-center">
                <thead>
                    <tr>
                    <th scope="col">Category Option</th>
                    <th scope="col">Service Option</th>
                    <th scope="col">Prices</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Archive</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql="Select * from `price` where service_id=2";
                    $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                            <td><?php echo $row ["laundry_category_option"] ?></td>
                            <td><?php echo $row ["laundry_service_option"]?></td>
                            <td><?php echo $row ["prices"]?></td>
                            <td>
                            <i style="cursor:pointer;" class="bx bxs-edit" onclick="openForm('<?php echo $row['service_id']; ?>', '<?php echo addslashes($row['laundry_category_option']); ?>')"></i></td>
                                <td><a href=""><i class="bx bx-box"></i></a></td>
                                </tr>
                                <?php
                            }
                        ?>
                </tbody>
            </table> 

            <div class="form-popup" id="myForm">
                <form class="form-container" method="post">

                <input type="hidden" id="service_id" name="service_id">

                <label for="laundry_category_option">Category Option:</label>
                <input type="text" class="form-control" id="laundry_category_option" name="laundry_category_option"
                value='" . $row[$laundry_category_option] . "'disabled><br><br>

                <label for="prices">Price:</label>
                <input type="text" class="form-control" name="prices"><br><br>

                <button type="submit" class="btn" name="submit" onclick="openPopup()">Submit</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
                </form>
            </div>

            <script>
                function openForm(serviceId, laundryCategoryOption) {
                document.getElementById("myForm").style.display = "block";
                document.getElementById("service_id").value = serviceId;
                document.querySelector('input[name="laundry_category_option"]').value = laundryCategoryOption;
            }

            function closeForm() {
                document.getElementById("myForm").style.display = "none";
            }

            </script>
                
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

</html>

<?php
$con->close();
?>