<?php

session_start();
unset ($SESSION['Email']);
session_destroy();

header('Location: http://localhost/Nueva/index.html');

?>