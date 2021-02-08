<div class = "col-md-12 center-block">
    <div class = "panel panel-default">
        <div class = "panel-heading">
            <h2 class = "panel-title"> <?php echo $this->lang->line('reports'); ?> </h2>
        </div>
        <div class = "panel-body">
            <div class = "col-md-8" id = "status"></div>
            <div class = "col-md-12">
                <form id = 'baby_new_accounts' action = "" method = "post">
                    <div class = "box-body">
                        <input name = "account_no" id = "account_no" value = "" type = "hidden" />
                        <div class = "col-md-8  form-group">
                            <div class = "seldiv" id = "curtn"> <?php echo $this->lang->line('account_number_selection'); ?> </div>
                            <div class = "seadiv">
                                <input name = "account_number" class = "filter form-control" type = "text" />
                                <ul class = "optlist">
                                    <?php
                                    foreach ($account_no as $key => $value) {
                                        ?>
                                        <li id="accno" class = ""
                                            onclick = "set_value('<?php echo $value['accountNo']; ?>');"><a
                                                href = "javascript:void(0);"><?php echo $value['accountNo']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <span id = "error_account_no" class = "has-error error"></span>
                        </div>
                        <div class = "col-md-8  form-group">
                            <label for = ""> <?php echo $this->lang->line('start_date'); ?> </label>
                            <input type = "text" class = "form-control" id = "start_date" name = "start_date" value = ""
                                   placeholder = "">
                            <span id = "error_amount" class = "has-error"></span>
                        </div>
                        <div class = "col-md-8  form-group">
                            <label for = ""> <?php echo $this->lang->line('end_date'); ?> </label>
                            <input type = "text" class = "form-control" id = "end_date" name = "end_date" value = ""
                                   placeholder = "">
                            <span id = "error_amount" class = "has-error"></span>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class = "box-footer col-md-8">
                        <input type = "submit" id = "submit" name = "submit" value = "Submit" class = "btn btn-primary">
                        <small><img id="loader" src="<?php echo site_url('assets/images/loadingg.gif'); ?>"/></small>
                    </div>
                </form><br/><br/>
            </div>
        </div>
        <div id = "accounts_reports"></div>
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
<script src = "<?php echo base_url(); ?>assets/dist/js/selection.js"></script>
<script src = "<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src = "<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
<link href = "<?php echo base_url(); ?>assets/css/datepicker.css" rel = "stylesheet">
<script src = "<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src = "<?php echo base_url(); ?>assets/js/jquery.printElement.min.js"></script>


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
<script type = "text/javascript">
    // When the document is ready
    $(document).ready(function () {

        $('#start_date').datepicker({
            format: "yyyy-mm-dd"

        }).on('changeDate',function(e){
            $(this).datepicker('hide');
        });

        $('#end_date').datepicker({
            format: "yyyy-mm-dd"

        }).on('changeDate',function(e){
            $(this).datepicker('hide');
        });

    });
</script>
<script>
    function printContent() {
       $('#invoice_print').printThis();
    }

</script>
<script>
    // print invoice function
    function PrintElem()
    {

        Popup($('#invoice_print').html());
    }
    function Popup(data)
    {
        var mywindow = window.open('', 'Fee_Collection', 'height=500,width=500');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/billboy.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables/css/dataTables.bootstrap.min.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        return true;
    }
</script>

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
                    url: BASE_URL + 'admin/account_transactions/get_accounts_information',
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

        var table = $('#Accounts_invoice').DataTable({
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