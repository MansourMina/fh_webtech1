<?php
$member = NULL;
$toUpdate = array();
$errors = array();

// Get Member information about the selected user
if (isset($_GET['members-profile'])) {
    $member = getMemberByAttribute("member_id", $_GET['members-profile'], "i");
}
// Deactive or Activate the current User
if (isset($_POST['changeLoginStatus'])) {
    $status = $member["is_active"] ? 0 : 1;
    $stmt = changeMemberLogin($member["member_id"], $status);
    if ($stmt) {
        header("Location: ?members-profile=" . $member['member_id']);
        exit();
    }
}



if (isset($_POST["changeMemberEmail"])) {
    $member_email = isset($_POST['member_email']) ? $_POST['member_email'] : "";

    // Check if email already existing
    $user_members_cred = getMembersCred();
    if (empty($member_password)) {
        $errors["member_email"] = "Email is required";
    }
    foreach ($user_members_cred as $user) {
        if ($member_email == $user['email']) {
            $errors["member_email"] = "Email already existing";
            break;
        }
    }


    // Change member email if there is no error
    if (empty($errors)) {
        if (!empty($member_email)) {
            $toUpdate["email"] = $member_email;
        }

        if (count($toUpdate) > 0) {
            $stmt = updateProfile($toUpdate, $member["member_id"]);
            if ($stmt) {
                $updatedUser = getMemberByAttribute("member_id", $member["member_id"], "i");
            }
        }
        header("Location: ?members-profile=" . $member['member_id']);
        $toUpdate = [];
        exit();
    }
}
if (isset($_POST["changeMemberPassword"])) {
    $member_password = isset($_POST['member_password']) ? $_POST['member_password'] : "";

    // Change member password
    if (empty($member_password)) {
        $errors["member_password"] = "Password is required";
    }
    if (empty($errors)) {

        if (!empty($member_password)) {
            $toUpdate["password"] = password_hash($member_password, PASSWORD_DEFAULT);;
        }

        if (count($toUpdate) > 0) {
            $stmt = updateProfile($toUpdate, $member["member_id"]);
            if ($stmt) {
                $updatedUser = getMemberByAttribute("member_id", $member["member_id"], "i");
            }
        }
        header("Location: ?members-profile=" . $member['member_id']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Member Management - Effectively manage your community members and user base.">
    <style>
        .border-profile {
            border-left: 5px solid <?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>;
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

        .form-control:not([readonly]) {
            background-color: #332D2D;
            color: white;
        }
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
                                    <img src="<?php echo isset($member["image"]) ? $member["image"] : 'res/img/default.jpg' ?>" alt="Profile Image" class="rounded-circle img-circle" width="200" height="200" id="profile">
                                </div>

                                <h5 class="my-3 mb-1 fw-bold"><?php echo "{$member['firstname']} {$member['lastname']}" ?></h5>
                                <p class="text-muted mb-1"><?php echo $member["email"] ?></p>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-9">
                        <p class="h2 fw-bold">Manage member information</p>
                        <p class="text-body-secondary">Make updates below to ensure the best support and experience for each member.</p>

                        <div class="row row-cols-1 row-cols-md-1 row-cols-xl-2 mt-5">
                            <div class="col mb-5 ">
                                <div class="card border-profile">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="mb-0 h5 fw-bold">Firstname</p>

                                                <div class="input-group ">
                                                    <p class="my-2 text-secondary"> <?php echo $member['firstname'] ?>
                                                    </p>

                                                </div>

                                            </div>
                                            <div class="ms-auto">
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
                                                <p class="mb-0 h5 fw-bold">Lastname</p>

                                                <div class="input-group ">
                                                    <p class="my-2 text-secondary"><?php echo $member['lastname'] ?></p>


                                                </div>

                                            </div>
                                            <div class="ms-auto">
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
                                                <?php if (!$member["is_admin"]) : ?>
                                                    <div class="input-group ">

                                                        <input class="form-control my-2 text-secondary " type="email" value="<?php echo $member["email"] ?>" id="memberEmailField" name="member_email" aria-label="Change members email" aria-describedby="member_email-button" readonly>

                                                        <button class="btn p-0 ms-4" type="button" id="memberEmailButton" onclick="toggleReadOnly('memberEmailButton', 'memberEmailField', '<?php echo $member['email']; ?>', 'saveMemberEmail')"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                <path fill="<?= $GLOBALS["darkMode"] ? 'white' : 'black' ?>" d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                                        </button>
                                                        <button class="btn ms-4 " name="changeMemberEmail" type="submit" id="saveMemberEmail" style="display: none;">
                                                            <i class="fa fa-check fa-lg"></i>
                                                        </button>


                                                    </div>

                                                <?php else : ?>

                                                    <div class="input-group ">
                                                        <p class="my-2 text-secondary"><?php echo $member['email'] ?></p>
                                                    </div>

                                                <?php endif; ?>



                                            </div>
                                            <div class="ms-auto d-none d-md-block">
                                                <i class="fa fa-envelope fa-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if (isset($errors["member_email"])) {
                                    echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["member_email"] . "</span>";
                                } ?>
                            </div>
                            <div class="col mb-5">
                                <div class="card  border-profile">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="mb-0 h5 fw-bold">Date of birth</p>
                                                <p class="my-2 text-secondary">21.11.2002</p>
                                            </div>
                                            <div class="ms-auto">
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
                                                    <p class="my-2 text-secondary"><?php echo $member["phone_number"] ?></p>
                                                </div>

                                            </div>
                                            <div class="ms-auto">
                                                <i class="fa fa-phone fa-lg"></i>
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

                                                <p class="mb-0 h5 fw-bold">Password</p>
                                                <?php if (!$member["is_admin"]) : ?>
                                                    <div class="input-group ">

                                                        <input class="form-control my-2 text-secondary " type="password" value="<?php echo $member["password"] ?>" id="memberPasswordField" name="member_password" aria-label="Change members password" aria-describedby="member_password-button" readonly>

                                                        <button class="btn p-0 ms-4" type="button" id="memberPasswordButton" onclick="toggleReadOnly('memberPasswordButton', 'memberPasswordField', '<?php echo $member['password']; ?>', 'saveMemberPassword')"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                <path fill="<?= $GLOBALS["darkMode"] ? 'white' : 'black' ?>" d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                                        </button>
                                                        <button class="btn ms-4 " name="changeMemberPassword" type=" submit" id="saveMemberPassword" style="display: none;">
                                                            <i class="fa fa-check fa-lg"></i>
                                                        </button>


                                                    </div>
                                                <?php endif; ?>



                                            </div>
                                            <div class="ms-auto d-none d-md-block">
                                                <i class="fa fa-envelope fa-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if (isset($errors["member_password"])) {
                                    echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["member_password"] . "</span>";
                                } ?>
                            </div>

                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class=" text-center ">
            <p>Account created: <?php echo $member["account_created"] ?></p>
        </div>
        <?php if (!$member["is_admin"]) : ?>
            <div class="text-center">
                <button data-bs-toggle="modal" data-bs-target="#memberStatusModal" class="btn <?= $member["is_active"] == 0 ? "btn-success" : "btn-danger" ?> mb-3 " type="submit"><?= $member["is_active"] == 0 ? "Activate account" : "Deactivate account" ?>
                </button>
            </div>
        <?php endif; ?>

    </div>

    <div class="modal " id="memberStatusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="" method="post">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h1 class="modal-title fs-5" id="memberStatusModalLabel"><?= $member["is_active"] == 0 ? "Activate account" : "Deactivate account" ?></h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            Are you sure you want to <?= ($member["is_active"] == 0 ? "activate" : "deactivate") . " <span class='fw-bold'>" . $member["firstname"] . " " . $member["lastname"]  . "'s </span> account?" ?>
                        </div>
                        <?php if ($member["is_active"] == 1) : ?>
                            <div class="alert alert-danger" role="alert">
                                <p><span class="fw-bold mb-0 pb-0"><i class="fa fa-warning me-2 text-danger"></i>Warning</span></p>
                                By deactivating this account, the user won't be able to access the system.

                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-secondary w-25" onclick="closePassword()" data-bs-dismiss="modal">Cancel</button>
                        <form action="" method="post">
                            <button type="submit" name="changeLoginStatus" class="btn <?= $member["is_active"] == 0 ? "btn-success" : "btn-danger" ?> w-25">Yes</button>
                        </form>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="res/js/index.js"> </script>

</body>

</html>