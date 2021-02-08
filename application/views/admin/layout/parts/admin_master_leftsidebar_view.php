<div class = "navbar-default sidebar" role = "navigation">
    <div class = "sidebar-nav navbar-collapse">
        <ul class = "nav" id = "side-menu">
            <li>
                <a href = "<?php echo site_url('admin/admin_dashboard/index'); ?>"><i class = "fa fa-dashboard fa-fw"></i>
                    <?php echo $this->lang->line('dashboard'); ?></a>
            </li>
            <li>
                <a href = "#"> <i class = "fa fa-list"> </i> <?php echo $this->lang->line('account_settings'); ?> <span class = "fa arrow"></span></a>
                <ul class = "nav nav-second-level">
                    <li><a href = "<?php echo site_url('admin/account_settings/create_new_account'); ?>"><i
                                class = "fa fa-circle-o"></i> <?php echo $this->lang->line('new_account'); ?> </a></li>
                    <li><a href = "<?php echo site_url('admin/account_settings/manage_accounts_settings'); ?>"><i
                                class = "fa fa-circle-o"></i> <?php echo $this->lang->line('manage_accounts'); ?> </a></li>
                </ul>
            </li>
            <li>
                <a href = "#"> <i class = "fa fa-list"> </i> <?php echo $this->lang->line('transaction'); ?> <span class = "fa arrow"></span></a>
                <ul class = "nav nav-second-level">
                    <li><a href = "<?php echo site_url('admin/account_transactions/create_new_transactions'); ?>"><i
                                class = "fa fa-circle-o"></i>
                            <?php echo $this->lang->line('new_transaction'); ?> </a></li>
                    <li><a href = "<?php echo site_url('admin/account_transactions/manage_all_transaction'); ?>"><i
                                class = "fa fa-circle-o"></i> <?php echo $this->lang->line('manage_transaction'); ?> </a></li>
                    <li><a href = "<?php echo site_url('admin/account_transactions/account_transactions_reports'); ?>"><i
                                class = "fa fa-circle-o"></i> <?php echo $this->lang->line('reports'); ?> </a></li>
                </ul>
            </li>
            
            <li>
                <a href = "<?php echo site_url('admin/sms'); ?>">
                    <i class = "fa fa-mobile-phone"></i>
                    <span> <?php echo $this->lang->line('sms'); ?> </span>
                </a>
            </li>
            
            <li>
                <a href = "<?php echo site_url('admin/auth/admin_login/logout'); ?>">
                    <i class = "fa fa-sign-out text-aqua"></i>
                    <span> <?php echo $this->lang->line('log_out'); ?> </span>
                </a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.sidebar -->
<script type = "text/javascript">
    $(document).ready(function () {

        $('.sidebar ul li').each(function () {
            if (window.location.href.indexOf($(this).find('a:first').attr('href')) > -1) {
                $(this).closest('ul').closest('li').attr('class', 'active');
                $(this).addClass('active').siblings().removeClass('active');
            }
        });

    });
</script>