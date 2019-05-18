<?php 
	 /** $status = $row_rec['wStatus'];
	  if ($row_rec['wStatus']=="Closed"){
		$date = new DateTime($row_rec['submitDate']);
		$date->add(new DateInterval('PT' . $row_rec['sl']. 'H'));
		$raised = $date->format('Y-m-d H:i:s');
		$now = Date($row_rec['feedbackdate1']);
			if ($now<=$raised){
				echo "<div class=\"alert alert-success\" role= \"alert\">" . $row_rec['wStatus'] . " Within " . $row_rec['sl'] . " hour  SLA</div>";
					}
					else
					{
				echo "<div class=\"alert alert-danger\" role= \"alert\">" . $row_rec['wStatus'] . " Past " . $row_rec['sl'] . " hour SLA</div>";
					}
	  }
		else 
		{
		$date = new DateTime($row_rec['submitDate']);
		$date->add(new DateInterval('PT' . $row_rec['sl']. 'H'));
		$now = Date('Y-m-d H:i:s');
		$raised = $date->format('Y-m-d H:i:s');
			if ($now<=$raised){
				echo "<div class=\"alert alert-success\" role= \"alert\">" . $row_rec['wStatus'] . " Within " . $row_rec['sl'] . " hour  SLA</div>";
					}
					else
					{
				echo "<div class=\"alert alert-danger\" role= \"alert\">" . $row_rec['wStatus'] . " Past " . $row_rec['sl'] . " hour SLA</div>";
					}
	  }**/
	  
	  
time();
$raised = strtotime($row_rec['submitDate']);
$service_level = ($row_rec['sl'] *60*60);

$due = $raised + $service_level;

?>

<script>
var x = document.getElementById("service_level");
if ('<?php echo $status;?>'=='Closed')
{
    var d = new Date();
    var n = (d.getTime()/1000);	
	if (n ><?php echo $due; ?>)
	{
    x.innerHTML = 'Past <?php echo $row_rec['sl'];?> hr SL';
	x.className = "alert alert-danger";
	}
	else
	{
	x.innerHTML = 'Within <?php echo $row_rec['sl'];?> hr SL';
    x.className = "alert alert-success";
	}
}
else
	{
    var d = new Date(<?php $row_rec['feedbackdate1']; ?>);
    var n = (d.getTime()/1000);
	if (n ><?php echo $due; ?>)
	{
    x.innerHTML = 'Past <?php echo $row_rec['sl'];?> hr SL';
	x.className = "alert alert-danger";
	}
	else
	{
	x.innerHTML = 'Within <?php echo $row_rec['sl'];?> hr SL';
    x.className = "alert alert-success";
	}
}
</script>
	 