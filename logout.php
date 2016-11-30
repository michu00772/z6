<?php
setcookie("loggedin", "val", time() - (86400 * 30), "/");
header("Location: z6.php");
?>