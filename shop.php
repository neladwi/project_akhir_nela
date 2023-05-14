<?php
//koneksi database
include "koneksi.php";

//query untuk menampilkan data barang
$sql = "SELECT * FROM barang";
$result = mysqli_query($conn, $sql);

//searching barang
if(isset($_POST['search'])) {
  $search_term = mysqli_real_escape_string($conn, $_POST['search_term']);
  $sql = "SELECT * FROM barang WHERE nama_barang LIKE '%".$search_term."%' OR deskripsi LIKE '%".$search_term."%' OR harga LIKE '%".$search_term."%'";
  $result = mysqli_query($conn, $sql);
}

//sorting barang
if(isset($_GET['sort'])) {
  $sort_type = $_GET['sort'];
  if($sort_type == 'asc') {
    $sql = "SELECT * FROM barang ORDER BY nama_barang ASC";
  } else {
    $sql = "SELECT * FROM barang ORDER BY nama_barang DESC";
  }
  $result = mysqli_query($conn, $sql);
}

//query untuk menampilkan data kategori
$sql_kategori = "SELECT * FROM kategori";
$result_kategori = mysqli_query($conn, $sql_kategori);
?>

<html>
<head>
    <link rel="stylesheet" href="stylemultirole.css">
    <link rel="icon" href="Bigetron Esports Logo.png">
    <title>Shop</title>
</head>
<body>
    <header>
        <img src="Bigetron Esports Logo.png" alt="logo" style="float: left;" style="text-align: right;" width="70px" height="70px">
        <h1>BIGETRON SHOP</h1>
    </header>
    <nav>
           <a href="index.php"><span>Home</span></a>
           <a href="about.php"><span>About</span></a>   
           <a href="profil.php"><span>Profile</span></a>
           <a href="sign-in.php"><span>Sign In</span></a>
           <a href="shop.php"><img border="0" src="shopping-cart.png" width="30px" style="margin: 0px 5px -8px 1100px; color:red;">Shop</a>
    </nav>
    <h1 style="margin-bottom: 0px; margin-top: 70px; margin-left: 790px; " ><span style="color: red; margin-left: -40px;">Bigetron</span>Shop</h1><br>
    <h3>Selamat datang, Bigetroopers</h3>
    <h4>Silahkan pilih barang yang ingin anda beli, selamat berbelanja!</h2>

  <form style="margin-top: -20px;" method="POST" action="">
  <input type="text" name="search_term" placeholder="Cari Barang" style="color: black;">
  <button type="submit" name="search">Cari</button>
  </form>

  <form method="GET" action="">
  <br>
  <label for="sort">Sortir berdasarkan:</label>
  <select id="sort" name="sort">
    <option value="asc">A-Z</option>
    <option value="desc">Z-A</option>
  </select>
  <button style="margin-top: 10px; padding: 10px 10px 10px 10px;" type="submit">Sortir</button>
  </form>
  <table style="margin-top: -140px;" border="1">
    <tr>
      <th>Nama Barang</th>
      <th>Deskripsi</th>
      <th>Harga</th>
      <th>Kategori</th>
    </tr>
    <?php while($barang = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><a style="text-decoration: none;" href="beli.php?id_barang=<?php echo $barang['id_barang']; ?>"><?php echo $barang['nama_barang']; ?></a></td>
      <td><?php echo $barang['deskripsi']; ?></td>
      <td><?php echo "Rp " . number_format($barang['harga'], 0, ',', '.'); ?></td>
      <td>
        <?php
         //query untuk menampilkan kategori barang
        $sql_kategori_barang = "SELECT * FROM kategori JOIN barang_kategori ON kategori.id_kategori = barang_kategori.id_kategori WHERE barang_kategori.id_barang = ".$barang['id_barang'];
        $result_kategori_barang = mysqli_query($conn, $sql_kategori_barang);

        while($data_kategori_barang = mysqli_fetch_array($result_kategori_barang)) {
        echo $data_kategori_barang['nama_kategori'].", ";
        }
        ?>
      </td>
    </tr>
    <?php } ?>
  </table>
  <div class="text2">
        <h4>sign In sebagai user untuk membeli
        </h4>
    </div>
    <div style="text-align: center;">
        <a href="sign-in.php" target="_SELF">
        <button class="btn fourth">SIGN IN</button>
    </div>
</body>
</html>
    <footer>
        <p>2023 Kelompok 6</p>
    </footer>
</body>
</html>