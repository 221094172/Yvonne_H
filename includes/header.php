<?php
/** @var string $activePage */
/** @var string $pageTitle */
/** @var string $pageDescription */
$activePage = $activePage ?? 'home';
$pageTitle = $pageTitle ?? 'Yvonne Hangara';
$pageDescription = $pageDescription ?? "Yvonne 'Yvy' Hangara - Christian Educator, Author, Composer, and Minister of the Gospel";

function nav_item(string $href, string $label, string $key, string $activePage): string {
    $current = $key === $activePage ? ' aria-current="page"' : '';
    return '<li><a class="nav__link" data-transition href="' . htmlspecialchars($href) . '"' . $current . '>' . htmlspecialchars($label) . '</a></li>';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>" />
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <link rel="stylesheet" href="assets/css/site.css" />
</head>
<body>
  <header class="site-header">
    <div class="container">
      <nav class="nav" aria-label="Primary">
        <a class="brand" data-transition href="index.php" aria-label="Go to Home">
          <img class="brand__icon" src="assets/img/mic-logo.png" alt="" aria-hidden="true" />
          <span class="brand__name">Yvonne Hangara</span>
          <span class="brand__dot" aria-hidden="true"></span>
        </a>

        <button class="nav__toggle" type="button" data-nav-toggle aria-label="Toggle menu" aria-expanded="false">
          <span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span>
        </button>

        <ul class="nav__links" data-nav-links>
          <?php echo nav_item('index.php', 'Home', 'home', $activePage); ?>
          <?php echo nav_item('bio.php', 'Bio', 'bio', $activePage); ?>
          <?php echo nav_item('ministry.php', 'Ministry', 'ministry', $activePage); ?>
          <?php echo nav_item('books.php', 'Books', 'books', $activePage); ?>
          <?php echo nav_item('gallery.php', 'Gallery', 'gallery', $activePage); ?>
          <?php echo nav_item('contact.php', 'Contact', 'contact', $activePage); ?>
        </ul>
      </nav>
    </div>
  </header>
  <main class="page">
    <div class="container">

