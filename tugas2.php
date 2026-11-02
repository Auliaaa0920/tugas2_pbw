<?php

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
}

function tentukanGrade($nilai) {
    if ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 75) {
        return "B";
    } elseif ($nilai >= 65) {
        return "C";
    } elseif ($nilai >= 50) {
        return "D";
    } else {
        return "E";
    }
}

function tentukanStatus($nilai) {
    return ($nilai >= 65) ? "Lulus" : "Tidak Lulus";
}

function tentukanPredikat($grade) {
    switch ($grade) {
        case "A": return "Sangat Baik";
        case "B": return "Baik";
        case "C": return "Cukup";
        case "D": return "Kurang";
        default: return "Sangat Kurang";
    }
}


$nama = $_POST["nama"] ?? [];
$nim = $_POST["nim"] ?? [];
$tugas = $_POST["tugas"] ?? [];
$uts = $_POST["uts"] ?? [];
$uas = $_POST["uas"] ?? [];

$jumlah = count($nama);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan Nilai</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>Penghitung Nilai Mahasiswa</h1>
    <p class="subtitle">Perhitungan Nilai Akhir Mahasiswa 🐻‍❄️</p>

    <div class="card">
        <h2>Data Mahasiswa</h2>

        <form action="tugas2.php" method="POST" id="formNilai">

            <div id="daftarMahasiswa">

                <?php for ($i = 0; $i < $jumlah; $i++): ?>
                    <div class="mahasiswa">
                        <h3>Mahasiswa <?= $i + 1 ?></h3>

                        <label>Nama Mahasiswa:</label>
                        <input type="text" name="nama[]" required
                            value="<?= htmlspecialchars($nama[$i]) ?>">

                        <label>NIM:</label>
                        <input type="text" name="nim[]" required
                            value="<?= htmlspecialchars($nim[$i]) ?>">

                        <label>Nilai Tugas:</label>
                        <input type="number" name="tugas[]" step="any" required
                            value="<?= htmlspecialchars($tugas[$i]) ?>">

                        <label>Nilai UTS:</label>
                        <input type="number" name="uts[]" step="any" required
                            value="<?= htmlspecialchars($uts[$i]) ?>">

                        <label>Nilai UAS:</label>
                        <input type="number" name="uas[]" step="any" required
                            value="<?= htmlspecialchars($uas[$i]) ?>">
                    </div>
                <?php endfor; ?>

            </div>

            <button type="button" id="tambahMahasiswa">
                + Tambah Mahasiswa
            </button>

            <button type="submit">
                Hitung Nilai
            </button>

        </form>
    </div>

    <?php
    $dataValid = true;

    for ($i = 0; $i < $jumlah; $i++) {
        if (
            trim($nama[$i]) === "" ||
            trim($nim[$i]) === "" ||
            !is_numeric($tugas[$i]) ||
            !is_numeric($uts[$i]) ||
            !is_numeric($uas[$i]) ||
            $tugas[$i] < 0 || $tugas[$i] > 100 ||
            $uts[$i] < 0 || $uts[$i] > 100 ||
            $uas[$i] < 0 || $uas[$i] > 100
        ) {
            $dataValid = false;
            break;
        }
    }
    ?>

    <?php if ($jumlah > 0 && $dataValid): ?>

        <?php for ($i = 0; $i < $jumlah; $i++): ?>

            <?php
            $nilaiAkhir = hitungNilaiAkhir(
                $tugas[$i],
                $uts[$i],
                $uas[$i]
            );

            $grade = tentukanGrade($nilaiAkhir);
            $status = tentukanStatus($nilaiAkhir);
            $predikat = tentukanPredikat($grade);
            ?>

            <div class="card">
                <h2>Data Mahasiswa <?= $i + 1 ?></h2>

                <p>Nama: <?= htmlspecialchars($nama[$i]) ?></p>
                <p>NIM: <?= htmlspecialchars($nim[$i]) ?></p>
                <p>Nilai Tugas: <?= htmlspecialchars($tugas[$i]) ?></p>
                <p>Nilai UTS: <?= htmlspecialchars($uts[$i]) ?></p>
                <p>Nilai UAS: <?= htmlspecialchars($uas[$i]) ?></p>

                <h2>Hasil Perhitungan</h2>

                <p>Nilai Akhir: <?= number_format($nilaiAkhir, 2, ',', '.') ?></p>
                <p>Grade: <?= $grade ?></p>
                <p>Status: <?= $status ?></p>
                <p>Predikat: <?= $predikat ?></p>
            </div>

        <?php endfor; ?>

    <?php else: ?>

        <p>Data tidak valid. Pastikan semua nilai berada di antara 0 sampai 100.</p>

    <?php endif; ?>

</div>

<script src="tugas2.js"></script>
</body>
</html>