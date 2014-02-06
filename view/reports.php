<?php 
session_start();
include 'protected/models/reports.php';

$db = new db_config();
$connect = $db->connect();
$reportsModel = new ReportsModel();
?>
<script src="js/highcharts.js"></script>
<script type="text/javascript">
$(function () {
    $('#pieChartContainer').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Percentage of Calls made'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Percentage of Calls',
            data: <?php echo $reportsModel->getReports($_SESSION['account_num'], $connect); ?>
        }]
		
    });
	
});
$(function () {
        $('#barChartContainer').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly Average Calls'
            },
            subtitle: {
                //text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Number of Calls made'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Work',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
    
            }, {
                name: 'Personal',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
    
            }, {
                name: 'Unflagged',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
    
            }]
        });
    });
</script>
<div class="container" style="">
  <div class="row">
    <div class="col-lg-12" style="">
      <div class="row">
        <div class="col-lg-6" style="">
          <h4>Summary Report</h4>
          <p>Total $ Amount:</p>
          <p>Plan Cap:</p>
          <p>% to Plan Cap:</p>
        </div>
        <div class="col-lg-3 col-lg-push-3" style="">
          <h5 class="" style="color:#666666; font-weight:bold;">Select Bill Date</h5>
          <?php echo $formelem->select(array('id'=>'billDate','name'=>'billDate','class'=>'form-control','data'=>'')); ?></div>
      </div>
    </div>
  </div>
  <hr />
  <div id="pieChartContainer"></div>
  <hr />
  <div id="barChartContainer"></div>
</div>
</div>
