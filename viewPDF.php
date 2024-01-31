<?php
header("Content-Type: application/pdf\n");
header("Content-Disposition: inline; filename=\"Company Register\"\n");
echo $_GET['pdf'];