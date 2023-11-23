<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>View Cart</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="text text-info" href="<?= base_url('partner/home') ?>">Home</a></li>
                        <li class="breadcrumb-item active">View Cart</li>
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
                                        <th scope="col">IMAGE</th>
                                        <th scope="col">PRODUCT</th>
                                        <th scope="col">PRICE</th>
                                        <th scope="col">QUANTITY</th>
                                        <th scope="col">SUBTOTAL</th>
                                        <!-- <th scope="col">REMOVE</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($this->cart_model->get_user_cart($this->session->userdata('user_id'))) != 0) {
                                        foreach ($cart as $key => $row) {
                                            if (isset($row['qty']) && $row['qty'] != 0) {
                                                $price = $row['special_price'] != '' && $row['special_price'] != null && $row['special_price'] > 0 ? $row['special_price'] : $row['price'];

                                    ?>
                                                <tr>
                                                    <td>
                                                        <a href="<?= base_url('products/details/' . $row['slug']) ?>" target="_blank">
                                                            <div class="product-thumbnail">
                                                                <img src="<?= $row['image'] ?>" alt="<?= $row['name']; ?>" style="max-width: 100px; height: auto;">
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <p class="product-name"><?= $row['name'] ?></p>
                                                        <p class="product-disc"><?= $row['short_description'] ?></p>
                                                    </td>
                                                    <input type="hidden" id="currency_symbol" value="<?= $settings['currency']; ?>">
                                                    <td class="product-price">
                                                        <p><?= $settings['currency'] . number_format($price, 2) ?></p>
                                                    </td>
                                                    <td class="product-quantity">
                                                        <span class="d-md-none d-block">QUANTITY</span>
                                                        <div class="input-group plus-minus-input mb-3 num-block">
                                                            <?php $check_current_stock_status = validate_stock([$row['id']], [$row['qty']]); ?>
                                                            <?php if (isset($check_current_stock_status['error']) && $check_current_stock_status['error'] == TRUE) { ?>
                                                                <div><span class='text text-danger'>Out of Stock</span></div>
                                                            <?php } else { ?>
                                                                <div class="num-in d-flex align-items-center">
                                                                    <div class="input-group-button">
                                                                        <button type="button" class="btn btn-danger btn-xs mx-1 minus-btn minus dis" data-quantity="minus" data-min="<?= (isset($row['minimum_order_quantity']) && !empty($row['minimum_order_quantity'])) ? $row['minimum_order_quantity'] : 1 ?>" data-step="<?= (isset($row['minimum_order_quantity']) && !empty($row['quantity_step_size'])) ? $row['quantity_step_size'] : 1 ?>">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                    </div>
                                                                    <input class="input-group-field input-field-cart-modal in-num itemQty form-control" type="number" name="qty" data-page="cart" data-id="<?= $row['id']; ?>" value="<?= $row['qty'] ?>" data-price="<?= $price ?>" data-step="<?= (isset($row['minimum_order_quantity']) && !empty($row['quantity_step_size'])) ? $row['quantity_step_size'] : 1 ?>" data-min="<?= (isset($row['minimum_order_quantity']) && !empty($row['minimum_order_quantity'])) ? $row['minimum_order_quantity'] : 1 ?>" data-max="<?= (isset($row['total_allowed_quantity']) && !empty($row['total_allowed_quantity'])) ? $row['total_allowed_quantity'] : '' ?>">
                                                                    <div class="input-group-button">
                                                                        <button type="button" class="btn btn-primary btn-xs mx-1 plus-btn plus" data-quantity="plus" data-max="<?= (isset($row['total_allowed_quantity']) && !empty($row['total_allowed_quantity'])) ? $row['total_allowed_quantity'] : '0' ?> " data-step="<?= (isset($row['minimum_order_quantity']) && !empty($row['quantity_step_size'])) ? $row['quantity_step_size'] : 1 ?>">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </td>

                                                    <td class="product-subtotal total-price">
                                                        <p class="product-line-price"><?= $settings['currency'] . number_format(($row['qty'] * $price), 2) ?></p>
                                                    </td>
                                                    <!-- <td class="product-removal">
                                                    <ion-icon name="close-outline" class="remove-product pointer" id="remove_inventory" data-id="<?= $row['id']; ?>" title="Remove From Cart"></ion-icon>
                                                </td> -->
                                                </tr>
                                        <?php }
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <p class="alert alert-primary">Your cart is empty!</p>
                                                <a href="<?= base_url('partner/buy_stock/') ?>"><button type="button" class="btn btn-primary">
                                                        Buy Stock <i class="fas fa-shopping-cart"></i>
                                                    </button></a>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                    <input type="hidden" id="user_id" value="<?= $this->session->userdata('user_id') ?>">
                    <input type="hidden" id="mobile" value="<?= fetch_details(['id' => $this->session->userdata('user_id')], "users", "mobile")[0]['mobile']; ?>">
                    <input type="hidden" id="product_variant_id" value="<?= implode(',', array_column($cart, 'id')) ?>">
                    <input type="hidden" id="quantity" value="<?= implode(',', array_column($cart, 'qty')) ?>">
                    <div class="col-xl-4 pb-4 position-sticky align-self-start top-0">
                        <div class="cart-total d-xl-block d-none bg-light p-3 rounded">
                            <div class="cart-titles h5 mb-3">Cart Totals</div>
                            <table class="table cart-total-table">
                                <tbody>
                                    <?php
                                    $total = !empty($cart['sub_total']) ? number_format($cart['overall_amount'], 2) : 0;
                                    ?>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td>
                                            <p class="h4"><?= $settings['currency'] ?><span id="final_total"><?= $total ?></span></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="javascript:void(0)" class="text-decoration-none">
                                <button class="btn btn-primary w-100 mt-3 place_order" <?= count($this->cart_model->get_user_cart($this->session->userdata('user_id'))) != 0 ? '' : 'disabled' ?>>Place order</button>
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