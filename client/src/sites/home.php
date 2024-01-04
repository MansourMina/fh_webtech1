<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active drk " data-bs-interval="4000">
      <img class="d-block w-100 " src="src/images/outer/outer_1.jpg" alt="Hotel from outside">

    </div>
    <div class="carousel-item drk " data-bs-interval="4000">
      <img class="d-block w-100 " src="src/images/outer/outer_2.jpg" alt="Hotel from outside">
    </div>
  </div>
  <div class="carousel-caption text-white">
    <div class="d-none d-sm-block">
      <h1>MF Palmside Resort </h1>
      <?php if (isset($_SESSION['member_id'])) : ?>
        <p> Welcome <span class='fw-bold'><?= $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?></span> </p>
      <?php endif; ?>
      <p>Playa El Aqua, Venezuela</p>
    </div>
    <div>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
    </div>

    <hr class="mt-3 bg-white mx-auto" style="width: 10vw; padding: 0.9px" />

  </div>
</div>

<div class="card my-5 py-5 text-center" style="align-items:center; ">
  <div class="card-body col-12  col-lg-12 col-xl-6 mx-auto text-center">
    <p class="card-subtitle mb-2 text-body-secondary">5-Star Beachfront Hotel in Playa El Aqua, Venezuela</p>
    <h1 class="card-title">Welcome to Paradise</h1>
    <p class="card-text mt-3">Escape to a tropical paradise at our luxurious 5-star hotel nestled amidst swaying palm trees in Playa El Aqua, Venezuela.
      Experience the epitome of relaxation and indulgence as you unwind in a setting that combines natural beauty with world-class hospitality.</p>
  </div>
</div>

<hr class="mt-3  mx-auto" style="width: 60vw; padding: 1px" />

<div class=" text-center mt-5 ">
  <h1 class="mb-4">Accomodation</h1>
  <div id="carouselExample" class="carousel slide">

    <div class="carousel-inner ">
      <div class="carousel-item active">
        <img src="src/images/accomodation/room_2.jpg" class="d-block w-100 " alt="Deluxe Ocean-View Suite">
        <div class="position-relative mt-5 d-block my-2">
          <div class="justify-content-center px-5 row g-0">
            <div class="col-12  col-lg-6 col-xl-5  text-accomodation">
              <p class="fs-5 fw-bolder">Deluxe Ocean-View Suite</p>
              <p>Wake up to the gentle sound of waves in our Deluxe Ocean-View Suite. Enjoy breathtaking panoramic views of the Caribbean Sea from the comfort of your own private haven.</p>
            </div>
            <div class="col-12  col-lg-6 col-xl-4">
              <a class="btn btn-lg mx-3 my-2" aria-current="page" href="?rooms">More Details</a>
              <?php if ((isset($_SESSION['member_id']) && $_SESSION['is_admin'] == 0) || !isset($_SESSION['member_id'])) : ?>

                <a class="btn btn-lg btn-full my-2" href="?book=<?php echo "Deluxe Ocean-View Suite"; ?>">Book Now</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="src/images/accomodation/room_3.jpg" class="d-block w-100 " alt="Family-Friendly Accommodation">
        <div class="position-relative mt-5 d-block my-2">
          <div class=" justify-content-center px-5 row g-0">
            <div class="col-12  col-lg-6 col-xl-5 text-accomodation ">
              <p class="fs-5 fw-bolder">Family-Friendly Accommodation</h5>
              <p>Our spacious Family-Friendly Rooms are designed with your loved ones in mind. Ideal for a memorable family vacation, these rooms offer the perfect blend of comfort and convenience.</p>
            </div>
            <div class="col-12  col-lg-6 col-xl-4">
              <a class="btn btn-lg  mx-3 my-2" aria-current="page" href="?rooms">More Details</a>
              <?php if ((isset($_SESSION['member_id']) && $_SESSION['is_admin'] == 0) || !isset($_SESSION['member_id'])) : ?>
                <a class="btn btn-lg btn-full my-2" href="?book=<?php echo "Family-Friendly Accommodation"; ?>">Book Now</a>
              <?php endif; ?>

            </div>
          </div>
        </div>

      </div>
      <div class="carousel-item">
        <img src="src/images/accomodation/room_4.jpg" class="d-block w-100 " alt="Elegant Suite with Private Balcony">
        <div class="position-relative mt-5 d-block my-2">
          <div class="  justify-content-center px-5 row g-0">
            <div class="col-12  col-lg-6 col-xl-5 text-accomodation ">
              <p class="fs-5 fw-bolder">Elegant Suite with Private Balcony</h5>
              <p>Discover elegance and luxury in our Suite with Private Balcony. This room features a spacious balcony where you can savor your morning coffee while taking in the stunning views of the coastline.</p>
            </div>
            <div class="col-12  col-lg-6 col-xl-4">
              <a class="btn btn-lg  mx-3 my-2" aria-current="page" href="?rooms">More Details</a>
              <?php if ((isset($_SESSION['member_id']) && $_SESSION['is_admin'] == 0) || !isset($_SESSION['member_id'])) : ?>

                <a class="btn btn-lg btn-full my-2" href="?book=<?php echo "Elegant Suite with Private Balcony"; ?>">Book Now</a>
              <?php endif; ?>

            </div>
          </div>
        </div>

      </div>
      <div class="carousel-item">
        <img src="src/images/accomodation/room_1.jpg" class="d-block w-100 " alt="Classic Comfort and Timeless Elegance">

        <div class=" mt-5 d-block my-2">
          <div class="  justify-content-center px-5 row g-0">
            <div class="col-12  col-lg-6 col-xl-5 text-accomodation">
              <p class="fs-5 fw-bolder">Classic Comfort and Timeless Elegance</h5>
              <p>Experience classic comfort and timeless elegance in our Classic Room. This well-appointed room offers a cozy retreat with all the essential amenities for a restful stay, providing a touch of traditional charm.</p>
            </div>
            <div class="col-12  col-lg-6 col-xl-4">
              <a class="btn btn-lg  mx-3 my-2" aria-current="page" href="?rooms">More Details</a>
              <?php if ((isset($_SESSION['member_id']) && $_SESSION['is_admin'] == 0) || !isset($_SESSION['member_id'])) : ?>

                <a class="btn btn-lg btn-full my-2" href="?book=<?php echo "Classic Comfort and Timeless Elegance"; ?>">Book Now</a>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon " aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


</div>
<hr class="mt-3  mx-auto" style="width: 60vw; padding: 1px" />
<div class=" text-center mt-5 ">
  <h1 class="mb-4">Services</h1>
  <?php include_once "src/util/services.php" ?>
</div>


<style>
  .carousel-item img {
    max-height: 80vh;
    object-fit: cover;
    position: relative;
  }



  .carousel-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    text-align: center;
    z-index: 2;
    height: fit-content;
  }

  .card {
    border: none;
  }

  .text-accomodation {
    text-align: left;
  }


  .carousel-control-next,
  .carousel-control-prev {
    align-items: flex-start;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    function updateControlPosition() {
      var currentImage = document.querySelector('.carousel-item.active img');
      var controlNext = document.querySelector('.carousel-control-next');
      var controlPrev = document.querySelector('.carousel-control-prev');

      if (currentImage) {
        var halfImageHeight = currentImage.height / 2;
        controlNext.style.top = halfImageHeight + 'px';
        controlPrev.style.top = halfImageHeight + 'px';
      }
    }
    updateControlPosition();
    window.addEventListener('resize', updateControlPosition);
  });
</script>