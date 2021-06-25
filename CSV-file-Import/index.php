<?php
$db	=	new mysqli('localhost','root','','stock');
if ($db->connect_errno) {
  echo "Failed to connect to MySQL: " . $db->connect_error;
  exit();
}
?>

<table align="center" width="800" border="1" style="border-collapse:collapse; border:1px solid #ddd;" cellpadding="5" cellspacing="0">
	<thead>
		<tr bgcolor="#FFCC00">
			<th>Name</th>
			<th>Current Market Price</th>
			<th>Market Cap</th>
			<th>Stock P/E</th>
			<th>Dividend Yield</th>
			<th>ROCE %</th>
			<th>ROE Previous Annum</th>
			<th>Debt to Equity</th>
			<th>EPS</th>
			<th>Reserves</th>
			<th>Debt</th>
		
		</tr>
	</thead>
	<tbody>
	<?php
if(($handle		=	fopen("30 NSE Stocks Info.csv", "r")) !== FALSE){
	$n			=	1;
	while(($row	=	fgetcsv($handle)) !== FALSE){
		$db->query('INSERT INTO stock (`Name`, `Market_Price`, `Market_Cap`, `P_E`, `DividendYield`, `ROCE`, `ROE`,
		`Equity`, `EPS`, `Reserves`, `Debt`) VALUES
		 ("'.$row[1].'","'.$row[2].'","'.$row[3].'","'.$row[4].'","'.$row[5].'","'.$row[6].'","'.$row[7].'",
		 "'.$row[8].'","'.$row[9].'","'.$row[10].'","'.$row[11].'")');
		if($n>1){
				?>
				<tr>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td><?php echo $row[4];?></td>
					<td><?php echo $row[5];?></td>
					<td><?php echo $row[6];?></td>
					<td><?php echo $row[7];?></td>
					<td><?php echo $row[8];?></td>
					<td><?php echo $row[9];?></td>
					<td><?php echo $row[10];?></td>
					<td><?php echo $row[11];?></td>
					
				</tr>
				<?php
			}
			$n++;
		}
		fclose($handle);
	}
	?>
	</tbody>
</table>