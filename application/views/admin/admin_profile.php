<?php foreach ($admin_information as $key => $value) {

    $id = $value['id'];
    $admin = $value['username'];
    $user_email = $value['user_email'];
    $file_path = $value['file_path'];
}
?>
<div class="col-md-12 center-block">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"> <?php echo $this->lang->line('admin_profile'); ?></h2>
        </div>
        <div class="panel-body">
            <div class="col-md-8" id="status"></div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle"
                             src="<?php echo base_url($file_path); ?>"
                             alt="Admin profile picture" style="margin-left: 150px; border: 10px solid #2acdd3; box-shadow: #001f3f" width="150px" height="150px"/>

                        <h3 class="profile-username text-center"><?php echo $this->lang->line('admin'); ?> <?php //echo $this->session->userdata['admin_logged_in']['user_name']; ?></h3>

                        <ul class="list-group list-group-unbordered">

                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('admin_name'); ?></b> <a class="pull-right"><?php echo $admin ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('admin_email'); ?></b> <a class="pull-right"><?php echo $user_email ?></a>
                            </li>
                        </ul>

                        <a href="<?php echo site_url('admin/admin_dashboard/admin_password_change'); ?>" class="btn btn-primary btn-block"> <strong><?php echo $this->lang->line('change_password'); ?></strong></a>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /.row -->




