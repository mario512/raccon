<div class="container-fluid">
    <!-- Title -->
    <h1 class="h2">
        <?php echo $dataPage['text_title_page']; ?>
    </h1>

    <div class="row">
        <div class="col">

            <!-- Card -->
            <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["name", "email", "id", {"name": "date", "attr": "data-signed"}, "status"], "page": 8}' id="users">
                <div class="row">
                    <div class="card-header border-0 card-header-space-between col">

                        <!-- Title -->
                        <h2 class="card-header-title h4 text-uppercase">
                            <?php echo $dataPage['text_title_coin']; ?>
                        </h2>


                    </div>

                    <div class="card-header border-0 card-header-space-between col">

                        <!-- Title -->
                        <h2 class="card-header-title">

                            <a href="<?php echo $dataPage['href_new'];?>" class="text-muted d-flex justify-content-end">
                                <img src="<?php echo $dataPage['href_new_icon'];?>" alt="..." class=" d-flex justify-content-end avatar-img" width="30" height="30">
                            </a>
                        </h2>



                    </div>
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table align-middle table-edge table-hover table-nowrap mb-0">
                            <thead class="thead-light">
                                <tr>

                                    <th>
                                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="name">
                                            <?php echo $dataPage['text_table_name']; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="email">
                                            <?php echo $dataPage['text_table_wallet']; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="id">
                                            <?php echo $dataPage['text_table_code']; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="date">
                                            <?php echo $dataPage['tetx_table_category']; ?>
                                        </a>
                                    </th>
                                    <th class="w-150px min-w-150px">
                                        <a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">
                                            <?php echo $dataPage['text_table_in_out']; ?>
                                        </a>
                                    </th>
                                    <th class="text-muted ">

                                    </th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                <?php if ($dataPage['currency']) { ?>
                                    <?php foreach ($dataPage['currency'] as $curency) { ?>
                                        <tr currency-id="<?php echo $curency['currency_id']; ?>">
                                            <td>
                                                <div class="avatar avatar-circle avatar-xs me-2">
                                                    <img src="<?php echo $curency['currency_image']; ?>" alt="..." class="avatar-img" width="30" height="30">
                                                </div>
                                                <span class="name fw-bold"><?php echo $curency['currency_name']; ?></span>
                                            </td>
                                            <td class="email"><?php echo $curency['currency_wallet']; ?></td>
                                            <td class="id"><?php echo $curency['currency_code']; ?></td>
                                            <td class="date"><?php echo $curency['currency_category_code']; ?></td>
                                            <td class="status"><span class="legend-circle bg-success"></span><?php echo $curency['currency_in_out']; ?></td>
                                            <td>
                                                <div class="avatar avatar-circle avatar-xs me-2">
                                                    <a href="<?php echo $curency['currency_href_edit']; ?>" class="text-muted">
                                                        <img src="<?php echo $curency['currency_edit_img']; ?>" alt="..." class="avatar-img" width="30" height="30">
                                                    </a>
                                                </div>
                                            </td>
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