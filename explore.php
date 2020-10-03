<?PHP
// Connection to database
include("conf.php");

if (isset($_GET['name'])){
	$name = $_GET['name'];
}else {
	$name = '';
}
if (isset($_GET['event'])){
	$event = $_GET['event'];
}else {
	$event = '';
}
if (isset($_GET['date'])){
	$date = $_GET['date'];
}else {
	$date = '';
}


// Query for filters
$participation_sql ='select ev.event_name, ev.event_date, em.employee_name, em.employee_mail, p.participation_fee from employee as em left join participation as p on p.employee_id = em.employee_id left join events as ev on p.event_id = ev.event_id order by event_date ASC';

$participation_result = $conn->query($participation_sql) or die($conn->error);

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Rexx Systems - Code Challenge</title>
<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>

<body class="center">
	<h1 class="color-blue">Rexx Systems - Code Challenge</h1>
	
	<!-- Showing data and Filters -->
	<fieldset class="center">
		<legend>Latest Booking Data</legend>
		<fieldset>
			<legend>Filters</legend>
			<form action="explore.php" method="get">
				<label for="name">Employee name :</label>
				<input type="text" name="name" tabindex="1" autocomplete="on" autofocus size="100" placeholder="Enter employee name..." /><br /><br />
				<label for="event">Event Name :</label>
				<input type="text" name="event" tabindex="2" autocomplete="on" autofocus size="100" placeholder="Enter event's name..." /><br /><br />
				<label for="date">Event Date :</label>
				<input type="datetime" name="date" tabindex="3" autocomplete="on" size="100" autofocus placeholder="Enter event's date" /><br /><br />
				<button type="submit" >Apply filters</button>
			</form>	
		</fieldset>
			<table width="900" border="1" align="center">
				<tbody>
					<tr>
						<th>#</th>
						<th>Event</th>
						<th>Date</th>
						<th>Participant</th>
						<th>Participant's Email</th>
						<th>Price</th>
					</tr>
					<?PHP
						$cnt = 1;
						$total_fee = 0;
						while($participation_row = $participation_result->fetch_assoc()):
						
					?>
					<tr>
						<td><?=$cnt?></td>
						<td><?=$participation_row['event_name']?></td>
						<td><?=$participation_row['event_date']?></td>
						<td><?=$participation_row['employee_name']?></td>
						<td><?=$participation_row['employee_mail']?></td>
						<td><?=$participation_row['participation_fee']?></td>
					</tr>
					<?PHP
						$total_fee += $participation_row['participation_fee'];
						$cnt++;
						endwhile;
					?>
					<?PHP
					if ((isset($_GET['name']) and isset($_GET['event']) and isset($_GET['date'])) and ($_GET['name'] != '' or $_GET['event'] != '' or $_GET['date'] != '')):
					?>
					<tr>
						<td colspan="5" align="center">Total Price :</td>
						<td><?=$total_fee?></td>
					</tr>

					<?PHP
					endif;
					?>
				</tbody>
			</table>

	</fieldset>

</body>
</html>