<div class="container-fluid">
    <!-- Title -->
    <h1 class="h2">
        <?php echo $dataPage['text_title_orders']; ?>
    </h1>

    <div class="row">
        <div class="col">

            <!-- Card -->
            <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["name", "wallet", "summ","cur_out", "date", {"name": "", "attr": "data-signed"}, "status"], "page": 8}' id="users">
                <div class="row">
                    <div class="card-header border-0 card-header-space-between col">

                        <!-- Title -->
                        <h2 class="card-header-title h4 text-uppercase">
                            <?php echo $dataPage['text_title_orders_list']; ?>
                        </h2>


                    </div>


                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table align-middle table-edge table-hover table-nowrap mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>
                                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="date">
                                            <?php echo $dataPage['text_table_date']; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="name">
                                            <?php echo $dataPage['text_table_name']; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="wallet">
                                            <?php echo $dataPage['text_table_wallet']; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="cur_out">
                                            <?php echo $dataPage['text_table_code']; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="summ">
                                            <?php echo $dataPage['text_table_summ']; ?>
                                        </a>
                                    </th>
                                    <th class="w-150px min-w-150px">
                                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">
                                            <?php echo $dataPage['text_table_status']; ?>
                                        </a>
                                    </th>
                                    <th class="text-muted ">

                                    </th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                <?php if ($dataPage['orders']) { ?>
                                    <?php foreach ($dataPage['orders'] as $order) { ?>
                                        <tr currency-id="<?php echo $order['order_id']; ?>">
                                            <td class="date"><?php echo $order['order_date']; ?></td>
                                            <td class="name"><?php echo $order['order_cur_in']; ?></td>
                                            <td class="wallet"><?php echo $order['order_wallet']; ?></td>
                                            <td class="cur_out"><?php echo $order['order_cur_out']; ?></td>
                                            <td class="summ"><?php echo $order['order_sum']; ?></td>
                                            <td class="status"><?php echo $order['order_status']; ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div> <!-- / .table-responsive -->

                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-5 text-secondary small">
                                <?php echo $dataPage['text_title_show']; ?>: <span class="list-pagination-page-first"></span> - <span class="list-pagination-page-last"></span> <?php echo $dataPage['text_title_of']; ?> <span class="list-pagination-pages"></span>
                            </div>

                            <!-- Pagination -->
                            <ul class="pagination list-pagination mb-0"></ul>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- / .row -->
    </div> <!-- / .row -->