<?php
// Nama file input
$inputFile = 'mau.txt';

// Nama file output untuk sitemap
$outputFile = 'sitemap.xml';

// URL dasar
$baseUrl = 'https://www.pfcs.org.ph/wp-content/jjx/?id_ID=';

// Fungsi untuk membuat elemen URL pada sitemap
function createUrlElement($url) {
    return "    <url>\n" .
           "        <loc>" . htmlspecialchars($url) . "</loc>\n" .
           "        <lastmod>" . date('Y-m-d') . "</lastmod>\n" .
           "        <priority>0.8</priority>\n" .
           "    </url>\n";
}

// Periksa apakah file input ada
if (!file_exists($inputFile)) {
    die("File $inputFile tidak ditemukan. Pastikan file tersebut ada.");
}

// Baca konten dari file input
$lines = file($inputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (!$lines) {
    die("File $inputFile kosong atau tidak dapat dibaca.");
}

// Mulai membuat konten sitemap
$sitemapContent = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$sitemapContent .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

// Tambahkan setiap URL ke dalam sitemap
foreach ($lines as $slug) {
    $slug = trim($slug);
    if (!empty($slug)) {
        $fullUrl = $baseUrl . $slug;
        $sitemapContent .= createUrlElement($fullUrl);
    }
}

$sitemapContent .= "</urlset>\n";

// Tulis ke file output
if (file_put_contents($outputFile, $sitemapContent)) {
    echo "Sitemap berhasil dibuat: $outputFile";
} else {
    echo "Gagal membuat sitemap. Periksa izin file.";
}
?>
