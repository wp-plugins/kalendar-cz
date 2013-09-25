<?php
/*
Plugin Name: Kalendář CZ
Plugin URI: http://phgame.cz
Description: Zobrazuje hodiny, čas, kdo má dnes a zítra svátek, sudý/lichý týden, číslo týdne a počet dní do Vánoc či konce roku.
Version: 1.4.0
Author: Webster.K a Patrik Bodnár
Author URI: http://phgame.cz
*/

load_plugin_textdomain('kalendar_cz', false, dirname(plugin_basename(__FILE__)) . '/languages/');

function kalendar_cz_install(){
global $wpdb;
mysql_query("DROP TABLE IF EXISTS ".$wpdb->prefix."plugin_websters_kalendar ");

mysql_query("CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."plugin_websters_kalendar (id INT NOT NULL AUTO_INCREMENT, cislo INT(1) NOT NULL,typ VARCHAR(20) NOT NULL,zobrazit BOOL NOT NULL,hodnota LONGTEXT NOT NULL,PRIMARY KEY (id))");

$existuje = mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar");
while ($radek = mysql_fetch_array($existuje)):
	if(isset($radek["typ"]) && $radek["typ"]=="cas"){$exi_cas=1;}
	elseif(isset($radek["typ"]) && $radek["typ"]=="den"){$exi_den=1;}
	elseif(isset($radek["typ"]) && $radek["typ"]=="svatek"){$exi_svatek=1;}
	elseif(isset($radek["typ"]) && $radek["typ"]=="svatek_zitra"){$exi_svatek_zitra=1;}
	elseif(isset($radek["typ"]) && $radek["typ"]=="vanoce"){$exi_vanoce=1;}
	elseif(isset($radek["typ"]) && $radek["typ"]=="novy_rok"){$exi_novy_rok=1;}
	elseif(isset($radek["typ"]) && $radek["typ"]=="sudy_lichy_tyden"){$exi_sudy_lichy_tyden=1;}
	elseif(isset($radek["typ"]) && $radek["typ"]=="cislo_tydne"){$exi_cislo_tydne=1;}
	elseif(isset($radek["typ"]) && $radek["typ"]=="odsazeni_vrsek"){$exi_odsazeni_vrsek=1;}
	elseif(isset($radek["typ"]) && $radek["typ"]=="centrovani"){$exi_centrovani=1;}
	elseif(isset($radek["typ"]) && $radek["typ"]=="barva_text"){$exi_barva=1;}
endwhile;
	if(isset($exi_cas) && $exi_cas==1){}else{
		mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('1', 'cas', '1')");
	}
	if(isset($exi_den) && $exi_den==1){}else{
		mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('2', 'den', '1')");
	}
	if(isset($exi_svatek) && $exi_svatek==1){}else{
		mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('3', 'svatek', '1')");
	}
	if(isset($exi_svatek_zitra) && $exi_svatek_zitra==1){}else{
		mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('4', 'svatek_zitra', '1')");
	}
	if(isset($exi_vanoce) && $exi_vanoce==1){}else{
		mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('5', 'vanoce', '1')");
	}
	if(isset($exi_novy_rok) && $exi_novy_rok==1){}else{
		mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('6', 'novy_rok', '1')");
	}
	if(isset($exi_sudy_lichy_tyden) && $exi_sudy_lichy_tyden==1){}else{
		mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('7', 'sudy_lichy_tyden', '1')");
	}
	if(isset($exi_sudy_lichy_tyden) && $exi_sudy_lichy_tyden==1){}else{
		mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('8', 'cislo_tydne', '1')");
	}
	if(isset($exi_barva) && $exi_barva==1){}else{
		mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit,hodnota) VALUES ('0', 'barva_text', '0','#000000')");
	}	
	if(isset($exi_odsazeni_vrsek) && $exi_odsazeni_vrsek==1){}else{
		mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('0', 'odsazeni_vrsek', '0')");
	}	
	if(isset($exi_centrovani) && $exi_centrovani==1){}else{
		mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit, hodnota) VALUES ('0', 'centrovani', '0','left')");
	}	

}

add_action('activate_kalendar-cz/kalendar_cz.php', 'kalendar_cz_install');

function kalendar_cz_uninstall(){
	global $wpdb;
	mysql_query("DROP TABLE IF EXISTS ".$wpdb->prefix."plugin_websters_kalendar ");
}

add_action('deactivate_kalendar-cz/kalendar_cz.php', 'kalendar_cz_uninstall');

function get_kalendar_cz($before = '', $after = '',$barva_textu) {
	
$svatek_1_1 = __('Nový rok','kalendar_cz');
$svatek_2_1 = __('Karina','kalendar_cz');
$svatek_3_1 = __('Radmila','kalendar_cz');
$svatek_4_1 = __('Diana','kalendar_cz');
$svatek_5_1 = __('Dalimil','kalendar_cz');
$svatek_6_1 = __('Tři králové','kalendar_cz');
$svatek_7_1 = __('Vilma','kalendar_cz');
$svatek_8_1 = __('Čestmír','kalendar_cz');
$svatek_9_1 = __('Vladan','kalendar_cz');
$svatek_10_1 = __('Břetislav','kalendar_cz');
$svatek_11_1 = __('Bohdana','kalendar_cz');
$svatek_12_1 = __('Pravoslav','kalendar_cz');
$svatek_13_1 = __('Edita','kalendar_cz');
$svatek_14_1 = __('Radovan','kalendar_cz');
$svatek_15_1 = __('Alice','kalendar_cz');
$svatek_16_1 = __('Ctirad','kalendar_cz');
$svatek_17_1 = __('Drahoslav','kalendar_cz');
$svatek_18_1 = __('Vladislav','kalendar_cz');
$svatek_19_1 = __('Doubravka','kalendar_cz');
$svatek_20_1 = __('Ilona','kalendar_cz');
$svatek_21_1 = __('Běla','kalendar_cz');
$svatek_22_1 = __('Slavomír','kalendar_cz');
$svatek_23_1 = __('Zdeněk','kalendar_cz');
$svatek_24_1 = __('Milena','kalendar_cz');
$svatek_25_1 = __('Miloš','kalendar_cz');
$svatek_26_1 = __('Zora','kalendar_cz');
$svatek_27_1 = __('Ingrid','kalendar_cz');
$svatek_28_1 = __('Otýlie','kalendar_cz');
$svatek_29_1 = __('Zdislava','kalendar_cz');
$svatek_30_1 = __('Robin','kalendar_cz');
$svatek_31_1 = __('Marika','kalendar_cz');
$svatek_1_2 = __('Hynek','kalendar_cz');
$svatek_2_2 = __('Nela a Hromnice','kalendar_cz');
$svatek_3_2 = __('Blažej','kalendar_cz');
$svatek_4_2 = __('Jarmila','kalendar_cz');
$svatek_5_2 = __('Dobromila','kalendar_cz');
$svatek_6_2 = __('Vanda','kalendar_cz');
$svatek_7_2 = __('Veronika','kalendar_cz');
$svatek_8_2 = __('Milada','kalendar_cz');
$svatek_9_2 = __('Apolena','kalendar_cz');
$svatek_10_2 = __('Mojmír','kalendar_cz');
$svatek_11_2 = __('Božena','kalendar_cz');
$svatek_12_2 = __('Slavěna','kalendar_cz');
$svatek_13_2 = __('Věnceslav','kalendar_cz');
$svatek_14_2 = __('Valentýn','kalendar_cz');
$svatek_15_2 = __('Jiřina','kalendar_cz');
$svatek_16_2 = __('Ljuba','kalendar_cz');
$svatek_17_2 = __('Miloslava','kalendar_cz');
$svatek_18_2 = __('Gizela','kalendar_cz');
$svatek_19_2 = __('Patrik','kalendar_cz');
$svatek_20_2 = __('Oldřich','kalendar_cz');
$svatek_21_2 = __('Lenka','kalendar_cz');
$svatek_22_2 = __('Petr','kalendar_cz');
$svatek_23_2 = __('Svatopluk','kalendar_cz');
$svatek_24_2 = __('Matěj','kalendar_cz');
$svatek_25_2 = __('Liliana','kalendar_cz');
$svatek_26_2 = __('Dorota','kalendar_cz');
$svatek_27_2 = __('Alexandr','kalendar_cz');
$svatek_28_2 = __('Lumír','kalendar_cz');
$svatek_29_2 = __('Horymír','kalendar_cz');
$svatek_1_3 = __('Bedřich','kalendar_cz');
$svatek_2_3 = __('Anežka','kalendar_cz');
$svatek_3_3 = __('Kamil','kalendar_cz');
$svatek_4_3 = __('Stela','kalendar_cz');
$svatek_5_3 = __('Kazimír','kalendar_cz');
$svatek_6_3 = __('Miroslav','kalendar_cz');
$svatek_7_3 = __('Tomáš','kalendar_cz');
$svatek_8_3 = __('Gabriela','kalendar_cz');
$svatek_9_3 = __('Františka','kalendar_cz');
$svatek_10_3 = __('Viktorie','kalendar_cz');
$svatek_11_3 = __('Anděla','kalendar_cz');
$svatek_12_3 = __('Řehoř','kalendar_cz');
$svatek_13_3 = __('Růžena','kalendar_cz');
$svatek_14_3 = __('Rút a Matylda','kalendar_cz');
$svatek_15_3 = __('Ida','kalendar_cz');
$svatek_16_3 = __('Elena a Herbert','kalendar_cz');
$svatek_17_3 = __('Vlastimil','kalendar_cz');
$svatek_18_3 = __('Eduard','kalendar_cz');
$svatek_19_3 = __('Josef','kalendar_cz');
$svatek_20_3 = __('Světlana','kalendar_cz');
$svatek_21_3 = __('Radek','kalendar_cz');
$svatek_22_3 = __('Leona','kalendar_cz');
$svatek_23_3 = __('Ivona','kalendar_cz');
$svatek_24_3 = __('Gabriel','kalendar_cz');
$svatek_25_3 = __('Marián','kalendar_cz');
$svatek_26_3 = __('Emanuel','kalendar_cz');
$svatek_27_3 = __('Dita','kalendar_cz');
$svatek_28_3 = __('Soňa','kalendar_cz');
$svatek_29_3 = __('Taťána','kalendar_cz');
$svatek_30_3 = __('Arnošt','kalendar_cz');
$svatek_31_3 = __('Kvido','kalendar_cz');
$svatek_1_4 = __('Hugo','kalendar_cz');
$svatek_2_4 = __('Erika','kalendar_cz');
$svatek_3_4 = __('Richard','kalendar_cz');
$svatek_4_4 = __('Ivana','kalendar_cz');
$svatek_5_4 = __('Miroslava','kalendar_cz');
$svatek_6_4 = __('Vendula','kalendar_cz');
$svatek_7_4 = __('Heřman a Hermína','kalendar_cz');
$svatek_8_4 = __('Ema','kalendar_cz');
$svatek_9_4 = __('Dušan','kalendar_cz');
$svatek_10_4 = __('Darja','kalendar_cz');
$svatek_11_4 = __('Izabela','kalendar_cz');
$svatek_12_4 = __('Julius','kalendar_cz');
$svatek_13_4 = __('Aleš','kalendar_cz');
$svatek_14_4 = __('Vincenc','kalendar_cz');
$svatek_15_4 = __('Anastázie','kalendar_cz');
$svatek_16_4 = __('Irena','kalendar_cz');
$svatek_17_4 = __('Rudolf','kalendar_cz');
$svatek_18_4 = __('Valérie','kalendar_cz');
$svatek_19_4 = __('Rostislav','kalendar_cz');
$svatek_20_4 = __('Marcela','kalendar_cz');
$svatek_21_4 = __('Alexandra','kalendar_cz');
$svatek_22_4 = __('Evžénie','kalendar_cz');
$svatek_23_4 = __('Vojtěch','kalendar_cz');
$svatek_24_4 = __('Jiří','kalendar_cz');
$svatek_25_4 = __('Marek','kalendar_cz');
$svatek_26_4 = __('Oto','kalendar_cz');
$svatek_27_4 = __('Jaroslav','kalendar_cz');
$svatek_28_4 = __('Vlastislav','kalendar_cz');
$svatek_29_4 = __('Robert','kalendar_cz');
$svatek_30_4 = __('Blahoslav','kalendar_cz');
$svatek_1_5 = __('Svátek práce','kalendar_cz');
$svatek_2_5 = __('Zikmund','kalendar_cz');
$svatek_3_5 = __('Alexej','kalendar_cz');
$svatek_4_5 = __('Květoslav','kalendar_cz');
$svatek_5_5 = __('Klaudie','kalendar_cz');
$svatek_6_5 = __('Radoslav','kalendar_cz');
$svatek_7_5 = __('Stanislav','kalendar_cz');
$svatek_8_5 = __('Statní svátek - Ukončení II. světové války','kalendar_cz');
$svatek_9_5 = __('Ctibor','kalendar_cz');
$svatek_10_5 = __('Blažena','kalendar_cz');
$svatek_11_5 = __('Svatava','kalendar_cz');
$svatek_12_5 = __('Pankrác','kalendar_cz');
$svatek_13_5 = __('Servác','kalendar_cz');
$svatek_14_5 = __('Bonifác','kalendar_cz');
$svatek_15_5 = __('Žofie','kalendar_cz');
$svatek_16_5 = __('Přemysl','kalendar_cz');
$svatek_17_5 = __('Aneta','kalendar_cz');
$svatek_18_5 = __('Nataša','kalendar_cz');
$svatek_19_5 = __('Ivo','kalendar_cz');
$svatek_20_5 = __('Zbyšek','kalendar_cz');
$svatek_21_5 = __('Monika','kalendar_cz');
$svatek_22_5 = __('Emil','kalendar_cz');
$svatek_23_5 = __('Vladimír','kalendar_cz');
$svatek_24_5 = __('Jana','kalendar_cz');
$svatek_25_5 = __('Viola','kalendar_cz');
$svatek_26_5 = __('Filip','kalendar_cz');
$svatek_27_5 = __('Valdemar','kalendar_cz');
$svatek_28_5 = __('Vilém','kalendar_cz');
$svatek_29_5 = __('Maxim','kalendar_cz');
$svatek_30_5 = __('Ferdinand','kalendar_cz');
$svatek_31_5 = __('Kamila','kalendar_cz');
$svatek_1_6 = __('Laura','kalendar_cz');
$svatek_2_6 = __('Jarmil','kalendar_cz');
$svatek_3_6 = __('Tamara','kalendar_cz');
$svatek_4_6 = __('Dalibor','kalendar_cz');
$svatek_5_6 = __('Dobroslav','kalendar_cz');
$svatek_6_6 = __('Norbert','kalendar_cz');
$svatek_7_6 = __('Iveta','kalendar_cz');
$svatek_8_6 = __('Medard','kalendar_cz');
$svatek_9_6 = __('Stanislava','kalendar_cz');
$svatek_10_6 = __('Gita','kalendar_cz');
$svatek_11_6 = __('Bruno','kalendar_cz');
$svatek_12_6 = __('Antonie','kalendar_cz');
$svatek_13_6 = __('Antonín','kalendar_cz');
$svatek_14_6 = __('Roland','kalendar_cz');
$svatek_15_6 = __('Vít','kalendar_cz');
$svatek_16_6 = __('Zbyněk','kalendar_cz');
$svatek_17_6 = __('Adolf','kalendar_cz');
$svatek_18_6 = __('Milan','kalendar_cz');
$svatek_19_6 = __('Leoš','kalendar_cz');
$svatek_20_6 = __('Květa','kalendar_cz');
$svatek_21_6 = __('Alois','kalendar_cz');
$svatek_22_6 = __('Pavla','kalendar_cz');
$svatek_23_6 = __('Zdeňka','kalendar_cz');
$svatek_24_6 = __('Jan','kalendar_cz');
$svatek_25_6 = __('Ivan','kalendar_cz');
$svatek_26_6 = __('Adriana','kalendar_cz');
$svatek_27_6 = __('Ladislav','kalendar_cz');
$svatek_28_6 = __('Lubomír','kalendar_cz');
$svatek_29_6 = __('Petr a Pavel','kalendar_cz');
$svatek_30_6 = __('Šárka','kalendar_cz');
$svatek_1_7 = __('Jaroslava','kalendar_cz');
$svatek_2_7 = __('Patricie','kalendar_cz');
$svatek_3_7 = __('Radomír','kalendar_cz');
$svatek_4_7 = __('Prokop','kalendar_cz');
$svatek_5_7 = __('Státní svátek , Cyril a Metoděj','kalendar_cz');
$svatek_6_7 = __('Státní svátek , Mistr Jan Hus','kalendar_cz');
$svatek_7_7 = __('Bohuslava','kalendar_cz');
$svatek_8_7 = __('Nora','kalendar_cz');
$svatek_9_7 = __('Drahoslava','kalendar_cz');
$svatek_10_7 = __('Libuše a Amálie','kalendar_cz');
$svatek_11_7 = __('Olga','kalendar_cz');
$svatek_12_7 = __('Bořek','kalendar_cz');
$svatek_13_7 = __('Markéta','kalendar_cz');
$svatek_14_7 = __('Karolína','kalendar_cz');
$svatek_15_7 = __('Jindřich','kalendar_cz');
$svatek_16_7 = __('Luboš','kalendar_cz');
$svatek_17_7 = __('Martina','kalendar_cz');
$svatek_18_7 = __('Drahomíra','kalendar_cz');
$svatek_19_7 = __('Čeněk','kalendar_cz');
$svatek_20_7 = __('Ilja','kalendar_cz');
$svatek_21_7 = __('Vítězslav','kalendar_cz');
$svatek_22_7 = __('Magdaléna','kalendar_cz');
$svatek_23_7 = __('Libor','kalendar_cz');
$svatek_24_7 = __('Kristýna','kalendar_cz');
$svatek_25_7 = __('Jakub','kalendar_cz');
$svatek_26_7 = __('Anna','kalendar_cz');
$svatek_27_7 = __('Věroslav','kalendar_cz');
$svatek_28_7 = __('Viktor','kalendar_cz');
$svatek_29_7 = __('Marta','kalendar_cz');
$svatek_30_7 = __('Bořivoj','kalendar_cz');
$svatek_31_7 = __('Ignác','kalendar_cz');
$svatek_1_8 = __('Oskar','kalendar_cz');
$svatek_2_8 = __('Gustav','kalendar_cz');
$svatek_3_8 = __('Miluše','kalendar_cz');
$svatek_4_8 = __('Dominik','kalendar_cz');
$svatek_5_8 = __('Kristián','kalendar_cz');
$svatek_6_8 = __('Oldřiška','kalendar_cz');
$svatek_7_8 = __('Lada','kalendar_cz');
$svatek_8_8 = __('Soběslav','kalendar_cz');
$svatek_9_8 = __('Roman','kalendar_cz');
$svatek_10_8 = __('Vavřinec','kalendar_cz');
$svatek_11_8 = __('Zuzana','kalendar_cz');
$svatek_12_8 = __('Klára','kalendar_cz');
$svatek_13_8 = __('Alena','kalendar_cz');
$svatek_14_8 = __('Alan','kalendar_cz');
$svatek_15_8 = __('Hana','kalendar_cz');
$svatek_16_8 = __('Jáchym','kalendar_cz');
$svatek_17_8 = __('Petra','kalendar_cz');
$svatek_18_8 = __('Helena','kalendar_cz');
$svatek_19_8 = __('Ludvík','kalendar_cz');
$svatek_20_8 = __('Bernard','kalendar_cz');
$svatek_21_8 = __('Johana','kalendar_cz');
$svatek_22_8 = __('Bohuslav','kalendar_cz');
$svatek_23_8 = __('Sandra','kalendar_cz');
$svatek_24_8 = __('Bartoloměj','kalendar_cz');
$svatek_25_8 = __('Radim','kalendar_cz');
$svatek_26_8 = __('Luděk','kalendar_cz');
$svatek_27_8 = __('Otakar','kalendar_cz');
$svatek_28_8 = __('Augustýn','kalendar_cz');
$svatek_29_8 = __('Evelína','kalendar_cz');
$svatek_30_8 = __('Vladěna','kalendar_cz');
$svatek_31_8 = __('Pavlína','kalendar_cz');
$svatek_1_9 = __('Linda a Samuel','kalendar_cz');
$svatek_2_9 = __('Adéla','kalendar_cz');
$svatek_3_9 = __('Bronislav','kalendar_cz');
$svatek_4_9 = __('Jindřiška','kalendar_cz');
$svatek_5_9 = __('Boris','kalendar_cz');
$svatek_6_9 = __('Boleslav','kalendar_cz');
$svatek_7_9 = __('Regína','kalendar_cz');
$svatek_8_9 = __('Mariana','kalendar_cz');
$svatek_9_9 = __('Daniela','kalendar_cz');
$svatek_10_9 = __('Irma','kalendar_cz');
$svatek_11_9 = __('Denisa','kalendar_cz');
$svatek_12_9 = __('Marie','kalendar_cz');
$svatek_13_9 = __('Lubor','kalendar_cz');
$svatek_14_9 = __('Radka','kalendar_cz');
$svatek_15_9 = __('Jolana','kalendar_cz');
$svatek_16_9 = __('Ludmila','kalendar_cz');
$svatek_17_9 = __('Naděžda','kalendar_cz');
$svatek_18_9 = __('Kryštof','kalendar_cz');
$svatek_19_9 = __('Zita','kalendar_cz');
$svatek_20_9 = __('Oleg','kalendar_cz');
$svatek_21_9 = __('Matouš','kalendar_cz');
$svatek_22_9 = __('Darina','kalendar_cz');
$svatek_23_9 = __('Berta','kalendar_cz');
$svatek_24_9 = __('Jaromír','kalendar_cz');
$svatek_25_9 = __('Zlata','kalendar_cz');
$svatek_26_9 = __('Andrea','kalendar_cz');
$svatek_27_9 = __('Jonáš','kalendar_cz');
$svatek_28_9 = __('Václav','kalendar_cz');
$svatek_29_9 = __('Michal','kalendar_cz');
$svatek_30_9 = __('Jeroným','kalendar_cz');
$svatek_1_10 = __('Igor','kalendar_cz');
$svatek_2_10 = __('Olívie a Oliver','kalendar_cz');
$svatek_3_10 = __('Bohumil','kalendar_cz');
$svatek_4_10 = __('František','kalendar_cz');
$svatek_5_10 = __('Eliška','kalendar_cz');
$svatek_6_10 = __('Hanuš','kalendar_cz');
$svatek_7_10 = __('Justýna','kalendar_cz');
$svatek_8_10 = __('Věra','kalendar_cz');
$svatek_9_10 = __('Štefan a Sára','kalendar_cz');
$svatek_10_10 = __('Marina','kalendar_cz');
$svatek_11_10 = __('Andrej','kalendar_cz');
$svatek_12_10 = __('Marcel','kalendar_cz');
$svatek_13_10 = __('Renáta','kalendar_cz');
$svatek_14_10 = __('Agáta','kalendar_cz');
$svatek_15_10 = __('Tereza','kalendar_cz');
$svatek_16_10 = __('Havel','kalendar_cz');
$svatek_17_10 = __('Hedvika','kalendar_cz');
$svatek_18_10 = __('Lukáš','kalendar_cz');
$svatek_19_10 = __('Michaela','kalendar_cz');
$svatek_20_10 = __('Vendelín','kalendar_cz');
$svatek_21_10 = __('Brigita','kalendar_cz');
$svatek_22_10 = __('Sabina','kalendar_cz');
$svatek_23_10 = __('Teodor','kalendar_cz');
$svatek_24_10 = __('Nina','kalendar_cz');
$svatek_25_10 = __('Beáta','kalendar_cz');
$svatek_26_10 = __('Erik','kalendar_cz');
$svatek_27_10 = __('Šarlota a Zoe','kalendar_cz');
$svatek_28_10 = __('Statní svátek - Vznik Československa','kalendar_cz');
$svatek_29_10 = __('Silvie','kalendar_cz');
$svatek_30_10 = __('Tadeáš','kalendar_cz');
$svatek_31_10 = __('Štěpánka','kalendar_cz');
$svatek_1_11 = __('Felix','kalendar_cz');
$svatek_2_11 = __('Památka zesnulých','kalendar_cz');
$svatek_3_11 = __('Hubert','kalendar_cz');
$svatek_4_11 = __('Karel','kalendar_cz');
$svatek_5_11 = __('Miriam','kalendar_cz');
$svatek_6_11 = __('Liběna','kalendar_cz');
$svatek_7_11 = __('Saskie','kalendar_cz');
$svatek_8_11 = __('Bohumír','kalendar_cz');
$svatek_9_11 = __('Bohdan','kalendar_cz');
$svatek_10_11 = __('Evžen','kalendar_cz');
$svatek_11_11 = __('Martin','kalendar_cz');
$svatek_12_11 = __('Benedikt','kalendar_cz');
$svatek_13_11 = __('Tibor','kalendar_cz');
$svatek_14_11 = __('Sáva','kalendar_cz');
$svatek_15_11 = __('Leopold','kalendar_cz');
$svatek_16_11 = __('Otmar','kalendar_cz');
$svatek_17_11 = __('Mahulena','kalendar_cz');
$svatek_18_11 = __('Romana','kalendar_cz');
$svatek_19_11 = __('Alžběta','kalendar_cz');
$svatek_20_11 = __('Nikola','kalendar_cz');
$svatek_21_11 = __('Albert','kalendar_cz');
$svatek_22_11 = __('Cecílie','kalendar_cz');
$svatek_23_11 = __('Klement','kalendar_cz');
$svatek_24_11 = __('Emílie','kalendar_cz');
$svatek_25_11 = __('Kateřina','kalendar_cz');
$svatek_26_11 = __('Artur','kalendar_cz');
$svatek_27_11 = __('Xenie','kalendar_cz');
$svatek_28_11 = __('René','kalendar_cz');
$svatek_29_11 = __('Zina','kalendar_cz');
$svatek_30_11 = __('Ondřej','kalendar_cz');
$svatek_1_12 = __('Iva','kalendar_cz');
$svatek_2_12 = __('Blanka','kalendar_cz');
$svatek_3_12 = __('Svatoslav','kalendar_cz');
$svatek_4_12 = __('Barbora','kalendar_cz');
$svatek_5_12 = __('Jitka','kalendar_cz');
$svatek_6_12 = __('Mikuláš','kalendar_cz');
$svatek_7_12 = __('Ambrož','kalendar_cz');
$svatek_8_12 = __('Květoslava','kalendar_cz');
$svatek_9_12 = __('Vratislav','kalendar_cz');
$svatek_10_12 = __('Julie','kalendar_cz');
$svatek_11_12 = __('Dana','kalendar_cz');
$svatek_12_12 = __('Simona','kalendar_cz');
$svatek_13_12 = __('Lucie','kalendar_cz');
$svatek_14_12 = __('Lýdie','kalendar_cz');
$svatek_15_12 = __('Radana','kalendar_cz');
$svatek_16_12 = __('Albína','kalendar_cz');
$svatek_17_12 = __('Daniel','kalendar_cz');
$svatek_18_12 = __('Miloslav','kalendar_cz');
$svatek_19_12 = __('Ester','kalendar_cz');
$svatek_20_12 = __('Dagmar','kalendar_cz');
$svatek_21_12 = __('Natálie','kalendar_cz');
$svatek_22_12 = __('Šimon','kalendar_cz');
$svatek_23_12 = __('Vlasta','kalendar_cz');
$svatek_24_12 = __('Adam a Eva , Štědrý den','kalendar_cz');
$svatek_25_12 = __('1. svátek vánoční','kalendar_cz');
$svatek_26_12 = __('Štěpán , 2. svátek vánoční','kalendar_cz');
$svatek_27_12 = __('Žaneta','kalendar_cz');
$svatek_28_12 = __('Bohumila','kalendar_cz');
$svatek_29_12 = __('Judita','kalendar_cz');
$svatek_30_12 = __('David','kalendar_cz');
$svatek_31_12 = __('Silvestr','kalendar_cz');

$svatky	= array(
$svatek_1_1,$svatek_2_1,$svatek_3_1,$svatek_4_1,$svatek_5_1,$svatek_6_1,$svatek_7_1,$svatek_8_1,$svatek_9_1,$svatek_10_1,$svatek_11_1,$svatek_12_1,$svatek_13_1,$svatek_14_1,$svatek_15_1,$svatek_16_1,$svatek_17_1,$svatek_18_1,$svatek_19_1,$svatek_20_1,$svatek_21_1,$svatek_22_1,$svatek_23_1,$svatek_24_1,$svatek_25_1,$svatek_26_1,$svatek_27_1,$svatek_28_1,$svatek_29_1,$svatek_30_1,$svatek_31_1,
$svatek_1_2,$svatek_2_2,$svatek_3_2,$svatek_4_2,$svatek_5_2,$svatek_6_2,$svatek_7_2,$svatek_8_2,$svatek_9_2,$svatek_10_2,$svatek_11_2,$svatek_12_2,$svatek_13_2,$svatek_14_2,$svatek_15_2,$svatek_16_2,$svatek_17_2,$svatek_18_2,$svatek_19_2,$svatek_20_2,$svatek_21_2,$svatek_22_2,$svatek_23_2,$svatek_24_2,$svatek_25_2,$svatek_26_2,$svatek_27_2,$svatek_28_2,$svatek_29_2,
$svatek_1_3,$svatek_2_3,$svatek_3_3,$svatek_4_3,$svatek_5_3,$svatek_6_3,$svatek_7_3,$svatek_8_3,$svatek_9_3,$svatek_10_3,$svatek_11_3,$svatek_12_3,$svatek_13_3,$svatek_14_3,$svatek_15_3,$svatek_16_3,$svatek_17_3,$svatek_18_3,$svatek_19_3,$svatek_20_3,$svatek_21_3,$svatek_22_3,$svatek_23_3,$svatek_24_3,$svatek_25_3,$svatek_26_3,$svatek_27_3,$svatek_28_3,$svatek_29_3,$svatek_30_3,$svatek_31_3,
$svatek_1_4,$svatek_2_4,$svatek_3_4,$svatek_4_4,$svatek_5_4,$svatek_6_4,$svatek_7_4,$svatek_8_4,$svatek_9_4,$svatek_10_4,$svatek_11_4,$svatek_12_4,$svatek_13_4,$svatek_14_4,$svatek_15_4,$svatek_16_4,$svatek_17_4,$svatek_18_4,$svatek_19_4,$svatek_20_4,$svatek_21_4,$svatek_22_4,$svatek_23_4,$svatek_24_4,$svatek_25_4,$svatek_26_4,$svatek_27_4,$svatek_28_4,$svatek_29_4,$svatek_30_4,
$svatek_1_5,$svatek_2_5,$svatek_3_5,$svatek_4_5,$svatek_5_5,$svatek_6_5,$svatek_7_5,$svatek_8_5,$svatek_9_5,$svatek_10_5,$svatek_11_5,$svatek_12_5,$svatek_13_5,$svatek_14_5,$svatek_15_5,$svatek_16_5,$svatek_17_5,$svatek_18_5,$svatek_19_5,$svatek_20_5,$svatek_21_5,$svatek_22_5,$svatek_23_5,$svatek_24_5,$svatek_25_5,$svatek_26_5,$svatek_27_5,$svatek_28_5,$svatek_29_5,$svatek_30_5,$svatek_31_5,
$svatek_1_6,$svatek_2_6,$svatek_3_6,$svatek_4_6,$svatek_5_6,$svatek_6_6,$svatek_7_6,$svatek_8_6,$svatek_9_6,$svatek_10_6,$svatek_11_6,$svatek_12_6,$svatek_13_6,$svatek_14_6,$svatek_15_6,$svatek_16_6,$svatek_17_6,$svatek_18_6,$svatek_19_6,$svatek_20_6,$svatek_21_6,$svatek_22_6,$svatek_23_6,$svatek_24_6,$svatek_25_6,$svatek_26_6,$svatek_27_6,$svatek_28_6,$svatek_29_6,$svatek_30_6,
$svatek_1_7,$svatek_2_7,$svatek_3_7,$svatek_4_7,$svatek_5_7,$svatek_6_7,$svatek_7_7,$svatek_8_7,$svatek_9_7,$svatek_10_7,$svatek_11_7,$svatek_12_7,$svatek_13_7,$svatek_14_7,$svatek_15_7,$svatek_16_7,$svatek_17_7,$svatek_18_7,$svatek_19_7,$svatek_20_7,$svatek_21_7,$svatek_22_7,$svatek_23_7,$svatek_24_7,$svatek_25_7,$svatek_26_7,$svatek_27_7,$svatek_28_7,$svatek_29_7,$svatek_30_7,$svatek_31_7,
$svatek_1_8,$svatek_2_8,$svatek_3_8,$svatek_4_8,$svatek_5_8,$svatek_6_8,$svatek_7_8,$svatek_8_8,$svatek_9_8,$svatek_10_8,$svatek_11_8,$svatek_12_8,$svatek_13_8,$svatek_14_8,$svatek_15_8,$svatek_16_8,$svatek_17_8,$svatek_18_8,$svatek_19_8,$svatek_20_8,$svatek_21_8,$svatek_22_8,$svatek_23_8,$svatek_24_8,$svatek_25_8,$svatek_26_8,$svatek_27_8,$svatek_28_8,$svatek_29_8,$svatek_30_8,$svatek_31_8,
$svatek_1_9,$svatek_2_9,$svatek_3_9,$svatek_4_9,$svatek_5_9,$svatek_6_9,$svatek_7_9,$svatek_8_9,$svatek_9_9,$svatek_10_9,$svatek_11_9,$svatek_12_9,$svatek_13_9,$svatek_14_9,$svatek_15_9,$svatek_16_9,$svatek_17_9,$svatek_18_9,$svatek_19_9,$svatek_20_9,$svatek_21_9,$svatek_22_9,$svatek_23_9,$svatek_24_9,$svatek_25_9,$svatek_26_9,$svatek_27_9,$svatek_28_9,$svatek_29_9,$svatek_30_9,
$svatek_1_10,$svatek_2_10,$svatek_3_10,$svatek_4_10,$svatek_5_10,$svatek_6_10,$svatek_7_10,$svatek_8_10,$svatek_9_10,$svatek_10_10,$svatek_11_10,$svatek_12_10,$svatek_13_10,$svatek_14_10,$svatek_15_10,$svatek_16_10,$svatek_17_10,$svatek_18_10,$svatek_19_10,$svatek_20_10,$svatek_21_10,$svatek_22_10,$svatek_23_10,$svatek_24_10,$svatek_25_10,$svatek_26_10,$svatek_27_10,$svatek_28_10,$svatek_29_10,$svatek_30_10,$svatek_31_10,
$svatek_1_11,$svatek_2_11,$svatek_3_11,$svatek_4_11,$svatek_5_11,$svatek_6_11,$svatek_7_11,$svatek_8_11,$svatek_9_11,$svatek_10_11,$svatek_11_11,$svatek_12_11,$svatek_13_11,$svatek_14_11,$svatek_15_11,$svatek_16_11,$svatek_17_11,$svatek_18_11,$svatek_19_11,$svatek_20_11,$svatek_21_11,$svatek_22_11,$svatek_23_11,$svatek_24_11,$svatek_25_11,$svatek_26_11,$svatek_27_11,$svatek_28_11,$svatek_29_11,$svatek_30_11,
$svatek_1_12,$svatek_2_12,$svatek_3_12,$svatek_4_12,$svatek_5_12,$svatek_6_12,$svatek_7_12,$svatek_8_12,$svatek_9_12,$svatek_10_12,$svatek_11_12,$svatek_12_12,$svatek_13_12,$svatek_14_12,$svatek_15_12,$svatek_16_12,$svatek_17_12,$svatek_18_12,$svatek_19_12,$svatek_20_12,$svatek_21_12,$svatek_22_12,$svatek_23_12,$svatek_24_12,$svatek_25_12,$svatek_26_12,$svatek_27_12,$svatek_28_12,$svatek_29_12,$svatek_30_12,$svatek_31_12,$svatek_1_1);

$d=getdate(get_presny_cas_z_wp());
$datum=date("d. m. Y");
$yday=$d["yday"];

$pred_text_dnes = $yday;
$pred_text_zitra = $yday + 1;

if (($yday>58) && ((date("Y")%4)!=0)) $yday++; // Detekce prestupneho roku
$svatek_now=$svatky[$yday];
if (($yday==58) && ((date("Y")%4)!=0)) $yday++; // Korektni vypis zitrejsiho svatku pri neprestupnem roku
$svatek_now_next=$svatky[$yday%366+1];
/* Not supported below
if (($yday==58) && ((date("Y")%4)!=0)) $yday++; // Korektni vypis zitrejsiho svatku pri neprestupnem roku
$svatek_now_next_next=$svatky[$yday%366+2];
*/

// Output:
$output .= "$before";
global $wpdb;

$data = mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE zobrazit=1 AND typ='cas' OR zobrazit=1 AND typ='den' OR zobrazit=1 AND typ='svatek' OR zobrazit=1 AND typ='svatek_zitra' OR zobrazit=1 AND typ='vanoce'  OR zobrazit=1 AND typ='novy_rok' OR zobrazit=1 AND typ='sudy_lichy_tyden' OR zobrazit=1 AND typ='cislo_tydne' ORDER BY cislo ASC");
$radku = mysql_num_rows($data);

//$data = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='cas' OR typ='den' OR typ='svatek' OR typ='svatek_zitra' OR typ='vanoce' OR typ='novy_rok' ORDER BY cislo ASC");
//$radku = $wpdb->get_row($data);

//pokud nekdo nahodou svatek nema, viz statni svatek, DNES
if($pred_text_dnes==0 OR $$pred_text_dnes==5 OR $pred_text_dnes==121 OR $pred_text_dnes==186 OR $pred_text_dnes==187 OR $pred_text_dnes==301 OR $pred_text_dnes==306 OR $pred_text_dnes==358 OR $pred_text_dnes==359 OR $pred_text_dnes==360 OR $pred_text_dnes==366){
	$vypis_pred_svatek = "Dnes je ";
}else{
	$vypis_pred_svatek = "Svátek má ";
}

//pokud nekdo nahodou svatek nema, viz statni svatek ZITRA
if($pred_text_zitra==0 OR $pred_text_zitra==5 OR $pred_text_zitra==121 OR $pred_text_zitra==186 OR $pred_text_zitra==187 OR $pred_text_zitra==301 OR $pred_text_zitra==306 OR $pred_text_zitra==358 OR $pred_text_zitra==359 OR $pred_text_zitra==360 OR $pred_text_zitra==366){
	$vypis_pred_svatek_a = "Zítra je ";
}else{
	$vypis_pred_svatek_a = "Zítra má svátek ";
}

while ($dat = mysql_fetch_array($data)):
	if($dat["typ"]=="cas"){
		$output .= "<div id=\"kalendar_cz_cas\"><font color=\"". $barva_textu ."\">" . aktualni_cas() . "</font></div>";
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}
	elseif($dat["typ"]=="den"){
		$output .= "<div id=\"kalendar_cz_datum\"><font color=\"". $barva_textu ."\">" . get_my_today_date() . "</font></div>";
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}
	elseif($dat["typ"]=="svatek"){
		$output .= "<div id=\"kalendar_cz_svatek_dnes\"><font color=\"". $barva_textu ."\">" . __($vypis_pred_svatek,'kalendar_cz') . $svatek_now  . "</font></div>";
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}
	elseif($dat["typ"]=="svatek_zitra"){
		$output .= "<div id=\"kalendar_cz_svatek_zitra\"><font color=\"". $barva_textu ."\">" . __($vypis_pred_svatek_a,'kalendar_cz') . $svatek_now_next . "</font></div>";
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}
	elseif($dat["typ"]=="vanoce"){
		$output .= "<div id=\"kalendar_cz_vanoce\"><font color=\"". $barva_textu ."\">" . get_vanoce() . "</font></div>";
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}
	elseif($dat["typ"]=="novy_rok"){
		$output .= "<div id=\"kalendar_cz_novy_rok\"><font color=\"". $barva_textu ."\">" . get_novy_rok() . "</font></div>";
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}
	elseif($dat["typ"]=="sudy_lichy_tyden"){
		$output .= "<div id=\"kalendar_cz_ls_tyden\"><font color=\"". $barva_textu ."\">" . get_sudy_lichy_tyden() . "</font></div>";
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}
	elseif($dat["typ"]=="cislo_tydne"){
		$output .= "<div id=\"kalendar_cz_cislo_tydne\"><font color=\"". $barva_textu ."\">" . get_cislo_tydne() . "</font></div>";
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}

endwhile;

return $output;
}

function zpetny_odkaz() {
	return '<div id="zpetny_odkaz" style="visibility: hidden;width:1px;height:1px"><a href="http://phgame.cz">PHGame.cz</a></div>';
}

function get_presny_cas_z_wp(){
$prevod_hodiny = split('\.', date_i18n(get_option('time_format')));
$prevod_datum = split('\.', date_i18n( get_option('date_format')));
return MkTime ((int)$prevod_hodiny[0], (int)$prevod_hodiny[1], (int)0, (int)$prevod_datum[1], (int)$prevod_datum[0], (int)$prevod_datum[2]) . "<br>";
}

function get_my_today_date() {
	$mesic_leden = __('ledna','kalendar_cz');
	$mesic_unor = __('února','kalendar_cz');
	$mesic_brezen = __('března','kalendar_cz');
	$mesic_duben = __('dubna','kalendar_cz');
	$mesic_kveten = __('května','kalendar_cz');
	$mesic_cerven = __('června','kalendar_cz');
	$mesic_cervenec = __('července','kalendar_cz');
	$mesic_srpen = __('srpna','kalendar_cz');
	$mesic_zari = __('září','kalendar_cz');
	$mesic_rijen = __('října','kalendar_cz');
	$mesic_listopad = __('listopadu','kalendar_cz');
	$mesic_prosinec = __('prosince','kalendar_cz');
	
	$den_tydne_Ne = __('Neděle','kalendar_cz');
	$den_tydne_Po = __('Pondělí','kalendar_cz');
	$den_tydne_Ut = __('Úterý','kalendar_cz');
	$den_tydne_St = __('Středa','kalendar_cz');
	$den_tydne_Ct = __('Čtvrtek','kalendar_cz');
	$den_tydne_Pa = __('Pátek','kalendar_cz');
	$den_tydne_So = __('Sobota','kalendar_cz');
	
    $mesic = array('',$mesic_leden,$mesic_unor,$mesic_brezen,$mesic_duben,$mesic_kveten,$mesic_cerven,$mesic_cervenec,$mesic_srpen,$mesic_zari,$mesic_rijen,$mesic_listopad,$mesic_prosinec);
    $den = array($den_tydne_Ne,$den_tydne_Po,$den_tydne_Ut,$den_tydne_St,$den_tydne_Ct,$den_tydne_Pa,$den_tydne_So);
    $d=getdate(get_presny_cas_z_wp());
    /* Not used
    $y=$d["year"];
    $timecz = Time();
    $beat = Date(B);
    */
    $dnes=$den[$d["wday"]];
    $dden=$d["mday"];
    $dmes=$mesic[$d["mon"]];
    $drok=$d["year"];
    return "$dnes $dden. $dmes $drok";
}

function aktualni_cas(){
return '
<div id="hodiny"></div>
<script language="javascript" type="text/javascript">
function casovac(){
var cas = new Date()
var hodiny = cas.getHours()
var minuty = cas.getMinutes()
var sekundy = cas.getSeconds()

if (minuty < 10){
minuty = "0" + minuty
}

if (sekundy <10){
sekundy = "0" + sekundy
}

//document.write("<strong>" + "Aktuální čas: " + hodiny + ":" + minuty + ":" + sekundy + "</strong>")
var div = document.getElementById("hodiny");
div.innerHTML = "' .  __('Aktuální čas: ','kalendar_cz') . '" + hodiny + ":" + minuty + ":" + sekundy
setTimeout("casovac()",1000)
}
casovac()
</script>
'; 


}

function get_vanoce(){
$dnesek = time();
$den_od_zacatku_roku = Date(z, $dnesek);
if(Date(Y, $dnesek)%4==0){$pocet_dni = 366;}else{$pocet_dni = 365;}
$den_do_vanoc = $pocet_dni - 8 - $den_od_zacatku_roku;
if($den_do_vanoc<0){
		$novy_dny = $pocet_dni + $den_do_vanoc;
		return __('Do Vánoc zbývá ','kalendar_cz') . $novy_dny . __(' dnů','kalendar_cz');
	}
elseif($den_do_vanoc==0){
	return __('Dnes jsou Vánoce','kalendar_cz');
	}
elseif($den_do_vanoc==1){
	return __('Do Vánoc zbývá jeden den','kalendar_cz');
	}
elseif($den_do_vanoc>1 AND $den_do_vanoc<5){
	return __('Do Vánoc zbývají ','kalendar_cz') . $den_do_vanoc . __(' dny','kalendar_cz');
	}
else{
		return __('Do Vánoc zbývá ','kalendar_cz') . $den_do_vanoc . __(' dnů','kalendar_cz');
	}
}

function get_novy_rok(){
$dnesek = time();
$den_od_zacatku_roku = Date(z, $dnesek);
if(Date(Y, $dnesek)%4==0){$pocet_dni = 366;}else{$pocet_dni = 365;}
$den_do_konce_roku = $pocet_dni - $den_od_zacatku_roku - 1;
if($den_do_konce_roku==0){
		return __('Dnes je konec roku','kalendar_cz');
	}
elseif($den_do_konce_roku==1){
	return __('Do konce roku zbývá jeden den','kalendar_cz');
	}
elseif($den_do_konce_roku>1 AND $den_do_konce_roku<5){
	return __('Do konce roku zbývají ','kalendar_cz') . $den_do_konce_roku . __(' dny','kalendar_cz');
	}
else{
		return __('Do konce roku zbývá ','kalendar_cz') . $den_do_konce_roku . __(' dnů','kalendar_cz');
	}
}

function get_sudy_lichy_tyden(){
	$dnesek = StrFTime("%W",time()) + 1;
	if($dnesek%2==0){return __('Je sudý týden','kalendar_cz');}else{return __('Je lichý týden','kalendar_cz');}
}

function get_cislo_tydne(){
	$dnesek = StrFTime("%W",time()) + 1;
	if($dnesek <=9){
		
		$samotny_cislo = split("0",$dnesek);
		return __('Je ','kalendar_cz') . $samotny_cislo[1] . __('týden','kalendar_cz');
	}else{
		return __('Je ','kalendar_cz') . $dnesek . __('týden','kalendar_cz');
		
	}
	
}



function widget_kalendar_cz($args) {
global $wpdb;
	$nastaveni = mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='odsazeni_vrsek' OR typ='centrovani' OR typ='barva_text'");
	while ($kalendar_cz_nastav = mysql_fetch_array($nastaveni)):
		if(isset($kalendar_cz_nastav["typ"]) && $kalendar_cz_nastav["typ"] == "odsazeni_vrsek"){$kalendar_cz_vrsek = $kalendar_cz_nastav["hodnota"];}
		if(isset($kalendar_cz_nastav["typ"]) && $kalendar_cz_nastav["typ"] == "centrovani"){
			$kalendar_cz_centrovani = $kalendar_cz_nastav["hodnota"];
		}
		if(isset($kalendar_cz_nastav["typ"]) &&  $kalendar_cz_nastav["typ"] == "barva_text"){$kalendar_cz_barva = $kalendar_cz_nastav["hodnota"];}
	endwhile;

	extract($args);
	echo "$before_widget";
	echo "$before_title\n";
	echo "Dnes" . zpetny_odkaz();
	echo "$after_title\n";
	echo "<div id=\"odsazeni\" style=\"text-align:" . $kalendar_cz_centrovani . ";padding-top:". $kalendar_cz_vrsek ."px \">" . get_kalendar_cz('<ul><li>','</li></ul>',$kalendar_cz_barva) . "</div>";
	echo "$after_widget\n";
}


function widget_kalendar_cz_control($args) {
}

function init_kalendar_cz_widget(){
        register_sidebar_widget("Kalendář CZ", "widget_kalendar_cz");
	register_widget_control("Kalendář Widget", "widget_kalendar_cz_control");
}

function kalendar_cz_menu(){
    global $wpdb;
    include 'kalendar_cz_admin.php';
}
function kalendar_cz_admin_actions()
{
    add_options_page("Kalendář CZ", "Kalendář CZ", 1,
"kalendar_cz", "kalendar_cz_menu");
}
 
add_action('admin_menu', 'kalendar_cz_admin_actions');

add_action("plugins_loaded", "init_kalendar_cz_widget");

$css_file = plugins_url( 'kalendar_cz_style.css', __FILE__ );
wp_register_style('kalendar_cz', $css_file, false, '1.2.2');
wp_enqueue_style('kalendar_cz'); 

?>