<div class = "col-md-12 center-block">
    <div class = "panel panel-default">
        <div class = "panel-heading">
            <h2 class = "panel-title"> <?php echo $this->lang->line('sent_sms'); ?> </h2>
        </div>
        <div class = "panel-body">
            <div class = "col-md-8" id = "status"></div>
            <div class = "col-md-11">
                <form name="sms_send" action = "<?php echo site_url('admin/sms/send_sms');?>" enctype = "multipart/form-data" method = "post" accept-charset = "utf-8">
                    <div class = "box-body">                                     

                        <div class = "col-md-8  form-group">                            
                                                      
                            <select class = "form-control" name = "sms_payment_type" id = "sms_payment_type">
                                <option value = "both"><?php echo $this->lang->line('select_payment_status'); ?></option>
                                <option value = "get_money"> Get Money</option>
                                <option value = "pay_money"> Pay Money</option>
                            </select>
                            
                        </div>          
                                             
                        
                    </div>
                    <div class = "box-footer col-md-8">
                        <input type = "submit" id = "submit" name = "submit" value = "Submit" class = "btn btn-primary">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>