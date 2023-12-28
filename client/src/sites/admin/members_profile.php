<?php
$member = NULL;
if (isset($_GET['members-profile'])) {
    $member = getMember($_GET['members-profile']);
}
if (isset($_POST['changeLoginStatus'])) {
    $status = $member["is_active"] ? 0 : 1;
    $stmt = changeMemberLogin($member["member_id"], $status);
    if ($stmt) {
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
                                    <img src="<?php echo isset($member["image"]) ? $member["image"] : 'src/images/default.png' ?>" alt="Profile Image" class="rounded-circle img-circle" width="200" height="200" id="profile">
                                </div>

                                <h5 class="my-3 mb-1 fw-bold"><?php echo "{$member['firstname']} {$member['lastname']}" ?></h5>
                                <p class="text-muted mb-1"><?php echo $member["email"] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-9">
                        <p class="h2 fw-bold">Members information</p>
                        <p class="text-body-secondary">These are the members information.</p>

                        <div class="row row-cols-1 row-cols-md-1 row-cols-xl-2 mt-5">
                            <div class="col mb-5 ">
                                <div class="card border-profile">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="mb-0 h5 fw-bold">Name</p>

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
                                                <p class="mb-0 h5 fw-bold">Name</p>

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
                                                <p class="my-2 text-secondary"><?php echo $member["email"] ?></p>

                                            </div>
                                            <div class="ms-auto">
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
                                                <i class="fa fa-user fa-lg"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class=" text-center ">
            <p>Account created: <?php echo $member["account_created"] ?></p>
        </div>
        <div class="text-center">
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn <?= $member["is_active"] == 0 ? "btn-success" : "btn-danger" ?> mb-3 " type="submit"><?= $member["is_active"] == 0 ? "Activate account" : "Deactivate account" ?>
            </button>
        </div>

    </div>

    <div class="modal " id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="" method="post">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $member["is_active"] == 0 ? "Activate account" : "Deactivate account" ?></h1>
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


</body>

</html>