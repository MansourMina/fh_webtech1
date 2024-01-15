<?php
include_once 'model/reservations.php';

$reservations = getMemberReservation($_SESSION["member_id"]);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reservations of User">

</head>

<body>
    <div class="container ">
        <?php if (!empty($reservations)) : ?>
            <p class="h2 fw-bold"> Your Reservations</p>
            <div class="d-flex flex-wrap">

                <?php foreach ($reservations as $reservation) : ?>
                    <div class="card w-100 me-5 my-5 justify-content-end">
                        <?php if ($reservation['status'] == 1) : ?>
                            <a href="?reservation-info=<?= $reservation['verification_code'] ?>" class="card-link" style="text-decoration: none; color: inherit;">
                            <?php endif; ?>

                            <div class="card-body bg-<?= $GLOBALS["darkMode"] ? '' : 'light' ?>">
                                <div class="row g-0">
                                    <div class="d-flex align-items-center mb-2 mb-lg-0 col-md-3 align-self-center  text-<?= $reservation['status'] == 0 ? 'warning' : ($reservation['status'] == 1 ? 'success' : 'danger') ?>">
                                        <i class="fa me-3 fa-circle text-<?= $reservation['status'] == 0 ? 'warning' : ($reservation['status'] == 1 ? 'success' : 'danger') ?>"></i>
                                        <p class="my-0"><?= $reservation['status'] == 0 ? 'Pending' : ($reservation['status'] == 1 ? 'Confirmed' : 'Canceled') ?></p>
                                    </div>

                                    <div class=" col-md-9">
                                        <p class="card-text fw-bold"><?= $reservation["check_in_date"] ?> - <?= $reservation["check_out_date"] ?></p>
                                        <h5 class="card-titel text-muted"><?= $reservation["room_type"] ?></h5>
                                    </div>
                                </div>

                                <div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text"><small>VERIFICATION CODE</small></p>
                                        <p><?= $reservation['verification_code'] ?></p>
                                    </div>
                                </div>

                            </div>
                            <?php if ($reservation['status'] == 1) : ?>
                            </a>
                        <?php endif; ?>

                    </div>
                <?php endforeach ?>
            </div>

        <?php else : ?>
            <div class="text-center">
                <h3 class="text-muted">You haven´t done any reservation yet</h3>
                <a class="btn btn-full mt-5" aria-current="page" href="?book">Book Now</a>

            </div>
        <?php endif; ?>
    </div>
</body>

</html>