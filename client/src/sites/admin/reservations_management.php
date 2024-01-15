<?php
include_once 'model/reservations.php';

$reservations = getMembersReservations();

if (isset($_POST['cancelReservation'])) {
    $reservation_id = isset($_POST['reservation_id']) ? $_POST['reservation_id'] : "";
    cancelReservation($reservation_id, 3);
    header('Location: ?reservations-management');
    exit();
}
if (isset($_POST['confirmReservation'])) {
    $reservation_id = isset($_POST['reservation_id']) ? $_POST['reservation_id'] : "";
    cancelReservation($reservation_id, 1);
    header('Location: ?reservations-management');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Reservations Management - Effectively manage the reservations from the customer">
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
                    <th>Check-in </th>
                    <th>Check-out </th>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Total Price</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
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
                            <td><?= $reservation["adults"] ?></td>
                            <td><?= $reservation["children"] ?></td>
                            <td> <?php
                                    $formatted = number_format($reservation['total_price'], 2, '.', ',');
                                    echo "$" .  $formatted;
                                    ?></td>
                            <td class="text-center">
                                <p class="text-<?= $reservation['status'] == 0 ? 'warning' : ($reservation['status'] == 1 ? 'success' : 'danger') ?>"><?= $reservation['status'] == 0 ? 'Pending' : ($reservation['status'] == 1 ? 'Confirmed' : 'Canceled') ?></p>
                            </td>
                            <td class="text-center">
                                <form action="" method="post">
                                    <?php if ($reservation['status'] == 1) : ?>
                                        <a href="?reservation-info=<?= $reservation['verification_code'] ?>" style="text-decoration:none"><i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mf-tooltip" data-bs-title="Preview" style="cursor: pointer;" class="fa fa-eye fa-lg "></i></a>
                                    <?php elseif ($reservation['status'] == 0) : ?>
                                        <input type="hidden" name="reservation_id" value="<?= $reservation['reservation_id'] ?>">
                                        <button class="btn btn-danger me-2" type="submit" name="cancelReservation"><i class="fa fa-trash text-white me-2"></i>Cancel</button>
                                        <button class="btn btn-success" type="submit" name="confirmReservation"><i class="fa fa-check text-white me-2"></i>Confirm</button>


                                    <?php endif; ?>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach ?>


                </div>
            </tbody>
        </table>
    </div>
</body>

</html>