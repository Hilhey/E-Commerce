<?php include __DIR__ . '/includes/header.php'; ?>

<section class="hero">
  <div class="container hero-grid">
    <div>
      <span class="tag">Portal Bisnis Digital</span>
      <h1>Selamat Datang di Digipreneur</h1>
      <p>Platform e-commerce dengan katalog produk fisik & digital yang unik. Temukan solusi bisnis kreatif untuk UMKM, kreator, dan pelaku industri digital.</p>
      <a class="button" href="/products.php">Lihat Produk</a>
    </div>
    <div class="card">
      <h3>Keunggulan Digipreneur</h3>
      <ol>
        <li>Produk kurasi kreatif.</li>
        <li>Konten multimedia interaktif.</li>
        <li>Dashboard admin berbasis frame.</li>
      </ol>
      <div class="notice">
        <strong>Info:</strong> Klik tombol di bawah untuk dialog interaktif.
        <button class="button" style="margin-top:10px" onclick="showWelcome()">Dialogbox</button>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2>Media Highlight</h2>
    <p>Kami menghadirkan audio dan video inspiratif untuk menambah pengalaman pengunjung.</p>
    <div class="card">
      <h4>Music</h4>
      <audio controls>
        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
        Browser Anda tidak mendukung audio.
      </audio>
      <h4 style="margin-top:20px">Video</h4>
      <video controls width="100%">
        <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
        Browser Anda tidak mendukung video.
      </video>
    </div>
  </div>
</section>

<script>
function showWelcome() {
  alert('Selamat datang di Digipreneur! Jelajahi katalog produk kami.');
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
