<?php
$errors = [];
$toUpdate = array();
if (isset($_POST["changePassword"])) {
    $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : "";
    $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : "";
    if (empty($old_password)) {
        $errors["old_password"] = "Please confirm your old password!";
    }
    if (empty($new_password)) {
        $errors["new_password"] = "New password is required!";
    } else if (password_verify($old_password, $_SESSION["password"])) {
        if (!empty($new_password) && $new_password != $_SESSION["password"]) {
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            $toUpdate["password"] = $hashedPassword;
            $stmt = updateProfile($toUpdate, $_SESSION["member_id"]);
            if ($stmt) {
                $updatedUser = getMemberByAttribute("member_id", $_SESSION["member_id"], "i");
                $_SESSION = $updatedUser;
            }
            header("Location: ?profile");
            exit();
        }
    } else {
        $errors["wrong_password"] = "Password confirmation failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .border-profile {
            border-left: 5px solid #15736b;
        }

        .profile-image-container {
            position: relative;
            cursor: pointer;
        }

        .card-body {
            position: relative;
        }

        .image-container {
            position: relative;
            display: inline-block;
            overflow: hidden;
            border-radius: 50%;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-container:hover .overlay {
            opacity: 1;
            /* Show the overlay on hover */
        }

        .card {
            min-height: 12vh;
        }

        <?php if ($GLOBALS["darkMode"]) : ?>
         .form-control:not([readonly]) {
            background-color: white !important;
            color: black !important;
        }

        <?php else : ?>.form-control:not([readonly]) {
            background-color: #332D2D;
            color: white;
        }
        <?php endif; ?>
    </style>
</head>

<body>

    <div class=" container ">
        <div class=" mb-3 p-4">
            <form enctype="multipart/form-data" action="" method="post">

                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="card mb-4 border-0">
                            <div class="card-body text-center">
                                <div class="image-container">
                                    <img src="<?php echo isset($_SESSION["image"]) ? $_SESSION["image"] : 'src/images/default.png' ?>" alt="Profile Image" class="rounded-circle" width="200" height="200" id="profile">
                                    <label class="overlay">
                                        Change Image
                                        <input type="file" name="picture" accept="image/jpeg,image/png" class="d-none" onchange="loadFile(event)">
                                    </label>
                                </div>

                                <h5 class="my-3 mb-1 fw-bold"><?php echo "{$_SESSION['firstname']} {$_SESSION['lastname']}" ?></h5>

                                <p class="text-muted mb-1"><?php echo $_SESSION["email"] ?></p>


                            </div>

                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-9">
                        <p class="h2 fw-bold">Personal information</p>
                        <p class="text-body-secondary">Manage your personal information to ensure we provide you with the best possible service.</p>

                        <div class="row row-cols-1 row-cols-md-1 row-cols-xl-2 mt-5">
                            <div class="col mb-5 ">
                                <div class="card border-profile">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="mb-0 h5 fw-bold">Firstname</p>

                                                <div class="input-group ">
                                                    <input class="form-control my-2 text-secondary " type="text" value="<?php echo "{$_SESSION['firstname']}" ?>" id="firstnameField" name="firstname" aria-label="Change firstname" aria-describedby="firstname-button" readonly>
                                                    <button class="btn p-0 ms-4" type="button" id="firstnameButton" onclick="toggleReadOnly('firstnameButton', 'firstnameField', '<?php echo $_SESSION['firstname']; ?>')"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                                        </svg></button>
                                                </div>

                                            </div>
                                            <div class="ms-auto d-none d-md-block">
                                                <i class="fa fa-user fa-lg"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5 ">
                                <div class="card border-profile">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="mb-0 h5 fw-bold">Nachname</p>

                                                <div class="input-group ">
                                                    <input class="form-control my-2 text-secondary " type="text" value="<?php echo "{$_SESSION['lastname']}" ?>" id="lastnameField" name="lastname" aria-label="Change lastname" aria-describedby="lastname-button" readonly>
                                                    <button class="btn p-0 ms-4" type="button" id="lastnameButton" onclick="toggleReadOnly('lastnameButton', 'lastnameField', '<?php echo $_SESSION['lastname']; ?>')"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                                        </svg></button>
                                                </div>

                                            </div>
                                            <div class="ms-auto d-none d-md-block">
                                                <i class="fa fa-user fa-lg"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5 mr-5">
                                <div class="card  border-profile">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="mb-0 h5 fw-bold">Email</p>
                                                <?php if (!$_SESSION["is_admin"]) : ?>
                                                    <p class="my-2 text-secondary"><?php echo $_SESSION["email"] ?></p>

                                                <?php else : ?>
                                                    <div class="input-group ">
                                                        <input class="form-control my-2 text-secondary " type="email" value="<?php echo $_SESSION["email"] ?>" id="emailField" name="email" aria-label="Change email" aria-describedby="member_email-button" readonly>
                                                        <button class="btn p-0 ms-4" type="button" id="emailButton" onclick="toggleReadOnly('emailButton', 'emailField', '<?php echo $_SESSION['email']; ?>')"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                                            </svg></button>
                                                    </div>
                                                <?php endif; ?>

                                            </div>
                                            <div class="ms-auto d-none d-md-block">
                                                <i class="fa fa-envelope fa-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card  border-profile">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="mb-0 h5 fw-bold">Date of birth</p>
                                                <p class="my-2 text-secondary"><?= $_SESSION["date_of_birth"] ?></p>
                                            </div>
                                            <div class="ms-auto d-none d-md-block">
                                                <i class="fa fa-calendar fa-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card border-profile">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="mb-0 h5 fw-bold">Phone number</p>

                                                <div class="input-group ">
                                                    <input class="form-control my-2 text-secondary " type="number" value="<?php echo "{$_SESSION["phone_number"]}" ?>" id="phoneField" name="phone_number" aria-label="Change Phone number" aria-describedby="phoneButton" readonly>
                                                    <button class="btn p-0 ms-4" type="button" id="phoneButton" onclick="toggleReadOnly('phoneButton', 'phoneField', '<?php echo $_SESSION['phone_number']; ?>')"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                                        </svg></button>
                                                </div>

                                            </div>
                                            <div class="ms-auto d-none d-md-block">
                                                <i class="fa fa-phone fa-lg"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card border-profile">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="mb-0 h5 fw-bold">Password</p>
                                                <div class="input-group ">
                                                    <input class="form-control my-2 text-secondary " type="password" value="<?php echo "{$_SESSION["password"]}" ?>" id="passwordField" aria-label="Change Password" aria-describedby="passwordButton" readonly>
                                                    <button class="btn p-0 ms-4" type="button" id="passwordButton" onclick="toggleReadOnly('passwordButton', 'passwordField', '<?php echo $_SESSION['password']; ?>')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                                        </svg>
                                                    </button>
                                                </div>

                                            </div>
                                            <div class="ms-auto d-none d-md-block">
                                                <i class="fa fa-lock fa-lg"></i>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center"><button class="btn btn-full mb-3 " name="saveChanges" type="submit" disabled id="saveButton">Save Changes</button></div>
            </form>
        </div>
        <div class=" text-center ">
            <p class="text-secondary">Account created: <?php echo $_SESSION["account_created"] ?></p>
        </div>

    </div>
    <!-- Because of reloading -->
    <!-- Modal opens if something was wrong with changing password -->
    <?php if (count($errors) > 0) : ?>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#exampleModal").modal('show');
            });
        </script>
    <?php endif; ?>
    <div class="modal " id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="old_password" class="col-form-label">Old password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password">
                            <?php if (isset($errors["old_password"])) {
                                echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["old_password"] . "</span>";
                            } ?>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="col-form-label">New password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                            <?php if (isset($errors["new_password"])) {
                                echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["new_password"] . "</span>";
                            } ?>
                        </div>
                        <?php if (isset($errors["wrong_password"])) {
                            echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["wrong_password"] . "</span>";
                        } ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closePassword()" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="changePassword" id="test" class="btn btn-danger">Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="res/js/index.js"> </script>
</body>

</html>