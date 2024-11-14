<!DOCTYPE html>
<html>
  <head>
    <title>Toko Sembako Novita</title>
    <style>
    /* Gaya dasar untuk tabel */
    table {
      width: 100%;
      border-collapse: collapse; /* Menghindari garis border dobel */
    }

    /* Gaya untuk border tabel dan sel */
    table, th, td {
      border: 1px solid #ddd; /* Menambahkan border tipis */
    }

    /* Gaya untuk header tabel */
    th {
      background-color: #4CAF50; /* Warna latar belakang header */
      color: white; /* Warna teks header */
      padding: 10px;
      text-align: center;
    }

    /* Gaya untuk sel tabel */
    td {
      padding: 10px;
      text-align: center; /* Menyelaraskan teks di tengah */
    }

    /* Warna latar belakang untuk baris genap */
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    /* Warna latar belakang untuk baris ganjil */
    tr:nth-child(odd) {
      background-color: #ffffff;
    }

    /* Efek hover saat kursor berada di atas baris */
    tr:hover {
      background-color: #ddd;
    }
  </style>
  </head>
  <body>
<table border="1" cellpacing="0" cellpading="5">
  <tr>
        <th>id barang</th>
        <th>nama barang</th>
        <th>stok</th>
        <th>harga beli</th>
        <th>harga jual</th>
      </tr>
      <tr>
        <td>223089</td>
        <td>minyak lentik</td>
        <td>10</td>
        <td>12000</td>
        <td>20000</td>
      </tr>
      <tr>
        <td>223456</td>
        <td>gula pasir</td>
        <td>15</td>
        <td>20000</td>
        <td>25000</td>
      </tr>
      <tr>
        <td>443257</td>
        <td>teh</td>
        <td>15</td>
        <td>1000</td>
        <td>2000</td>
      </tr>
      <tr>
        <td>762882</td>
        <td>beras</td>
        <td>20</td>
        <td>14000/td>
        <td>15000</td>
      </tr>
      <tr>
        <td>765788</td>
        <td>telor ayam</td>
        <td>10</td>
        <td>2000</td>
        <td>3000</td>
      </tr>
      <tr>
</table>
  </body>
  <?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];

    $sql = "INSERT INTO tbl_barang (nama_barang, stok, harga_beli, harga_jual) VALUES ('$nama_barang', '$stok', '$harga_beli', '$harga_jual')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");  // Redirect to index.php after adding data
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
</head>
<body>
    <h2>Tambah Data Barang</h2>
    <form method="post">
        Nama Barang: <input type="text" name="nama_barang" required><br>
        Stok: <input type="number" name="stok" required><br>
        Harga Beli: <input type="number" name="harga_beli" required><br>
        Harga Jual: <input type="number" name="harga_jual" required><br>
        <input type="submit" value="Tambah">
    </form>
</body>
</html>
add_data.php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "novita_tokosembako";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
database.php
<?php
include 'database.php';

$id = $_GET['id'];
$sql = "DELETE FROM tbl_novitastok WHERE id_barang='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");  // Redirect to index.php after deleting data
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
delete.php
<?php
include 'database.php';

$id = $_GET['id'];
$sql = "SELECT * FROM tbl_novitastok WHERE id_barang='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];

    $sql = "UPDATE tbl_novitastok SET nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE id_barang='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");  // Redirect to index.php after editing data
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
</head>
<body>
    <h2>Edit Data Barang</h2>
    <form method="post">
        Nama Barang: <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required><br>
        Stok: <input type="number" name="stok" value="<?php echo $row['stok']; ?>" required><br>
        Harga Beli: <input type="number" name="harga_beli" value="<?php echo $row['harga_beli']; ?>" required><br>
        Harga Jual: <input type="number" name="harga_jual" value="<?php echo $row['harga_jual']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
edit.php
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h2>Selamat Datang di toko sembako novita_tokosembako</h2>
    <a href="view_data.php">Lihat Data Barang</a>
</body>
</html>
index.php
<?php
include 'database.php';

$sql = "SELECT * FROM tbl_novitastok";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Data</title>
</head>
<body>
    <h2>Data Barang</h2>
    <a href="add_data.php">Tambah Data</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Stok</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id_barang']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td><?php echo $row['harga_beli']; ?></td>
            <td><?php echo $row['harga_jual']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id_barang']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id_barang']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
view_data.php
 