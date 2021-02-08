<div class="row" style="mar">
    <div class="col-lg-12">
        <h1 class="page-header" style="margin: 0px 0 10px;"><?php echo $this->lang->line('dashboard'); ?></h1>
    </div>
<!--    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3">
                <div class="box-icon" id="date-box1"></div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3">
                <div class="box-icon" id="date-box2"></div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3">
                <div class="box-icon" id="date-box3"></div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3">
                <div class="box-icon" id="date-box4"></div>
            </div>
        </div>
    </div>-->
</div>
<?php

function convert($number) {

    $english_number = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    $bangla_number = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    $convert = str_replace($english_number, $bangla_number, $number);

    return $convert;
}
?>
<?php
// print_r($last_balances)."<br/>";
$pos_arr = array();
$neg_arr = array();
$pos_total = "";
$neg_total = "";

foreach ($last_balances as $value) {
    
    if ($value > 0) {
        $pos_arr[] = $value;
        $pos_total = $pos_total + $value;
        //  print_r($pos_arr);
        //  $neg_arr[]=$value;
    } else {
        $neg_arr[] = $value;
        $neg_total = $neg_total - $value;
        //  print_r($neg_arr);
    }
}

if ($this->lang->line('digit') == "bengoli") {
    $neg_total = convert($neg_total);
    $pos_total = convert($pos_total);
}
//echo $pos_total . "<br/>"; echo $neg_total . "<br/>";
//  print_r($pos_arr); print_r($neg_arr);
$months = array("April", "August", "February", "january", "December");

usort($months, "compare_months");

//var_dump($months);

function compare_months($a, $b) {
    $monthA = date_parse($a);
    $monthB = date_parse($b);

    return $monthA["month"] - $monthB["month"];
}
?>
<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $neg_total."BDT"; ?><?php // echo $neg_total;  ?></div>
                        <div> Have to Get!!</div>
                    </div>
                </div>
            </div>
<!--            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"> </span>
                    <span class="pull-right"></span>

                    <div class="clearfix"></div>
                </div>
            </a>-->
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $pos_total."BDT"; ?></div>
                        <div>Have to Pay !!</div>
                    </div>
                </div>
            </div>
<!--            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"> </span>
                    <span class="pull-right"> </span>

                    <div class="clearfix"></div>
                </div>
            </a>-->
        </div>
    </div>
    
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-calendar fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="box-icon" id="date-box1"></div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="box-icon" id="date-box2"></div>
                                </div>
<!--                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="box-icon" id="date-box3"></div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="box-icon" id="date-box4"></div>
                                </div>-->
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
</div>
<div class="row">
    <div id="bar_chart2"></div>
    <div id="bar_chart"></div>
<?php echo "<div style='text-align:center; font-size:25px; padding:15px; color:#5785ce;'>Data Diagram of the Year " . date('Y') . "</div>" ?>
</div>

<p><?php // echo $this->lang->line('dashboard');  ?></p>

<script language="javascript">

    $(document).ready(function () {
        // put Ajax here.
        $.ajax({
            url: BASE_URL + 'admin/admin_dashboard/yearly_bar_chart',
            type: 'POST',
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function () {
                //  $('#loader').show();
            },
            success: function (response) {

                // alert(data);

                //  $("#bar_chart2").html(response);

                var parsedContent = JSON.parse(response);
                Morris.Bar({
                    element: 'bar_chart',
                    data: parsedContent,
                    xkey: 'Month',
                    ykeys: ['Deposit', 'Withdraw'],
                    labels: ['Series Deposit', 'Series Withdraw'],
                    hideHover: 'auto',
                    resize: true
                });
            }
        });
    });
</script>

