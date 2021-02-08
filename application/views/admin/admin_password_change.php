<?php foreach ($admin_information as $key => $value) {

    $id = $value['id'];
    $user_email = $value['user_email'];
    $file_path = $value['file_path'];
}
?>
<div class="col-md-12 center-block">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"> <?php echo $this->lang->line('change_password'); ?>  </h2>
        </div>
        <div class="panel-body">
            <div class="col-md-7">
                <form id='admin_password_change' action="" enctype="multipart/form-data" method="post"
                      accept-charset="utf-8">
                <fieldset style=" padding: 15px;">
                    <div class="form-group has-feedback">
                        <input type="text" id="user_email" name="user_email" class="form-control" value="<?php echo $user_email; ?>" readonly/>
                        <input type="hidden" name="updateId" id="updateId" value="<?php echo $id ?>">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control"
                               value="<?php echo set_value('password'); ?>"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class = "has-feedback form-group">
                   <!--     <label for = "blog_image"><?php // echo $this->lang->line('admin_image'); ?></label>  -->
                        <input id = "blog_image" type = "file" name = "blog_image" style = "display:none">

                        <div class = "input-group">
                            <div class = "input-group-btn">
                                <a class = "btn btn-primary" onclick = "$('input[id=blog_image]').click();">Browse</a>

                            </div>
                            <!-- /btn-group -->

                            <input type = "text" name = "SelectedFileName" class = "form-control" id = "SelectedFileName"
                                   value = "<?php echo $file_path ?>" readonly>

                        </div>
                        <div style = "clear:both;"></div>
                        <p class = "help-block">File Extension must be jpg, jpeg, png, allowed dimension(1200*700) and Size less than 2MB </p>
                        <script type = "text/javascript">
                            $('input[id=blog_image]').change(function () {
                                $('#SelectedFileName').val($(this).val());
                            });
                        </script>
                        <span id = "error_SelectedFileName" class="has-error"></span>
                    </div>
                    <br/>
                    <input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" id="submit"
                           value="Update">
                    <small><img id = "loader" src = "<?php echo site_url('assets/images/loadingg.gif'); ?>" /></small>
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#loader').hide();
        $('#admin_password_change').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                password: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                password: {
                    required: 'Please enter your Password'
                }
            },
            submitHandler: function (form) {

                var myData = new FormData($("#admin_password_change")[0]);

                $.ajax({
                    url: BASE_URL + 'admin/admin_dashboard/admin_profile_update_process',
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#loader').show();
                        $("#submit").prop('disabled', true); // disable button
                    },
                    success: function (data) {

                        if (data.type === 'success') {
                            $('#loader').hide();
                            notify_view(data.type, data.message);
                            $("#submit").prop('disabled', false); // disable button
                            $("html, body").animate({scrollTop: 0}, "slow");

                        } else if (data.type === 'danger') {
                            $('#loader').hide();
                            notify_view(data.type, data.message);
                            $("#submit").prop('disabled', false); // disable button
                            $("html, body").animate({scrollTop: 0}, "slow");

                        }
                    }
                });
            }
            // <- end 'submitHandler' callback
        });                    // <- end '.validate()'

    });
</script>




