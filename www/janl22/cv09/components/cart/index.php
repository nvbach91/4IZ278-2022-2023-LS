<?php

$priceSum = sumItemsInCartPrice();

?>
<div class="row animation fade-in">
	<table class="table">
		<thead>
		<tr>
			<th scope="col" style="width:50%;">Product</th>
			<th scope="col" class="text-center" style="width:15%;">Unit price</th>
			<th scope="col" class="text-center" style="width:15%;">Amount</th>
			<th scope="col" class="text-center" style="width:15%;">Price</th>
			<th scope="col" class="text-center" style="width:5%;"></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($_SESSION['cart'] as $item): ?>
			<tr>
				<th scope="row"><?php echo $item['name']; ?></th>
				<td class="text-center"><?php echo formatPrice($item['unitPrice']); ?></td>
				<td class="text-center">
					<a href="removeFromCart?id=<?php echo $item['id_product']; ?>&flag=one" class="badge bg-dark text-white ms-2 me-2 rounded-pill">
						<i class="bi bi-dash"></i>
					</a>
					<?php echo $item['count']; ?>
					<a href="addToCart?id=<?php echo $item['id_product']; ?>&flag=buy" class="badge bg-dark text-white ms-2 me-2 rounded-pill">
						<i class="bi bi-plus"></i>
					</a>
				</td>
				<td class="text-center"><?php echo formatPrice($item['unitPrice'] * $item['count']); ?></td>
				<td>
					<a href="removeFromCart?id=<?php echo $item['id_product']; ?>&flag=all" class="text-black ms-2 me-2">
						<i class="bi bi-trash"></i>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<table class="table">
		<thead>
		<tr>
			<th scope="col" style="width:50%;">Total</th>
			<th scope="col" class="text-center" style="width:15%;"></th>
			<th scope="col" class="text-center" style="width:15%;"></th>
			<th scope="col" class="text-center" style="width:15%;"><?php echo formatPrice($priceSum) ?></th>
			<th scope="col" class="text-center" style="width:5%;"></th>
		</tr>
		</thead>
	</table>
</div>
