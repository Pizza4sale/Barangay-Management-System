<?php
include 'include/conn.php';

if($_GET['from'] == "account"){

	$del = "DELETE FROM `tbl_user` WHERE user_id ='".$_GET['id']."' ";
	$delaccount = mysqli_query($conn, $del);  
	?> 
<script>
    alert("You have successfully deleted an account");
    window.location.replace("newaccount.php");
</script>
<?php

	}
if($_GET['from'] == "news"){

	$del = "DELETE FROM `tbl_brgy` WHERE brgy_id ='".$_GET['id']."' ";
	$delaccount = mysqli_query($conn, $del);  
	?> 
<script>
    alert("You have successfully deleted an update");
    window.location.replace("news.php");
</script>
<?php

	}
	if($_GET['from'] == "org"){

	$del = "DELETE FROM `tbl_org` WHERE org_id ='".$_GET['id']."' ";
	$delaccount = mysqli_query($conn, $del);  
	?> 
<script>
   alert("Successfully deleted!");
    window.location.replace("updatebrgy.php");
</script>
<?php

	}if($_GET['from'] == "faq"){

	$del = "DELETE FROM `tbl_faq` WHERE id ='".$_GET['id']."' ";
	$delaccount = mysqli_query($conn, $del);  
	?> 
<script>
    alert("Successfully deleted!");
    window.location.replace("updatefaq.php");
</script>
<?php

	}

	if($_GET['from'] == "resi"){

	$del = "DELETE FROM `tbl_resident` WHERE id ='".$_GET['id']."' ";
	$delaccount = mysqli_query($conn, $del);  
	?> 
<script>
    alert("You have successfully deleted this resident");
    window.location.replace("newresident.php");
</script>
<?php

	}

	if($_GET['from'] == "port"){

	$del = "DELETE FROM `tbl_portfolio` WHERE id ='".$_GET['id']."' ";
	$delaccount = mysqli_query($conn, $del);  
	?> 
<script>
    alert("Successfully deleted!");
    window.location.replace("updateportfolio.php");
</script>
<?php

	}
	if($_GET['from'] == "job"){
		if($_GET['type'] =="removejob"){
   $query = "SELECT  * FROM `tbl_jobquali` where q_id='".$_GET['id']."' ";  
   $result = mysqli_query($conn, $query);  
   while($row = mysqli_fetch_array($result)) { 
   			$idd = $row['job_id'];
   		}
	$del = "DELETE FROM `tbl_jobquali` WHERE q_id ='".$_GET['id']."' ";
	$delaccount = mysqli_query($conn, $del);  
	?> 
<script>
    alert("You have successfully deleted a job qualification");
    window.location.replace("edit.php?id=<?php echo $idd;?>&from=job");
</script>
<?php
	}elseif($_GET['type'] =="removealljob"){

	$del = "DELETE FROM `tbl_jobquali` WHERE job_id ='".$_GET['id']."' ";
	$delaccount = mysqli_query($conn, $del);  

	$del2 = "DELETE FROM `tbl_job` WHERE jobid ='".$_GET['id']."' ";
	$delaccount2 = mysqli_query($conn, $del2);  
	?> 
<script>
    alert("You have successfully deleted a job");
    window.location.replace("jobs.php");
</script>
<?php
	}elseif($_GET['type'] =="close"){
    date_default_timezone_set('Asia/Manila');
    $dat= date('Y-m-d');
	$updjob = "UPDATE `tbl_job` SET status='CLOSE' , closed_date='".$dat."' where jobid ='".$_GET['id']."' ";
 	$updd = $conn->query($updjob);
	?> 
<script>
    alert("You have successfully closed a job");
    window.location.replace("jobs.php");
</script>
<?php
	}elseif($_GET['type'] =="reopen"){
    date_default_timezone_set('Asia/Manila');
    $dat= date('Y-m-d');
	$updjob = "UPDATE `tbl_job` SET status='OPEN' , closed_date='' where jobid ='".$_GET['id']."' ";
 	$updd = $conn->query($updjob);
	?> 
<script>
    alert("You have successfully re-opened a job");
    window.location.replace("jobs.php");
</script>
<?php
	}
	}
?>