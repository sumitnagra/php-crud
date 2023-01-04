<?php
session_start();
echo $_SESSION['username'];
echo "<br>";
echo $_SESSION['password'];
session_unset();
session_destroy();
?>