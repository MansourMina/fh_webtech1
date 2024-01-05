<?php
$title = "";
$folder = "";
$id = "";
$services = [
  "limousine-service" => ["id" => 1, "title" => "Limousine service", "folder" => "limousine"],
  "hotel-spa" => ["id" => 2, "title" => "Hotel's Spa", "image" => "spa-service.webp", "folder" => "spa"],
  "fitness-center" => ["id" => 3, "title" => "Fitness Center", "image" => "fitness-service.webp", "folder" => "fitness"],
  "bar" => ["id" => 4, "title" => "Bar", "image" => "bar-service.webp", "folder" => "bar"],
];
if (empty($_GET["service"])) {
  header("Location: ?404");
  exit;
} else if (isset($_GET['service'])) {
  foreach ($services as $service => $values) {
    if ($service == $_GET['service']) {
      $id = $values["id"];
      $title = $values["title"];
      $folder = $values["folder"];
      break;
    }
  }
  $service = $_GET['service'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .service-img {
      max-height: 60vh;
      min-height: 50vh;
      object-fit: cover;
      position: relative;
    }

    .service-titles {
      letter-spacing: 5px;
      margin-bottom: 40px;
    }

    .row ul {
      list-style-type: circle;
    }
  </style>
</head>

<body>
  <div class="container-fluid mx-0 px-0">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">

        <?php $i = 1;
        foreach (array_filter(glob('src/images/services/' . $folder . '/*'), 'is_file') as $file) : ?>
          <div class="carousel-item  <?= $i == 1 ? 'active' : '' ?> " data-bs-interval="3200">
            <img class="d-block w-100 service-img img-flud" src="<?= $file ?>" alt="Hotel from outside">
          </div>
          <?php $i++; ?>
        <?php endforeach; ?>

      </div>
    </div>
    <div class="container my-5">

      <header>
        <p class="service-titles">Luxury Beyond Appearance</p>
        <h1 class="service-titles">MF <?php echo $title ?></h1>
      </header>
      <?php if ($id == 1) : ?>
        <section class="my-5 ">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <h2 class="service-titles">Arrive in Style</h2>
                <p class="mt-4">Our Limousine Service at MF Palmside Resort is designed to elevate your transportation experience. Enjoy the epitome of luxury as you travel in a sleek, well-appointed limousine, ensuring a seamless and stylish journey from the moment you arrive.</p>
                <div class=" text-center my-5">

                  <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path fill="<?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>" d="M135.2 117.4L109.1 192H402.9l-26.1-74.6C372.3 104.6 360.2 96 346.6 96H165.4c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32H346.6c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2V400v48c0 17.7-14.3 32-32 32H448c-17.7 0-32-14.3-32-32V400H96v48c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V400 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                  </svg>
                </div>
              </div>

              <div class="col-md-6">
                <h3 class="service-titles">Limousine Service Features</h3>
                <ul>
                  <li><strong>Exquisite Fleet:</strong> Choose from our fleet of high-end limousines, each meticulously maintained and equipped with modern amenities for your comfort.</li>
                  <li><strong>Professional Chauffeurs:</strong> Experience personalized service with our professional chauffeurs, ensuring a safe and enjoyable journey throughout your stay.</li>
                  <li><strong>Airport Transfers:</strong> Start and end your trip stress-free with our convenient airport transfer services, making your arrival and departure seamless.</li>
                  <li><strong>Customized Packages:</strong> Tailor your limousine experience with our customizable packages, whether for special events, city tours, or private excursions.</li>
                </ul>
              </div>
            </div>

            <div class="row mt-5">
              <div class="col-md-23">
                <article class="">
                  <h3 class="service-titles">Your Journey, Your Elegance</h3>
                  <p>At MF Palmside Resort, we understand that every journey is unique. Our Limousine Service is designed to add an extra layer of sophistication, ensuring your travel experiences reflect the elegance and style you deserve.</p>
                </article>
              </div>

            </div>
          </div>
        </section>
      <?php elseif ($id == 2) : ?>

        <section class="my-4">
          <div class="container">
            <div class="row">

              <div class="col-md-6">
                <h2 class="service-titles">Pure Relaxation</h2>
                <p class="mt-4">Discover a world of tranquility and rejuvenation at our exquisite spa facility. Our unparalleled spa services are designed to provide a truly blissful escape from the everyday hustle and bustle.</p>
                <div class=" text-center my-5">

                  <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path fill="<?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>" d="M183.1 235.3c33.7 20.7 62.9 48.1 85.8 80.5c7 9.9 13.4 20.3 19.1 31c5.7-10.8 12.1-21.1 19.1-31c22.9-32.4 52.1-59.8 85.8-80.5C437.6 207.8 490.1 192 546 192h9.9c11.1 0 20.1 9 20.1 20.1C576 360.1 456.1 480 308.1 480H288 267.9C119.9 480 0 360.1 0 212.1C0 201 9 192 20.1 192H30c55.9 0 108.4 15.8 153.1 43.3zM301.5 37.6c15.7 16.9 61.1 71.8 84.4 164.6c-38 21.6-71.4 50.8-97.9 85.6c-26.5-34.8-59.9-63.9-97.9-85.6c23.2-92.8 68.6-147.7 84.4-164.6C278 33.9 282.9 32 288 32s10 1.9 13.5 5.6z" />
                  </svg>
                </div>
              </div>

              <div class="col-md-6">

                <h3 class="service-titles">Signature Spa Features</h3>
                <ul>
                  <li><strong>Therapeutic Treatments:</strong> Experience a range of rejuvenating spa treatments tailored to soothe your body and mind.</li>
                  <li><strong>Sauna and Steam Rooms:</strong> Unwind in our state-of-the-art sauna and steam rooms, promoting detoxification and relaxation.</li>
                  <li><strong>Private Massage Rooms:</strong> Enjoy personalized massages in the privacy of our dedicated massage rooms.</li>
                  <li><strong>Refreshment Bar:</strong> Rehydrate and refresh with our complimentary selection of infused water and healthy snacks.</li>
                </ul>
              </div>

            </div>
            <div class="row mt-5">
              <div class="col-md-12">
                <article>
                  <h3 class="service-titles">Our Expert Spa Team</h3>
                  <p>Our highly trained and professional spa therapists are dedicated to ensuring your experience is nothing short of extraordinary. Let us pamper you with our world-class services, leaving you feeling refreshed and revitalized.</p>
                </article>

              </div>
            </div>
          </div>
        </section>
      <?php elseif ($id == 3) : ?>

        <section class="my-5">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <h2 class=" service-titles">Your Fitness Experience</h2>
                <p class="mt-4">Embark on a journey to wellness at our state-of-the-art Fitness Center, where health and vitality take center stage. We're committed to providing you with a comprehensive fitness experience that energizes both body and mind.</p>
                <div class=" text-center my-5">

                  <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path fill="<?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>" d="M96 64c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32V224v64V448c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32V384H64c-17.7 0-32-14.3-32-32V288c-17.7 0-32-14.3-32-32s14.3-32 32-32V160c0-17.7 14.3-32 32-32H96V64zm448 0v64h32c17.7 0 32 14.3 32 32v64c17.7 0 32 14.3 32 32s-14.3 32-32 32v64c0 17.7-14.3 32-32 32H544v64c0 17.7-14.3 32-32 32H480c-17.7 0-32-14.3-32-32V288 224 64c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32zM416 224v64H224V224H416z" />
                  </svg>
                </div>
              </div>

              <div class="col-md-6">
                <h3 class="service-titles">Gym Facilities</h3>
                <ul>
                  <li><strong>Modern Gym Equipment:</strong> Our fitness center is equipped with cutting-edge machines and tools for a diverse range of workouts.</li>
                  <li><strong>Expert Personal Trainers:</strong> Benefit from the guidance of our certified personal trainers, dedicated to helping you achieve your fitness goals.</li>
                  <li><strong>Group Fitness Classes:</strong> Join invigorating group classes led by experienced instructors, promoting camaraderie and motivation.</li>
                  <li><strong>Wellness Amenities:</strong> After your workout, unwind in our relaxation areas or refresh with complimentary towels and hydration stations.</li>
                </ul>

              </div>
            </div>
            <div class="row mt-5">
              <div class="col-md-12">
                <article>
                  <h3 class="service-titles">Shape your stay, hit our gym</h3>
                  <p>At the MF Palmside Resort Fitness Center, we understand that everyone's fitness journey is unique. That's why we offer personalized plans and a supportive environment, ensuring your path to wellness is tailored to your individual needs.</p>
                </article>
              </div>
            </div>

          </div>
        </section>
      <?php elseif ($id == 4) : ?>

        <section class="my-5">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <h2 class="service-titles">Sip, Socialize, and Savor</h2>
                <p class="mt-4">Step into the heart of hospitality at our stylish Bar, where we curate an inviting atmosphere for you to unwind and indulge. Immerse yourself in a world of premium beverages, expertly crafted cocktails, and a convivial ambiance that sets the perfect tone for any occasion.</p>
                <div class=" text-center my-5">
                  <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" viewBox="0 0 640 512">
                    <path fill="<?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>" d="M155.6 17.3C163 3 179.9-3.6 195 1.9L320 47.5l125-45.6c15.1-5.5 32 1.1 39.4 15.4l78.8 152.9c28.8 55.8 10.3 122.3-38.5 156.6L556.1 413l41-15c16.6-6 35 2.5 41 19.1s-2.5 35-19.1 41l-71.1 25.9L476.8 510c-16.6 6.1-35-2.5-41-19.1s2.5-35 19.1-41l41-15-31.3-86.2c-59.4 5.2-116.2-34-130-95.2L320 188.8l-14.6 64.7c-13.8 61.3-70.6 100.4-130 95.2l-31.3 86.2 41 15c16.6 6 25.2 24.4 19.1 41s-24.4 25.2-41 19.1L92.2 484.1 21.1 458.2c-16.6-6.1-25.2-24.4-19.1-41s24.4-25.2 41-19.1l41 15 31.3-86.2C66.5 292.5 48.1 226 76.9 170.2L155.6 17.3zm44 54.4l-27.2 52.8L261.6 157l13.1-57.9L199.6 71.7zm240.9 0L365.4 99.1 378.5 157l89.2-32.5L440.5 71.7z" />
                  </svg>
                </div>
              </div>

              <div class="col-md-6">
                <h3 class="service-titles">Bar Highlights</h3>
                <ul>
                  <li><strong>Craft Cocktails</strong> Experience the artistry of mixology with our skilled bartenders, who create signature cocktails using the finest spirits and fresh ingredients.</li>
                  <li><strong>Extensive Wine Selection:</strong> Explore a curated collection of wines, carefully chosen to complement our diverse menu and satisfy the most discerning palates.</li>
                  <li><strong>Cozy Lounge Areas:</strong> Unwind in our stylish lounge areas, designed for comfort and socializing with friends or fellow travelers.</li>
                  <li><strong>Live Entertainment:</strong> Elevate your evenings with live music or themed events, adding an extra layer of excitement to your bar experience.</li>
                </ul>
              </div>
            </div>

            <div class="row mt-5">
              <div class="col-md-12">
                <article>
                  <h3 class="service-titles">Your Cheers, Your Moments</h3>
                  <p>At the MF Palmside Resort Bar, we celebrate every moment. Whether you're toasting to success or enjoying a casual evening, our attentive staff is dedicated to ensuring your time at the bar is nothing short of exceptional.</p>
                </article>
              </div>

            </div>
          </div>
        </section>
      <?php endif; ?>

    </div>

  </div>

</body>

</html>