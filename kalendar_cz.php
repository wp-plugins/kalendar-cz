<?php
/*
Plugin Name: Kalendář / Calendar
Plugin URI: http://phgame.cz
Description: Zobrazuje hodiny, čas, kdo má dnes a zítra svátek, sudý/lichý týden, číslo týdne a počet dní do Vánoc či konce roku.
Version: 2.0
Author: Webster.K
Author URI: http://phgame.cz/kalendar
*/

load_plugin_textdomain('kalendar_cz', false, dirname(plugin_basename(__FILE__)) . '/languages/');

include_once plugin_dir_path(__FILE__) . "./kalendar_functions.php";

add_action('activate_kalendar-cz/kalendar_cz.php', 'kalendar_cz_install');

add_action('deactivate_kalendar-cz/kalendar_cz.php', 'kalendar_cz_uninstall');

add_action( 'wp_dashboard_setup', 'kalendar_cz_dashboard_widgets' );

add_action('admin_menu', 'kalendar_cz_admin_actions');

add_action("plugins_loaded", "init_kalendar_cz_widget");

$css_file = plugins_url( 'kalendar_cz_style.css', __FILE__ );

wp_register_style('kalendar_cz', $css_file, false, '2.0');

wp_enqueue_style('kalendar_cz'); 



?>