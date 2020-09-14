<?php
include '..\config.php';
include '..\db\DataBaseAccess.php';
include '..\header.php';

if (!isset($_GET['code']) || empty($_GET['code'])) {
    header("Location: /");
    return;
};

$itemCode = $_GET['code'];

$db = new DataBaseAccess($dbhost, $dbuser, $dbpass, $dbname);
$salesItems = $db->query(
    'SELECT * FROM OSBSTD WHERE UCITNO = ' . $itemCode
)->fetchAll();
echo '<a href="\"> Back </a> </br>';
echo 'Item Code: ' . $itemCode;
?>

<table>
    <tr>
        <th>Customer Code</th>
        <th>Order Type</th>
        <th>Incoice Date</th>
        <th>Invoiced Quantity</th>
        <th>Sold Liters</th>
        <th>Sales Ammount</th>
    </tr>
    <?php
    foreach ($salesItems as $salesItem) {
        echo '<tr><td>' . $salesItem['UCCUNO'] . '</td>';
        echo '<td>' . $salesItem['UCORTP'] . '</td>';
        echo '<td>' . $salesItem['UCIVDT'] . '</td>';
        echo '<td>' . $salesItem['UCIVQT'] . '</td>';
        echo '<td>' . $salesItem['UCVOL3'] . '</td>';
        echo '<td>' . $salesItem['UCSAAM'] . '</td></tr>';
    }
    ?>
</table>