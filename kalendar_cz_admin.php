<?php
/*
Plugin Name: Kalendář CZ
Plugin URI: http://phgame.cz
Description: Zobrazuje hodiny, čas, kdo má dnes a zítra svátek a počet dní do Vánoc či konce roku.
Version: 1.1.0
Author: Webster.K
Author URI: http://phgame.cz
*/
?>


<div class="wrap">
<h2>Kalendář CZ</h2>
<?php


if (isset($_POST['kalendar-cz-submit'])) {
global $wpdb;
if(isset($_POST["zobrazeno1"])){$zob1=1;}else{$zob1=0;}
if(isset($_POST["zobrazeno2"])){$zob2=1;}else{$zob2=0;}
if(isset($_POST["zobrazeno3"])){$zob3=1;}else{$zob3=0;}
if(isset($_POST["zobrazeno4"])){$zob4=1;}else{$zob4=0;}
if(isset($_POST["zobrazeno5"])){$zob5=1;}else{$zob5=0;}
if(isset($_POST["zobrazeno6"])){$zob6=1;}else{$zob6=0;}

mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi1"].",zobrazit=".$zob1." WHERE id=1");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi2"].",zobrazit=".$zob2." WHERE id=2");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi3"].",zobrazit=".$zob3." WHERE id=3");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi4"].",zobrazit=".$zob4." WHERE id=4");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi5"].",zobrazit=".$zob5." WHERE id=5");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi6"].",zobrazit=".$zob6." WHERE id=6");

}
if (isset($_POST['kalendar-cz-submit1'])) {
global $wpdb;
$center = $_POST["centrovani"];
$odsazeni = $_POST["odsazeni"];

mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET zobrazit=".$center." WHERE typ='centrovani'");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET zobrazit=".$odsazeni." WHERE typ='odsazeni_vrsek'");


}





echo '<form method="post"><table><tr><td>Pořadí</td><td>Typ</td><td>Zobrazení</td></tr>';
$data = mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='cas' OR typ='den' OR typ='svatek' OR typ='svatek_zitra' OR typ='vanoce' OR typ='novy_rok' ORDER BY cislo ASC");
while ($a=mysql_fetch_array($data)):

echo '<tr><td><input type="text" value="' . $a["cislo"] . '" name="poradi'. $a["id"] .'"></td><td>';
if($a["typ"]=="cas"){echo "Zobrazí aktuální čas";}
elseif($a["typ"]=="den"){echo "Zobrazí aktuální datum";}
elseif($a["typ"]=="svatek"){echo "Zobrazí, kdo má dnes svátek";}
elseif($a["typ"]=="svatek_zitra"){echo "Zobrazí, kdo má zítra svátek";}
elseif($a["typ"]=="vanoce"){echo "Zobrazí, kolik dní zbývá do Vánoc";}
elseif($a["typ"]=="novy_rok"){echo "Zobrazí, kolik dní zbývá do konce roku";}

echo '</td><td><center>';
if($a["zobrazit"]==1){echo '<input type="checkbox" checked name="zobrazeno'. $a["id"] .'"></center>';}else{echo '<input type="checkbox" name="zobrazeno'. $a["id"] .'"></center>';}
echo '</td></tr>';

endwhile;
echo '</table><input type="submit" name="kalendar-cz-submit" value=" Uložit " /></form>';
?>
<p>* Pořadí je určené číslem, každé číslo může být pouze jednou, jinak plugin nebude správně fungovat.</p>
<p>* Zaškrtnuté pole znamená, že je daný řádek vidět, nezaškrtnutý, že není.</p>
<p>* Pokud nebudete některou z částí (datum, cas, svátky...) používat, přesuňte jí na konec, u některých témat tímto předejdete chybám</p>







<br><br>

<?php

$nastaveni = mysql_num_rows(mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='centrovani' OR typ='odsazeni_vrsek'"));

if($nastaveni!=2){
	mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('0', 'odsazeni_vrsek', '0')");
	mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('0', 'centrovani', '1')");
}
$data1 = mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='centrovani' OR typ='odsazeni_vrsek'");

echo '<form method="post"><table>';
while ($a1=mysql_fetch_array($data1)):
	if($a1["typ"]=="odsazeni_vrsek"){echo '<tr><td>Odsazení od shora:</td><td><input type="text" value="'. $a1["zobrazit"] .'" name="odsazeni">px</td></tr>';}
	if($a1["typ"]=="centrovani"){echo "<tr><td>Umístění textu:</td><td> 
<select name=\"centrovani\">
<option value=\"1\">levá strana</option>
<option value=\"2\">střed</option>
<option value=\"3\">pravá strana</option>
</select></td></tr>";}
endwhile;
echo '</table><input type="submit" name="kalendar-cz-submit1" value=" Uložit " /></form>';

?>

<p>* Hodnotu pro odsazení zadávejte pouze jako číslo</p><br><br>


<p>* Plugin je stále ve vývoji, oficiální stránka: <a href="http://phgame.cz/kalendar">http://phgame.cz/kalendar</a></p>
<p>* Pokud Vám něco v pluginu chybí, neváhejte na web napsat, pokud to bude v našich silách, rozšíření o které žádáte v nové verzi naleznete</p>

</div>