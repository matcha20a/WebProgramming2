<?php
$uploadDir = 'uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$showForm = true;
$errors = [];
$data = [
    'nama' => '',
    'email' => '',
    'alamat' => '',
    'foto' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input
    $data['nama'] = trim($_POST['nama'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['alamat'] = trim($_POST['alamat'] ?? '');

    if ($data['nama'] === '') {
        $errors[] = 'Nama harus diisi.';
    }
    if ($data['email'] === '' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email tidak valid atau kosong.';
    }
    if ($data['alamat'] === '') {
        $errors[] = 'Alamat harus diisi.';
    }

    // Upload foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileName = basename($_FILES['foto']['name']);

        // Cek ekstensi file
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png'];

        if (!in_array($ext, $allowedExt)) {
            $errors[] = 'Format foto harus JPG atau PNG.';
        } else {
            $newFileName = uniqid('foto_') . '.' . $ext;
            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $data['foto'] = $destPath;
            } else {
                $errors[] = 'Gagal menyimpan foto.';
            }
        }
    } else {
        $errors[] = 'Foto harus diupload.';
    }

    if (empty($errors)) {
        $showForm = false; // tampilkan hasil, bukan form
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Biodata dan Upload Foto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
        }
        h2 {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="email"], textarea {
            width: 300px;
            padding: 6px;
            margin-top: 4px;
        }
        textarea {
            resize: vertical;
            height: 80px;
        }
        input[type="file"] {
            margin-top: 6px;
        }
        button {
            margin-top: 15px;
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .success-label {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .link-kembali {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
            margin-top: 20px;
            display: inline-block;
        }
        img.uploaded-photo {
            margin-top: 10px;
            max-width: 300px;
            height: auto;
            border: 1px solid #ccc;
            padding: 4px;
        }
    </style>
</head>
<body>

<?php if ($showForm): ?>

    <h2>Form Biodata dan Upload Foto</h2>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
            <?php foreach ($errors as $err): ?>
                <li><?php echo htmlspecialchars($err); ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>

        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>

        <label for="foto">Upload Foto (JPG/PNG):</label>
        <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png" required>

        <button type="submit">Kirim</button>
    </form>

<?php else: ?>

    <h2>Form Biodata dan Upload Foto</h2>

    <div class="success-label">Data Berhasil Dikirim:</div>

    <p><strong>Nama:</strong> <?php echo htmlspecialchars($data['nama']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($data['email']); ?></p>
    <p><strong>Alamat:</strong> <?php echo nl2br(htmlspecialchars($data['alamat'])); ?></p>
    <p><strong>Foto:</strong><br>
        <img src="<?php echo htmlspecialchars($data['foto']); ?>" alt="Foto Upload" class="uploaded-photo">
    </p>

    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="link-kembali">Kembali</a>

<?php endif; ?>

</body>
</html>