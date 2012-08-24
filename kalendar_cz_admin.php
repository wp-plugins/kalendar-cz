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

mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi1"].",zobrazit=".$zob1." WHERE id=1");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi2"].",zobrazit=".$zob2." WHERE id=2");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi3"].",zobrazit=".$zob3." WHERE id=3");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi4"].",zobrazit=".$zob4." WHERE id=4");
mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET cislo=".$_POST["poradi5"].",zobrazit=".$zob5." WHERE id=5");


}

echo '<form method="post"><table><tr><td>Pořadí</td><td>Typ</td><td>Zobrazení</td></tr>';
$data = mysql_query("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar ORDER BY cislo ASC");
while ($a=mysql_fetch_array($data)):

echo '<tr><td><input type="text" value="' . $a["cislo"] . '" name="poradi'. $a["id"] .'"></td><td>';
if($a["typ"]=="cas"){echo "Zobrazí aktuální čas";}
elseif($a["typ"]=="den"){echo "Zobrazí aktuální datum";}
elseif($a["typ"]=="svatek"){echo "Zobrazí, kdo má dnes svátek";}
elseif($a["typ"]=="svatek_zitra"){echo "Zobrazí, kdo má zítra svátek";}
elseif($a["typ"]=="vanoce"){echo "Zobrazí, kolik dní zbývá do Vánoc";}

echo '</td><td><center>';
if($a["zobrazit"]==1){echo '<input type="checkbox" checked name="zobrazeno'. $a["id"] .'"></center>';}else{echo '<input type="checkbox" name="zobrazeno'. $a["id"] .'"></center>';}
echo '</td></tr>';

endwhile;
echo '</table><input type="submit" name="kalendar-cz-submit" value=" Uložit " /></form>';
?>
<p >* Pořadí je určené číslem, každé číslo může být pouze jednou, jinak plugin nebude správně fungovat.</p>
<p>* Zaškrtnuté pole znamená, že je daný řádek vidět, nezaškrtnutý, že není.</p>
</div>