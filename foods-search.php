<?php include('partials-front/menu.php'); ?>

<section class="food-search text-center">
    <div class="container">

        <?php
        
        // get the search keyword
        $search = $_POST['search'];


        ?>

        <h2>Foods on Your Search <a href="#" class="text-white fs-1" style="text-decoration:none;">"<?php echo $search; ?>"</a></h2>
        <form action="<?php echo SITEURL; ?>foods-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" class="btn btn-warning btn-lg" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>





<?php

$sql = "SELECT id, title, price, description, image_name FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
$result = $conn->query($sql);

// Handle add to cart
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $image_name = $_POST['image_name'];
    $description = $_POST['description'];
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
            'description' => $description,
            'image_name' => $image_name,
            'quantity' => 1
        ];
    }

    // Redirect to avoid form resubmission
    header("Location: foods-search.php");
    exit();
}
?>




<div class="container">
    <h1 class="my-4">Food Menu</h1>
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $row['image_name']; ?>" style="max-height: 300px; object-fit: cover;" class="card-img-top" alt="<?php echo $row['title']; ?> " >
                        <div class="card-body">
                            <h5 class="card-title text-center"><?php echo $row['title']; ?></h5>
                            <p class="card-text">Price: $<?php echo $row['price']; ?></p>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <form method="post" action="foods-search.php">
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



    <div class="cart" style="display:flex; align-items:center;">
        <h2 class="my-4" style="margin-right:9px;">Cart</h2>
        <i class="fas fa-shopping-cart cart-icon" style="font-size:larger;"></i>
    </div>
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
        <form method="post" action="checkout.php">
            <button type="submit" class="btn btn-success">Checkout</button>
        </form>
        <br>
        <a href="cancel.php" class="btn btn-danger">Clear Cart</a>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>


<?php include('partials-front/footer.php'); ?>
