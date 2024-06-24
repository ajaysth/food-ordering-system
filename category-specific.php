<?php include('partials-front/menu.php'); ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

    <?php
    $category_name='';
    // $category_id = $_GET['category_id'];
    // $category_name = $_GET['title'];
    if (isset($_GET['title'])) {
        // category id is set and get the id
        $category_id = $_GET['category_id'];
        $category_name = $_GET['title'];
        // get the category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        // execute the query
        $res = mysqli_query($conn, $sql);
    
        // get the value from database
        $row = mysqli_fetch_assoc($res);
        // get the title
        $category_name = $row['title'];
    }
    
   
    ?>

        <h2>Foods on <a class="fs-1" href="#" style="text-decoration:none; color:white;" class="text-white">"<?php echo $category_name; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php
 // Include the database connection

$category_id = $_GET['category_id'];


// Fetch food items from the database for the selected category
$sql = "SELECT id, title, price, image_name FROM tbl_food WHERE category_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $category_id);
$stmt->execute();
$result = $stmt->get_result();


// Handle add to cart
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $image_name = $_POST['image_name'];
    $category_name =$_POST['title'];
    // $category_title = $row['title'];

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
    header("Location: category-specific.php?category_id=$category_id");
    exit();
}
?>




<div class="container">
    <h1 class="my-4">Food Items</h1>
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/food/<?php echo $row['image_name']; ?>" class="card-img-top img-fluid" style="max-height: 200px; object-fit: cover;" alt="<?php echo $row['title']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text">Price: $<?php echo $row['price']; ?></p>
                            <form method="post" action="category-specific.php?category_id=<?php echo $category_id; ?>&title=<?php echo urlencode($row['title']); ?>">
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
            <p>No food items available for this category.</p>
        <?php endif; ?>
    </div>

    <h2 class="my-4">Cart</h2>
    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table">
            <thead>
            <tr>
                <th>Item</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php $total = 0; ?>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <tr>
                    <td><?php echo $item['title']; ?></td>
                    <td><img src="images/food/<?php echo $item['image_name']; ?>" class="img-fluid" style="max-height: 50px; object-fit: cover;" alt="<?php echo $item['title']; ?>"></td>
                    <td>$<?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>$<?php echo $item['price'] * $item['quantity']; ?></td>
                </tr>
                <?php $total += $item['price'] * $item['quantity']; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="4" class="text-right"><strong>Total</strong></td>
                <td><strong>$<?php echo $total; ?></strong></td>
            </tr>
            </tbody>
        </table>
        <!-- Checkout Form -->
        <form method="post" action="checkout.php">
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="number" class="form-control" id="contact" name="contact" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div><br>
            <button type="submit" class="btn btn-success">Checkout</button>
        </form>
        <br>
        <a href="cancel.php" class="btn btn-danger">Clear Cart</a>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>
<?php include('partials-front/footer.php'); ?>




