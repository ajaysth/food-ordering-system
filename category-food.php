<?php include('partials-front/menu.php'); ?>

<?php

// check whether id is passed or not
if (isset($_GET['category_id'])) {
    // category id is set and get the id
    $category_id = $_GET['category_id'];
    // get the category title based on category id
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

    
// $result = $conn->query($sql);
    // execute the query
    $res = mysqli_query($conn, $sql);

    // get the value from database
    $row = mysqli_fetch_assoc($res);
    // get the title
    $category_title = $row['title'];
} else {
    // category id not passed
    // redirect to home page
    header('location:' . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" style="text-decoration:none;" class="text-white">"<?php echo $category_title; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php
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

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Food Menu</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body> -->
<div class="container">
    <h1 class="my-4">Food Menu</h1>
    <div class="row">
        <?php if ($res->num_rows > 0): ?>
            <?php while($row = $res->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $row['image_name']; ?>" width="50px" class="card-img-top" alt="<?php echo $row['title']; ?> " >
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text">Price: $<?php echo $row['price']; ?></p>
                            <form method="post" action="food.php">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                <input type="hidden" name="title" value="<?php echo $row['title']; ?>" />
                                <input type="hidden" name="price" value="<?php echo $row['price']; ?>" />
                                <input type="hidden" name="image_name" value="<?php echo SITEURL; ?>images/food/<?php echo $row['image_name']; ?>" />
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
                    <td><img src="<?php echo SITEURL; ?>images/food/<?php echo $row['image_name']; ?>"   alt="<?php echo $item['title']; ?>" ></td>
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
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>