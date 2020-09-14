<?php
include '..\config.php';
include '..\db\DataBaseAccess.php';
include '..\filter.php';
include '..\header.php';

$db = new DataBaseAccess($dbhost, $dbuser, $dbpass, $dbname);

$hasSalesFilter = isset($_POST['salesman']) && !empty($_POST['salesman']);
$hasRegionFilter = isset($_POST['region']) && !empty($_POST['region']);

$filter = '';

if ($hasSalesFilter || $hasRegionFilter) {
    $filter = 'WHERE ';
    if ($hasRegionFilter) {
        $filter .= 'c.OKCUCL = "' . $_POST['region'] . '" ';
    }

    if ($hasSalesFilter) {
        if ($hasRegionFilter) {
            $filter .= " AND ";
        }
        $filter .= 'c.OKSMCD = "' . $_POST['salesman'] . '"';
    }
}

$salesItems = $db->query(
    'SELECT c.OKCUCL, c.OKSMCD,  SUM(s.UCIVQT) as qt, SUM(s.UCVOL3) as liters, SUM(s.UCSAAM) as ammount,
        s.UCITNO as itemCode
		FROM OSBSTD s LEFT JOIN OCUSMA c ON s.UCCUNO = c.OKCUNO ' . $filter . ' GROUP BY c.OKCUCL, c.OKSMCD'
)->fetchAll();
?>

<table>
    <tr>
        <th>Region Code</th>
        <th>Sales Person</th>
        <th>Invoiced Quantity</th>
        <th>Sold Liters</th>
        <th>Sales Amount</th>
        <th></th>
    </tr>
    <?php
    foreach ($salesItems as $salesItem) {
        echo '<tr> ';
        echo '<td>' . $salesItem['OKCUCL'] . '</td>';
        echo '<td>' . $salesItem['OKSMCD'] . '</td>';
        echo '<td>' . $salesItem['qt'] . '</td>';
        echo '<td>' . $salesItem['liters'] . '</td>';
        echo '<td>' . $salesItem['ammount'] . '</td>';
        echo '<td> <a href="/details?code=' . $salesItem['itemCode'] . '"> Details </a></td></tr>';
    }
    ?>
</table>