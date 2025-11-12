<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator Sederhana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #a0a0a0; /* abu-abu lebih gelap */
            padding: 20px;
            width: 350px;
            border-radius: 8px;
            box-shadow: 0 0 5px #666;
            color: #fff;
        }
        .container h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }
        .row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .row input[type="number"], 
        .row select,
        .row input[type="text"] {
            flex: 1;
            padding: 6px 8px;
            border: 1px solid #555;
            border-radius: 4px;
            font-size: 16px;
            background-color: #e0e0e0;
            color: #000;
        }
        .row .operator-container {
            display: flex;
            flex: 1;
        }
        .row .operator-container select {
            flex: 1;
            margin-right: 10px;
        }
        button {
            padding: 7px 15px;
            font-size: 16px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .result {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Kalkulator</h2>
    <form method="post">
        <div class="row">
            <input type="number" name="angka1" id="angka1" required placeholder="Angka pertama" value="<?php echo isset($_POST['angka1']) ? htmlspecialchars($_POST['angka1']) : ''; ?>">
        </div>
        <div class="row">
            <input type="number" name="angka2" id="angka2" required placeholder="Angka kedua" value="<?php echo isset($_POST['angka2']) ? htmlspecialchars($_POST['angka2']) : ''; ?>">
        </div>
        <div class="row">
            <div class="operator-container">
                <select name="operator" id="operator" required>
                    <option value="" disabled <?php if(!isset($_POST['operator'])) echo 'selected'; ?>>Pilih operator</option>
                    <option value="+" <?php if(isset($_POST['operator']) && $_POST['operator'] == '+') echo 'selected'; ?>>Tambah (+)</option>
                    <option value="-" <?php if(isset($_POST['operator']) && $_POST['operator'] == '-') echo 'selected'; ?>>Kurang (-)</option>
                    <option value="*" <?php if(isset($_POST['operator']) && $_POST['operator'] == '*') echo 'selected'; ?>>Kali (×)</option>
                    <option value="/" <?php if(isset($_POST['operator']) && $_POST['operator'] == '/') echo 'selected'; ?>>Bagi (÷)</option>
                </select>
                <button type="submit" name="hitung">Hitung</button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['hitung'])) {
        $angka1 = $_POST['angka1'];
        $angka2 = $_POST['angka2'];
        $operator = $_POST['operator'];
        $hasil = null;

        if (!is_numeric($angka1) || !is_numeric($angka2)) {
            echo "<div class='row'><input type='text' class='result' value='Error: Input harus angka valid.' readonly style='color:red; background:#fdd;'></div>";
        } else {
            switch ($operator) {
                case '+':
                    $hasil = $angka1 + $angka2;
                    break;
                case '-':
                    $hasil = $angka1 - $angka2;
                    break;
                case '*':
                    $hasil = $angka1 * $angka2;
                    break;
                case '/':
                    if ($angka2 == 0) {
                        echo "<div class='row'><input type='text' class='result' value='Error: Pembagian dengan nol tidak diperbolehkan.' readonly style='color:red; background:#fdd;'></div>";
                        exit;
                    }
                    $hasil = $angka1 / $angka2;
                    break;
                default:
                    echo "<div class='row'><input type='text' class='result' value='Operator tidak valid.' readonly style='color:red; background:#fdd;'></div>";
                    exit;
            }

            echo "<div class='row'><input type='text' class='result' value='$hasil' readonly></div>";
        }
    }
    ?>
</div>

</body>
</html>