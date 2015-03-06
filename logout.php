<?php
 
/* Load and clear sessions */
session_start();
session_destroy();

echo '<a href="login.php">Login with Twitter.</a>';
echo '<hr>';