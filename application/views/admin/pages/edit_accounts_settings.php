<?php foreach ($account_no as $key => $value) {

    $id = $value['Id'];
    $accountNo = $value['accountNo'];
    $accountAddress = $value['accountAddress'];
    $accountName = $value['accountName'];
    $contactNo = $value['contactNo'];
}
?>
<div class="col-md-12 center-block">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"> <?php echo $this->lang->line('update_account'); ?> </h2>
        </div>
        <div class="panel-body">
            <div class="col-md-8" id="status"></div>
            <div class="col-md-11">
                <form id='update_accounts_settings' action="" enctype="multipart/form-data" method="post"
                      accept-charset="utf-8">
                    <div class="box-body">
                    <!--    <div class="col-md-8  form-group">
                            <label for=""> <?php echo $this->lang->line('account_number'); ?> </label>
                            <input type="text" class="form-control" id="account_no" name="account_no" value="<?php echo $accountNo ?>"
                                   placeholder="" readonly>
                            <span id = "error_account_no" class="has-error"></span>
                        </div> -->
                        <div class="col-md-8  form-group">
                            <label for=""> <?php echo $this->lang->line('account_name'); ?> </label>
                            <input type="text" class="form-control" id="account_name" name="account_name" value="<?php echo $accountName ?>"
                                   placeholder="">
                            <input type="hidden" name="updateId" id="updateId" value="<?php echo $id ?>">
                            <span id = "error_account_name" class="has-error"></span>
                        </div>
                        <div class="col-md-8  form-group">
                            <label for=""> <?php echo $this->lang->line('address'); ?> </label>
                            <input type="text" class="form-control" id="account_address" name="account_address" value="<?php echo $accountAddress ?>"
                                   placeholder="">
                            <span id = "error_account_address" class="has-error"></span>
                        </div>
                        <div class="col-md-8  form-group">
                            <label for=""> <?php echo $this->lang->line('contact_number'); ?> </label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo $contactNo ?>"
                                   placeholder="">
                            <span id = "error_contact_no" class="has-error"></span>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer col-md-8">
                        <input type="submit" id="submit" name="submit" value="Update" class="btn btn-primary">
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
<script
    src="<?php echo base_url(); ?>assets/js/Custom_Validation/baby_accounts/update_accounts_settings_validation.js"></script>