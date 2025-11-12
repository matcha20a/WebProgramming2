<!DOCTYPE html>
<html>
<head>
    <title>Menu Kafe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
        }
        table, th, td {
            border: 1px solid #aaa;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        input[type="number"] {
            width: 60px;
            padding: 4px;
            text-align: center;
        }
        button {
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
        }
        /* Styling baris total */
        .total-row td:first-child {
            text-align: left;
            padding-left: 20px;
            font-weight: bold;
        }
        .total-row td:last-child {
            text-align: right;
            padding-right: 20px;
            font-weight: bold;
        }
        .total-row td {
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php
$menuList = [
    ['nama' => 'Kopi Hitam', 'harga' => 10000],
    ['nama' => 'Cappucino', 'harga' => 15000],
    ['nama' => 'Teh Manis', 'harga' => 8000],
    ['nama' => 'Es Jeruk', 'harga' => 9000],
    ['nama' => 'Nasi Goreng', 'harga' => 20000],
    ['nama' => 'Mie Goreng', 'harga' => 18000],
];

$pesanan = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pesan'])) {
    foreach ($menuList as $index => $item) {
        $jumlah = isset($_POST['jumlah'][$index]) ? intval($_POST['jumlah'][$index]) : 0;
        if ($jumlah > 0) {
            $pesanan[] = [
                'menu' => $item['nama'],
                'harga' => $item['harga'],
                'jumlah' => $jumlah,
                'subtotal' => $item['harga'] * $jumlah
            ];
        }
    }
}
?>

<h2>Menu Kafe</h2>
<form method="post">
    <table>
        <thead>
            <tr>
                <th>Menu</th>
                <th>Harga (Rp)</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menuList as $index => $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['nama']); ?></td>
                <td><?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                <td><input type="number" name="jumlah[<?php echo $index; ?>]" min="0" value="0"></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button type="submit" name="pesan">Pesan</button>
</form>

<h2>Detail Pesanan</h2>
<?php if (empty($pesanan)): ?>
    <p>Belum ada pesanan.</p>
<?php else: ?>
<table>
    <thead>
        <tr>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Harga (Rp)</th>
            <th>Subtotal (Rp)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total = 0;
        foreach ($pesanan as $item):
            $total += $item['subtotal'];
        ?>
        <tr>
            <td><?php echo htmlspecialchars($item['menu']); ?></td>
            <td><?php echo $item['jumlah']; ?></td>
            <td><?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
            <td><?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr class="total-row">
            <td colspan="3">Total</td>
            <td><?php echo number_format($total, 0, ',', '.'); ?></td>
        </tr>
    </tfoot>
</table>
<?php endif; ?>

</body>
</html>