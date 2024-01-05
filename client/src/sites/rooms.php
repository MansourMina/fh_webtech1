<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .l-img {
            min-height: 100%;
            width: auto;
            object-fit: cover;
            position: relative;
        }

        h5 {
            color: <?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>
        }
    </style>
</head>

<body>
    <div class="container  ">

        <div class="row no-gutters shadow-box " style="min-height: 40vh;">
            <div class="col-lg-7 ">
                <img src="src/images/accomodation/room_2.webp" class="img-fluid l-img" alt=" MF Palmside Resort">

            </div>
            <div class="col-lg-5 ">
                <div class="mb-2">
                    <i class="fa fa-star text-warning"></i>
                    <span class="fw-bold ">Top Pick</span>
                </div>


                <h5 class="fw-bolder">Deluxe Ocean-View Suite</h5>
                <p>Immerse yourself in the epitome of luxury with our Top Pick, the Deluxe Ocean-View Suite at MF Palmside Resort.</p>
                <p>
                <p class="fw-bolder mt-3 mb-1">Bedding</p>
                The Deluxe Ocean-View Suite promises a restful night's sleep on a bed adorned with premium linens and an array of plush pillows. The bedding is designed for ultimate comfort, inviting you to unwind and wake up refreshed to the sound of the waves and the breathtaking ocean views.

                <p class="fw-bolder mt-3 mb-1">Amenities</p>
                Experience unparalleled luxury with amenities tailored to elevate your stay

                <p class="fw-bolder mt-1 mb-0">Private Balcony</p>
                Experience the Deluxe Ocean-View Suite's standout feature – a generously sized private balcony providing breathtaking, unobstructed views of the Caribbean Sea.

                <p class="fw-bolder mb-0">Luxurious Bath</p>
                Treat yourself to the opulent ensuite bathroom, complete with contemporary fixtures, a deep soaking tub, and complimentary high-quality toiletries.

                <p class="fw-bolder mb-0">In-Room Entertainment</p>
                <p>Enjoy a flat-screen TV with a diverse channel selection, ensuring you can relax with your preferred shows or movies during your stay.</p>
                <?php if ((isset($_SESSION['member_id']) && $_SESSION['is_admin'] == 0) || !isset($_SESSION['member_id'])) : ?>

                    <a class="btn btn-outline-<?= $GLOBALS["darkMode"] ? 'light' : 'dark' ?>" href="?book=<?php echo "Deluxe Ocean-View Suite"; ?>">Book Now <i class="fa fa-hotel "></i></a>
                <?php endif; ?>
            </div>
        </div>
        <hr class="my-5">
        <div class="row no-gutters shadow-box " style="min-height: 40vh;">

            <div class="col-lg-7 ">
                <img src="src/images/accomodation/room_3.webp" class="img-fluid l-img" alt=" MF Palmside Resort">

            </div>
            <div class="col-lg-5 ">



                <h5 class="fw-bolder">Family-Friendly Accommodation</h5>
                <p>Our spacious Family-Friendly Rooms are designed with your loved ones in mind. </p>
                <p>
                <p class="fw-bolder mt-3 mb-1">Color Scheme</p>
                Step into a vibrant and welcoming atmosphere with a family-friendly color scheme that combines playful tones with soothing hues.

                <p class="fw-bolder mt-3 mb-1">Bedding</p>
                Our Family-Friendly Rooms feature versatile bedding options to accommodate different family configurations. Plush beds with a variety of pillow options provide a cozy haven for a restful night's sleep.

                <p class="fw-bolder mt-3 ">Amenities</p>
                These thoughtfully appointed rooms are equipped with a range of amenities catering to families

                <p>These family-oriented rooms feature amenities such as kid-friendly entertainment with a selection of movies and TV channels suitable for all ages. Safety is prioritized with childproofing features, providing peace of mind for parents. The spacious layout is designed for comfort, offering ample room for families to move around, blending functionality and style for everyone's relaxation.</p>
                <?php if ((isset($_SESSION['member_id']) && $_SESSION['is_admin'] == 0) || !isset($_SESSION['member_id'])) : ?>

                    <a class="btn btn-outline-<?= $GLOBALS["darkMode"] ? 'light' : 'dark' ?>" href="?book=<?php echo "Family-Friendly Accommodation"; ?>">Book Now <i class="fa fa-hotel "></i></a>
                <?php endif; ?>
            </div>
        </div>
        <hr class="my-5">
        <div class="row no-gutters shadow-box " style="min-height: 40vh;">

            <div class="col-lg-7 ">
                <img src="src/images/accomodation/room_4.webp" class="img-fluid l-img" alt=" MF Palmside Resort">

            </div>
            <div class="col-lg-5 ">


                <h5 class="fw-bolder">Elegant Suite with Private Balcony</h5>
                <p>Discover elegance and luxury in our Suite with Private Balcony. </p>
                <p class="fw-bolder mt-3 mb-1">Color Scheme</p>
                Step into a harmonious color palette that captures the essence of coastal elegance. Soft tones of ocean blues and sandy beige create a serene ambiance, seamlessly blending the interior with the breathtaking views visible through the balcony.

                <p class="fw-bolder mt-3 mb-1">Bedding</p>
                Experience the pinnacle of comfort in our Elegant Suite with premium bedding. The bed is adorned with high-thread-count linens and an array of plush pillows, promising a restful night's sleep.

                <p class="fw-bolder mt-3 mb-1">Amenities</p>
                Your Elegant Suite is thoughtfully equipped with an array of amenities to enhance your stay

                <p>The room features a spacious private balcony, ideal for starting the day with coffee or unwinding in the evening with coastal views. Stay connected with high-speed Wi-Fi, enjoy an entertainment system with a flat-screen TV, and indulge in a well-stocked mini-bar. Pamper yourself with premium bath amenities for added luxury.</p>
                <?php if ((isset($_SESSION['member_id']) && $_SESSION['is_admin'] == 0) || !isset($_SESSION['member_id'])) : ?>

                    <a class="btn btn-outline-<?= $GLOBALS["darkMode"] ? 'light' : 'dark' ?>" href="?book=<?php echo "Elegant Suite with Private Balcony"; ?>">Book Now <i class="fa fa-hotel "></i></a>
                <?php endif; ?>

            </div>
        </div>
        <hr class="my-5">
        <div class="row no-gutters shadow-box " style="min-height: 40vh;">

            <div class="col-lg-7 ">
                <img src="src/images/accomodation/room_1.webp" class="img-fluid l-img" alt=" MF Palmside Resort">

            </div>
            <div class="col-lg-5 ">



                <h5 class="fw-bolder"></i>Classic Comfort and Timeless Elegance</h5>
                <p>The Classic Room is available in both single and double configurations, offering flexibility to cater to individual travelers or couples seeking a cozy retreat.</p>

                <p>
                <p class="fw-bold">Color Scheme</p>
                Immerse yourself in a palette of soothing neutral tones complemented by tasteful accents, creating an ambiance that exudes timeless elegance. Subtle shades of cream and beige are interspersed with touches of soft blues or greens, adding a touch of sophistication to the space.</p>
                <p>
                <p class="fw-bold">Bedding</p>
                Indulge in the plush comfort of deluxe bedding, adorned with high-quality linens and an array of soft pillows. The bed is positioned to offer a perfect view of any entertainment options and the scenic surroundings.</p>
                <p>
                <p class="fw-bold">Amenities</p>

                <p class="p-0 m-0">High-speed Wi-Fi</p>
                <p class="p-0 m-0">Flat-screen TV with a selection of channels</p>
                <p class="p-0 m-0">In-room coffee and tea-making facilities</p>
                <p class="p-0 m-0">Workstation with desk and chair</p>
                <p class="p-0 m-0">Climate control for personalized comfort</p>
                </p>
                <?php if ((isset($_SESSION['member_id']) && $_SESSION['is_admin'] == 0) || !isset($_SESSION['member_id'])) : ?>
                    <a class="btn btn-outline-<?= $GLOBALS["darkMode"] ? 'light' : 'dark' ?>" href="?book=<?php echo "Classic Comfort and Timeless Elegance"; ?>">Book Now <i class="fa fa-hotel "></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>