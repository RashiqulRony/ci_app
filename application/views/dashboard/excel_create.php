<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->
</head>

<body>
	<?php
		$filename = "ExcelImport.xls";
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
	?>

	<table>
		<thead>
			<tr>
			<th>skfdjfd</th>
		<th>skfdjfd</th>
		<th>skfdjfd</th>
		<th>skfdjfd</th>
		<th>skfdjfd</th>
		<th>skfdjfd</th>
		</tr>
		</thead>
		<tbody>
			<?php foreach ($results as $key => $val) { ?>
				
			<tr>
				<td><?= $val['id'] ?></td>
				<td><?= $val['name'] ?></td>
				<td><?= $val['price'] ?></td>
				<td><?= $val['sale_price'] ?></td>
				<td><?= $val['sales_count'] ?></td>
				<td><?= $val['sale_date'] ?></td>
			</tr>
			<?php } ?>
		</tbody>
		
	</table>
</body>
</html>
<?php die(); ?>