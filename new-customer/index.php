<?php
include '..\config.php';
include '..\db\DataBaseAccess.php';

if (
    isset($_POST['Customer_Number'])
    && isset($_POST['Customer_Name'])
    && isset($_POST['Region_Code'])
    && isset($_POST['Salesman_Code'])
) {
    $db = new DataBaseAccess($dbhost, $dbuser, $dbpass, $dbname);
    $query = 'INSERT INTO OCUSMA (OKCUNO, OKCUNM, OKCUCL, OKSMCD, OKSTAT) VALUES (
        "' . $_POST["Customer_Number"] . '", 
        "' . $_POST["Customer_Name"] . '", 
        "' . $_POST["Region_Code"] . '", 
        "' . $_POST["Salesman_Code"] . '", 20 )';
    echo $query;

    $succsess = $db->query($query)->affectedRows() > 0;

    if ($succsess) {
        header("Location: /");
        return;
    }
}
?>

<form method="post">
    <label for="Customer_Number"> Customer Number </label>
    <input type="text" name="Customer_Number" required />
    <br>
    <label for="Customer_Name"> Customer Name </label>
    <input type="text" name="Customer_Name" required />
    <br>
    <label for="Region_Code"> Region Code </label>
    <input type="text" name="Region_Code" required />
    <br>
    <label for="Salesman_Code"> Salesman Code </label>
    <input type="text" name="Salesman_Code" required />

    <input type="submit" name="save client" />
</form>