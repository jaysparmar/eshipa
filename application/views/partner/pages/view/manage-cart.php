<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>View Product</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="text text-info" href="<?= base_url('partner/home') ?>">Home</a></li>
                        <li class="breadcrumb-item active">View Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row py-4">
                    <div class="col-xl-8">
                        <div class="mb-4 cart-table">
                            <table id="cart_item_table" class="table w-100 mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col">PRODUCT</th>
                                        <th scope="col">PRICE</th>
                                        <th scope="col">QUANTITY</th>
                                        <th scope="col">SUBTOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart as $key => $row) {
                                        if (isset($row['qty']) && $row['qty'] != 0) {
                                            if ($row['sale_price'] != 0) {
                                                $price = $row['sale_price'];
                                            } else {
                                                $price = $row['special_price'] != '' && $row['special_price'] != null && $row['special_price'] > 0 ? $row['special_price'] : $row['price'];
                                            }
                                    ?>
                                            <tr>
                                                <td class="product-removal">
                                                    <ion-icon name="close-outline" class="remove-product pointer" id="remove_inventory" data-id="<?= $row['id']; ?>" title="Remove From Cart"></ion-icon>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('products/details/' . $row['slug']) ?>" target="_blank">
                                                        <div class="product-thumbnail">
                                                            <img src="<?= $row['image'] ?>" alt="<?= $row['name']; ?>">
                                                        </div>
                                                    </a>
                                                </td>
                                                <div class="id">
                                                    <input type="hidden" name="<?= 'id[' . $key . ']' ?>" id="id" value="<?= $row['id'] ?>">
                                                </div>
                                                <td>
                                                    <p class="product-name"><?= $row['name'] ?></p>
                                                    <p class="product-disc"><?= $row['short_description'] ?></p>
                                                </td>
                                                <td class="product-price">
                                                    <span class="d-md-none d-block">PRICE</span>
                                                    <p><?= $settings['currency'] . number_format($price, 2) ?></p>
                                                </td>
                                                <td class="product-quantity">
                                                    <span class="d-md-none d-block">QUANTITY</span>
                                                    <div class="input-group plus-minus-input mb-3 num-block">
                                                        <?php $check_current_stock_status = validate_stock([$row['id']], [$row['qty']]); ?>
                                                        <?php if (isset($check_current_stock_status['error'])  && $check_current_stock_status['error'] == TRUE) { ?>
                                                            <div><span class='text text-danger'> Out of Stock </span></div>
                                                        <?php } else { ?>
                                                            <div class="num-in d-flex">
                                                                <?php $price ?>
                                                                <div class="input-group-button">
                                                                    <button type="button" class="button hollow circle minus-btn minus dis" data-quantity="minus" data-min="<?= (isset($row['minimum_order_quantity']) && !empty($row['minimum_order_quantity'])) ? $row['minimum_order_quantity'] : 1 ?>" data-step="<?= (isset($row['minimum_order_quantity']) && !empty($row['quantity_step_size'])) ? $row['quantity_step_size'] : 1 ?>">
                                                                        <i class="fa-solid fa-minus"></i>
                                                                    </button>
                                                                </div>
                                                                <input class="input-group-field input-field-cart-modal in-num itemQty" type="number" name="qty" data-page="cart" data-id="<?= $row['id']; ?>" value="<?= $row['qty'] ?>" data-price="<?= $price ?>" data-step="<?= (isset($row['minimum_order_quantity']) && !empty($row['quantity_step_size'])) ? $row['quantity_step_size'] : 1 ?>" data-min="<?= (isset($row['minimum_order_quantity']) && !empty($row['minimum_order_quantity'])) ? $row['minimum_order_quantity'] : 1 ?>" data-max="<?= (isset($row['total_allowed_quantity']) && !empty($row['total_allowed_quantity'])) ? $row['total_allowed_quantity'] : '' ?>">
                                                                <div class="input-group-button">
                                                                    <button type="button" class="button hollow circle plus-btn plus" data-quantity="plus" data-max="<?= (isset($row['total_allowed_quantity']) && !empty($row['total_allowed_quantity'])) ? $row['total_allowed_quantity'] : '0' ?> " data-step="<?= (isset($row['minimum_order_quantity']) && !empty($row['quantity_step_size'])) ? $row['quantity_step_size'] : 1 ?>">
                                                                        <i class="fa-solid fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal total-price">
                                                    <span class="d-md-none d-block">SUBTOTAL</span>
                                                    <p class="product-line-price"><?= $settings['currency'] . number_format(($row['qty'] * $price), 2) ?></p>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    <div class="col-xl-4 pb-4 position-sticky align-self-start top-0">
                        <div class="cart-total d-xl-block d-none">
                            <div class="cart-titles">Cart Totals</div>
                            <table class="table cart-total-table">
                                <tbody>
                                    <?php $total = !empty($cart['sub_total']) ? number_format($cart['overall_amount'] - $cart['delivery_charge'], 2) : 0 ?>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td>
                                            <p><?= $settings['currency'] . '<span id="final_total"> ' . $total . '</span>' ?></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="cart/checkout">
                                <button class="btn btn-primary w-100">Proceed to checkout</button>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
</div>
<!-- /.content -->