<div class="col-md-12 center-block">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"> <?php echo $this->lang->line('manage_transaction'); ?> </h2>
        </div>
        <div class="panel-body">
            <div class="col-md-8" id="status"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="col-md-12 col-sm-12">
                                <form id='single_table_transactions' action="" method="post">
                                    <div class="box-body">
                                        <input name="account_no" id="account_no" value="" type="hidden"/>

                                        <div class="col-md-8  form-group">
                                            <div class="seldiv"
                                                 id="curtn"> <?php echo $this->lang->line('account_number_selection'); ?> </div>
                                            <div class="seadiv">
                                                <input name="account_number" class="filter form-control" type="text"/>
                                                <ul class="optlist">
                                                    <?php
                                                    foreach ($account_no as $key => $value) {
                                                        ?>
                                                        <li id="accno" class=""
                                                            onclick="set_value('<?php echo $value['accountNo']; ?>');">
                                                            <a
                                                                href="javascript:void(0);"><?php echo $value['accountNo']; ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <span id="error_account_no" class="has-error error"></span>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer col-md-8">
                                        <input type="submit" id="submit" name="submit" value="Submit"
                                               class="btn btn-primary">
                                        <small><img id="loader"
                                                    src="<?php echo site_url('assets/images/loadingg.gif'); ?>"/>
                                        </small><br/><br/>
                                    </div>
                                </form>

                                <?php echo $this->session->flashdata('msg'); ?>
                                <div id="accounts_transactions" class=" col-md-12 table-responsive"></div>

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
<script src="<?php echo base_url(); ?>assets/dist/js/selection.js"></script>
<script src = "<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src = "<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
<link href="<?php echo base_url(); ?>assets/vendor/datatables/css/dataTables.semanticui.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/vendor/datatables/css/semantic.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>

<!--        <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>-->

<!--        semantic-->

<script src="<?php echo base_url(); ?>assets/vendor/datatables/js/dataTables.semanticui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables/js/semantic.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>

<script>
    $(document).ready(function () {
        $('#loader').hide();
        //alert();
        $('#single_table_transactions').validate({// <- attach '.validate()' to your form
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

                var myData = new FormData($("#single_table_transactions")[0]);

                $.ajax({
                    url: BASE_URL + 'admin/account_transactions/get_table_transaction_information',
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

                        $("#accounts_transactions").html(data);
                        $("#submit").prop('disabled', false); // disable button
                        $('#loader').hide();
                        transaction_datatable();
                    }
                });
            }
            // <- end 'submitHandler' callback
        });                    // <- end '.validate()'

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $("#accounts_transactions").on("click", ".deleteinformation", function () {
            var id = $(this).attr('id');
            var account_no = $(this).attr('acc_no');
            var btn = this;
           // alert(account_no);
            var result = confirm("Are you sure to delete the record?");
            if (result) {
                $.ajax({
                    type: 'POST',
                    url: BASE_URL + 'admin/account_transactions/delete_accounts_transaction',
                    dataType: 'json',
                    data: 'id=' + id + '&account_no=' + account_no,
                    success: function (data) {

                        if (data.type === 'success') {

                            notify_view(data.type, data.message)

                            $(btn).closest('tr').animate({backgroundColor: "#ff471a"}, 1000).animate({opacity: "hide"}, 1200);

                          //  update_reload(account_no)
                            setInterval('update_reload(account_no)', 2000);
                            //      $("#status").animate({ backgroundColor: "#fbc7c7" }, 4000).animate({ opacity: "hide" }, 1000);

                        } else if (data.type === 'danger') {

                            notify_view(data.type, data.message)
                            //   $("#status").animate({backgroundColor: "#fbc7c7"}, 4000).animate({opacity: "hide"}, 1000);

                        }
                    }
                });
            }
        });
    });
</script>


<script>
    function update_reload(account_no){
        window.location.reload(1);
       // alert(account_no);
     /*   $.ajax({
            url: BASE_URL + 'admin/baby_accounts/get_table_transaction_information',
            type: 'POST',
            data: 'account_no=' + account_no,
            //  dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#loader').show();
                $("#submit").prop('disabled', true); // disable button
            },
            success: function (data) {

                $("#accounts_transactions").html(data);
                $("#submit").prop('disabled', false); // disable button
                $('#loader').hide();
                transaction_datatable();
            }
        }); */
    }
    function set_value(val) {

        $('#account_no').val(val);
    }
</script>


<script>

       function transaction_datatable(){
        //    alert();

        var table = $('#all_accounts_transactions').DataTable({
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
        }

    setTimeout(function () {
        $('.alert-success').fadeOut(2000);
    }, 5000); // <-- time in milliseconds
</script>