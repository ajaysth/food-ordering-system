<?php include('partials-front/menu.php'); ?>




<?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>foods-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.."  required >
            <input type="submit" class="btn btn-warning btn-lg" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}

if (isset($_SESSION['transaction'])) {
    echo $_SESSION['transaction'];
    unset($_SESSION['transaction']);
}


?>



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h1 class=" my-4 text-center" style="font-weight: bold;">Explore Categories</h1>
        <br>

        <h2 class="text-center text-success" style="font: size 18px;">Available categories</h2>


        <?php
        // create sql queries to display categories from database
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 4";
        // execute the query
        $res = mysqli_query($conn, $sql);
        // count rows to check whether the category is available or not
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            // categories available
            while ($row = mysqli_fetch_assoc($res)) {
                // get the values like title image_name and id
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php echo SITEURL; ?>category-specific.php?category_id=<?php echo $id; ?>&title=<?php echo urlencode($row['title']); ?>">
                    <div class="box-3 float-container">
                        <?php
                        // check whether image is available or not
                        if ($image_name == "") {
                            // display message
                            echo "<div class='error'>Image not available.</div>";
                        } else {
                            // image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza"  class="img-responsive img-curve">

                        <?php
                        }

                        ?>


                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>


        <?php
            }
        } else {
            // categories not available
            echo "<div class='error'>Categories Not Added</div>";
        }

        ?>
        <br>
        






        <div class="clearfix"></div>
    </div>

    <p class="text-center">
            <a class="btn btn-outline-info" href="<?php echo SITEURL; ?>category.php">See All Categories</a>
        </p>
</section>
<!-- Categories Section Ends Here -->



<!-- food section starts here -->
<?php  

$sql = "SELECT id, title, price, image_name FROM tbl_food LIMIT 3"  ;
$result = $conn->query($sql);


// Handle add to cart
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $image_name = $_POST['image_name'];
    // $image_path = $_POST['image_path'];

    // Check if the item is already in the cart
    $found = false;
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $id) {
            $cart_item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    // If item not found in cart, add new item
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $id,
            'title' => $title,
            'price' => $price,
            'image_name' => $image_name,
            'quantity' => 1
        ];
    }

    // Redirect to avoid form resubmission
    header("Location: food.php");
    exit();
}
?>


<div class="container">
    <h1 class="my-4 text-center" style="font-weight: bold;">Explore Foods</h1>
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/food/<?php echo $row['image_name']; ?>"  class="card-img-top" style="max-height: 400px; object-fit: cover;" alt="<?php echo $row['title']; ?> " >
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text">Price: $<?php echo $row['price']; ?></p>
                            <form method="post" action="food.php">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                <input type="hidden" name="title" value="<?php echo $row['title']; ?>" />
                                <input type="hidden" name="price" value="<?php echo $row['price']; ?>" />
                                <input type="hidden" name="image_name" value="<?php echo $row['image_name']; ?>" />
                                <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No food items available.</p>
        <?php endif; ?>
    </div>

    <p class="text-center">
        <a class="btn btn-outline-secondary" href="<?php echo SITEURL; ?>food.php">See All Foods</a>
    </p>
</section>

<!-- food section ends here -->




<br>
<br>


<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="text-center mb-4">Contact Us</h2>
      <form action="process_form.php" method="POST">
        <!-- <div class="form-group">
          <label for="name">Your Name</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">Your Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div> -->
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div><br>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include('partials-front/footer.php'); ?>