<div class="col-md-12 center-block">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"> <?php echo $this->lang->line('manage_accounts'); ?> </h2>
        </div>
        <div class="panel-body">
            <div class="col-md-8" id="status"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="col-md-12 col-sm-12">
                                <?php echo $this->session->flashdata('msg'); ?>
                                <table id="all_baby_accounts" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Accounts No</th>
                                        <th> Accounts Name</th>
                                        <th> Address</th>
                                        <th> Contact No</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    $serial = 1;
                                    echo "<tbody>";
                                    foreach ($all_accounts as $key => $value) {

                                        $id = $value['Id'];
                                        $edit_url = base_url('admin/account_settings/update_accounts_settings/' . $id);

                                        echo "<tr>";
                                        echo "<td>" . $serial++ . "</td>";
                                        echo "<td class=''>" . $value['accountNo'] . "</td>";
                                        echo "<td class=''>" . $value['accountName'] . "</td>";
                                        echo "<td class=''>" . $value['accountAddress'] . "</td>";
                                        echo "<td class=''>" . $value['contactNo'] . "</td>";
                                        echo "<td style='text-align:center;'><a data-toggle='tooltip' class='btn btn-primary'  href='" . $edit_url . "' title='Edit'> <i class='fa fa-pencil-square-o'></i> </a></td>";
                                        // echo " <a data-toggle='tooltip' class='btn btn-danger deleteinformation'  id='" . $id . "'  title='Delete'> <i class='fa fa-trash-o'></i> </a></td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "<tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th> Accounts No</th>
                                                    <th> Accounts Name</th>
                                                    <th> Address</th>
                                                    <th> Contact No</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>";
                                    echo "</table>";
                                    //close the database connection
                                    ?>
                            </div>
                            <!-- /.table responsive -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.row -->
<style>
    #accno a:hover {
        background: #2acdd3;
        text-decoration: none;
    }

    #accounts_reports #btn {
        margin-top: 10px 10px;
    }

    .seldiv {

        height: 37px;
        line-height: 32px;
        border-radius: 5px;
    }
</style>

<link href="<?php echo base_url(); ?>assets/vendor/datatables/css/dataTables.semanticui.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/vendor/datatables/css/semantic.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables/js/dataTables.semanticui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables/js/semantic.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
<script>
    function set_value(val) {

        $('#account_no').val(val);
    }
</script>
<script>
    $(document).ready(function () {
        $('#loader').hide();
        //alert();
        $('#baby_new_accounts').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                account_no: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                account_no: {
                    required: 'Please enter your account number'
                }
            },
            submitHandler: function (form) {

                var myData = new FormData($("#baby_new_accounts")[0]);

                $.ajax({
                    url: BASE_URL + 'admin/baby_accounts/get_accounts_information',
                    type: 'POST',
                    data: myData,
                    //  dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#loader').show();
                        $("#submit").prop('disabled', true); // disable button
                    },
                    success: function (data) {

                        $("#accounts_reports").html(data);
                        $("#submit").prop('disabled', false); // disable button
                        $('#loader').hide();
                    }
                });
            }
            // <- end 'submitHandler' callback
        });                    // <- end '.validate()'

    });
</script>

<script>

    $(document).ready(function () {

        var table = $('#all_baby_accounts').DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-8'f>>" +
            "<'row'<'col-sm-12'>>" + //
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-4'i><'col-sm-8'p>>",

            "lengthMenu": [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]],
            "autoWidth": false,
            select: true,
            scrollY: '90vh',
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            stateSave: true,
            buttons: [
                /* {
                 extend: 'copyHtml5',
                 text: '<i class="fa fa-files-o"> COPY </i>',
                 titleAttr: 'Copy',
                 exportOptions: {
                 columns: ':visible'
                 }
                 }, */
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-table"> EXCEL </i>',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: ':visible:not(.not-exported)'
                    }
                },
                /* {
                 extend: 'csvHtml5',
                 text: '<i class="fa fa-file-text-o"> CSV </i>',
                 titleAttr: 'CSV',
                 exportOptions: {
                 columns: ':visible'
                 }
                 },  */
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"> PDF</i>',
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"> PRINT </i>',
                    titleAttr: 'Print',
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-eye-slash"> Column Visibility </i>',
                    titleAttr: 'Visibility'
                }


            ],

            "oSelectorOpts": {filter: 'applied', order: "current"},
            language: {
                buttons: {},

                "emptyTable": "<strong style='color:#ff0000'> Sorry!!! No Records have found </strong>",
                "search": "<i class='fa fa-search'> Search : </i>",
                "paginate": {
                    "next": "Next",
                    "previous": "Previous"
                },

                "zeroRecords": "Sorry No Records have found"
            }
        });


        $('.dataTables_filter input[type="search"]').
            attr('placeholder', 'Type here to search...').
            css({'width': '500px'});

    });


    setTimeout(function () {
        $('.alert-success').fadeOut(2000);
    }, 5000); // <-- time in milliseconds
</script>