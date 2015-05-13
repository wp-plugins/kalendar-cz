<?php
load_plugin_textdomain('kalendar_cz', false, dirname(plugin_basename(__FILE__)) . '/languages/');

include_once plugin_dir_path(__FILE__) . "./kalendar_functions.php";

global $wpdb;
?>

<div class="wrap">
	<h2><?php printf( __('Kalendář CZ','kalendar_cz')); ?></h2>
	<div class="updated">
		<p><?php printf( __('* Plugin je stále ve vývoji, oficiální stránka:','kalendar_cz'));?> <a href="http://phgame.cz/kalendar">http://phgame.cz/kalendar</a></p>
		<p><?php printf( __('* Pokud Vám něco v pluginu chybí, neváhejte na web napsat, pokud to bude v našich silách, rozšíření o které žádáte v nové verzi naleznete','kalendar_cz'));?></p>
	</div>
	
	<?php
	//ověření, zda jsou opravdu všechny data v tabulce s kalendářem a zda není načtena starší verze
	$tabulka_data = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar");
	$cislo = count($tabulka_data);
	if($cislo<11){
		echo '<div class="updated"><p>';
		printf( __('Wordpress při aktivaci pluginu provedl neplatnou operaci, pro správnou funkci pluginu jej deaktivujte a znovu aktivujte, pokud se chyba neodstraní, dejte nám o ní vědet na <a href=\"http://phgame.cz/kalendar\">PHGame.cz</a>','kalendar_cz'));
		echo '</p></div>';
	}else{
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
		
		$wpdb->update(
			$wpdb->prefix . 'plugin_websters_kalendar',
			array(
				'cislo' => $_POST["poradi1"],
				'zobrazit' => $zob1
				),
			array('id'=> 1)
			);
		
		$wpdb->update(
			$wpdb->prefix . 'plugin_websters_kalendar',
			array(
				'cislo' => $_POST["poradi2"],
				'zobrazit' => $zob2
				),
			array('id'=> 2)
			);
		$wpdb->update(
			$wpdb->prefix . 'plugin_websters_kalendar',
			array(
				'cislo' => $_POST["poradi3"],
				'zobrazit' => $zob3
				),
			array('id'=> 3)
			);
		$wpdb->update(
			$wpdb->prefix . 'plugin_websters_kalendar',
			array(
				'cislo' => $_POST["poradi4"],
				'zobrazit' => $zob4
				),
			array('id'=> 4)
			);
		$wpdb->update(
			$wpdb->prefix . 'plugin_websters_kalendar',
			array(
				'cislo' => $_POST["poradi5"],
				'zobrazit' => $zob5
				),
			array('id'=> 5)
			);
		$wpdb->update(
			$wpdb->prefix . 'plugin_websters_kalendar',
			array(
				'cislo' => $_POST["poradi6"],
				'zobrazit' => $zob6
				),
			array('id'=> 6)
			);
		$wpdb->update(
			$wpdb->prefix . 'plugin_websters_kalendar',
			array(
				'cislo' => $_POST["poradi7"],
				'zobrazit' => $zob7
				),
			array('id'=> 7)
			);
		$wpdb->update(
			$wpdb->prefix . 'plugin_websters_kalendar',
			array(
				'cislo' => $_POST["poradi8"],
				'zobrazit' => $zob8
				),
			array('id'=> 8)
			);
		echo "<div class=\"updated\"><p>";
		printf( __('Uloženo','kalendar_cz'));
		echo "</p></div>";
		}


		if (isset($_POST['kalendar-cz-submit1'])) {
			$wpdb->update(
				$wpdb->prefix . 'plugin_websters_kalendar',
				array(
					'hodnota' => $_POST["centrovani"]
					),
				array('typ'=> 'centrovani')
			);
			$wpdb->update(
				$wpdb->prefix . 'plugin_websters_kalendar',
				array(
					'hodnota' => $_POST["odsazeni"]
					),
				array('typ'=> 'odsazeni_vrsek')
			);
			$wpdb->update(
				$wpdb->prefix . 'plugin_websters_kalendar',
				array(
					'hodnota' => $_POST["barva_textu"]
					),
				array('typ'=> 'barva_text')
			);
			/*
			mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET hodnota='" . $_POST["centrovani"] . "' WHERE typ='centrovani'");
			mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET hodnota='" . $_POST["odsazeni"] . "' WHERE typ='odsazeni_vrsek'");
			mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET hodnota='" . $_POST["barva_textu"] . "' WHERE typ='barva_text'");
			*/
			echo "<div class=\"updated\"><p>";
			printf( __('Uloženo','kalendar_cz'));
			echo "</p></div>";
		}
		if (isset($_POST['kalendar-cz-submit2'])) {
			$real_file = dirname(plugin_basename(__FILE__)) . '/kalendar_cz_style.css';
			$text = $_POST["cssko"];
			$soubor = fopen($real_file, "w");
			fwrite($soubor, $text);
			fclose($soubor);

			echo "<div class=\"updated\"><p>";
			printf( __('Uloženo','kalendar_cz'));
			echo "</p></div>";
		}
		if (isset($_POST['kalendar-cz-submit3'])) {
			$wpdb->update(
				$wpdb->prefix . 'plugin_websters_kalendar',
				array(
					'hodnota' => $_POST["kalibrace_tydne_plus"]
					),
				array('typ'=> 'kalibrace_tydne')
			);
			
			/*
			mysql_query("UPDATE ".$wpdb->prefix."plugin_websters_kalendar SET hodnota='" . $_POST["kalibrace_tydne_plus"] . "' WHERE typ='kalibrace_tydne'");
			*/
			echo "<div class=\"updated\"><p>";
			printf( __('Uloženo','kalendar_cz'));
			echo "</p></div>";
		}



		//po odeslani formulare
		//hlavicka s casem
		$caaaa = get_presny_cas_z_wp();


		echo '<div class="updated"><p>';
		printf( __('Aktuální datum a čas:','kalendar_cz')); echo " " . Date ("d. n. Y, H:i", $caaaa);

		echo ", ";

		$kalibrator = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='kalibrace_tydne'");

		$dnesek = StrFTime("%W",$caaaa) + $kalibrator->hodnota;
			if($dnesek <=9){
				$samotny_cislo = str_replace("0","",$dnesek);
				echo $samotny_cislo . " " . __('týden','kalendar_cz');
			}else{
				echo $dnesek . " " . __('týden','kalendar_cz');
			}
			
		//hlavicka s casem
		echo "</p><p>";printf( __('* Pokud je tento čas a datum nesprávné, nastavte prosím Wordpress správně (nastavení/obecné), nesprávné zobrazení času může být nesprávným nastavením časové zóny','kalendar_cz'));
		echo "</p></div>";

		//kalibrace tydne
		?>
		<div id="kalibrace_donate" style="width:100%;">
			<div id="main-container" style="width:69%;float:left;">
				<div id="left-sortables" class="meta-box-sortables">
					<div id="dashboard_right_now" class="postbox " >
						<h3 class='hndle' style="padding-left:20px;">
							<span>
								<?php printf( __('Kalibrace čísla týdne','kalendar_cz'));?>
							</span>
						</h3>
						<blockquote>
						<form action="" method="post">
						<?php printf( __('Kolik týdnu se má přidat:','kalendar_cz'));?> <input type="text" name="kalibrace_tydne_plus" value="<?php echo $velikost_kalibrace;?>">
						<input type="submit" name="kalendar-cz-submit3" class="button button-primary" value="<?php printf( __(' Uložit ','kalendar_cz'));?>" />
						</form>
						<p><?php printf( __('* Číslo týdne zadávejte pouze jako číslo. Toto číslo značí, o kolik bude posunuto počítání týdnů.','kalendar_cz'));?></p>
						</blockquote>
					</div>
				</div>
			</div>
			<div id="side-container" style="width:29%;float:right;">
				<div id="left-sortables" class="meta-box-sortables">
					<div id="dashboard_right_now" class="postbox " >
						<h3 class='hndle' style="padding-left:20px;"><span><?php printf( __('Líbí se Vám tento plugin?','kalendar_cz'));?></span></h3>
						<div style="width:160px;margin-left:auto;margin-right:auto;margin-top:20px;">
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="RQC2YYEQW3A8E">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div id="vypis_na_webu" style="width:100%;float:left;">
			<div id="main-container" style="width:100%;">
				<div id="left-sortables" class="meta-box-sortables">
					<div id="dashboard_right_now" class="postbox " >
						<h3 class='hndle' style="padding-left:20px;">
							<span>
								<?php printf( __('Co se bude na webu vypisovat','kalendar_cz'));?>
							</span>
						</h3>
						<?php
						echo "<blockquote>";
						echo '<form method="post">
						<table><tr><td>';printf( __('Pořadí','kalendar_cz'));echo '</td><td>';printf( __('Typ','kalendar_cz'));echo '</td><td>';printf( __('Zobrazení','kalendar_cz'));echo '</td></tr>';
						$data = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='cas' OR typ='den' OR typ='svatek' OR typ='svatek_zitra' OR typ='vanoce' OR typ='novy_rok' OR typ='sudy_lichy_tyden' OR typ='cislo_tydne' ORDER BY cislo ASC");
						$pocet_zaznamu = count($data) - 1;
						for($a=0;$a<=$pocet_zaznamu;$a++):
							echo '<tr><td><input type="text" value="' . $data[$a]->cislo . '" name="poradi'. $data[$a]->id .'"></td><td>';
							if($data[$a]->typ=="cas"){printf( __('Zobrazí aktuální čas','kalendar_cz'));}
							elseif($data[$a]->typ=="den"){printf( __('Zobrazí aktuální datum','kalendar_cz'));}
							elseif($data[$a]->typ=="svatek"){printf( __('Zobrazí, kdo má dnes svátek','kalendar_cz'));}
							elseif($data[$a]->typ=="svatek_zitra"){printf( __('Zobrazí, kdo má zítra svátek','kalendar_cz'));}
							elseif($data[$a]->typ=="vanoce"){printf( __('Zobrazí, kolik dní zbývá do Vánoc','kalendar_cz'));}
							elseif($data[$a]->typ=="novy_rok"){printf( __('Zobrazí, kolik dní zbývá do konce roku','kalendar_cz'));}
							elseif($data[$a]->typ=="sudy_lichy_tyden"){printf( __('Zobrazí sudý/lichý týden','kalendar_cz'));}
							elseif($data[$a]->typ=="cislo_tydne"){printf( __('Zobrazí číslo týdne','kalendar_cz'));}

							echo '</td><td><center>';
							if($data[$a]->zobrazit==1){echo '<input type="checkbox" checked name="zobrazeno'. $data[$a]->id .'"></center>';}else{echo '<input type="checkbox" name="zobrazeno'. $data[$a]->id .'"></center>';}
							echo '</td></tr>';
						endfor;
						echo '</table><input type="submit" name="kalendar-cz-submit" class="button button-primary" value="'; printf( __(' Uložit ','kalendar_cz')); echo '" /></form>';
						?>

						<p><?php printf( __('* Pořadí je určené číslem, každé číslo může být pouze jednou, jinak plugin nebude správně fungovat.','kalendar_cz'));?></p>
						<p><?php printf( __('* Zaškrtnuté pole znamená, že je daný řádek vidět, nezaškrtnutý, že není.','kalendar_cz'));?></p>
						<p><?php printf( __('* Pokud nebudete některou z částí (datum, čas, svátky...) používat, přesuňte jí na konec, u některých témat tímto předejdete chybám','kalendar_cz'));?></p>
						</blockquote>
					</div>
				</div>
			</div>
		</div>
		<div id="nastaveni_vzhledu" style="width:100%;float:left;">
			<div id="main-container" style="width:100%;">
				<div id="left-sortables" class="meta-box-sortables">
					<div id="dashboard_right_now" class="postbox " >
						<h3 class='hndle' style="padding-left:20px;">
							<span>
								<?php printf( __('Jednoduché nastavení vzhledu','kalendar_cz'));?>
							</span>
						</h3>
						<blockquote>
						<?php

						$data1 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='centrovani' OR typ='odsazeni_vrsek' OR typ='barva_text'");
						$pocet_zaznamu1 = count($data1) - 1;
						echo '<form method="post"><table>';
						
						for($b=0;$b<=$pocet_zaznamu1;$b++):
						
							if($data1[$b]->typ=="odsazeni_vrsek"){
								echo '<tr><td>';
								printf( __('Odsazení od shora:','kalendar_cz'));
								echo '</td><td><input type="text" value="'. $data1[$b]->hodnota .'" name="odsazeni">px</td></tr>';
							}
							if($data1[$b]->typ=="centrovani"){
								?>
								<tr><td><?php printf( __('Umístění textu:','kalendar_cz'));?></td><td>
								<select name="centrovani">
								<option value="left" <?php if($data1[$b]->hodnota=="left"){echo 'selected="selected"';} ?>><?php printf( __('levá strana','kalendar_cz'));?></option>
								<option value="center" <?php if($data1[$b]->hodnota=="center"){echo 'selected="selected"';} ?>><?php printf( __('střed','kalendar_cz'));?></option>
								<option value="right" <?php if($data1[$b]->hodnota=="right"){echo 'selected="selected"';} ?>><?php printf( __('pravá strana','kalendar_cz'));?></option>
								</select></td></tr>
								<?php
							}
							if($data1[$b]->typ=="barva_text"){
								?>
								<tr><td><?php printf( __('Barva textu:','kalendar_cz'));?></td><td>
								<select name="barva_textu">
								<option value="" <?php if($data1[$b]->hodnota==""){echo 'selected="selected"';} ?>>barva thema</option>
								<option value="#000000" <?php if($data1[$b]->hodnota=="#000000"){echo 'selected="selected"';} ?> style="color: #000000"><?php printf( __('černá','kalendar_cz'));?></option>
								<option value="#0000FF" <?php if($data1[$b]->hodnota=="#0000FF"){echo 'selected="selected"';} ?> style="color: #0000FF"><?php printf( __('modrá','kalendar_cz'));?></option>
								<option value="#FF0000" <?php if($data1[$b]->hodnota=="#FF0000"){echo 'selected="selected"';} ?> style="color: #FF0000"><?php printf( __('červená','kalendar_cz'));?></option>
								<option value="#00FF00" <?php if($data1[$b]->hodnota=="#00FF00"){echo 'selected="selected"';} ?> style="color: #00FF00"><?php printf( __('zelená','kalendar_cz'));?></option>
								<option value="#FFFFFF" <?php if($data1[$b]->hodnota=="#FFFFFF"){echo 'selected="selected"';} ?> style="color: #000000"><?php printf( __('bílá','kalendar_cz'));?></option>
								<option value="#FF1493" <?php if($data1[$b]->hodnota=="#FF1493"){echo 'selected="selected"';} ?> style="color: #FF1493"><?php printf( __('růžová','kalendar_cz'));?></option>
								<option value="#BA55D3" <?php if($data1[$b]->hodnota=="#BA55D3"){echo 'selected="selected"';} ?> style="color: #BA55D3"><?php printf( __('fialová','kalendar_cz'));?></option>
								<option value="#FFFF00" <?php if($data1[$b]->hodnota=="#FFFF00"){echo 'selected="selected"';} ?> style="color: #FFFF00"><?php printf( __('žlutá','kalendar_cz'));?></option>
								<option value="#D3D3D3" <?php if($data1[$b]->hodnota=="#D3D3D3"){echo 'selected="selected"';} ?> style="color: #D3D3D3"><?php printf( __('světle šedá','kalendar_cz'));?></option>
								<option value="#696969" <?php if($data1[$b]->hodnota=="#696969"){echo 'selected="selected"';} ?> style="color: #696969"><?php printf( __('tmavě šedá','kalendar_cz'));?></option>
								<option value="#FFA500" <?php if($data1[$b]->hodnota=="#FFA500"){echo 'selected="selected"';} ?> style="color: #FFA500"><?php printf( __('oranžová','kalendar_cz'));?></option>
								<option value="#00BFFF" <?php if($data1[$b]->hodnota=="#00BFFF"){echo 'selected="selected"';} ?> style="color: #00BFFF"><?php printf( __('světe modrá','kalendar_cz'));?></option>
								</select>
								</td></tr>
								<?php
							}
						endfor;
						?>
						</table><input type="submit" name="kalendar-cz-submit1" class="button button-primary" value="<?php printf( __(' Uložit ','kalendar_cz'));?>" /></form>
						<p><?php printf( __('* Hodnotu pro odsazení zadávejte pouze jako číslo','kalendar_cz'));?></p>
						</blockquote>
					</div>
				</div>
			</div>
		</div>
		<div id="css_styly" style="width:100%;float:left;">
			<div id="main-container" style="width:100%;">
				<div id="left-sortables" class="meta-box-sortables">
					<div id="dashboard_right_now" class="postbox " >
						<h3 class='hndle' style="padding-left:20px;">
							<span>
								<?php printf( __('Vlastní CSS styly','kalendar_cz'));?>
							</span>
						</h3>
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
						<input type="submit" name="kalendar-cz-submit2" class="button button-primary" value="<?php printf( __(' Uložit ','kalendar_cz'));?>" />
						</form>
						<p><?php printf( __('* Tato funkce je pro zkušené uživatele','kalendar_cz'));?></p>
						<p><?php printf( __('* Styly uvedené nalevo jsou ty, které jasně definují jednotlivé řádky pluginu','kalendar_cz'));?></p>
						</blockquote>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	?>
</div>