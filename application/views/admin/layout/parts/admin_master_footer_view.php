<p class="text-footer">yafitech.com &copy;copyright 2016 Yafi Tech</p>


<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/morrisjs/morris.min.js"></script>
<script src="<?php echo base_url(); ?>assets/data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>assets/dist/js/billboy.js"></script>

<!--        Include custom date time script-->
<script src="<?php echo base_url(); ?>assets/dist/js/datetime.js"></script>
<script src = "<?php echo base_url(); ?>assets/js/bootstrap-notify.min.js"></script>
<script>
    setTimeout(function () {
        $('.alert').fadeOut(2000);
    }, 5000); // <-- time in milliseconds
</script>
<script>

    function notify_view(type, message) {

        $.notify({
            message: message
        }, {
            type: type,
            offset: {
                x: '30',
                y: '85'
            },
            spacing: 10,
            z_index: 1031,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            template: '<div data-notify="container" class="col-xs-11 col-sm-4 alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });
    }


</script>