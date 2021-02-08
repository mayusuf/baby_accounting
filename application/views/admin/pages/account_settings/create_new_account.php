<div class="col-md-12 center-block">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"> <?php echo $this->lang->line('new_account'); ?> </h2>
        </div>
        <div class="panel-body">
            <div class="col-md-8" id="status"></div>
            <div class="col-md-12">
                <form id='create_new_account' action="" enctype="multipart/form-data" method="post"
                      accept-charset="utf-8">
                    <div class="box-body">
                        <div class="col-md-8  form-group">
                            <label for=""> <?php echo $this->lang->line('account_number'); ?>  </label>
                            <input type="text" class="form-control" id="account_no" name="account_no" value=""
                                   placeholder="">
                            <span id="error_account_no" class="has-error"></span>
                        </div>
                        <div class="tool_inf col-md-1"><i data-toggle='tooltip'
                          title="The Account Number contains only characters and numbers. Not any special characters allowed"
                          class="tool_inf fa fa-info-circle fa-2x"></i></div>
                        <div class="col-md-8  form-group">
                            <label for=""> <?php echo $this->lang->line('account_name'); ?> </label>
                            <input type="text" class="form-control" id="account_name" name="account_name" value=""
                                   placeholder="">
                            <span id="error_account_name" class="has-error"></span>
                        </div>
                        <div class="col-md-8  form-group">
                            <label for=""> <?php echo $this->lang->line('address'); ?> </label>
                            <input type="text" class="form-control" id="account_address" name="account_address" value=""
                                   placeholder="">
                            <span id="error_account_address" class="has-error"></span>
                        </div>
                        <div class="col-md-8  form-group">
                            <label for=""> <?php echo $this->lang->line('contact_number'); ?> </label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" value=""
                                   placeholder="">
                            <span id="error_contact_no" class="has-error"></span>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer col-md-8">
                        <input type="submit" id="submit" name="submit" value="Save" class="btn btn-primary">
                        <small><img id="loader" src="<?php echo site_url('assets/images/loadingg.gif'); ?>"/></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.panel -->
</div>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $('#account_no').keyup(function () {

        var accountRegex = /^[0-9a-zA-Z]+$/;
        var account_no = $("#account_no").val();

        if (!(accountRegex.test(account_no))) {
            $("#error_account_no").html('The Account Number contains only characters and numbers. Not any special characters allowed');
            return false;
        }else{
            $("#error_account_no").html('');
        }
    });
</script>
<script
    src="<?php echo base_url(); ?>assets/js/Custom_Validation/baby_accounts/create_new_account_validation.js"></script>