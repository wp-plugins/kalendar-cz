<?php
/*
Plugin Name: Kalendář CZ
Plugin URI: http://phgame.cz
Description: Zobrazuje hodiny, čas, svátky a počet dní do Vánoc.
Version: 1.0.2
Author: Webster.K
Author URI: http://phgame.cz
*/


function kalendar_cz_install(){
global $wpdb;
mysql_query("CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."plugin_websters_kalendar (id INT NOT NULL AUTO_INCREMENT, cislo INT(1) NOT NULL,typ VARCHAR(15) NOT NULL,zobrazit BOOL NOT NULL,PRIMARY KEY (id))");

$existuje = mysql_num_rows(mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar"));
if($existuje<=4){

mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('1', 'cas', '1')");
mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('2', 'den', '1')");
mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('3', 'svatek', '1')");
mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('4', 'svatek_zitra', '1')");
mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('5', 'vanoce', '1')");

}
}

add_action('activate_kalendar-cz/kalendar_cz.php', 'kalendar_cz_install');

function get_kalendar_cz($before = '', $after = '') {
$svatky	= array('Nový rok','Karina','Radmila','Diana','Dalimil','Tři králové','Vilma','Čestmír','Vladan',
'Břetislav','Bohdana','Pravoslav','Edita','Radovan','Alice','Ctirad','Drahoslav','Vladislav','Doubravka',
'Ilona','Běla','Slavomír','Zdeněk','Milena','Miloš','Zora','Ingrid','Otýlie','Zdislava','Robin','Marika',
'Hynek',array('Nela','Hromnice'),'Blažej','Jarmila','Dobromila','Vanda','Veronika','Milada','Apolena','Mojmír',
'Božena','Slavěna','Věnceslav','Valentýn','Jiřina','Ljuba','Miloslava','Gizela','Patrik','Oldřich','Lenka',
'Petr','Svatopluk','Matěj','Liliana','Dorota','Alexandr','Lumír','Horymír','Bedřich','Anežka','Kamil',
'Stela','Kazimír','Miroslav','Tomáš','Gabriela','Františka','Viktorie','Anděla','Řehoř','Růžena',array('Rút','Matylda'),
'Ida',array('Elena','Herbert'),'Vlastimil','Eduard','Josef','Světlana','Radek','Leona','Ivona','Gabriel','Marián',
'Emanuel','Dita','Soňa','Taťána','Arnošt','Kvido','Hugo','Erika','Richard','Ivana','Miroslava','Vendula',
array('Heřman','Hermína'),'Ema','Dušan','Darja','Izabela','Julius','Aleš','Vincenc','Anastázie','Irena','Rudolf',
'Valérie','Rostislav','Marcela','Alexandra','Evžénie','Vojtěch','Jiří','Marek','Oto','Jaroslav','Vlastislav',
'Robert','Blahoslav','Svátek práce','Zikmund','Alexej','Květoslav','Klaudie','Radoslav','Stanislav','Statní svátek - Ukončení II. světové války',
'Ctibor','Blažena','Svatava','Pankrác','Servác','Bonifác','Žofie','Přemysl','Aneta','Nataša','Ivo','Zbyšek',
'Monika','Emil','Vladimír','Jana','Viola','Filip','Valdemar','Vilém','Maxim','Ferdinand','Kamila','Laura',
'Jarmil','Tamara','Dalibor','Dobroslav','Norbert','Iveta','Medard','Stanislava','Gita','Bruno','Antonie','Antonín',
'Roland','Vít','Zbyněk','Adolf','Milan','Leoš','Květa','Alois','Pavla','Zdeňka','Jan','Ivan','Adriana','Ladislav',
'Lubomír',array('Petr','Pavel'),'Šárka','Jaroslava','Patricie','Radomír','Prokop',array('Státní svátek','Cyril','Metoděj'),
array('Státní svátek','Mistr Jan Hus'),'Bohuslava','Nora','Drahoslava',array('Libuše','Amálie'),'Olga','Bořek','Markéta',
'Karolína','Jindřich','Luboš','Martina','Drahomíra','Čeněk','Ilja','Vítězslav','Magdaléna','Libor','Kristýna',
'Jakub','Anna','Věroslav','Viktor','Marta','Bořivoj','Ignác','Oskar','Gustav','Miluše','Dominik','Kristián','Oldřiška',
'Lada','Soběslav','Roman','Vavřinec','Zuzana','Klára','Alena','Alan','Hana','Jáchym','Petra','Helena','Ludvík',
'Bernard','Johana','Bohuslav','Sandra','Bartoloměj','Radim','Luděk','Otakar','Augustýn','Evelína','Vladěna','Pavlína',
array('Linda','Samuel'),'Adéla','Bronislav','Jindřiška','Boris','Boleslav','Regína','Mariana','Daniela','Irma','Denisa',
'Marie','Lubor','Radka','Jolana','Ludmila','Naděžda','Kryštof','Zita','Oleg','Matouš','Darina','Berta','Jaromír',
'Zlata','Andrea','Jonáš','Václav','Michal','Jeroným','Igor',array('Olívie','Oliver'),'Bohumil','František','Eliška','Hanuš',
'Justýna','Věra',array('Štefan','Sára'),'Marina','Andrej','Marcel','Renáta','Agáta','Tereza','Havel','Hedvika','Lukáš',
'Michaela','Vendelín','Brigita','Sabina','Teodor','Nina','Beáta','Erik',array('Šarlota','Zoe'),'Statní svátek - Vznik Československa','Silvie',
'Tadeáš','Štěpánka','Felix','Památka zesnulých','Hubert','Karel','Miriam','Liběna','Saskie','Bohumír','Bohdan','Evžen',
'Martin','Benedikt','Tibor','Sáva','Leopold','Otmar','Mahulena','Romana','Alžběta','Nikola','Albert','Cecílie','Klement',
'Emílie','Kateřina','Artur','Xenie','René','Zina','Ondřej','Iva','Blanka','Svatoslav','Barbora','Jitka','Mikuláš','Ambrož',
'Květoslava','Vratislav','Julie','Dana','Simona','Lucie','Lýdie','Radana','Albína','Daniel','Miloslav','Ester','Dagmar',
'Natálie','Šimon','Vlasta',array('Adam','Eva','Štědrý den'),'1. svátek vánoční',array('Štěpán','2. svátek vánoční'),'Žaneta','Bohumila',
'Judita','David','Silvestr','Nový rok');

$d=getdate();
$datum=date("d. m. Y");
$yday=$d["yday"];

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


$data = mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE zobrazit='1' ORDER BY cislo ASC");
$radku = mysql_num_rows($data);

//$data = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE zobrazit='1' ORDER BY cislo ASC");
//$radku = $wpdb->get_row($data);


while ($dat = mysql_fetch_array($data)):
	if($dat["typ"]=="cas"){
		$output .= aktualni_cas();
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}
	elseif($dat["typ"]=="den"){
		$output .= get_my_today_date();
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}
	elseif($dat["typ"]=="svatek"){
		$output .= "Svátek má " . $svatek_now ."<br/>\n";
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}
	elseif($dat["typ"]=="svatek_zitra"){
		$output .= "Zítra má svátek " . $svatek_now_next;
		if($radku!=$dat["cislo"]){
			$output .= "$after\n$before";
		}else{$output .= "$after\n";}
	}
	elseif($dat["typ"]=="vanoce"){
		$output .= get_vanoce();
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



function get_my_today_date() {
    $mesic = array('','ledna','února','března','dubna','května','června','července','srpna','září','října','listopadu','prosince');
    $den = array('Neděle','Pondělí','Úterý','Středa','Čtvrtek','Pátek','Sobota');
    $d=getdate();
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
$den_do_vanoc = $pocet_dni - 7 - $den_od_zacatku_roku;
return "Do Vánoc zbývá " . $den_do_vanoc . " dnů";
}


function widget_kalendar_cz($args) {
    extract($args);
    echo "$before_widget";
    echo "$before_title\n";
    echo "Dnes" . zpetny_odkaz();
    echo "$after_title\n";
    echo get_kalendar_cz('<ul><li>','</li></ul>');
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
?>