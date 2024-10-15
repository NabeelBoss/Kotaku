<?php
require 'header.php';
require 'database.php';

$query = "SELECT * FROM userreg WHERE userrole = 'ADMIN'";
$result = mysqli_query($con, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($con);
    exit;
}
?>


<!-- Page Container -->
<div class="page-container" style="min-height: 100vh; display: flex; flex-direction: column;">

    <!-- Page Content -->
    <div class="page-content"
        style="flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20px;">

        <!-- Page Inner -->
        <div class="page-inner" style="width: 100%; max-width: 600px;">

            <!-- Main Content -->
            <div class="container-fluid" id="main-wrapper"
                style="display: flex; justify-content: center; align-items: center; height: auto; width: 100%;">
                <div class="row" style="width: 100%; display: flex; justify-content: center;">
                    <div class="col-lg-12">
                        <div class="card border" style="border-radius: 8px; border: 1px solid #ddd; ">
                            <div class="card-body"
                                style="padding: 30px; background-color: lightgrey; border:2px solid lightgrey; border-radius:8px;">
                                <h4 class="mt-0 pt-2 text-center"
                                    style="margin-bottom: 30px; padding-bottom: 10px; color:#94908f; font-weight: 700; font-size: 40px;">
                                    <span style="color:grey;">UPDATE ADMIN</span></h4>
                                <form action="updateadminaction.php" method="POST" enctype="multipart/form-data">
                                    <!-- Image Uploader -->
                                    <div class="form-group" style="margin-bottom: 20px; text-align: center;">
                                        <div style="position: relative; display: inline-block;">
                                            <!-- Displaying the user image -->
                                            <img id="avatarPreview" src="../<?php echo $user["userprofile"] ?>"
                                            alt="Avatar Preview" style="border-radius: 50%; width: 150px; height: 150px;
                                            object-fit: cover; border: 3px solid #f6571e;">
                                            <input type="file" name="img" id="avatarInput"
                                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;"
                                                accept="image/*" onchange="previewImage(event)" required>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="exampleInputName"
                                            style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Full
                                            Name</label><span>
                                            <input type="text" name="name" class="form-control" id="exampleInputName"
                                                placeholder="Name" value="<?php echo $user["username"] ?>" required
                                            style="border-radius: 4px; padding: 12px; border: 2px solid #f6571e;">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="exampleInputEmail1"
                                            style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Email
                                            address</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Email" value="<?php echo $user["useremail"] ; ?>" required
                                        style="border-radius: 4px; padding: 12px; border: 2px solid #f6571e;">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="exampleInputPassword1"
                                            style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Password</label>
                                        <input type="password" name="pass" class="form-control"
                                            id="exampleInputPassword1" placeholder="Password" value="<?php echo $user["userpass"] ; ?>" required style="border-radius: 4px; padding: 12px; border:
                                        2px solid #f6571e;">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="exampleInputNumber"
                                            style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Phone
                                            Number</label>
                                        <input type="number" name="number" class="form-control" id="exampleInputNumber"
                                            placeholder="Number" value="<?php echo $user["usernumber"] ?>" required
                                        style="border-radius: 4px; padding: 12px; border: 2px solid #f6571e;">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 20px;">
                                        <label for="exampleInputNumber"
                                            style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Banner</label>
                                        <input type="file" name="banner" class="form-control" id="exampleInputNumber"
                                            placeholder="Banner" value="<?php echo $user["userbanner"] ?>" required
                                        style="border-radius: 4px; padding: 12px; border: 2px solid #f6571e;">
                                    </div>
                                    <input type="hidden" name="updateid" value="<?php echo $user["userid"] ?>">
                                    <button type="submit" name="update" class="btn btn-primary mt-3"
                                        style="background-color: #f6571e; border-color: #f6571e; padding: 12px 24px; border-radius: 4px; color: #ffffff; font-weight: 600; font-size: 22px; letter-spacing: 2px; width: 100%;">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Content -->

        </div>

        <?php require 'footer.php'; ?>
    </div>

    <!-- Footer -->
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>