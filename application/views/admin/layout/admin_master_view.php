<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title ?></title>
    <!-- Header and head section -->
    <?php $this->load->view('admin/layout/parts/admin_master_header_view'); ?>
    <script type = "text/javascript">
        var BASE_URL = "<?php echo base_url(); ?>";
    </script>
</head>
<body class = "">
<div class = "wrapper">
    <!-- Navigation -->
    <nav class = "navbar navbar-default navbar-static-top" role = "navigation" style = "margin-bottom: 0">
        <!-- Topbar -->
        <?php $this->load->view('admin/layout/parts/admin_master_topbar_view'); ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php $this->load->view('admin/layout/parts/admin_master_leftsidebar_view'); ?>
    </nav>

    <!-- Content Wrapper. Contains page content -->
    <div id = "page-wrapper">
        <div class = "row">
            <div class = "col-md-12 col-sm-12">
                <ol class = "breadcrumb">
                    <li><a href = "<?php echo site_url('admin/admin_dashboard/index'); ?>"><i class = "fa fa-home fa-fw"></i><?php echo $this->lang->line('home'); ?></a></li>
                    <li class = "active"><?php // echo $breadcrumbs; ?></li><?php echo $this->lang->line($breadcrumbs); ?>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class = "row">

            <?php echo $the_view_content; ?>

        </div>

        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
        <div class = "footer">
            <?php $this->load->view('admin/layout/parts/admin_master_footer_view'); ?>
        </div>
</div>
<!-- ./wrapper -->
</body>
</html>
