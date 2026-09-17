<?php


define("SMTP_SERVER", getenv('SMTP_SERVER') ?: 'localhost');
define("SENT_FROM", getenv('SENT_FROM') ?: 'noreply@example.com');
define("SENT_FROM_NAME", getenv('SENT_FROM_NAME') ?: "Abby's Framework");
define("TEMPLATE_DIR",'/mail/templates/');
define("ADM1", getenv('ADM1') ?: 'admin1@example.com');
define("ADM2", getenv('ADM2') ?: 'admin2@example.com');
define("ADM3", getenv('ADM3') ?: 'admin3@example.com');
define("ADM4", getenv('ADM4') ?: 'admin4@example.com');


?>
