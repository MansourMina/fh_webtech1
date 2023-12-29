<?php
$title = "";
$folder = "";
$id = "";
$services = [
  "limousine-service" => ["id" => 1, "title" => "Limousine service", "folder" => "limousine"],
  "hotel-spa" => ["id" => 2, "title" => "Hotel's Spa", "image" => "spa-service.jpg", "folder" => "spa"],
  "fitness-center" => ["id" => 3, "title" => "Fitness Center", "image" => "fitness-service.jpg", "folder" => "fitness"],
  "bar" => ["id" => 4, "title" => "Bar", "image" => "bar-service.jpg", "folder" => "bar"],
];

if (isset($_GET['service'])) {
  foreach ($services as $service => $values) {
    if ($service == $_GET['service']) {
      $id = $values["id"];
      $title = $values["title"];
      $folder = $values["folder"];
      break;
    }
  }
  $service = $_GET['service'];
} ?>

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
        <p>Luxury Beyond Appearance</p>
        <h1>MF Palmside Resort <?php echo $title ?></h1>
      </header>
      <?php if ($id == 1) : ?>
        <section>
          <h2 class="mt-4">Arrive in Style, Travel in Comfort</h2>

          <p class="mt-4">Our Limousine Service at MF Palmside Resort is designed to elevate your transportation experience. Enjoy the epitome of luxury as you travel in a sleek, well-appointed limousine, ensuring a seamless and stylish journey from the moment you arrive.</p>

          <article class="mt-4">
            <h3>Limousine Service Features</h3>
            <ul>
              <li><strong>Exquisite Fleet:</strong> Choose from our fleet of high-end limousines, each meticulously maintained and equipped with modern amenities for your comfort.</li>
              <li><strong>Professional Chauffeurs:</strong> Experience personalized service with our professional chauffeurs, ensuring a safe and enjoyable journey throughout your stay.</li>
              <li><strong>Airport Transfers:</strong> Start and end your trip stress-free with our convenient airport transfer services, making your arrival and departure seamless.</li>
              <li><strong>Customized Packages:</strong> Tailor your limousine experience with our customizable packages, whether for special events, city tours, or private excursions.</li>
            </ul>
          </article>

          <article class="mt-4">
            <h3>Your Journey, Your Elegance</h3>
            <p>At MF Palmside Resort, we understand that every journey is unique. Our Limousine Service is designed to add an extra layer of sophistication, ensuring your travel experiences reflect the elegance and style you deserve.</p>
          </article>

          <footer class="mt-4">
            <p>Indulge in the luxury of effortless travel with the MF Palmside Resort Limousine Service. Your journey awaits, adorned with comfort and style.</p>
          </footer>
        </section>
      <?php elseif ($id == 2) : ?>

        <section>
          <h2 class="mt-4">Indulge in Pure Relaxation</h2>

          <p class="mt-4">Discover a world of tranquility and rejuvenation at our exquisite spa facility. Our unparalleled spa services are designed to provide a truly blissful escape from the everyday hustle and bustle.</p>

          <article class="mt-4">
            <h3>Signature Spa Features</h3>
            <ul>
              <li><strong>Therapeutic Treatments:</strong> Experience a range of rejuvenating spa treatments tailored to soothe your body and mind.</li>
              <li><strong>Sauna and Steam Rooms:</strong> Unwind in our state-of-the-art sauna and steam rooms, promoting detoxification and relaxation.</li>
              <li><strong>Private Massage Rooms:</strong> Enjoy personalized massages in the privacy of our dedicated massage rooms.</li>
              <li><strong>Refreshment Bar:</strong> Rehydrate and refresh with our complimentary selection of infused water and healthy snacks.</li>
            </ul>
          </article>

          <article class="mt-4">
            <h3>Our Expert Spa Team</h3>
            <p>Our highly trained and professional spa therapists are dedicated to ensuring your experience is nothing short of extraordinary. Let us pamper you with our world-class services, leaving you feeling refreshed and revitalized.</p>
          </article>

          <footer class="mt-4">
            <p>Indulge in the extraordinary at the MF Palmside Resort Spa. Your journey to relaxation begins here.</p>
          </footer>
        </section>
      <?php elseif ($id == 3) : ?>

        <section>
          <h2 class="mt-4">Elevate Your Fitness Experience</h2>

          <p class="mt-4">Embark on a journey to wellness at our state-of-the-art Fitness Center, where health and vitality take center stage. We're committed to providing you with a comprehensive fitness experience that energizes both body and mind.</p>

          <article class="mt-4">
            <h3>Exceptional Fitness Facilities</h3>
            <ul>
              <li><strong>Modern Gym Equipment:</strong> Our fitness center is equipped with cutting-edge machines and tools for a diverse range of workouts.</li>
              <li><strong>Expert Personal Trainers:</strong> Benefit from the guidance of our certified personal trainers, dedicated to helping you achieve your fitness goals.</li>
              <li><strong>Group Fitness Classes:</strong> Join invigorating group classes led by experienced instructors, promoting camaraderie and motivation.</li>
              <li><strong>Wellness Amenities:</strong> After your workout, unwind in our relaxation areas or refresh with complimentary towels and hydration stations.</li>
            </ul>
          </article>

          <article class="mt-4">
            <h3>Your Fitness, Your Way</h3>
            <p>At the MF Palmside Resort Fitness Center, we understand that everyone's fitness journey is unique. That's why we offer personalized plans and a supportive environment, ensuring your path to wellness is tailored to your individual needs.</p>
          </article>

          <footer class="mt-4">
            <p>Experience fitness at its finest at the MF Palmside Resort. Your journey to a healthier, stronger you begins here.</p>
          </footer>
        </section>
      <?php elseif ($id == 4) : ?>

        <section>
          <h2 class="mt-4">Sip, Socialize, and Savor</h2>

          <p class="mt-4">Step into the heart of hospitality at our stylish Bar, where we curate an inviting atmosphere for you to unwind and indulge. Immerse yourself in a world of premium beverages, expertly crafted cocktails, and a convivial ambiance that sets the perfect tone for any occasion.</p>

          <article class="mt-4">
            <h3>Bar Highlights</h3>
            <ul>
              <li><strong>Craft Cocktails</strong> Experience the artistry of mixology with our skilled bartenders, who create signature cocktails using the finest spirits and fresh ingredients.</li>
              <li><strong>Extensive Wine Selection:</strong> Explore a curated collection of wines, carefully chosen to complement our diverse menu and satisfy the most discerning palates.</li>
              <li><strong>Cozy Lounge Areas:</strong> Unwind in our stylish lounge areas, designed for comfort and socializing with friends or fellow travelers.</li>
              <li><strong>Live Entertainment:</strong> Elevate your evenings with live music or themed events, adding an extra layer of excitement to your bar experience.</li>
            </ul>
          </article>

          <article class="mt-4">
            <h3>Your Cheers, Your Moments</h3>
            <p>At the MF Palmside Resort Bar, we celebrate every moment. Whether you're toasting to success or enjoying a casual evening, our attentive staff is dedicated to ensuring your time at the bar is nothing short of exceptional.</p>
          </article>

          <footer class="mt-4">
            <p>Raise your glass and savor the moment at the MF Palmside Resort Bar. Your unforgettable experiences await.</p>
          </footer>
        </section>
      <?php endif; ?>

    </div>

  </div>
</body>

</html>