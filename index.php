<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<?php
include 'includes/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            🍽 SAVORA EATERY
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Menu
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Contact
                    </a>
                </li>

                <li class="nav-item ms-lg-3">
                    <a href="#" class="btn btn-warning">
                        Cart (0)
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>

<section id="hero" class="py-5">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h1 class="display-4 fw-bold">
                    Digital Restaurant Ordering Experience
                </h1>

                <p class="lead mt-3">
                    Browse the restaurant menu, customize your meal, and place your order directly from your phone, tablet, or the restaurant's digital ordering screen.
                </p>

                <a href="#menu" class="btn btn-warning btn-lg mt-3">
                    Order Now
                </a>

            </div>

            <div class="col-lg-6 text-center">

                <img src="/restaurant-order-system/assets/images/alfredo.jpg"
                     style="width:500px; height:400px; object-fit:cover;"
                     class="img-fluid"
                     alt="Food Image">

            </div>

        </div>

    </div>

</section>

<section id="menu" class="py-5" style="background-color: #FFF8E7;">

    <div class="container">

        <h2 class="text-center mb-5 fw-bold">
            Our Menu
        </h2>

        <?php

        $categoryQuery = "SELECT * FROM categories
                          WHERE status='Available'
                          ORDER BY name";

        $categoryResult = mysqli_query($conn, $categoryQuery);

        while($category = mysqli_fetch_assoc($categoryResult)){

        ?>

            <div class="mb-5">

                <h3 class="fw-bold text-primary mb-4 border-bottom pb-2">
                    <?php echo $category['name']; ?>
                </h3>

                <div class="row">

                    <?php

                    $menuQuery = "SELECT *
                                  FROM menu_items
                                  WHERE category_id = {$category['id']}
                                  AND availability='Available'
                                  ORDER BY featured DESC, name";

                    $menuResult = mysqli_query($conn,$menuQuery);

                    while($row = mysqli_fetch_assoc($menuResult)){

                    ?>

                        <div class="col-6 col-md-3 mb-4">

                            <div class="card h-100 shadow-sm">

                                <img src="/restaurant-order-system/<?php echo $row['image']; ?>"
                                     class="card-img-top"
                                     style="height:180px; object-fit:cover;">

                                <div class="card-body d-flex flex-column">

                                    <h6 class="fw-bold">
                                        <?php echo $row['name']; ?>
                                    </h6>

                                    <p class="small text-muted mb-2">
                                        <?php echo $row['description']; ?>
                                    </p>

                                    <h5 class="text-success fw-bold">
                                        GHS <?php echo number_format($row['price'],2); ?>
                                    </h5>

                                    <button class="btn btn-dark mt-auto"
                                        onclick="openOrderModal(
                                            '<?php echo $row['id']; ?>',
                                            '<?php echo $row['name']; ?>',
                                            '<?php echo $row['price']; ?>',
                                            '/restaurant-order-system/<?php echo $row['image']; ?>'
                                        )">
                                         Order
                                    </button>

                                </div>

                            </div>

                        </div>

                    <?php } ?>

                </div>

            </div>

        <?php } ?>

    </div>

</section>

<section id="cart" class="py-5 bg-light">

<div class="container">

    <h2 class="text-center mb-4 fw-bold">
        Your Cart
    </h2>

    <?php if (!empty($_SESSION['cart'])): ?>

        <div class="table-responsive">

            <table class="table table-bordered align-middle text-center">

                <thead class="table-dark">
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Spice</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $index => $item):

                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>

                <tr>
                    <td><?php echo $item['name']; ?></td>

                    <td>GHS <?php echo $item['price']; ?></td>

                    <td><?php echo $item['quantity']; ?></td>

                    <td>GHS <?php echo $subtotal; ?></td>

                    <td><?php echo $item['spice']; ?></td>

                    <td><?php echo $item['notes']; ?></td>

                    <td>
                        <a href="remove_item.php?index=<?php echo $index; ?>" 
                           class="btn btn-sm btn-danger">
                            Remove
                        </a>
                    </td>
                </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <!-- TOTAL + CHECKOUT -->
        <div class="text-end mt-4">

            <h4 class="fw-bold">
                Total: GHS <?php echo $total; ?>
            </h4>

            <a href="checkout.php" class="btn btn-success mt-2">
                Proceed to Checkout
            </a>

            <a href="clear_cart.php" class="btn btn-outline-danger mt-2">
                Clear Cart
            </a>

        </div>

    <?php else: ?>

        <p class="text-center text-muted">
            Your cart is empty. Start ordering from the menu above.
        </p>

    <?php endif; ?>

</div>

</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
let currentItem = {};

function openOrderModal(id, name, price, image){
    currentItem = {id, name, price};

    document.getElementById('modalItemName').innerText = name;
    document.getElementById('modalItemPrice').innerText = "GHS " + price;
    document.getElementById('modalItemImage').src = image;

    document.getElementById('modalQuantity').value = 1;
    document.getElementById('modalNotes').value = "";

    let modal = new bootstrap.Modal(document.getElementById('orderModal'));
    modal.show();
}
</script>

<script>
function addToCart() {

    let quantity = document.getElementById('modalQuantity').value;
    let notes = document.getElementById('modalNotes').value;
    let spice = document.getElementById('modalSpice').value;

    let item = {
        id: currentItem.id,
        name: currentItem.name,
        price: currentItem.price,
        quantity: quantity,
        notes: notes,
        spice: spice
    };

    fetch('cart_add.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(item)
    })
    .then(res => res.json())
    .then(data => {

        // close modal
        let modalEl = document.getElementById('orderModal');
        let modal = bootstrap.Modal.getInstance(modalEl);
        modal.hide();

        // show feedback
        alert("Item added to cart!");

        // reload page so cart UI updates
        location.reload();
    });
}
</script>

<!-- ORDER MODAL -->
<div class="modal fade" id="orderModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="modalItemName">Item Name</h5>
      </div>

      <div class="modal-body">

        <img id="modalItemImage" class="img-fluid mb-3" style="height:200px; object-fit:cover; width:100%;">

        <p class="fw-bold text-success" id="modalItemPrice"></p>

        <!-- Quantity -->
        <div class="mb-3">
          <label class="form-label">Quantity</label>
          <input type="number" id="modalQuantity" class="form-control" value="1" min="1">
        </div>

        <!-- Spice Level -->
        <div class="mb-3">
          <label class="form-label">Spice Level</label>
          <select class="form-select" id="modalSpice">
            <option>Mild</option>
            <option>Medium</option>
            <option>Hot</option>
          </select>
        </div>

        <!-- Extras -->
        <div class="mb-3">
          <label class="form-label">Extras</label>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Extra Cheese">
            <label class="form-check-label">Extra Cheese</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Extra Sauce">
            <label class="form-check-label">Extra Sauce</label>
          </div>

        </div>

        <!-- Notes -->
        <div class="mb-3">
          <label class="form-label">Special Instructions</label>
          <textarea class="form-control" id="modalNotes" rows="2"></textarea>
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-dark" onclick="addToCart()">
         Add to Order
        </button>
      </div>

    </div>
  </div>
</div>

</body>
</html>