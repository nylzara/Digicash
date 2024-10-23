<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Print Laporan Kas</title>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h2>LAPORAN KAS UMUM</h2>
        <hr>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Id Kas</th>
                <th>Tanggal</th>
                <th>No Bukti</th>
                <th>Uraian</th>
                <th>Kas Masuk</th>
                <th>Kas Keluar</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>

            <!-- Looping Data Kas -->
            <?php $i = 1; ?>
            <?php foreach ($dataKas as $row): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $row['id_kas']; ?></td>
                <td><?= tgl_indo($row['tanggal']); ?></td>
                <td><?= $row['no_bukti']; ?></td>
                <td><?= $row['uraian']; ?></td>
                <td>Rp. <?= num($row['kas_masuk']); ?></td>
                <td class="text-red">Rp. <?= num($row['kas_keluar']); ?></td>
                <td>Rp. <?= num($row['saldo']); ?></td>
            </tr>
            <?php endforeach; ?>

            <tr class="total-row">
                <td colspan="5" class="text-center">Total Jumlah</td>
                <td>Rp. <?= num($kas_masuk); ?></td>
                <td>Rp. <?= num($kas_keluar); ?></td>
                <td>Rp. <?= num($saldo); ?></td>
            </tr>

        </tbody>
    </table>

    <!-- Tombol Cetak -->
    <button class="no-print" onclick="window.print()">Cetak Laporan</button>


</body>

</html>