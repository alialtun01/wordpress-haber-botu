<?php
/**
 * Plugin Name: Haber İçerik Botu
 * Description: Bu içerik botudur.
 * Version: 1.0
 * Author: Ali Altun
 * Author URI: https://github.com/alialtun01/wordpress-haber-botu
 */

 function admin_page_create(){
    add_menu_page( "Bot Ayarları", "Bot Ayarları", "manage_options", "bot-ayarlari", "botayarlari");
 }
 add_action( "admin_menu", "admin_page_create" );

 function botayarlari(){
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    ';
    include "ayarlar.php";
 }