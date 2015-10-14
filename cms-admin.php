<?php 
	require_once 'model/paths.php';
	$session = new Session();
	if (!$session->isLogin){redirect("login.php");}
	include_once 'includes/header.php';
?>
<title id="dashboard">Dashboard</title>
	
<div id="rightContainer"><!-- Open rightContainer -->
	<div id="dashboard"><!-- Open dashboard -->
	
	
	
	
	
	
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Visitors'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Units'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
});
		</script>

<script src="charts/js/highcharts.js"></script>
<script src="charts/js/modules/data.js"></script>
<script src="charts/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<?php 
	$visitors = new Visitors();
	$database = new Database();
?>
<table id="datatable" style="display:none;">
	<thead>
		<tr>
			<th></th>
			<th>Visitors</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>January</th>
			<td><?php echo $visitors->countByMonthAndYear($database,1);?></td>
		</tr>
		<tr>
			<th>February</th>
			<td><?php echo $visitors->countByMonthAndYear($database,2);?></td>
		</tr>
		<tr>
			<th>March</th>
			<td><?php echo $visitors->countByMonthAndYear($database,3);?></td>
		</tr>
		<tr>
			<th>April</th>
			<td><?php echo $visitors->countByMonthAndYear($database,4);?></td>
		</tr>
		<tr>
			<th>May</th>
			<td><?php echo $visitors->countByMonthAndYear($database,5);?></td>
		</tr>
        <tr>
			<th>June</th>
			<td><?php echo $visitors->countByMonthAndYear($database,6);?></td>
		</tr>
        <tr>
			<th>July</th>
			<td><?php echo $visitors->countByMonthAndYear($database,7);?></td>
		</tr>
        <tr>
			<th>August</th>
			<td><?php echo $visitors->countByMonthAndYear($database,8);?></td>
		</tr>
        <tr>
			<th>September</th>
			<td><?php echo $visitors->countByMonthAndYear($database,9);?></td>
		</tr>
        <tr>
			<th>October</th>
			<td><?php echo $visitors->countByMonthAndYear($database,10);?></td>
		</tr>
        <tr>
			<th>November</th>
			<td><?php echo $visitors->countByMonthAndYear($database,11);?></td>
		</tr>
        <tr>
			<th>December</th>
			<td><?php echo $visitors->countByMonthAndYear($database,12);?></td>
		</tr>
	</tbody>
</table>
	
	
	
	
	
	</div><!-- Close dashboard -->
</div><!-- Close rightContainer -->
	
<?php include_once 'includes/footer.php'; ?>
