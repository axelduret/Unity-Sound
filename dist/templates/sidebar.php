<?php

defined('open_access') or die('Restricted access');

require 'inc/db.php';

$req = $pdo->query('SELECT * FROM pages');
    
?>
 
        <aside class="sidebar">

            <div class="main-menu">

                <?php while($page = $req->fetch(PDO::FETCH_ASSOC)) : ?>

                    <?php $name = htmlspecialchars($page['title']); ?>

                    <?php $title = strtoupper($name); ?>

                    <?php $url = strtolower($name); ?>

                    <?php if($url !== 'home'): ?>
                
                    <div class="menu-item" onclick="window.location = 'index.php?id=<?php echo $url ?>'"><?php echo $title; ?></div>

                    <?php else: ?>
                
                    <div class="menu-item" onclick="window.location = 'index.php'"><?php echo $title; ?></div>

                    <?php endif; ?>
                
                <?php endwhile; ?>

            </div>

        </aside>



            
