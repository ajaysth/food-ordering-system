<?php include('partials-front/menu.php'); 

$sql = "SELECT id, title, price, image_name FROM tbl_food where active='yes'";
$result = $conn->query($sql);
?>

<?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        
        
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


<div class="container">
    <h1 class="my-4 text-center" style="font-weight: bold;">Food Menu</h1>
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/food/<?php echo $row['image_name']; ?>"  class="card-img-top" style="max-height: 300px; object-fit: cover;" alt="<?php echo $row['title']; ?> " >
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text">Price: Rs <?php echo $row['price']; ?></p>
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
                            <td>Rs<?php echo $item['price']; ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>Rs<?php echo $item['price'] * $item['quantity']; ?></td>
                        </tr>
                        <?php $total += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total</strong></td>
                        <td><strong>Rs<?php echo $total; ?></strong></td>
                    </tr>
                    </tbody>
                    
                </table>

       <?php

       $email='';

if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    $email = $_SESSION['user']['email'];
    $user_id = $_SESSION['user']['id'];
    
}
?>

        <!-- Checkout Form -->
        <form method="post" action="checkout.php">
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required >
                
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="number" class="form-control" id="contact" name="contact" required>
                
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="<?php echo $email;?>" name="email"  >
                
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
        
            </div>
            <br>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Checkout</button>
            </div>
            
        </form>
        <br>
        <div class="d-flex justify-content-center">
            <a  href="cancel.php" class="btn btn-danger clear-cart" onclick="confirmClearCart(event)">Clear Cart</a>
        </div>
        
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
</div>
<script>
function confirmClearCart(event) {
            if (!confirm("Are you sure you want to delete this food?")) {
                event.preventDefault();
            }
        }
    </script>



<?php include('partials-front/footer.php'); ?>

 

