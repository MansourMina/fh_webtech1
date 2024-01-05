<?php
include_once 'model/reservations.php';

$reservations = getMembersReservations();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Reservations Management - Effectively manage the reservations from the customer">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h2>RESERVATIONS</h2>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Check-in date</th>
                    <th>Check-out date</th>
                    <th>Guests</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>

            </thead>
            <tbody>
                <div class="form-check">
                    <?php foreach ($reservations as $reservation) : ?>
                        <tr>
                            <td>
                                <a href=<?= '?members-profile=' . $reservation['member_id'] ?>>
                                    <img src="<?php echo isset($reservation["image"]) ? $reservation["image"] : 'res/img/default.jpg' ?>" alt="Profile Image" class="rounded-circle img-circle" width="50" height="50" id="profile">
                                </a>
                            </td>

                            <td><?= $reservation["firstname"] ?> <?= $reservation["lastname"] ?></td>
                            <td><?= $reservation["email"] ?></td>
                            <td><?= $reservation["check_in_date"] ?></td>
                            <td><?= $reservation["check_out_date"] ?></td>
                            <td><?= $reservation["guest_count"] ?></td>
                            <td><?= $reservation["total_price"] ?></td>
                            <td><?= $reservation["status"] ?></td>
                        </tr>
                    <?php endforeach ?>


                </div>
            </tbody>
        </table>
    </div>
</body>

</html>