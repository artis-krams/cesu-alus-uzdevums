<?php
include 'config.php';

$db = new DataBaseAccess($dbhost, $dbuser, $dbpass, $dbname);

$regions =  $db->query('SELECT DISTINCT OKCUCL FROM OCUSMA')->fetchAll();
$salesmen =  $db->query('SELECT DISTINCT OKSMCD FROM OCUSMA')->fetchAll();

if (isset($_POST['region'])) {
	$selectedRegion = $_POST['region'];
}

if (isset($_POST['salesman'])) {
	$selectedSalesman = $_POST['salesman'];
}
?>
<form action="/summary/" method="post">
	<label for="region">Region Code<br></label>
	<select name="region" id="region">
		<option value="">All Regions</option>
		<?php
		foreach ($regions as $region) {
			echo '<option ';
			$r = $region['OKCUCL'];
			if (isset($selectedRegion) && $selectedRegion == $r) {
				echo ' selected="selected" ';
			}

			echo ' value="' . $r . '">' . $r . '</option>';
		}
		?>
	</select>
	</br>
	<label for="regions">Salesman</br></label>
	<select name="salesman" id="salesman">
		<option value="">All Salesmen</option>
		<?php
		foreach ($salesmen as $salesman) {
			$man = $salesman['OKSMCD'];
			echo '<option ';

			if (isset($selectedSalesman) && $selectedSalesman == $man) {
				echo ' selected="selected" ';
			}

			echo ' value="' . $man . '">' . $man . '</option>';
		}
		?>
	</select>
	</br>
	<input type="submit" name="submit" />
</form>