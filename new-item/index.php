<?php
include '..\config.php';
include '..\db\DataBaseAccess.php';

if (
    isset($_POST['Item_Number'])
    && isset($_POST['Item_Description'])
    && isset($_POST['Volume'])
    && isset($_POST['Item_Type'])
) {
    $db = new DataBaseAccess($dbhost, $dbuser, $dbpass, $dbname);
    $query = 'INSERT INTO MITMAS (MMITNO, MMITDS, MMVOL3, MMITTY, MMSTAT) VALUES (
        "' . $_POST["Item_Number"] . '", 
        "' . $_POST["Item_Description"] . '", 
        "' . $_POST["Volume"] . '", 
        "' . $_POST["Item_Type"] . '", 99 )';
        
    $succsess = $db->query($query)->affectedRows() > 0;
    if ($succsess) {
        header("Location: /");
        return;
    }
}
?>

<form method="post">
    <label for="Item_Number"> Item Number </label>
    <input type="text" name="Item_Number" required />
    <br>
    <label for="Item_Description"> Item Description </label>
    <input type="text" name="Item_Description" required />
    <br>
    <label for="Volume"> Volume </label>
    <input type="text" name="Volume" required />
    <br>
    <label for="Item_Type"> Item Type </label>
    <input type="text" name="Item_Type" required />

    <input type="submit" name="save client" />
</form>