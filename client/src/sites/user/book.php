<?php
$image = '';
$room = '';
$total = 0;
include_once 'model/reservations.php';
$room_types = getRoomTypes();
if (isset($_GET['book'])) {
    $images = [
        "Deluxe Ocean-View Suite" => ["image" => "src/images/accomodation/room_2.webp", "price" => 325],
        "Family-Friendly Accommodation" => ["image" => "src/images/accomodation/room_3.webp", "price" => 182],
        "Elegant Suite with Private Balcony" => ["image" => "src/images/accomodation/room_4.webp", "price" => 255],
        "Classic Comfort and Timeless Elegance" => ["image" => "src/images/accomodation/room_1.webp", "price" => 140],
    ];

    if (!empty($_GET['book'])) {
        foreach ($room_types as $room_type) {
            if ($room_type == $room_type) {
                if ($room_type['available'] > 0) {
                    $room = $_GET['book'];
                    $image = $images[$_GET['book']]['image'];
                }
            }
        }
    }
}

if (isset($_POST['reservation'])) {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reservation - Securely reserve your spot with ease.">
    <style>
        .booking {
            padding: 7px 0px 7px 0px;
            font-weight: bold;
        }

        .col {
            margin-bottom: 8px;
            margin-top: 8px;
        }

        label {
            margin-bottom: 2px;
        }

        #room-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container-fluid mx-0 px-0">
        <div class="container my-5">
            <h1>Request a booking</h1>
            <p>Discover the extraordinary with us.</p>
            <div class="booking">
                <form action="" method="post">

                    <div class="row">
                        <div class="col-12  col-lg-7 col-xl-7 border-end">

                            <div class="row">
                                <div class="col">
                                    <label for="room">Room</label>
                                    <select class="form-select" aria-label="Room select" id="room" name="room" onchange="changeRoom()">
                                        <option value="" selected disabled>-- not selected --</option>
                                        <?php foreach ($room_types as $room_type) : ?>
                                            <option <?php echo $room_type['available'] == 0 ? 'disabled' : '' ?> value="<?php echo $room_type['room_type']; ?>" <?php echo $room == $room_type['room_type'] ? 'selected' : '' ?>>
                                                <?= $room_type['room_type'] ?>
                                                <?php if ($room_type['available'] == 0) : ?>

                                                    (not available)
                                                <?php endif; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="name">Name</label>
                                    <input disabled placeholder="John" type="text" id="name" name="name" class="form-control" value="<?php echo isset($_SESSION['member_id']) ? "{$_SESSION['firstname']} {$_SESSION['lastname']}" : ''; ?>">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="email">Email</label>
                                    <input disabled placeholder="example@domain.com" type="email" id="email" name="email" class="form-control" autocomplete="on" value="<?php echo isset($_SESSION['member_id']) ? "{$_SESSION['email']}" : ''; ?>">
                                </div>
                                <div class="col">
                                    <label for="phonenumber">Phone</label>
                                    <input disabled placeholder="+1 999 99-99-99" type="tel" id="phonenumber" name="phonenumber" class="form-control" value="<?php echo isset($_SESSION['member_id']) ? "{$_SESSION['phone_number']}" : ''; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="checkin">Check-in date</label>
                                    <input placeholder="mm/dd/yyyy" type="date" id="checkin" name="checkin" class="form-control" onchange="setDateSummary()">
                                </div>
                                <div class="col">
                                    <label for="checkout">Check-out date</label>
                                    <input placeholder="mm/dd/yyyy" type="date" id="checkout" name="checkout" class="form-control" onchange="setDateSummary()">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <label for="nadults">Number of adults</label>
                                        <select class="form-select" aria-label="Adults select" name="nadults" id="nadults" onchange="setGuests()">
                                            <option selected disabled value="">- Not selected -</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col">
                                    <label for="nchildren">Number of Children</label>
                                    <select class="form-select" aria-label="Children select" name="nchildren" id="nchildren" onchange="setGuests()">
                                        <option selected disabled value="">- Not selected -</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <div>
                                        <input class="form-check-input me-2" type="checkbox" value="" id="breakfastCheckbox" onchange="setTotalSummary()">
                                        <label class="form-check-label" for="breakfastCheckbox">
                                            breakfast <span class="text-muted">(23€/night)</span>
                                        </label>
                                    </div>


                                    <div>
                                        <input class="form-check-input me-2" type="checkbox" value="" id="parkingCheckbox" onchange="setTotalSummary()">
                                        <label class="form-check-label" for="parkingCheckbox">
                                            parking space <span class="text-muted">(12€/night)</span>
                                        </label>
                                    </div>
                                    <div>
                                        <input class="form-check-input me-2" type="checkbox" value="true" id="petCheckbox" onchange="setTotalSummary()">
                                        <label class="form-check-label" for="petCheckbox">
                                            Pet on board <span class="text-muted">(52€)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="Requests">Special Requests</label>
                                <textarea type="text" id="Requests" name="Requests" class="form-control"></textarea>
                            </div>

                        </div>
                        <div class="col-12  col-lg-5 col-xl-5 mt-4 mt-lg-0 mt-xl-0">
                            <div class="px-4">
                                <h5 class="text-uppercase ">Order Summary</h5>
                                <hr>
                            </div>

                            <div class="px-4 py-1">

                                <img src="<?= $image ?>" class="mb-3" alt="Vamos" id="room-img" style="display:none">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Room Type</span>
                                    <span class="fw-bold d-inline-block text-truncate " style=' max-width: 200px;' id="room-name">N/A</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Check-In</span>
                                    <span class="fw-bold" id="summary_checkin">N/A</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Check-Out</span>
                                    <span class="fw-bold" id="summary_checkout">N/A</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1" id="div_summary_days">
                                    <span class="text-muted">Num. of nights</span>
                                    <span class="fw-bold" id="summary_days">N/A</span>
                                </div>
                                <hr>
                                <span class="theme-color">Payment Summary</span>
                                <div class="mb-3">
                                    <hr class="new1">
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span class="text-muted d-inline-block text-truncate " style=' max-width: 140px;' id="payment_room_type">Room</span>
                                    <span class="fw-bold" id="payment_room_price">$0.00</span>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <small><span>Adults</span></small>
                                    <small><span id="payment_adults">$0.00</span></small>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <small><span>Children</span></small>
                                    <small><span id="payment_children">$0.00</span></small>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <small><span>Extras</span></small>
                                    <small> <span id="payment_extras" style="display:none !important">None</span></small>
                                </div>

                                <div class="d-flex justify-content-between " id="payment_breakfast" style="display:none !important">
                                    <small><span>Breakfast</span></small>
                                    <small><span id="payment_breakfast_price">$0.00</span></small>
                                </div>
                                <div class="d-flex justify-content-between" id="payment_parking" style="display:none !important">
                                    <small> <span>Parking space</span></small>
                                    <small><span id="payment_parking_price">$0.00</span></small>
                                </div>
                                <div class="d-flex justify-content-between" id="payment_pet" style="display:none !important">
                                    <small><span>Pet on board</span></small>
                                    <small><span id="payment_pet_price">$0.00</span></small>
                                </div>


                                <div class="d-flex justify-content-between mt-3">
                                    <span class="font-weight-bold">Total</span>
                                    <span class="font-weight-bold theme-color" id="payment_summary">$0.00</span>
                                </div>

                                <div class="d-flex mt-4 justify-content-end">
                                    <button type="submit" name="reservation" class="btn btn-dark btn-full  w-50 mt-4  " style="outline: none;box-shadow:none !important;
                          border:0px solid #ccc !important;">Book</button>
                                    <a type="button" name="register" value="1" class="btn btn-danger  w-50 mt-4 ms-3 " style="outline: none;box-shadow:none !important;
                          border:0px solid #ccc !important;" href="?">Cancel booking</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        let images = {
            "Deluxe Ocean-View Suite": {
                "image": "src/images/accomodation/room_2.webp",
                "price": 325
            },
            "Family-Friendly Accommodation": {
                "image": "src/images/accomodation/room_3.webp",
                "price": 182
            },
            "Elegant Suite with Private Balcony": {
                "image": "src/images/accomodation/room_4.webp",
                "price": 255
            },
            "Classic Comfort and Timeless Elegance": {
                "image": "src/images/accomodation/room_1.webp",
                "price": 140
            }
        };
        changeRoom();
        var checkinInput = document.getElementById("checkin");
        var checkoutInput = document.getElementById("checkout");

        checkinInput.min = new Date().toISOString().split("T")[0];
        checkoutInput.min = new Date(new Date().getTime() + 24 * 60 * 60 * 1000).toISOString().split("T")[0];

        checkinInput.addEventListener('change', function() {
            var checkinDate = new Date(checkinInput.value);
            var nextDay = new Date(checkinDate);
            nextDay.setDate(checkinDate.getDate() + 1);
            checkoutInput.min = nextDay.toISOString().split("T")[0];
        });

        function changeRoom() {
            let selectedRoom = document.getElementById('room').value;
            let img = document.getElementById('room-img');
            let room_name = document.getElementById('room-name');

            if (selectedRoom.trim() !== "") {
                img.src = images[selectedRoom].image;
                room_name.innerText = selectedRoom;
                img.style.display = 'block';
                setTotalSummary();
            } else {
                img.src = '';
                img.style.display = 'none';
            }

        }

        function setDateSummary() {
            let checkinValue = document.getElementById('checkin').value;
            let checkoutValue = document.getElementById('checkout').value;
            checkinValue ? document.getElementById('summary_checkin').innerText = checkinValue : '';
            checkoutValue ? document.getElementById('summary_checkout').innerText = checkoutValue : '';
            if (checkinValue && checkoutValue) {
                document.getElementById('summary_days').innerText = getDays();
                setTotalSummary()
            }
        }

        function getRoomPrice() {
            let selectedRoom = document.getElementById('room').value;
            if (selectedRoom) return images[selectedRoom].price;
            return 0;

        }

        function getDays() {
            let checkinValue = new Date(document.getElementById('checkin').value);
            let checkoutValue = new Date(document.getElementById('checkout').value);
            const timeDifference = checkoutValue.getTime() - checkinValue.getTime();
            if (timeDifference > 0) {
                // Convert the time difference to days
                const daysDifference = timeDifference / (24 * 60 * 60 * 1000);
                return Math.round(daysDifference);
            }
            return 0;
        }

        function setExtras() {
            let breakfastValue = document.getElementById('breakfastCheckbox');
            let parkinValue = document.getElementById('parkingCheckbox');
            let petValue = document.getElementById('petCheckbox');
            setTotalSummary();
            showExtrasPaymentSummary(breakfastValue, parkinValue, petValue, getDays())
        }

        function formattedNumber(price) {
            if (price > 0) {
                let formatted = price.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD',
                    minimumFractionDigits: 2
                });
                return formatted;
            }
            return '$0.00';

        }

        function showRoomPaymentSummary(room_price, days) {
            let payment_room_type = document.getElementById('payment_room_type');
            let payment_room_price = document.getElementById('payment_room_price');
            let room_name = document.getElementById('room-name').innerText;
            payment_room_type.innerText = room_name;
            payment_room_price.innerText = `${formattedNumber(room_price)} ${days > 0 ? '(*' + days + ' Nights)':''}`;

        }

        function showGuestsPaymentSummary(adults, children, childrenPrice, adultsPrice) {
            if (adults > 0) {
                let payment_adults = document.getElementById('payment_adults');
                payment_adults.innerText = `${formattedNumber(adultsPrice)} (${adults})`;
            }
            if (children > 0) {
                let payment_children = document.getElementById('payment_children');
                payment_children.innerText = `${formattedNumber(childrenPrice)} (${children})`;
            }



        }

        function showExtrasPaymentSummary(breakfastCheck, parkingCheck, petCheck, days) {
            document.getElementById('payment_breakfast').style = 'display: none !important';
            document.getElementById('payment_parking').style = 'display: none !important';
            document.getElementById('payment_pet').style = 'display: none !important';
            document.getElementById('payment_extras').style.display = 'none';



            if (breakfastCheck.checked) {
                let payment_breakfast_price = document.getElementById('payment_breakfast_price');
                let payment_breakfast = document.getElementById('payment_breakfast');
                payment_breakfast.style.display = 'block';
                payment_breakfast_price.innerText = formattedNumber(23 * days)
            }
            if (parkingCheck.checked) {
                let payment_parking = document.getElementById('payment_parking');
                let payment_parking_price = document.getElementById('payment_parking_price');
                payment_parking.style.display = 'block';
                payment_parking_price.innerText = formattedNumber(12 * days)
            }
            if (petCheck.checked) {
                let payment_pet = document.getElementById('payment_pet');
                let payment_pet_price = document.getElementById('payment_pet_price');
                payment_pet.style.display = 'block';
                payment_pet_price.innerText = formattedNumber(52 * days)
            }
            if (!breakfastCheck.checked && !parkingCheck.checked && !petCheck.checked) {
                document.getElementById('payment_extras').style.display = 'block';
            }

        }

        function setTotalSummary() {
            let payment_summary = 0;
            let room_price = getRoomPrice();
            let days = getDays();
            let childrenValue = document.getElementById('nchildren').value;
            let adultsValue = document.getElementById('nadults').value;
            childrenValue !== '' ? payment_summary += days * (childrenValue * room_price) / 2 : 0
            adultsValue !== '' ? payment_summary += days * adultsValue * room_price : 0

            // Extras
            let breakfastCheck = document.getElementById('breakfastCheckbox');
            let parkingCheck = document.getElementById('parkingCheckbox');
            let petCheck = document.getElementById('petCheckbox');
            breakfastCheck.checked ? payment_summary += days * 23 : 0;
            parkingCheck.checked ? payment_summary += days * 12 : 0;
            petCheck.checked ? payment_summary += days * 52 : 0;

            // Convert to currency format

            document.getElementById("payment_summary").innerText = formattedNumber(payment_summary);
            showRoomPaymentSummary(room_price, days);
            showGuestsPaymentSummary(adultsValue, childrenValue, days * (childrenValue * room_price) / 2, days * adultsValue * room_price)
            showExtrasPaymentSummary(breakfastCheck, parkingCheck, petCheck, days);

        }
    </script>
</body>

</html>