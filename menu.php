<?php include 'partials/header.php'; ?>

<section class="container mt-5">
    <h2 class="mb-4">Daftar Obat-obatan</h2>
    <div class="row">
        <?php
        $limit = 10; // Number of items per page

        // Get the current page from the URL, default to page 1
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $tampil = mysqli_query($koneksi, "SELECT * FROM data_obat LIMIT $start, $limit");
        while ($data = mysqli_fetch_array($tampil)) :
        ?>
            <div class="col-md-12 col-lg-3">
                <div class="card mb-4">
                    <img style="height: 200px; object-fit: cover;" src="<?= $data['gambar_obat']; ?>" class="card-img-top" alt="Obat 1">
                    <div class="card-body">
                        <h3 class="card-title"><?= $data['nama_obat'] ?></h3>
                        <h5><?= "Rp " . number_format($data['harga_obat'], 0, ',', '.') ?></h5>
                        <a class="btn btn-success" href="detail_obat.php?hal=detail&id=<?= $data['id_obat'] ?>">Detail</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <?php
    // Calculate total pages before using in the loop
    $result = mysqli_query($koneksi, "SELECT COUNT(id_obat) as total FROM data_obat");
    $row = mysqli_fetch_assoc($result);
    $total_pages = ceil($row['total'] / $limit);
    ?>

    <!-- Pagination links using Bootstrap structure -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            // Previous Page Link
            echo "<li class='page-item " . ($page == 1 ? 'disabled' : '') . "'><a class='page-link' href='?page=" . ($page - 1) . "'>Previous</a></li>";

            // Page links
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=$i'>$i</a></li>";
            }

            // Next Page Link
            echo "<li class='page-item " . ($page == $total_pages ? 'disabled' : '') . "'><a class='page-link' href='?page=" . ($page + 1) . "'>Next</a></li>";
            ?>
        </ul>
    </nav>
</section>

<?php include 'partials/footer.php'; ?>
