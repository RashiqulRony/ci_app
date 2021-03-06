<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Users <small>products List</small></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>products</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div align="right">
                        <a class="btn btn-success" href="http://localhost/codeigniter/common/dompdf_report">DOMPdf download</a>
                        <a class="btn btn-primary" href="http://localhost/codeigniter/common/excelCreate">Excel download</a>
                        <a class="btn btn-success" href="http://localhost/codeigniter/common/generate_pdf">TCPdf download</a>

                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Sale price</th>
                                <th>Sale count</th>
                                <th>Date</th>
                            </tr>
                            </thead>


                            <tbody>
                            <?php foreach ($results as $key => $row): ?>
                                <tr>
                                    <td><?= $key+1; ?></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['price'] ?></td>
                                    <td><?= $row['sale_price'] ?></td>
                                    <td><?= $row['sales_count'] ?></td>
                                    <td><?= $row['sale_date'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
<!-- /page content -->