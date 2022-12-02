<?php
session_start();

session_destroy();

exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=index1.php'></head></html>");
?>