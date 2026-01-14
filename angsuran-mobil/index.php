<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Hitung Angsuran Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- HEADER -->
<div class="header">
    <h1>IMS Finance</h1>
    <p>Aplikasi Perhitungan Angsuran Kredit Mobil</p>
</div>

<!-- CONTENT -->
<div class="container">
    <h2>Simulasi Angsuran</h2>

    <form method="post">
        <label>Harga Mobil (Rp)</label>
        <input type="number" name="harga"
               value="<?= $_POST['harga'] ?? 240000000 ?>" required>

        <label>Down Payment (%)</label>
        <input type="number" name="dp"
               value="<?= $_POST['dp'] ?? 20 ?>" required>

        <label>Tenor (Bulan)</label>
        <input type="number" name="tenor"
               value="<?= $_POST['tenor'] ?? 18 ?>" required>

        <button type="submit">Hitung Angsuran</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $harga = $_POST['harga'];
        $dpPersen = $_POST['dp'];
        $tenor = $_POST['tenor'];

        $dp = ($dpPersen / 100) * $harga;
        $pokokKredit = $harga - $dp;

        /* Tentukan bunga berdasarkan tenor */
        if ($tenor <= 12) {
            $bunga = 0.12;
        } elseif ($tenor <= 24) {
            $bunga = 0.14;
        } else {
            $bunga = 0.165;
        }

        /* Hitung total bunga & angsuran */
        $totalBunga = $pokokKredit * $bunga;
        $angsuranPerBulan = ($pokokKredit + $totalBunga) / $tenor;

    ?>

    <div class="hasil">
        <div class="hasil-row">
            <span>Nama Client</span>
            <span>Sugus</span>
        </div>
        <div class="hasil-row">
            <span>Kontrak No</span>
            <span>AGR00001</span>
        </div>
        <div class="hasil-row">
            <span>Down Payment</span>
            <span>Rp <?= number_format($dp, 0, ',', '.') ?></span>
        </div>
        <div class="hasil-row">
            <span>Pokok Kredit</span>
            <span>Rp <?= number_format($pokokKredit, 0, ',', '.') ?></span>
        </div>
        <div class="hasil-row">
            <span>Bunga</span>
            <span><?= ($bunga * 100) ?>%</span>
        </div>

        <div class="hasil-row">
            <span>Total Bunga</span>
            <span>Rp <?= number_format($totalBunga, 0, ',', '.') ?></span>
        </div>
        <div class="hasil-row">
            <span>Angsuran / Bulan</span>
            <span>Rp <?= number_format($angsuranPerBulan, 0, ',', '.') ?></span>
        </div>
    </div>

    <?php } ?>
</div>

<!-- FOOTER -->
<div class="footer">
    © 2026 Musfara Zahra Nadien
</div>

</body>
</html>
