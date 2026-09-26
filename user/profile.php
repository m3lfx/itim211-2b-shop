<?php
session_start();
include("../includes/header.php");
include("../includes/config.php");
if (isset($_POST['submit'])) {
    // echo htmlentities($_POST['fname']);
    $lname = trim($_POST['lname']);
    $fname = trim(strip_tags($_POST['fname']));
    $title = trim($_POST['title']);
    $address = trim($_POST['address']);
    $town = trim($_POST['town']);
    $zipcode = trim($_POST['zipcode']);
    $phone = trim($_POST['phone']);

    $sql = "INSERT INTO customer (title, lname, fname, addressline, town, zipcode, phone, user_id) VALUES ('$title', '$lname', '$fname', '$address', '$town', '$zipcode', '$phone', {$_SESSION['user_id']} )";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['success'] = 'profile saved';
        header("Location: profile.php");
    }
}
// print_r($_SESSION);
?>

<div class="container-xl px-4 mt-4">
    <?php include("../includes/alert.php"); ?>
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="https://www.bootdey.com/snippets/view/bs5-edit-profile-account-details"
            target="__blank">Profile</a>

    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2"
                        src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button">Upload new image</button>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">


                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class="form-control" id="inputFirstName" type="text"
                                    placeholder="Enter your first name" name="fname">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control" id="inputLastName" type="text"
                                    placeholder="Enter your last name" name="lname">
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">

                            <div class="col-md-6">
                                <label class="small mb-1" for="address">Address</label>
                                <input class="form-control" id="address" type="text" placeholder="Enter your address"
                                    name="address">
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="town">town</label>
                                <input class="form-control" id="town" type="text" placeholder="Enter your town"
                                    name="town">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="zip">zip code</label>
                                <input class="form-control" id="zip" type="tel" placeholder="Enter zipcode"
                                    name="zipcode">
                            </div>

                        </div>

                        <div class="col-md-6">


                            <label class="small mb-1" for="title">title</label>
                            <input class="form-control" id="title" type="text" name="title">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel"
                                    placeholder="Enter your phone number" name="phone">
                            </div>

                        </div>

                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" name="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>