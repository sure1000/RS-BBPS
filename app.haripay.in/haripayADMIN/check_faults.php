<?php
session_start();
include "include.php";
include "session.php";

$aid = $_GET['aid'];

if ($aid == "") {
	$aid = 0;
}

if (isset($_GET['sdate'])) {
	$start_date = $_GET['sdate'] . " 00:00:00";
} else {
	$start_date = todaysDate_only() . " 00:00:00";
}

$sql = "Select transaction_type, user_old_balance, amount, user_new_balance from wallet where user_id = " . $aid . " and transaction_date > '" . $start_date . "'";
$res = getXbyY($sql);
$rows = count($res);

$date1 = "2019-09-11";

$diff = (strtotime($start_date) - strtotime($date1));

?>
<table width="100%" border="1">
<tr>
	<th>Type</th>
	<th>Old</th>
	<th>Amount</th>
	<th>New</th>
</tr>
<?php for ($i = 0; $i < $rows; $i++) {
	?>
	<?php if ($i > 0) {
		if ($res[$i]['user_old_balance'] == $res[$i - 1]['user_new_balance']) {
			$bg = "#fff";
		} else {
			$bg = "red";
		}

		if ($diff > 0) {
			$bg = "#fff";
		}

	}?>
	<tr bgcolor="<?=$bg;?>">
		<td><?=$res[$i]['transaction_type'];?></td>
		<td><?=$res[$i]['user_old_balance'];?></td>
		<td><?=$res[$i]['amount'];?></td>
		<td><?=$res[$i]['user_new_balance'];?></td>
	</tr>
<?php }?>
</table>