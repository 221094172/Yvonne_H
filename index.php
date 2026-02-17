<?php
$activePage = 'home';
$pageTitle = 'Yvonne Hangara | Home';
$pageDescription = "Yvonne 'Yvy' Hangara - Christian Educator, Author, Composer, and Minister of the Gospel";
require __DIR__ . '/includes/header.php';
?>

<section class="hero" aria-label="Home hero">
  <div class="hero__panel hero__left">
    <div class="hero__kicker">Singer • Author • Educator</div>
    <h1 class="hero__title">
      Yvonne <span class="accent">Hangara</span>
    </h1>
    <p class="hero__subtitle">Christian educator, author, composer, and minister of the Gospel.</p>
    <p class="hero__bio">
      A believer in Christ with 20+ years in the music industry and over six years of educational leadership.
      Graduate with Honors in History &amp; Arts, Post Graduate Diploma in Higher Education, and a Master’s degree in Educational Psychology.
    </p>

    <div class="quote" role="note" aria-label="Scripture quote">
      “My people are destroyed for lack of knowledge...”
      <span class="quote__ref">Hosea 4:6</span>
    </div>

    <div class="actions" aria-label="Primary actions">
      <a class="btn btn--primary" data-transition href="bio.php">Explore</a>
      <a class="btn btn--ghost" data-transition href="contact.php">Contact</a>
    </div>
  </div>

  <div class="hero__panel hero__right" aria-label="Inspirational image">
    <img
      class="hero__image"
      src="assets/img/owner-source.png"
      alt="Portrait of Yvonne Hangara"
      loading="eager"
      data-remove-bg
    />
    <div class="hero__overlay" aria-hidden="true"></div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

