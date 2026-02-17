<?php
$activePage = 'gallery';
$pageTitle = 'Yvonne Hangara | Gallery';
$pageDescription = "Gallery — ministry moments, worship, teaching, and community outreach.";
require __DIR__ . '/includes/header.php';
?>

<header class="page-header">
  <h1 class="page-title">Gallery</h1>
  <p class="page-lead">
    Moments from worship, teaching, community outreach, and speaking engagements.
  </p>
</header>

<section class="card section">
  <div class="gallery" aria-label="Photo gallery">
    <button type="button" data-gallery-item data-image="https://images.pexels.com/photos/1144691/pexels-photo-1144691.jpeg?auto=compress&cs=tinysrgb&w=1400" aria-label="Open image: Ministry event">
      <img src="https://images.pexels.com/photos/1144691/pexels-photo-1144691.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Ministry Event" loading="lazy" />
    </button>
    <button type="button" data-gallery-item data-image="https://images.pexels.com/photos/442540/pexels-photo-442540.jpeg?auto=compress&cs=tinysrgb&w=1400" aria-label="Open image: Musical performance">
      <img src="https://images.pexels.com/photos/442540/pexels-photo-442540.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Musical Performance" loading="lazy" />
    </button>
    <button type="button" data-gallery-item data-image="https://images.pexels.com/photos/8092/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1400" aria-label="Open image: Teaching session">
      <img src="https://images.pexels.com/photos/8092/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=800" alt="Teaching Session" loading="lazy" />
    </button>
    <button type="button" data-gallery-item data-image="https://images.pexels.com/photos/1190297/pexels-photo-1190297.jpeg?auto=compress&cs=tinysrgb&w=1400" aria-label="Open image: Community outreach">
      <img src="https://images.pexels.com/photos/1190297/pexels-photo-1190297.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Community Outreach" loading="lazy" />
    </button>
    <button type="button" data-gallery-item data-image="https://images.pexels.com/photos/2102934/pexels-photo-2102934.jpeg?auto=compress&cs=tinysrgb&w=1400" aria-label="Open image: Worship service">
      <img src="https://images.pexels.com/photos/2102934/pexels-photo-2102934.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Worship Service" loading="lazy" />
    </button>
    <button type="button" data-gallery-item data-image="https://images.pexels.com/photos/1684187/pexels-photo-1684187.jpeg?auto=compress&cs=tinysrgb&w=1400" aria-label="Open image: Conference speaking">
      <img src="https://images.pexels.com/photos/1684187/pexels-photo-1684187.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Conference Speaking" loading="lazy" />
    </button>
  </div>
</section>

<div class="lightbox" data-lightbox aria-hidden="true">
  <div class="lightbox__inner">
    <button class="lightbox__close" type="button" data-lightbox-close aria-label="Close">Close</button>
    <img class="lightbox__img" data-lightbox-img src="" alt="Gallery image" />
  </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>

