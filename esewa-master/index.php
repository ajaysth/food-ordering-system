<?php include('../partials-front/menu.php'); 
$sql = "SELECT * FROM tbl_food";
$result = mysqli_query($conn, $sql);
//var_dump($result);
	
?>

		<div class="container">
			<div class="pt-md-5">
				<div class="row">
					
					<?php while( $product = mysqli_fetch_assoc($result)) {?>
					<div class="col-md-4">
						<div class="card" stylea="width: 18rem;">
							<div class="imagecontainer" style="height: 400px;">
								<img src="image/food/<?php echo $product['image']?>" class="card-img-top" alt="..." style="width: 100%; height: 100%;">
							</div>
							<div class="card-body">
								<h5 class="card-title"><?php echo $product['title'];?></h5>
								<p class="card-text">Rs. <?php echo $product['amount'];?></p>
								<p class="card-text"><?php echo $product['description'];?></p>

								<form method="post" action="checkout.php">
									<input type="hidden" name="product_id" value="<?php echo $product['id'];?>">
									<input type="submit" name="submit" value="Buy Now" class="btn btn-success">
								</form>
							</div>
						</div>
					</div>
					<?php }?>
					
				</div>
			</div>
		</div>
	</body>
</html>