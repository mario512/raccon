<div class="container-fluid">
    <!-- Title -->
    <h1 class="h2">
        <?php echo $dataPage['text_title_page'];?>
    </h1>

    <div class="row">
        <div class="col">

            <!-- Card -->
            <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["name", "email", "id", {"name": "date", "attr": "data-signed"}, "status"], "page": 8}' id="users">
                <div class="card-header border-0 card-header-space-between">

                    <!-- Title -->
                    <h2 class="card-header-title h4 text-uppercase">
                        <?php echo $dataPage['text_title_table'];?>
                    </h2>


                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table align-middle table-edge table-hover table-nowrap mb-0">
                        <thead class="thead-light">
                            <tr>

                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="name">
                                        <?php echo $dataPage['text_table_name'];?>
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="email">
                                        <?php echo $dataPage['text_table_code'];?>
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="id">
                                        <?php echo $dataPage['text_table_in_out'];?>
                                    </a>
                                </th>
                                
                            </tr>
                        </thead>

                        <tbody class="list">
                         <?php if ($dataPage['currency_category']) { ?>
                                <?php foreach ($dataPage['currency_category'] as $category) { ?>
                                    <tr currency-id="<?php echo $category['currency_cat_id']; ?>">
                                        <td class="name"><?php echo $category['currency_cat_name']; ?></td>
                                        <td class="email"><?php echo $category['currency_cat_code']; ?></td>
                                        <td class="id"><?php echo $category['currency_cat_in_out']; ?></td>
                                        
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> <!-- / .table-responsive -->

                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-5 text-secondary small">
                            <?php echo $dataPage['text_title_show'];?>: <span class="list-pagination-page-first"></span> - <span class="list-pagination-page-last"></span> <?php echo $dataPage['text_title_of'];?> <span class="list-pagination-pages"></span>
                        </div>

                        <!-- Pagination -->
                        <ul class="pagination list-pagination mb-0"></ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div> <!-- / .row -->