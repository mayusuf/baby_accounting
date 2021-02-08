<div class="col-md-12 center-block">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"> Account Transactions Reports View</h2>
        </div>
        <div class="panel-body">
            <div class="col-md-8" id="status"></div>
            <div class="col-md-12">
                <?php
                foreach ($details_inf as $key => $baby_details) {

                    $baby_name = $baby_details['accountName'];
                    $baby_account_no = $baby_details['accountNo'];
                    $accountAddress = $baby_details['accountAddress'];
                    $contactNo = $baby_details['contactNo'];
                }
                if ($amount_inf) {
                    foreach ($amount_inf as $key => $transaction) {

                        $entryDate = $transaction['entryDate'];
                        $deposit = $transaction['deposit'];
                        $withDraw = $transaction['withDraw'];
                        $balance = $transaction['balance'];
                    }

                } else {
                    $entryDate = 0;
                    $deposit = 0;
                    $withDraw = 0;
                    $balance = 0;
                }

                ?>
                <div class="col-md-12" id="reports">

                    <div class="col-md-12" style="text-align: center;">
                        <p><strong> Account Name : <?php echo $baby_name; ?></strong></p>

                        <p> Account Number : <strong> <?php echo $baby_account_no; ?> </strong></p>

                        <p><?php echo $accountAddress . "  , " . $contactNo; ?>
                    </div>
                    <div class="col-md-12 table-responsive">
                        <table id='Tablestdresult' class='table table-bordered table-hover'>
                            <thead>
                            <tr>
                                <th> Date </th>
                                <th> Deposit</th>
                                <th> Withdraw</th>
                                <th> Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $entryDate; ?></td>
                                <td><?php echo $deposit; ?></td>
                                <td><?php echo $withDraw; ?></td>
                                <td><?php echo $balance; ?></td>
                            </tr>
                            </tbody>

                            <tfoot>
                            <tr>
                                <th> Date </th>
                                <th> Deposit</th>
                                <th> Withdraw</th>
                                <th> Balance</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!--                                <a class="btn btn-success" onclick="printContent('abh')">Click to Print</a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->