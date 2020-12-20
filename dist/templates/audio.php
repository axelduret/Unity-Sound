
<?php

defined('open_access') or die('Restricted access');

require 'inc/functions.php';

require 'template/header.php';

require 'template/sidebar.php';

?>

<section class="content">

<?php flash_alert(); ?>
    
<?php require 'widget/keyboard.php'; ?>

</section>

<?php require 'template/footer.php'; ?>