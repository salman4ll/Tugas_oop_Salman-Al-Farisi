<?php
require_once 'Person.php';
require_once 'Mahasiswa.php';
require_once 'Dosen.php';
require_once 'MataKuliah.php';

// Membuat objek mahasiswa
$mahasiswa = new Mahasiswa("Salman Al-Farisi", "J0303211005");

// Mendapatkan daftar mata kuliah yang dipilih dari cookie (jika ada)
$daftarMataKuliahDipilih = [];
if (isset($_COOKIE['daftar_mata_kuliah'])) {
    $daftarMataKuliahDipilih = unserialize($_COOKIE['daftar_mata_kuliah']);
}

// Daftar mata kuliah yang tersedia
$daftarMataKuliah = array(
    new MataKuliah("Matematika Diskrit", new Dosen("Dr. Andi", "D001"), "Senin 08.00 - 10.00"),
    new MataKuliah("Statistika dan Probabilitas", new Dosen("Nur Aziezah", "D002"), "Selasa 10.00 - 12.00"),
    // Tambahkan mata kuliah lain jika perlu
);

// Menambah mata kuliah yang dipilih jika ada
if (isset($_POST['add'])) {
    $selectedMatkulIndex = $_POST['mata_kuliah'];
    if (isset($daftarMataKuliah[$selectedMatkulIndex])) {
        // Memeriksa apakah mata kuliah sudah ada dalam daftar yang dipilih
        $isAlreadySelected = false;
        foreach ($daftarMataKuliahDipilih as $mataKuliahDipilih) {
            if ($mataKuliahDipilih->getNama() == $daftarMataKuliah[$selectedMatkulIndex]->getNama()) {
                $isAlreadySelected = true;
                break;
            }
        }
        // Jika belum ada, tambahkan mata kuliah ke dalam daftar
        if (!$isAlreadySelected) {
            $daftarMataKuliahDipilih[] = $daftarMataKuliah[$selectedMatkulIndex];
            // Menyimpan kembali daftar mata kuliah yang dipilih ke dalam cookie
            setcookie('daftar_mata_kuliah', serialize($daftarMataKuliahDipilih), time() + (86400 * 30), "/"); // Cookie berlaku selama 30 hari
            // Redirect kembali ke halaman index untuk menghindari resubmission saat refresh
            header("Location: index.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mata Kuliah</title>
</head>
<body>
    <h1>Daftar Mata Kuliah</h1>

    <!-- Tabel Daftar Mata Kuliah -->
    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Mata Kuliah</th>
                <th>Dosen Pengajar</th>
                <th>Jadwal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarMataKuliah as $index => $mataKuliah): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $mataKuliah->getNama(); ?></td>
                    <td><?php echo $mataKuliah->getDosen()->getNama(); ?></td>
                    <td><?php echo $mataKuliah->getJadwal(); ?></td>
                    <td>
                        <form action="index.php" method="post">
                            <input type="hidden" name="mata_kuliah" value="<?php echo $index; ?>">
                            <input type="submit" name="add" value="Add">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Daftar Mata Kuliah yang Sudah Dipilih -->
    <h2>Daftar Mata Kuliah yang Sudah Dipilih oleh <?php echo $mahasiswa->getNama(); ?> dengan NIM: <?php echo $mahasiswa->getNim(); ?></h2>
    <ul>
        <?php if (empty($daftarMataKuliahDipilih)): ?>
            <li>Belum ada mata kuliah yang dipilih.</li>
        <?php else: ?>
            <?php foreach ($daftarMataKuliahDipilih as $mataKuliah): ?>
                <li>
                    <?php echo $mataKuliah->getNama(); ?> (<?php echo $mataKuliah->getDosen()->getNama(); ?>, <?php echo $mataKuliah->getJadwal(); ?>)
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</body>
</html>
