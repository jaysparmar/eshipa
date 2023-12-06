<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Buy Stock</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="text text-info" href="<?= base_url('partner/home') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Buy Stock</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 main-content">
                    <div class="card content-area p-4">

                        <div class="card-innr">

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="zipcode" class="col-form-label">Filter By Product Category</label>
                                    <select id="category_parent" name="category_parent">
                                        <option value=""><?= (isset($categories) && empty($categories)) ? 'No Categories Exist' : 'Select Categories' ?>
                                        </option>
                                        <?php
                                        echo get_categories_option_html($categories);
                                        ?>
                                    </select>
                                    <!-- <input type="text" name="barcode" id="buy_stock_barcode" class="form-control" value=""> -->
                                </div>
                                <input type="hidden" id="restro_filter" value="0">
                                <input type="hidden" id="buy_stock" value="1">
                            </div>
                            <div class="gaps-1-5x"></div>
                            <table class='table-striped' id='products_table' data-toggle="table" data-url="<?= isset($_GET['flag']) ? base_url('partner/product/get_product_data?flag=') . $_GET['flag'] : base_url('partner/product/get_product_data') ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-sort-name="id" data-sort-order="desc" data-mobile-responsive="true" data-toolbar="" data-show-export="true" data-maintain-selected="true" data-export-types='["txt","excel","csv"]' data-export-options='{"fileName": "products-list","ignoreColumn": ["state"] }' data-query-params="product_query_params">
                                <thead>
                                    <tr>
                                        <th data-field="id" data-sortable="true" data-visible='false'>ID</th>
                                        <th data-field="image" data-sortable="true">Image</th>
                                        <th data-field="name" data-sortable="false">Name</th>
                                        <th data-field="variations" data-sortable="true" data-visible='false'>Variations</th>
                                        <th data-field="operate" data-sortable="true">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div><!-- .card-innr -->
                    </div><!-- .card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>