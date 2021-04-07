<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <h4 align="center">Laporan Pemesanan</h4>
    <br>
    <br>

    <table width="100%" border-collapse="collapse">
        <tr>
            <th>Nomor Pesanan</th>
            <th><?= $dataCetak->nomor_pesanan
                ?></th>

        </tr>
        <tr>
            <td>Tanggal Pesanan</td>
            <td><?= $dataCetak->tanggal_pesanan
                ?></td>
        </tr>
        <tr>
            <td>Nama Pesanan</td>
            <td><?= $dataCetak->nama_pemesan
                ?></td>

        </tr>
        <tr>
            <td>NIK</td>
            <td><?= $dataCetak->nik_pemesan
                ?></td>

        </tr>
        <tr>
            <td>Alamat</td>
            <td><?= $dataCetak->alamat_pemesan
                ?></td>

        </tr>
        <tr>
            <td>Nomor HP</td>
            <td><?= $dataCetak->nomor_hp_pemesan
                ?></td>
        </tr>

        <tr>
            <td>Daerah Tujuan</td>
            <td><?= $dataCetak->daerahTujuan->daerah_tujuan
                ?></td>
        </tr>

        <tr>
            <td>Jarak Tambahan</td>
            <td><?= $dataCetak->jarak_tambahan
                ?></td>
        </tr>

        <tr>
            <td>Nomor Polisi Mobil Ambulan</td>
            <td><?= $dataCetak->nomorPolisiMobilAmbulance->nomor_polisi_mobil_ambulance
                ?></td>
        </tr>

        <tr>
            <td>Supir Ambulan</td>
            <td><?= $dataCetak->sopirAmbulance->nama_supir
                ?></td>
        </tr>


    </table>

</body>

</html>