<?php
include_once 'model/reservations.php';
if (isset($_GET['reservation-info'])) {
    $reservation = getReservation($_GET['reservation-info']);
    if ($_SESSION['member_id'] != $reservation['member_id'] && $_SESSION['is_admin'] == false || $reservation['status'] != 1) {
        header("Location: ?reservations");
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reservation Information">

    <style>
        .timeline-with-icons {
            border-left: 1px solid hsl(0, 0%, 90%);
            position: relative;
            list-style: none;
        }

        .timeline-with-icons .timeline-item {
            position: relative;
        }

        .timeline-with-icons .timeline-item:after {
            position: absolute;
            display: block;
            top: 0;
        }

        .timeline-with-icons .timeline-icon {
            position: absolute;
            left: -48px;
            background-color: hsl(217, 88.2%, 90%);
            color: hsl(217, 88.8%, 35.1%);
            border-radius: 50%;
            height: 31px;
            width: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <section class="py-5 p-3">
            <ul class="timeline-with-icons">
                <div class="timeline-item mb-5">
                    <span class="timeline-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#15736b" d="M.3 166.9L0 68C0 57.7 9.5 50.1 19.5 52.3l35.6 7.9c10.6 2.3 19.2 9.9 23 20L96 128l127.3 37.6L181.8 20.4C178.9 10.2 186.6 0 197.2 0h40.1c11.6 0 22.2 6.2 27.9 16.3l109 193.8 107.2 31.7c15.9 4.7 30.8 12.5 43.7 22.8l34.4 27.6c24 19.2 18.1 57.3-10.7 68.2c-41.2 15.6-86.2 18.1-128.8 7L121.7 289.8c-11.1-2.9-21.2-8.7-29.3-16.9L9.5 189.4c-5.9-6-9.3-14.1-9.3-22.5zM32 448H608c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32zm96-80a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm128-16a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                        </svg>
                    </span>

                    <h5 class="fw-bold">Check-in</h5>
                    <p class="text-muted fw-bold mb-2 ">
                        <?php
                        $todaysdate = new DateTime();
                        $checkinDatum = new DateTime($reservation["check_in_date"]);
                        if ($todaysdate->format('Y-m-d') > $checkinDatum->format('Y-m-d'))
                            echo "Completed";
                        else if ($todaysdate->format('Y-m-d') == $checkinDatum->format('Y-m-d'))
                            echo "Today";
                        else {
                            $differenz = $todaysdate->diff($checkinDatum);
                            echo "In " . $differenz->format("%a") + 1 . " Days";
                        }
                        ?>
                    </p>
                    <div>

                        <li class="timeline-item mb-5">
                            <div class="text-muted">
                                Your reservation has been successfully confirmed, and we are already looking forward to ensuring you have a pleasant stay.
                                Our entire team is ready to make sure your time at MF Palmside Resort is unforgettable. If you have any questions or concerns, please do not hesitate to contact us anytime.
                                <div class="mt-3">
                                    <?php if ($reservation['adults'] > 0) : ?>
                                        <p>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path fill="<?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>" d="M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V256.9L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6h29.7c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V352H152z" />
                                            </svg>
                                            <span class="ms-2 fw-bold"><?= $reservation['adults'] ?> <?= $reservation['adults'] > 1 ? 'Adults' : 'Adult' ?></span>
                                        </p>
                                    <?php endif; ?>

                                    <?php if ($reservation['children'] > 0) : ?>
                                        <p>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path fill="<?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>" d="M96 64a64 64 0 1 1 128 0A64 64 0 1 1 96 64zm48 320v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V287.8L59.1 321c-9.4 15-29.2 19.4-44.1 10S-4.5 301.9 4.9 287l39.9-63.3C69.7 184 113.2 160 160 160s90.3 24 115.2 63.6L315.1 287c9.4 15 4.9 34.7-10 44.1s-34.7 4.9-44.1-10L240 287.8V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V384H144z" />
                                            </svg>
                                            <span class="ms-2 fw-bold"><?= $reservation['children'] ?> <?= $reservation['children'] > 1 ? 'Children' : 'Child' ?></span>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>

                        <li class="timeline-item mb-5">
                            <span class="timeline-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="#15736b" d="M375.7 19.7c-1.5-8-6.9-14.7-14.4-17.8s-16.1-2.2-22.8 2.4L256 61.1 173.5 4.2c-6.7-4.6-15.3-5.5-22.8-2.4s-12.9 9.8-14.4 17.8l-18.1 98.5L19.7 136.3c-8 1.5-14.7 6.9-17.8 14.4s-2.2 16.1 2.4 22.8L61.1 256 4.2 338.5c-4.6 6.7-5.5 15.3-2.4 22.8s9.8 13 17.8 14.4l98.5 18.1 18.1 98.5c1.5 8 6.9 14.7 14.4 17.8s16.1 2.2 22.8-2.4L256 450.9l82.5 56.9c6.7 4.6 15.3 5.5 22.8 2.4s12.9-9.8 14.4-17.8l18.1-98.5 98.5-18.1c8-1.5 14.7-6.9 17.8-14.4s2.2-16.1-2.4-22.8L450.9 256l56.9-82.5c4.6-6.7 5.5-15.3 2.4-22.8s-9.8-12.9-17.8-14.4l-98.5-18.1L375.7 19.7zM269.6 110l65.6-45.2 14.4 78.3c1.8 9.8 9.5 17.5 19.3 19.3l78.3 14.4L402 242.4c-5.7 8.2-5.7 19 0 27.2l45.2 65.6-78.3 14.4c-9.8 1.8-17.5 9.5-19.3 19.3l-14.4 78.3L269.6 402c-8.2-5.7-19-5.7-27.2 0l-65.6 45.2-14.4-78.3c-1.8-9.8-9.5-17.5-19.3-19.3L64.8 335.2 110 269.6c5.7-8.2 5.7-19 0-27.2L64.8 176.8l78.3-14.4c9.8-1.8 17.5-9.5 19.3-19.3l14.4-78.3L242.4 110c8.2 5.7 19 5.7 27.2 0zM256 368a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM192 256a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z" />
                                </svg>
                            </span>
                            <h5 class="fw-bold">Enjoy your stay</h5>
                            <p class="text-muted mb-2 fw-bold">
                                <?php
                                $todaysdate = new DateTime();
                                $checkinDatum = new DateTime($reservation["check_in_date"]);
                                if ($todaysdate->format('Y-m-d') > $checkinDatum->format('Y-m-d'))
                                    echo "Completed";
                                else if ($todaysdate->format('Y-m-d') == $checkinDatum->format('Y-m-d'))
                                    echo "Today";
                                else {
                                    echo $reservation["check_in_date"];
                                }
                                ?>
                            </p>
                            <div class="text-muted">
                                Welcome to MF Palmside Resort! We hope your journey was pleasant, and we are delighted to know you have safely arrived.
                                Our entire team is at your disposal to ensure that your stay is as relaxing and comfortable as possible. If you have any special requests or concerns, please feel free to contact us at any time.
                                Enjoy the amenities of our hotel, and let us know if there's anything we can assist you with. Wishing you a wonderful stay at MF Palmside Resort.

                                <div class="mt-3">
                                    <?php if ($reservation['breakfast']) : ?>
                                        <p>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path fill="<?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>" d="M416 0C400 0 288 32 288 176V288c0 35.3 28.7 64 64 64h32V480c0 17.7 14.3 32 32 32s32-14.3 32-32V352 240 32c0-17.7-14.3-32-32-32zM64 16C64 7.8 57.9 1 49.7 .1S34.2 4.6 32.4 12.5L2.1 148.8C.7 155.1 0 161.5 0 167.9c0 45.9 35.1 83.6 80 87.7V480c0 17.7 14.3 32 32 32s32-14.3 32-32V255.6c44.9-4.1 80-41.8 80-87.7c0-6.4-.7-12.8-2.1-19.1L191.6 12.5c-1.8-8-9.3-13.3-17.4-12.4S160 7.8 160 16V150.2c0 5.4-4.4 9.8-9.8 9.8c-5.1 0-9.3-3.9-9.8-9L127.9 14.6C127.2 6.3 120.3 0 112 0s-15.2 6.3-15.9 14.6L83.7 151c-.5 5.1-4.7 9-9.8 9c-5.4 0-9.8-4.4-9.8-9.8V16zm48.3 152l-.3 0-.3 0 .3-.7 .3 .7z" />
                                            </svg>
                                            <span class="ms-2 fw-bold">Breakfast included</span>
                                        </p>
                                        <?php if ($reservation['parking']) : ?>
                                            <p>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path fill="<?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>" d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM192 256h48c17.7 0 32-14.3 32-32s-14.3-32-32-32H192v64zm48 64H192v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V288 168c0-22.1 17.9-40 40-40h72c53 0 96 43 96 96s-43 96-96 96z" />
                                                </svg>
                                                <span class="ms-2 fw-bold">Parking space included</span>
                                            </p>
                                        <?php endif; ?>

                                        <?php if ($reservation['pet']) : ?>
                                            <p>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path fill="<?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>" d="M309.6 158.5L332.7 19.8C334.6 8.4 344.5 0 356.1 0c7.5 0 14.5 3.5 19 9.5L392 32h52.1c12.7 0 24.9 5.1 33.9 14.1L496 64h56c13.3 0 24 10.7 24 24v24c0 44.2-35.8 80-80 80H464 448 426.7l-5.1 30.5-112-64zM416 256.1L416 480c0 17.7-14.3 32-32 32H352c-17.7 0-32-14.3-32-32V364.8c-24 12.3-51.2 19.2-80 19.2s-56-6.9-80-19.2V480c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V249.8c-28.8-10.9-51.4-35.3-59.2-66.5L1 167.8c-4.3-17.1 6.1-34.5 23.3-38.8s34.5 6.1 38.8 23.3l3.9 15.5C70.5 182 83.3 192 98 192h30 16H303.8L416 256.1zM464 80a16 16 0 1 0 -32 0 16 16 0 1 0 32 0z" />

                                                    <span class="ms-2 fw-bold">Pet on board included</span>
                                            </p>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>

                        <li class="timeline-item mb-5">

                            <span class="timeline-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="#15736b" d="M381 114.9L186.1 41.8c-16.7-6.2-35.2-5.3-51.1 2.7L89.1 67.4C78 73 77.2 88.5 87.6 95.2l146.9 94.5L136 240 77.8 214.1c-8.7-3.9-18.8-3.7-27.3 .6L18.3 230.8c-9.3 4.7-11.8 16.8-5 24.7l73.1 85.3c6.1 7.1 15 11.2 24.3 11.2H248.4c5 0 9.9-1.2 14.3-3.4L535.6 212.2c46.5-23.3 82.5-63.3 100.8-112C645.9 75 627.2 48 600.2 48H542.8c-20.2 0-40.2 4.8-58.2 14L381 114.9zM0 480c0 17.7 14.3 32 32 32H608c17.7 0 32-14.3 32-32s-14.3-32-32-32H32c-17.7 0-32 14.3-32 32z" />
                                </svg>
                            </span>
                            <h5 class="fw-bold">Day of departure</h5>
                            <p class="text-muted mb-2 fw-bold">
                            <p class="text-muted mb-2 fw-bold">
                                <?php
                                $todaysdate = new DateTime();
                                $checkinDatum = new DateTime($reservation["check_out_date"]);
                                if ($todaysdate->format('Y-m-d') > $checkinDatum->format('Y-m-d'))
                                    echo "Completed";
                                else if ($todaysdate->format('Y-m-d') == $checkinDatum->format('Y-m-d'))
                                    echo "Today";
                                else {
                                    echo $reservation["check_out_date"];
                                }
                                ?>
                            </p>
                            </p>
                            <p class="text-muted">
                                It was a pleasure to have you as our valued guest. We hope your stay was enjoyable, and that you were able to fully experience the amenities our hotel has to offer.
                                Our goal is always to provide our guests with a memorable and comfortable stay, and your feedback is particularly important to us. If you have any comments or suggestions, we would love to hear from you.
                                Thank you for choosing MF Palmside Resort.
                            </p>
                        </li>

                        <li class="timeline-item mb-5">

                            <span class="timeline-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="#15736b" d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V240c0 8.8-7.2 16-16 16s-16-7.2-16-16V64c0-17.7-14.3-32-32-32s-32 14.3-32 32V336c0 1.5 0 3.1 .1 4.6L67.6 283c-16-15.2-41.3-14.6-56.6 1.4s-14.6 41.3 1.4 56.6L124.8 448c43.1 41.1 100.4 64 160 64H304c97.2 0 176-78.8 176-176V128c0-17.7-14.3-32-32-32s-32 14.3-32 32V240c0 8.8-7.2 16-16 16s-16-7.2-16-16V64c0-17.7-14.3-32-32-32s-32 14.3-32 32V240c0 8.8-7.2 16-16 16s-16-7.2-16-16V32z" />
                                </svg>
                            </span>
                            <h5 class="fw-bold">Goodbye! See you soon!</h5>

                        </li>
                        <?php if (!$_SESSION['is_admin']) : ?>
                            <a href="?reservations" class="btn btn-secondary">
                                Go back to your Reservations
                            </a>
                        <?php endif; ?>

            </ul>
        </section>
    </div>

</body>

</html>