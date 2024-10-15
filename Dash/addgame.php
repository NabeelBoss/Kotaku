<?php require 'header.php'; ?>

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
                                style="padding: 30px; background-color: inherit; border:2px solid lightgrey; border-radius:8px;">
                                <h4 class="mt-0 pt-2 text-center"
                                    style="margin-bottom: 30px; padding-bottom: 10px; color:#94908f; font-weight: 700; font-size: 40px;">
                                    <span style="color:inherit;">Add Game</span></h4>
                                <div>
                                    <form action="addgameaction.php" method="POST" enctype="multipart/form-data">
                                        <!-- Image Uploader -->
                                        <div class="form-group" style="margin-bottom: 20px; text-align: center;">
                                            <div style="position: relative; display: inline-block;">
                                                <img id="avatarPreview" src="assets/images/gameavatar.jpeg"
                                                    alt="Avatar Preview"
                                                    style="border-radius: 50%; width: 150px; height: 150px; object-fit: cover; border: 3px solid grey;">
                                                <input type="file" name="gameimg" id="avatarInput"
                                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;"
                                                    accept="image/*" onchange="previewImage(event)" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="exampleInputName"
                                                style="display: block; margin-bottom: 8px; font-weight: 500; color: lightgrey;">Game
                                                Name</label>
                                            <input type="text" name="gamename" class="form-control"
                                                id="exampleInputName ppp" placeholder="Name" required
                                                style="border-radius: 4px; padding: 12px; border: 2px solid grey;">
                                        </div>
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="exampleInputEmail1"
                                                style="display: block; margin-bottom: 8px; font-weight: 500; color: lightgrey;">Page
                                                URL</label>
                                            <input type="text" name="gameurl" class="form-control"
                                                id="exampleInputEmail1 ppp" placeholder="URL" required
                                                style="border-radius: 4px; padding: 12px; border: 2px solid grey;">
                                        </div>

                                        <button type="submit" name="Submit" class="btn btn-primary"
                                            style="background-color: #f6571e; border-color: #f6571e; padding: 12px 24px; border-radius: 4px; color: #ffffff; font-weight: 600; font-size: 22px; letter-spacing:2px; width: 100%;">Upload</button>
                                    </form>
                                </div>
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

<style>
    #ppp::placeholder {
        color: black; /* Change placeholder text color to black */
    }
</style>

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

</body>
</html>
