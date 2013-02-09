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
echo "Uloženo<br>";
}





echo '<form method="post"><table><tr><td>Pořadí</td><td>Typ</td><td>Zobrazení</td></tr>';
$data = mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='cas' OR typ='den' OR typ='svatek' OR typ='svatek_zitra' OR typ='vanoce' OR typ='novy_rok' OR typ='sudy_lichy_tyden' ORDER BY cislo ASC");
while ($a=mysql_fetch_array($data)):

echo '<tr><td><input type="text" value="' . $a["cislo"] . '" name="poradi'. $a["id"] .'"></td><td>';
if($a["typ"]=="cas"){echo "Zobrazí aktuální čas";}
elseif($a["typ"]=="den"){echo "Zobrazí aktuální datum";}
elseif($a["typ"]=="svatek"){echo "Zobrazí, kdo má dnes svátek";}
elseif($a["typ"]=="svatek_zitra"){echo "Zobrazí, kdo má zítra svátek";}
elseif($a["typ"]=="vanoce"){echo "Zobrazí, kolik dní zbývá do Vánoc";}
elseif($a["typ"]=="novy_rok"){echo "Zobrazí, kolik dní zbývá do konce roku";}
elseif($a["typ"]=="sudy_lichy_tyden"){echo "Zobrazí sudý/lichý týden";}
elseif($a["typ"]=="cislo_tydne"){echo "Zobrazí číslo týdne";}

echo '</td><td><center>';
if($a["zobrazit"]==1){echo '<input type="checkbox" checked name="zobrazeno'. $a["id"] .'"></center>';}else{echo '<input type="checkbox" name="zobrazeno'. $a["id"] .'"></center>';}
echo '</td></tr>';

endwhile;
echo '</table><input type="submit" name="kalendar-cz-submit" value=" Uložit " /></form>';
?>
<p>* Pořadí je určené číslem, každé číslo může být pouze jednou, jinak plugin nebude správně fungovat.</p>
<p>* Zaškrtnuté pole znamená, že je daný řádek vidět, nezaškrtnutý, že není.</p>
<p>* Pokud nebudete některou z částí (datum, čas, svátky...) používat, přesuňte jí na konec, u některých témat tímto předejdete chybám</p>







<br><br>

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
	if($a1["typ"]=="odsazeni_vrsek"){echo '<tr><td>Odsazení od shora:</td><td><input type="text" value="'. $a1["hodnota"] .'" name="odsazeni">px</td></tr>';}

if($a1["typ"]=="centrovani"){
?>
<tr><td>Umístění textu:</td><td>
<select name="centrovani">
<option value="left" <?php if($a1["hodnota"]=="left"){echo 'selected="selected"';} ?>>levá strana</option>
<option value="center" <?php if($a1["hodnota"]=="center"){echo 'selected="selected"';} ?>>střed</option>
<option value="right" <?php if($a1["hodnota"]=="right"){echo 'selected="selected"';} ?>>pravá strana</option>
</select></td></tr>
<?php
}
if($a1["typ"]=="barva_text"){
?>
<tr><td>Barva textu:</td><td>
<select name="barva_textu">
<option value="" <?php if($a1["hodnota"]==""){echo 'selected="selected"';} ?>>barva thema</option>
<option value="#000000" <?php if($a1["hodnota"]=="#000000"){echo 'selected="selected"';} ?> style="color: #000000">černá</option>
<option value="#0000FF" <?php if($a1["hodnota"]=="#0000FF"){echo 'selected="selected"';} ?> style="color: #0000FF">modrá</option>
<option value="#FF0000" <?php if($a1["hodnota"]=="#FF0000"){echo 'selected="selected"';} ?> style="color: #FF0000">červená</option>
<option value="#00FF00" <?php if($a1["hodnota"]=="#00FF00"){echo 'selected="selected"';} ?> style="color: #00FF00">zelená</option>
<option value="#FFFFFF" <?php if($a1["hodnota"]=="#FFFFFF"){echo 'selected="selected"';} ?> style="color: #000000">bílá</option>
<option value="#FF1493" <?php if($a1["hodnota"]=="#FF1493"){echo 'selected="selected"';} ?> style="color: #FF1493">růžová</option>
<option value="#BA55D3" <?php if($a1["hodnota"]=="#BA55D3"){echo 'selected="selected"';} ?> style="color: #BA55D3">fialová</option>
<option value="#FFFF00" <?php if($a1["hodnota"]=="#FFFF00"){echo 'selected="selected"';} ?> style="color: #FFFF00">žlutá</option>
<option value="#D3D3D3" <?php if($a1["hodnota"]=="#D3D3D3"){echo 'selected="selected"';} ?> style="color: #D3D3D3">světle šedá</option>
<option value="#696969" <?php if($a1["hodnota"]=="#696969"){echo 'selected="selected"';} ?> style="color: #696969">tmavě šedá</option>
<option value="#FFA500" <?php if($a1["hodnota"]=="#FFA500"){echo 'selected="selected"';} ?> style="color: #FFA500">oranžová</option>
<option value="#00BFFF" <?php if($a1["hodnota"]=="#00BFFF"){echo 'selected="selected"';} ?> style="color: #00BFFF">světe modrá</option>
</select>
</td></tr>
<?php
}
endwhile;
?>
</table><input type="submit" name="kalendar-cz-submit1" value=" Uložit " /></form>




<p>* Hodnotu pro odsazení zadávejte pouze jako číslo</p><br><br>


<p>* Plugin je stále ve vývoji, oficiální stránka: <a href="http://phgame.cz/kalendar">http://phgame.cz/kalendar</a></p>
<p>* Pokud Vám něco v pluginu chybí, neváhejte na web napsat, pokud to bude v našich silách, rozšíření o které žádáte v nové verzi naleznete</p>


<?php
echo the_time('G:i');
?>
</div>