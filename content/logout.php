<?php
session_start();
session_destroy();
session_regenerate_id();
unset($_SESSION);

session_start();
header('Location: index.php');

?>

<!DOCTYPE html>
<html lang="en">
<?= make_head("Logging out"); ?>
<body>
    
</body>
</html>