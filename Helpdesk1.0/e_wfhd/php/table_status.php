<?php 
	  $status = $row_obc['wStatus'];
	  if ($row_obc['wStatus']=="Closed"){
		 time();
		$raised = strtotime($row_obc['submitDate']);
		$service_level = ($row_obc['sl'] *60*60);
		$due = $raised + $service_level; 
		$now = strtotime($row_obc['feedbackdate1']);
			if ($now<$due){
				echo "<td class=\"alert alert-success\" role= \"alert\">Within " . $row_obc['sl'] . " hr  SL</td>";
					}
					else
					{
				echo "<td class=\"alert alert-danger\" role= \"alert\">Past " . $row_obc['sl'] . " hr SL</td>";
					}
	  }
		else 
		{
		$raised = strtotime($row_obc['submitDate']);
		$service_level = ($row_obc['sl'] *60*60);
		$due = $raised + $service_level; 
		$now = strtotime(Date('Y-m-d H:i:s'));

			if ($now<$due){
				echo "<td class=\"alert alert-success\" role= \"alert\">Within " . $row_obc['sl'] . " hr SL</td>";
					}
					else
					{
				echo "<td class=\"alert alert-danger\" role= \"alert\">Past " . $row_obc['sl'] . " hr SL</td>";
					}
	  }
	  ?>