<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url('admin/admin_dashboard/index'); ?>"><?php echo $this->lang->line('admin_panel'); ?></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
         <?php echo $this->lang->line('select_lang'); ?>
        <select onchange="javascript:window.location.href='<?php echo base_url(); ?>admin/LanguageSwitcher/switchLang/'+this.value;">
            <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
            <option value="bengoli" <?php if($this->session->userdata('site_lang') == 'bengoli') echo 'selected="selected"'; ?>> বাংলা </option>
        </select>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <?php // echo $this->session->userdata['admin_logged_in']['user_name']; ?> <?php echo $this->lang->line('admin'); ?>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo site_url('admin/admin_dashboard/profile'); ?>"><i class="fa fa-user fa-fw"></i> <?php // echo $this->session->userdata['admin_logged_in']['user_name']; ?> <?php echo $this->lang->line('admin_profile'); ?> </a></li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url('admin/auth/admin_login/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> <?php echo $this->lang->line('log_out'); ?> </a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>