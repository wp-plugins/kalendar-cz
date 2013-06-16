<?php
/*
Plugin Name: Kalendář CZ
Plugin URI: http://phgame.cz
Description: Zobrazuje hodiny, čas, kdo má dnes a zítra svátek, sudý/lichý týden, číslo týdne a počet dní do Vánoc či konce roku.
Version: 1.3.3
Author: Webster.K
Author URI: http://phgame.cz
*/


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
	kalendar_cz_stats();
}

add_action('activate_kalendar-cz/kalendar_cz.php', 'kalendar_cz_install');

function kalendar_cz_uninstall(){
	global $wpdb;
	mysql_query("DROP TABLE IF EXISTS ".$wpdb->prefix."plugin_websters_kalendar ");
}

add_action('deactivate_kalendar-cz/kalendar_cz.php', 'kalendar_cz_uninstall');

function get_kalendar_cz($before = '', $after = '',$barva_textu) {
$svatky	= array('Nový rok','Karina','Radmila','Diana','Dalimil','Tři králové','Vilma','Čestmír','Vladan',
'Břetislav','Bohdana','Pravoslav','Edita','Radovan','Alice','Ctirad','Drahoslav','Vladislav','Doubravka',
'Ilona','Běla','Slavomír','Zdeněk','Milena','Miloš','Zora','Ingrid','Otýlie','Zdislava','Robin','Marika',
'Hynek','Nela a Hromnice','Blažej','Jarmila','Dobromila','Vanda','Veronika','Milada','Apolena','Mojmír',
'Božena','Slavěna','Věnceslav','Valentýn','Jiřina','Ljuba','Miloslava','Gizela','Patrik','Oldřich','Lenka',
'Petr','Svatopluk','Matěj','Liliana','Dorota','Alexandr','Lumír','Horymír','Bedřich','Anežka','Kamil',
'Stela','Kazimír','Miroslav','Tomáš','Gabriela','Františka','Viktorie','Anděla','Řehoř','Růžena','Rút a Matylda',
'Ida','Elena a Herbert','Vlastimil','Eduard','Josef','Světlana','Radek','Leona','Ivona','Gabriel','Marián',
'Emanuel','Dita','Soňa','Taťána','Arnošt','Kvido','Hugo','Erika','Richard','Ivana','Miroslava','Vendula',
'Heřman a Hermína','Ema','Dušan','Darja','Izabela','Julius','Aleš','Vincenc','Anastázie','Irena','Rudolf',
'Valérie','Rostislav','Marcela','Alexandra','Evžénie','Vojtěch','Jiří','Marek','Oto','Jaroslav','Vlastislav',
'Robert','Blahoslav','Svátek práce','Zikmund','Alexej','Květoslav','Klaudie','Radoslav','Stanislav','Statní svátek - Ukončení II. světové války',
'Ctibor','Blažena','Svatava','Pankrác','Servác','Bonifác','Žofie','Přemysl','Aneta','Nataša','Ivo','Zbyšek',
'Monika','Emil','Vladimír','Jana','Viola','Filip','Valdemar','Vilém','Maxim','Ferdinand','Kamila','Laura',
'Jarmil','Tamara','Dalibor','Dobroslav','Norbert','Iveta','Medard','Stanislava','Gita','Bruno','Antonie','Antonín',
'Roland','Vít','Zbyněk','Adolf','Milan','Leoš','Květa','Alois','Pavla','Zdeňka','Jan','Ivan','Adriana','Ladislav',
'Lubomír','Petr a Pavel','Šárka','Jaroslava','Patricie','Radomír','Prokop','Státní svátek , Cyril, Metoděj',
'Státní svátek , Mistr Jan Hus','Bohuslava','Nora','Drahoslava','Libuše a Amálie','Olga','Bořek','Markéta',
'Karolína','Jindřich','Luboš','Martina','Drahomíra','Čeněk','Ilja','Vítězslav','Magdaléna','Libor','Kristýna',
'Jakub','Anna','Věroslav','Viktor','Marta','Bořivoj','Ignác','Oskar','Gustav','Miluše','Dominik','Kristián','Oldřiška',
'Lada','Soběslav','Roman','Vavřinec','Zuzana','Klára','Alena','Alan','Hana','Jáchym','Petra','Helena','Ludvík',
'Bernard','Johana','Bohuslav','Sandra','Bartoloměj','Radim','Luděk','Otakar','Augustýn','Evelína','Vladěna','Pavlína',
'Linda a Samuel','Adéla','Bronislav','Jindřiška','Boris','Boleslav','Regína','Mariana','Daniela','Irma','Denisa',
'Marie','Lubor','Radka','Jolana','Ludmila','Naděžda','Kryštof','Zita','Oleg','Matouš','Darina','Berta','Jaromír',
'Zlata','Andrea','Jonáš','Václav','Michal','Jeroným','Igor','Olívie a Oliver','Bohumil','František','Eliška','Hanuš',
'Justýna','Věra','Štefan a Sára','Marina','Andrej','Marcel','Renáta','Agáta','Tereza','Havel','Hedvika','Lukáš',
'Michaela','Vendelín','Brigita','Sabina','Teodor','Nina','Beáta','Erik','Šarlota a Zoe','Statní svátek - Vznik Československa','Silvie',
'Tadeáš','Štěpánka','Felix','Památka zesnulých','Hubert','Karel','Miriam','Liběna','Saskie','Bohumír','Bohdan','Evžen',
'Martin','Benedikt','Tibor','Sáva','Leopold','Otmar','Mahulena','Romana','Alžběta','Nikola','Albert','Cecílie','Klement',
'Emílie','Kateřina','Artur','Xenie','René','Zina','Ondřej','Iva','Blanka','Svatoslav','Barbora','Jitka','Mikuláš','Ambrož',
'Květoslava','Vratislav','Julie','Dana','Simona','Lucie','Lýdie','Radana','Albína','Daniel','Miloslav','Ester','Dagmar',
'Natálie','Šimon','Vlasta','Adam a Eva , Štědrý den','1. svátek vánoční','Štěpán , 2. svátek vánoční','Žaneta','Bohumila',
'Judita','David','Silvestr','Nový rok');

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
		$output .= "<div id=\"kalendar_cz_svatek_dnes\"><font color=\"". $barva_textu ."\">" . $vypis_pred_svatek . $svatek_now  . "</font></div>";
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}
	elseif($dat["typ"]=="svatek_zitra"){
		$output .= "<div id=\"kalendar_cz_svatek_zitra\"><font color=\"". $barva_textu ."\">" . $vypis_pred_svatek_a . $svatek_now_next . "</font></div>";
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
return MkTime ($prevod_hodiny[0], $prevod_hodiny[1], 0, $prevod_datum[1], $prevod_datum[0], $prevod_datum[2]) . "<br>";
}

function get_my_today_date() {
    $mesic = array('','ledna','února','března','dubna','května','června','července','srpna','září','října','listopadu','prosince');
    $den = array('Neděle','Pondělí','Úterý','Středa','Čtvrtek','Pátek','Sobota');
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
div.innerHTML = "Aktuální čas: " + hodiny + ":" + minuty + ":" + sekundy
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
		return "Do Vánoc zbývá " . $novy_dny . " dnů";
	}
elseif($den_do_vanoc==0){
	return "Dnes jsou Vánoce";
	}
elseif($den_do_vanoc==1){
	return "Do Vánoc zbývá jeden den";
	}
elseif($den_do_vanoc>1 AND $den_do_vanoc<5){
	return "Do Vánoc zbývají " . $den_do_vanoc . " dny";
	}
else{
		return "Do Vánoc zbývá " . $den_do_vanoc . " dnů";
	}
}

function get_novy_rok(){
$dnesek = time();
$den_od_zacatku_roku = Date(z, $dnesek);
if(Date(Y, $dnesek)%4==0){$pocet_dni = 366;}else{$pocet_dni = 365;}
$den_do_konce_roku = $pocet_dni - $den_od_zacatku_roku - 1;
if($den_do_konce_roku==0){
		return "Dnes je konec roku";
	}
elseif($den_do_konce_roku==1){
	return "Do konce roku zbývá jeden den";
	}
elseif($den_do_konce_roku>1 AND $den_do_konce_roku<5){
	return "Do konce roku zbývají " . $den_do_konce_roku . " dny";
	}
else{
		return "Do konce roku zbývá " . $den_do_konce_roku . " dnů";
	}
}

function get_sudy_lichy_tyden(){
	$dnesek = StrFTime("%W",time());
	if($dnesek%2==0){return "Je sudý týden";}else{return "Je lichý týden";}
}

function get_cislo_tydne(){
	$dnesek = StrFTime("%W",time());
	if($dnesek <=9){
		
		$samotny_cislo = split("0",$dnesek);
		return "Je " . $samotny_cislo[1] . ". týden";
	}else{
		return "Je " . $dnesek . ". týden";
		
	}
	
}

function kalendar_cz_stats(){
$adresa_serveru = $_SERVER['SERVER_NAME'];
$verze_pluginu = "1.3.3";
$datum_instalace = time();

file_get_contents('http://www.data.phgame.cz/stats/kalendar-cz/send.php?server=' . $adresa_serveru . '&verze=' . $verze_pluginu . '&instalace=' . $datum_instalace . ''); 
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