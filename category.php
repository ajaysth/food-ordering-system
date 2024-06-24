<?php include('partials-front/menu.php'); 



$sql = "SELECT id, title, image_name FROM tbl_category WHERE active='Yes'";
$result = $conn->query($sql);



    
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>foods-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" class="btn btn-warning btn-lg" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->


    
<div class="container">
    <h1 class="my-4 text-center" style="font-weight: bold;">Food Categories</h1>
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <a href="category-specific.php?category_id=<?php echo $row['id']; ?>&title=<?php echo urlencode($row['title']); ?>">
                          <img src="images/category/<?php echo $row['image_name']; ?>" class="card-img-top img-fluid" style="max-height: 300px; object-fit: cover;" alt="<?php echo $row['title']; ?>">                        </a>
                        <div class="card-body">
                            <h5 class="card-title text-center fs-2"><?php echo $row['title']; ?></h5>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No categories available.</p>
        <?php endif; ?>
    </div>
</div>


<?php include('partials-front/footer.php'); ?>