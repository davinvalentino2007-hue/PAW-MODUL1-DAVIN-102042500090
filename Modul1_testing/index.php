<?php
// Memanggil data array produk dari data.php
require_once 'data.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cia Store</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Memanggil file CSS eksternal -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- NAVBAR -->
    <header>
        <div class="container navbar">
            <a href="#" class="brand-logo">Cia Store</a>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#katalog">Products</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </div>
    </header>

    <main class="container">
        <!-- HERO SECTION -->
        <section class="hero">
            <span class="hero-tag">CIA STORE</span>
            <h1>Simple Tech Store.</h1>
            <p>Temukan berbagai perangkat dan aksesoris teknologi untuk kebutuhanmu.</p>
            <a href="#katalog" class="btn-hero">Lihat Produk</a>
        </section>

        <!-- HEADER KATALOG -->
        <section id="katalog">
            <div class="catalog-header">
                <div class="catalog-title">
                    <span class="sub-title">OUR PRODUCTS</span>
                    <h2>Katalog Produk</h2>
                </div>
                <div class="total-badge">
                    Total Produk: <?= $total_produk ?>
                </div>
            </div>

            <!-- GRID PRODUK -->
            <div class="product-grid">
                <?php foreach ($products as $item): ?>
                    <?php 
                        // Perhitungan Diskon 10% jika harga >= Rp1.000.000
                        $harga_normal = $item['harga'];
                        $is_discount = $harga_normal >= 1000000;
                        $harga_akhir = $is_discount ? $harga_normal * 0.9 : $harga_normal;
                        $stok_tersedia = $item['stok'] > 0;
                    ?>
                    <div class="product-card">
                        <div class="card-top">
                            <!-- Badge Diskon jika dapat promo -->
                            <?php if ($is_discount): ?>
                                <span class="discount-badge">DISKON 10%</span>
                            <?php endif; ?>
                            
                            <h3 class="product-name"><?= htmlspecialchars($item['nama']) ?></h3>
                            <p class="product-category">Kategori: <?= htmlspecialchars($item['kategori']) ?></p>

                            <!-- Kotak Harga -->
                            <div class="price-box">
                                <?php if ($is_discount): ?>
                                    <div class="original-price">Rp <?= number_format($harga_normal, 0, ',', '.') ?></div>
                                    <div class="final-price">Rp <?= number_format($harga_akhir, 0, ',', '.') ?></div>
                                <?php else: ?>
                                    <div class="final-price">Rp <?= number_format($harga_normal, 0, ',', '.') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-bottom">
                            <!-- Informasi Stok -->
                            <div class="stock-info">
                                <span>Stok: <?= $item['stok'] ?></span>
                                <?php if ($stok_tersedia): ?>
                                    <span class="status-badge available">Tersedia</span>
                                <?php else: ?>
                                    <span class="status-badge out-of-stock">Stok Habis</span>
                                <?php endif; ?>
                            </div>

                            <!-- Tombol Pembelian -->
                            <?php if ($stok_tersedia): ?>
                                <button class="btn-buy">Beli Sekarang</button>
                            <?php else: ?>
                                <button class="btn-buy" disabled>Stok Habis</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            &copy; <?= date('Y') ?> Cia Store. All rights reserved.
        </div>
    </footer>

</body>
</html>