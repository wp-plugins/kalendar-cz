<?php
load_plugin_textdomain('kalendar_cz', false, dirname(plugin_basename(__FILE__)) . '/languages/');

?>

<div class="wrap">
<h2><?php printf( __('Kalendář CZ','kalendar_cz')); ?></h2>
<?php
//ověření, zda jsou opravdu všechny data v tabulce s kalendářem a zda není načtena starší verze

$cislo = mysql_num_rows(mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar"));
if($cislo<11){printf( __('Wordpress při aktivaci pluginu provedl neplatnou operaci, pro správnou funkci pluginu jej deaktivujte a znovu aktivujte, pokud se chyba neodstraní, dejte nám o ní vědet na <a href=\"http://phgame.cz/kalendar\">PHGame.cz</a>','kalendar_cz'));}
else{
?>


<?php

//po odeslani formulare
if (isset($_POST['kalendar-cz-submit'])) {
global $wpdb;
if(isset($_POST["zobrazeno1"])){$zob1=1;}else{$zob1=0;}
if(isset($_POST["zobrazeno2"])){$zob2=1;}else{$zob2=0;}
if(isset($_POST["zobrazeno3"])){$zob3=1;}else{$zob3=0;}
if(isset($_POST["zobrazeno4"])){$zob4=1;}else{$zob4=0;}
if(isset($_POST["zobrazeno5"])){$zob5=1;}else{$zob5=0;}
if(isset($_POST["zobrazeno6"])){$zob6=1;}else{$zob6=0;}
if(isset($_POST["zobrazeno7"])){$zob7=1;}else{$zob7=0;}
if(isset($_POST["zobrazeno8"])){$zob8=1;}else{$zob8=0;}

mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi1"].",zobrazit=".$zob1." WHERE id=1");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi2"].",zobrazit=".$zob2." WHERE id=2");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi3"].",zobrazit=".$zob3." WHERE id=3");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi4"].",zobrazit=".$zob4." WHERE id=4");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi5"].",zobrazit=".$zob5." WHERE id=5");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi6"].",zobrazit=".$zob6." WHERE id=6");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi7"].",zobrazit=".$zob7." WHERE id=7");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi8"].",zobrazit=".$zob8." WHERE id=8");
echo "Uloženo<br>";
}


if (isset($_POST['kalendar-cz-submit1'])) {
global $wpdb;

mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET hodnota='" . $_POST["centrovani"] . "' WHERE typ='centrovani'");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET hodnota='" . $_POST["odsazeni"] . "' WHERE typ='odsazeni_vrsek'");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET hodnota='" . $_POST["barva_textu"] . "' WHERE typ='barva_text'");
printf( __('Uloženo','kalendar_cz')); echo "<br>";
}


if (isset($_POST['kalendar-cz-submit2'])) {



$real_file = dirname(__FILE__) . '/kalendar_cz_style.css';
$text = $_POST["cssko"];
$soubor = fopen($real_file, "w");
fwrite($soubor, $text);
fclose($soubor);

printf( __('Uloženo','kalendar_cz')); echo "<br>";
}

//po odeslani formulare
//hlavicka s casem
$cas_ted = date_i18n(get_option('time_format'));
$prevod_hodiny = split('\.', $cas_ted);
$prevod_datum = split('\.', date_i18n( get_option('date_format')));
$caaaa = MkTime ((int)$prevod_hodiny[0], (int)$prevod_hodiny[1], (int)0, (int)$prevod_datum[1], (int)$prevod_datum[0], (int)$prevod_datum[2]) . "<br>";
printf( __('Aktuální datum a čas:','kalendar_cz')); echo " " . Date ("d. n. Y, H:i", MkTime ((int)$prevod_hodiny[0], (int)$prevod_hodiny[1], (int)0, (int)$prevod_datum[1], (int)$prevod_datum[0], (int)$prevod_datum[2])) . "<br>";

echo "<p>";printf( __('* Pokud je tento čas a datum nesprávné, nastavte prosím Wordpress správně (nastavení/obecné), nesprávné zobrazení času může být nesprávným nastavením časové zóny','kalendar_cz'));echo "</p>";
//hlavicka s casem




echo "<fieldset style=\"border:1px solid black;\"><legend style=\"margin-left:20px;\">"; printf( __('Co se bude na webu vypisovat','kalendar_cz')); echo "</legend><blockquote>";
echo '<form method="post">
<table><tr><td>';printf( __('Pořadí','kalendar_cz'));echo '</td><td>';printf( __('Typ','kalendar_cz'));echo '</td><td>';printf( __('Zobrazení','kalendar_cz'));echo '</td></tr>';
$data = mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='cas' OR typ='den' OR typ='svatek' OR typ='svatek_zitra' OR typ='vanoce' OR typ='novy_rok' OR typ='sudy_lichy_tyden' OR typ='cislo_tydne' ORDER BY cislo ASC");
while ($a=mysql_fetch_array($data)):

echo '<tr><td><input type="text" value="' . $a["cislo"] . '" name="poradi'. $a["id"] .'"></td><td>';
if($a["typ"]=="cas"){printf( __('Zobrazí aktuální čas','kalendar_cz'));}
elseif($a["typ"]=="den"){printf( __('Zobrazí aktuální datum','kalendar_cz'));}
elseif($a["typ"]=="svatek"){printf( __('Zobrazí, kdo má dnes svátek','kalendar_cz'));}
elseif($a["typ"]=="svatek_zitra"){printf( __('Zobrazí, kdo má zítra svátek','kalendar_cz'));}
elseif($a["typ"]=="vanoce"){printf( __('Zobrazí, kolik dní zbývá do Vánoc','kalendar_cz'));}
elseif($a["typ"]=="novy_rok"){printf( __('Zobrazí, kolik dní zbývá do konce roku','kalendar_cz'));}
elseif($a["typ"]=="sudy_lichy_tyden"){printf( __('Zobrazí sudý/lichý týden','kalendar_cz'));}
elseif($a["typ"]=="cislo_tydne"){printf( __('Zobrazí číslo týdne','kalendar_cz'));}

echo '</td><td><center>';
if($a["zobrazit"]==1){echo '<input type="checkbox" checked name="zobrazeno'. $a["id"] .'"></center>';}else{echo '<input type="checkbox" name="zobrazeno'. $a["id"] .'"></center>';}
echo '</td></tr>';

endwhile;
echo '</table><input type="submit" name="kalendar-cz-submit" value="'; printf( __(' Uložit ','kalendar_cz')); echo '" /></form>';
?>

<p><?php printf( __('* Pořadí je určené číslem, každé číslo může být pouze jednou, jinak plugin nebude správně fungovat.','kalendar_cz'));?></p>
<p><?php printf( __('* Zaškrtnuté pole znamená, že je daný řádek vidět, nezaškrtnutý, že není.','kalendar_cz'));?></p>
<p><?php printf( __('* Pokud nebudete některou z částí (datum, čas, svátky...) používat, přesuňte jí na konec, u některých témat tímto předejdete chybám','kalendar_cz'));?></p>
</blockquote>
</fieldset>






<br>
<fieldset style="border:1px solid black;">
<legend  style="margin-left:20px;"><?php printf( __('Jednoduché nastavení vzhledu','kalendar_cz'));?></legend>
<blockquote>
<?php
/*
$nastaveni = mysql_num_rows(mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='centrovani' OR typ='odsazeni_vrsek'"));

if($nastaveni!=2){
	mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('0', 'odsazeni_vrsek', '0')");
	mysql_query("INSERT INTO ".$wpdb->prefix."plugin_websters_kalendar (cislo,typ,zobrazit) VALUES ('0', 'centrovani', '1')");
}
*/
$data1 = mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='centrovani' OR typ='odsazeni_vrsek' OR typ='barva_text'");

echo '<form method="post"><table>';
while ($a1=mysql_fetch_array($data1)):
	if($a1["typ"]=="odsazeni_vrsek"){echo '<tr><td>';printf( __('Odsazení od shora:','kalendar_cz'));echo '</td><td><input type="text" value="'. $a1["hodnota"] .'" name="odsazeni">px</td></tr>';}

if($a1["typ"]=="centrovani"){
?>
<tr><td><?php printf( __('Umístění textu:','kalendar_cz'));?></td><td>
<select name="centrovani">
<option value="left" <?php if($a1["hodnota"]=="left"){echo 'selected="selected"';} ?>><?php printf( __('levá strana','kalendar_cz'));?></option>
<option value="center" <?php if($a1["hodnota"]=="center"){echo 'selected="selected"';} ?>><?php printf( __('střed','kalendar_cz'));?></option>
<option value="right" <?php if($a1["hodnota"]=="right"){echo 'selected="selected"';} ?>><?php printf( __('pravá strana','kalendar_cz'));?></option>
</select></td></tr>
<?php
}
if($a1["typ"]=="barva_text"){
?>
<tr><td><?php printf( __('Barva textu:','kalendar_cz'));?></td><td>
<select name="barva_textu">
<option value="" <?php if($a1["hodnota"]==""){echo 'selected="selected"';} ?>>barva thema</option>
<option value="#000000" <?php if($a1["hodnota"]=="#000000"){echo 'selected="selected"';} ?> style="color: #000000"><?php printf( __('černá','kalendar_cz'));?></option>
<option value="#0000FF" <?php if($a1["hodnota"]=="#0000FF"){echo 'selected="selected"';} ?> style="color: #0000FF"><?php printf( __('modrá','kalendar_cz'));?></option>
<option value="#FF0000" <?php if($a1["hodnota"]=="#FF0000"){echo 'selected="selected"';} ?> style="color: #FF0000"><?php printf( __('červená','kalendar_cz'));?></option>
<option value="#00FF00" <?php if($a1["hodnota"]=="#00FF00"){echo 'selected="selected"';} ?> style="color: #00FF00"><?php printf( __('zelená','kalendar_cz'));?></option>
<option value="#FFFFFF" <?php if($a1["hodnota"]=="#FFFFFF"){echo 'selected="selected"';} ?> style="color: #000000"><?php printf( __('bílá','kalendar_cz'));?></option>
<option value="#FF1493" <?php if($a1["hodnota"]=="#FF1493"){echo 'selected="selected"';} ?> style="color: #FF1493"><?php printf( __('růžová','kalendar_cz'));?></option>
<option value="#BA55D3" <?php if($a1["hodnota"]=="#BA55D3"){echo 'selected="selected"';} ?> style="color: #BA55D3"><?php printf( __('fialová','kalendar_cz'));?></option>
<option value="#FFFF00" <?php if($a1["hodnota"]=="#FFFF00"){echo 'selected="selected"';} ?> style="color: #FFFF00"><?php printf( __('žlutá','kalendar_cz'));?></option>
<option value="#D3D3D3" <?php if($a1["hodnota"]=="#D3D3D3"){echo 'selected="selected"';} ?> style="color: #D3D3D3"><?php printf( __('světle šedá','kalendar_cz'));?></option>
<option value="#696969" <?php if($a1["hodnota"]=="#696969"){echo 'selected="selected"';} ?> style="color: #696969"><?php printf( __('tmavě šedá','kalendar_cz'));?></option>
<option value="#FFA500" <?php if($a1["hodnota"]=="#FFA500"){echo 'selected="selected"';} ?> style="color: #FFA500"><?php printf( __('oranžová','kalendar_cz'));?></option>
<option value="#00BFFF" <?php if($a1["hodnota"]=="#00BFFF"){echo 'selected="selected"';} ?> style="color: #00BFFF"><?php printf( __('světe modrá','kalendar_cz'));?></option>
</select>
</td></tr>
<?php
}
endwhile;
?>
</table><input type="submit" name="kalendar-cz-submit1" value="<?php printf( __(' Uložit ','kalendar_cz'));?>" /></form>
<p><?php printf( __('* Hodnotu pro odsazení zadávejte pouze jako číslo','kalendar_cz'));?></p>
</blockquote>
</fieldset>



<br>
<fieldset style="border:1px solid black;">
<legend style="margin-left:20px;"><?php printf( __('Vlastní CSS styly','kalendar_cz'));?></legend>
<blockquote>
<table><tr><td>
#kalendar_cz_cas<br>#kalendar_cz_datum<br>#kalendar_cz_svatek_dnes<br>#kalendar_cz_svatek_zitra<br>#kalendar_cz_vanoce<br>#kalendar_cz_novy_rok<br>#kalendar_cz_ls_tyden<br>#kalendar_cz_cislo_tydne
</td><td>
<?php



$real_file = dirname(__FILE__) . '/kalendar_cz_style.css';
if(is_writeable($real_file)){
$soubor = fopen($real_file, 'r');
//$text = fread($soubor, 10);
//$text = file_get_contents($soubor);
$radek = "";
while(!feof($soubor)){
	$radek .= fgets($soubor, 4096); 
	}
fclose($soubor);
echo "<form method=\"post\"><textarea name=\"cssko\" cols=\"100\" rows=\"8\">" . $radek . "</textarea>";
}else{printf( __('Do souboru stylů není možné zapisovat, vyhledejte prosím soubor kalendar_cz_style.css ve složce pluginu (wp-content/plugins/kalendar-cz/) a změňte práva souboru na 775, aby bylo možné do něj zapisovat','kalendar_cz'));}
?>
</td></tr></table>
<input type="submit" name="kalendar-cz-submit2" value="<?php printf( __(' Uložit ','kalendar_cz'));?>" />
</form>
<p><?php printf( __('* Tato funkce je pro zkušené uživatele','kalendar_cz'));?></p>
<p><?php printf( __('* Styly uvedené nalevo jsou ty, které jasně definují jednotlivé řádky pluginu','kalendar_cz'));?></p>
</blockquote>
</fieldset><br>
<p><?php printf( __('* Plugin je stále ve vývoji, oficiální stránka:','kalendar_cz'));?> <a href="http://phgame.cz/kalendar">http://phgame.cz/kalendar</a></p>
<p><?php printf( __('* Pokud Vám něco v pluginu chybí, neváhejte na web napsat, pokud to bude v našich silách, rozšíření o které žádáte v nové verzi naleznete','kalendar_cz'));?></p>


<?php
}
?>
</div>