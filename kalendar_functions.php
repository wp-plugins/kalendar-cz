<?php
function kalendar_cz_install(){
	global $wpdb;
	
	$table_name = $wpdb->prefix . "plugin_websters_kalendar";
	$charset_collate = $wpdb->get_charset_collate();
	
	$wpdb->query("DROP TABLE IF EXISTS $table_name");
	
	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	  id INT NOT NULL AUTO_INCREMENT,
	  cislo INT(1) NOT NULL,
	  typ VARCHAR(20) NOT NULL,
	  zobrazit BOOL NOT NULL,
	  hodnota LONGTEXT NOT NULL,
	  PRIMARY KEY (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	$wpdb->insert( 
		$table_name,
		array( 
			'cislo' => '1', 
			'typ' => 'cas', 
			'zobrazit' => '1', 
		)
	);
	$wpdb->insert( 
		$table_name,
		array( 
			'cislo' => '2', 
			'typ' => 'den', 
			'zobrazit' => '1', 
		)
	);
	$wpdb->insert( 
		$table_name,
		array( 
			'cislo' => '3', 
			'typ' => 'svatek', 
			'zobrazit' => '1', 
		)
	);
	$wpdb->insert( 
		$table_name,
		array( 
			'cislo' => '4', 
			'typ' => 'svatek_zitra', 
			'zobrazit' => '1', 
		)
	);
	$wpdb->insert( 
		$table_name,
		array( 
			'cislo' => '5', 
			'typ' => 'vanoce', 
			'zobrazit' => '1', 
		)
	);
	$wpdb->insert( 
		$table_name,
		array( 
			'cislo' => '6', 
			'typ' => 'novy_rok', 
			'zobrazit' => '1', 
		)
	);
	$wpdb->insert( 
		$table_name,
		array( 
			'cislo' => '7', 
			'typ' => 'sudy_lichy_tyden', 
			'zobrazit' => '1', 
		)
	);
	$wpdb->insert( 
		$table_name,
		array( 
			'cislo' => '8', 
			'typ' => 'cislo_tydne', 
			'zobrazit' => '1', 
		)
	);
	$wpdb->insert( 
		$table_name,
		array( 
			'cislo' => '0', 
			'typ' => 'barva_text', 
			'zobrazit' => '0', 
			'hodnota' => '#000000',
		)
	);
	$wpdb->insert( 
		$table_name,
		array( 
			'cislo' => '0', 
			'typ' => 'centrovani', 
			'zobrazit' => '0', 
			'hodnota' => 'left',
		)
	);
	$wpdb->insert( 
		$table_name,
		array( 
			'cislo' => '0', 
			'typ' => 'kalibrace_tydne', 
			'zobrazit' => '0', 
			'hodnota' => '1',
		)
	);
	$wpdb->insert( 
		$table_name,
		array( 
			'cislo' => '0', 
			'typ' => 'odsazeni_vrsek', 
			'zobrazit' => '0', 
			'hodnota' => '0',
		)
	);
}

function kalendar_cz_uninstall(){
	global $wpdb;
	$table_name = $wpdb->prefix . "plugin_websters_kalendar";
	$wpdb->query("DROP TABLE IF EXISTS $table_name");
}

function get_kalendar_cz($before = '', $after = '',$barva_textu) {
	$svatek[1][1] = __('Nový rok','kalendar_cz');
	$svatek[2][1] = __('Karina','kalendar_cz');
	$svatek[3][1] = __('Radmila','kalendar_cz');
	$svatek[4][1] = __('Diana','kalendar_cz');
	$svatek[5][1] = __('Dalimil','kalendar_cz');
	$svatek[6][1] = __('Tři králové','kalendar_cz');
	$svatek[7][1] = __('Vilma','kalendar_cz');
	$svatek[8][1] = __('Čestmír','kalendar_cz');
	$svatek[9][1] = __('Vladan','kalendar_cz');
	$svatek[10][1] = __('Břetislav','kalendar_cz');
	$svatek[11][1] = __('Bohdana','kalendar_cz');
	$svatek[12][1] = __('Pravoslav','kalendar_cz');
	$svatek[13][1] = __('Edita','kalendar_cz');
	$svatek[14][1] = __('Radovan','kalendar_cz');
	$svatek[15][1] = __('Alice','kalendar_cz');
	$svatek[16][1] = __('Ctirad','kalendar_cz');
	$svatek[17][1] = __('Drahoslav','kalendar_cz');
	$svatek[18][1] = __('Vladislav','kalendar_cz');
	$svatek[19][1] = __('Doubravka','kalendar_cz');
	$svatek[20][1] = __('Ilona','kalendar_cz');
	$svatek[21][1] = __('Běla','kalendar_cz');
	$svatek[22][1] = __('Slavomír','kalendar_cz');
	$svatek[23][1] = __('Zdeněk','kalendar_cz');
	$svatek[24][1] = __('Milena','kalendar_cz');
	$svatek[25][1] = __('Miloš','kalendar_cz');
	$svatek[26][1] = __('Zora','kalendar_cz');
	$svatek[27][1] = __('Ingrid','kalendar_cz');
	$svatek[28][1] = __('Otýlie','kalendar_cz');
	$svatek[29][1] = __('Zdislava','kalendar_cz');
	$svatek[30][1] = __('Robin','kalendar_cz');
	$svatek[31][1] = __('Marika','kalendar_cz');
	$svatek[1][2] = __('Hynek','kalendar_cz');
	$svatek[2][2] = __('Nela a Hromnice','kalendar_cz');
	$svatek[3][2] = __('Blažej','kalendar_cz');
	$svatek[4][2] = __('Jarmila','kalendar_cz');
	$svatek[5][2] = __('Dobromila','kalendar_cz');
	$svatek[6][2] = __('Vanda','kalendar_cz');
	$svatek[7][2] = __('Veronika','kalendar_cz');
	$svatek[8][2] = __('Milada','kalendar_cz');
	$svatek[9][2] = __('Apolena','kalendar_cz');
	$svatek[10][2] = __('Mojmír','kalendar_cz');
	$svatek[11][2] = __('Božena','kalendar_cz');
	$svatek[12][2] = __('Slavěna','kalendar_cz');
	$svatek[13][2] = __('Věnceslav','kalendar_cz');
	$svatek[14][2] = __('Valentýn','kalendar_cz');
	$svatek[15][2] = __('Jiřina','kalendar_cz');
	$svatek[16][2] = __('Ljuba','kalendar_cz');
	$svatek[17][2] = __('Miloslava','kalendar_cz');
	$svatek[18][2] = __('Gizela','kalendar_cz');
	$svatek[19][2] = __('Patrik','kalendar_cz');
	$svatek[20][2] = __('Oldřich','kalendar_cz');
	$svatek[21][2] = __('Lenka','kalendar_cz');
	$svatek[22][2] = __('Petr','kalendar_cz');
	$svatek[23][2] = __('Svatopluk','kalendar_cz');
	$svatek[24][2] = __('Matěj','kalendar_cz');
	$svatek[25][2] = __('Liliana','kalendar_cz');
	$svatek[26][2] = __('Dorota','kalendar_cz');
	$svatek[27][2] = __('Alexandr','kalendar_cz');
	$svatek[28][2] = __('Lumír','kalendar_cz');
	$svatek[29][2] = __('Horymír','kalendar_cz');
	$svatek[1][3] = __('Bedřich','kalendar_cz');
	$svatek[2][3] = __('Anežka','kalendar_cz');
	$svatek[3][3] = __('Kamil','kalendar_cz');
	$svatek[4][3] = __('Stela','kalendar_cz');
	$svatek[5][3] = __('Kazimír','kalendar_cz');
	$svatek[6][3] = __('Miroslav','kalendar_cz');
	$svatek[7][3] = __('Tomáš','kalendar_cz');
	$svatek[8][3] = __('Gabriela','kalendar_cz');
	$svatek[9][3] = __('Františka','kalendar_cz');
	$svatek[10][3] = __('Viktorie','kalendar_cz');
	$svatek[11][3] = __('Anděla','kalendar_cz');
	$svatek[12][3] = __('Řehoř','kalendar_cz');
	$svatek[13][3] = __('Růžena','kalendar_cz');
	$svatek[14][3] = __('Rút a Matylda','kalendar_cz');
	$svatek[15][3] = __('Ida','kalendar_cz');
	$svatek[16][3] = __('Elena a Herbert','kalendar_cz');
	$svatek[17][3] = __('Vlastimil','kalendar_cz');
	$svatek[18][3] = __('Eduard','kalendar_cz');
	$svatek[19][3] = __('Josef','kalendar_cz');
	$svatek[20][3] = __('Světlana','kalendar_cz');
	$svatek[21][3] = __('Radek','kalendar_cz');
	$svatek[22][3] = __('Leona','kalendar_cz');
	$svatek[23][3] = __('Ivona','kalendar_cz');
	$svatek[24][3] = __('Gabriel','kalendar_cz');
	$svatek[25][3] = __('Marián','kalendar_cz');
	$svatek[26][3] = __('Emanuel','kalendar_cz');
	$svatek[27][3] = __('Dita','kalendar_cz');
	$svatek[28][3] = __('Soňa','kalendar_cz');
	$svatek[29][3] = __('Taťána','kalendar_cz');
	$svatek[30][3] = __('Arnošt','kalendar_cz');
	$svatek[31][3] = __('Kvido','kalendar_cz');
	$svatek[1][4] = __('Hugo','kalendar_cz');
	$svatek[2][4] = __('Erika','kalendar_cz');
	$svatek[3][4] = __('Richard','kalendar_cz');
	$svatek[4][4] = __('Ivana','kalendar_cz');
	$svatek[5][4] = __('Miroslava','kalendar_cz');
	$svatek[6][4] = __('Vendula','kalendar_cz');
	$svatek[7][4] = __('Heřman a Hermína','kalendar_cz');
	$svatek[8][4] = __('Ema','kalendar_cz');
	$svatek[9][4] = __('Dušan','kalendar_cz');
	$svatek[10][4] = __('Darja','kalendar_cz');
	$svatek[11][4] = __('Izabela','kalendar_cz');
	$svatek[12][4] = __('Julius','kalendar_cz');
	$svatek[13][4] = __('Aleš','kalendar_cz');
	$svatek[14][4] = __('Vincenc','kalendar_cz');
	$svatek[15][4] = __('Anastázie','kalendar_cz');
	$svatek[16][4] = __('Irena','kalendar_cz');
	$svatek[17][4] = __('Rudolf','kalendar_cz');
	$svatek[18][4] = __('Valérie','kalendar_cz');
	$svatek[19][4] = __('Rostislav','kalendar_cz');
	$svatek[20][4] = __('Marcela','kalendar_cz');
	$svatek[21][4] = __('Alexandra','kalendar_cz');
	$svatek[22][4] = __('Evžénie','kalendar_cz');
	$svatek[23][4] = __('Vojtěch','kalendar_cz');
	$svatek[24][4] = __('Jiří','kalendar_cz');
	$svatek[25][4] = __('Marek','kalendar_cz');
	$svatek[26][4] = __('Oto','kalendar_cz');
	$svatek[27][4] = __('Jaroslav','kalendar_cz');
	$svatek[28][4] = __('Vlastislav','kalendar_cz');
	$svatek[29][4] = __('Robert','kalendar_cz');
	$svatek[30][4] = __('Blahoslav','kalendar_cz');
	$svatek[1][5] = __('Svátek práce','kalendar_cz');
	$svatek[2][5] = __('Zikmund','kalendar_cz');
	$svatek[3][5] = __('Alexej','kalendar_cz');
	$svatek[4][5] = __('Květoslav','kalendar_cz');
	$svatek[5][5] = __('Klaudie','kalendar_cz');
	$svatek[6][5] = __('Radoslav','kalendar_cz');
	$svatek[7][5] = __('Stanislav','kalendar_cz');
	$svatek[8][5] = __('Statní svátek - Ukončení II. světové války','kalendar_cz');
	$svatek[9][5] = __('Ctibor','kalendar_cz');
	$svatek[10][5] = __('Blažena','kalendar_cz');
	$svatek[11][5] = __('Svatava','kalendar_cz');
	$svatek[12][5] = __('Pankrác','kalendar_cz');
	$svatek[13][5] = __('Servác','kalendar_cz');
	$svatek[14][5] = __('Bonifác','kalendar_cz');
	$svatek[15][5] = __('Žofie','kalendar_cz');
	$svatek[16][5] = __('Přemysl','kalendar_cz');
	$svatek[17][5] = __('Aneta','kalendar_cz');
	$svatek[18][5] = __('Nataša','kalendar_cz');
	$svatek[19][5] = __('Ivo','kalendar_cz');
	$svatek[20][5] = __('Zbyšek','kalendar_cz');
	$svatek[21][5] = __('Monika','kalendar_cz');
	$svatek[22][5] = __('Emil','kalendar_cz');
	$svatek[23][5] = __('Vladimír','kalendar_cz');
	$svatek[24][5] = __('Jana','kalendar_cz');
	$svatek[25][5] = __('Viola','kalendar_cz');
	$svatek[26][5] = __('Filip','kalendar_cz');
	$svatek[27][5] = __('Valdemar','kalendar_cz');
	$svatek[28][5] = __('Vilém','kalendar_cz');
	$svatek[29][5] = __('Maxim','kalendar_cz');
	$svatek[30][5] = __('Ferdinand','kalendar_cz');
	$svatek[31][5] = __('Kamila','kalendar_cz');
	$svatek[1][6] = __('Laura','kalendar_cz');
	$svatek[2][6] = __('Jarmil','kalendar_cz');
	$svatek[3][6] = __('Tamara','kalendar_cz');
	$svatek[4][6] = __('Dalibor','kalendar_cz');
	$svatek[5][6] = __('Dobroslav','kalendar_cz');
	$svatek[6][6] = __('Norbert','kalendar_cz');
	$svatek[7][6] = __('Iveta','kalendar_cz');
	$svatek[8][6] = __('Medard','kalendar_cz');
	$svatek[9][6] = __('Stanislava','kalendar_cz');
	$svatek[10][6] = __('Gita','kalendar_cz');
	$svatek[11][6] = __('Bruno','kalendar_cz');
	$svatek[12][6] = __('Antonie','kalendar_cz');
	$svatek[13][6] = __('Antonín','kalendar_cz');
	$svatek[14][6] = __('Roland','kalendar_cz');
	$svatek[15][6] = __('Vít','kalendar_cz');
	$svatek[16][6] = __('Zbyněk','kalendar_cz');
	$svatek[17][6] = __('Adolf','kalendar_cz');
	$svatek[18][6] = __('Milan','kalendar_cz');
	$svatek[19][6] = __('Leoš','kalendar_cz');
	$svatek[20][6] = __('Květa','kalendar_cz');
	$svatek[21][6] = __('Alois','kalendar_cz');
	$svatek[22][6] = __('Pavla','kalendar_cz');
	$svatek[23][6] = __('Zdeňka','kalendar_cz');
	$svatek[24][6] = __('Jan','kalendar_cz');
	$svatek[25][6] = __('Ivan','kalendar_cz');
	$svatek[26][6] = __('Adriana','kalendar_cz');
	$svatek[27][6] = __('Ladislav','kalendar_cz');
	$svatek[28][6] = __('Lubomír','kalendar_cz');
	$svatek[29][6] = __('Petr a Pavel','kalendar_cz');
	$svatek[30][6] = __('Šárka','kalendar_cz');
	$svatek[1][7] = __('Jaroslava','kalendar_cz');
	$svatek[2][7] = __('Patricie','kalendar_cz');
	$svatek[3][7] = __('Radomír','kalendar_cz');
	$svatek[4][7] = __('Prokop','kalendar_cz');
	$svatek[5][7] = __('Státní svátek , Cyril a Metoděj','kalendar_cz');
	$svatek[6][7] = __('Státní svátek , Mistr Jan Hus','kalendar_cz');
	$svatek[7][7] = __('Bohuslava','kalendar_cz');
	$svatek[8][7] = __('Nora','kalendar_cz');
	$svatek[9][7] = __('Drahoslava','kalendar_cz');
	$svatek[10][7] = __('Libuše a Amálie','kalendar_cz');
	$svatek[11][7] = __('Olga','kalendar_cz');
	$svatek[12][7] = __('Bořek','kalendar_cz');
	$svatek[13][7] = __('Markéta','kalendar_cz');
	$svatek[14][7] = __('Karolína','kalendar_cz');
	$svatek[15][7] = __('Jindřich','kalendar_cz');
	$svatek[16][7] = __('Luboš','kalendar_cz');
	$svatek[17][7] = __('Martina','kalendar_cz');
	$svatek[18][7] = __('Drahomíra','kalendar_cz');
	$svatek[19][7] = __('Čeněk','kalendar_cz');
	$svatek[20][7] = __('Ilja','kalendar_cz');
	$svatek[21][7] = __('Vítězslav','kalendar_cz');
	$svatek[22][7] = __('Magdaléna','kalendar_cz');
	$svatek[23][7] = __('Libor','kalendar_cz');
	$svatek[24][7] = __('Kristýna','kalendar_cz');
	$svatek[25][7] = __('Jakub','kalendar_cz');
	$svatek[26][7] = __('Anna','kalendar_cz');
	$svatek[27][7] = __('Věroslav','kalendar_cz');
	$svatek[28][7] = __('Viktor','kalendar_cz');
	$svatek[29][7] = __('Marta','kalendar_cz');
	$svatek[30][7] = __('Bořivoj','kalendar_cz');
	$svatek[31][7] = __('Ignác','kalendar_cz');
	$svatek[1][8] = __('Oskar','kalendar_cz');
	$svatek[2][8] = __('Gustav','kalendar_cz');
	$svatek[3][8] = __('Miluše','kalendar_cz');
	$svatek[4][8] = __('Dominik','kalendar_cz');
	$svatek[5][8] = __('Kristián','kalendar_cz');
	$svatek[6][8] = __('Oldřiška','kalendar_cz');
	$svatek[7][8] = __('Lada','kalendar_cz');
	$svatek[8][8] = __('Soběslav','kalendar_cz');
	$svatek[9][8] = __('Roman','kalendar_cz');
	$svatek[10][8] = __('Vavřinec','kalendar_cz');
	$svatek[11][8] = __('Zuzana','kalendar_cz');
	$svatek[12][8] = __('Klára','kalendar_cz');
	$svatek[13][8] = __('Alena','kalendar_cz');
	$svatek[14][8] = __('Alan','kalendar_cz');
	$svatek[15][8] = __('Hana','kalendar_cz');
	$svatek[16][8] = __('Jáchym','kalendar_cz');
	$svatek[17][8] = __('Petra','kalendar_cz');
	$svatek[18][8] = __('Helena','kalendar_cz');
	$svatek[19][8] = __('Ludvík','kalendar_cz');
	$svatek[20][8] = __('Bernard','kalendar_cz');
	$svatek[21][8] = __('Johana','kalendar_cz');
	$svatek[22][8] = __('Bohuslav','kalendar_cz');
	$svatek[23][8] = __('Sandra','kalendar_cz');
	$svatek[24][8] = __('Bartoloměj','kalendar_cz');
	$svatek[25][8] = __('Radim','kalendar_cz');
	$svatek[26][8] = __('Luděk','kalendar_cz');
	$svatek[27][8] = __('Otakar','kalendar_cz');
	$svatek[28][8] = __('Augustýn','kalendar_cz');
	$svatek[29][8] = __('Evelína','kalendar_cz');
	$svatek[30][8] = __('Vladěna','kalendar_cz');
	$svatek[31][8] = __('Pavlína','kalendar_cz');
	$svatek[1][9] = __('Linda a Samuel','kalendar_cz');
	$svatek[2][9] = __('Adéla','kalendar_cz');
	$svatek[3][9] = __('Bronislav','kalendar_cz');
	$svatek[4][9] = __('Jindřiška','kalendar_cz');
	$svatek[5][9] = __('Boris','kalendar_cz');
	$svatek[6][9] = __('Boleslav','kalendar_cz');
	$svatek[7][9] = __('Regína','kalendar_cz');
	$svatek[8][9] = __('Mariana','kalendar_cz');
	$svatek[9][9] = __('Daniela','kalendar_cz');
	$svatek[10][9] = __('Irma','kalendar_cz');
	$svatek[11][9] = __('Denisa','kalendar_cz');
	$svatek[12][9] = __('Marie','kalendar_cz');
	$svatek[13][9] = __('Lubor','kalendar_cz');
	$svatek[14][9] = __('Radka','kalendar_cz');
	$svatek[15][9] = __('Jolana','kalendar_cz');
	$svatek[16][9] = __('Ludmila','kalendar_cz');
	$svatek[17][9] = __('Naděžda','kalendar_cz');
	$svatek[18][9] = __('Kryštof','kalendar_cz');
	$svatek[19][9] = __('Zita','kalendar_cz');
	$svatek[20][9] = __('Oleg','kalendar_cz');
	$svatek[21][9] = __('Matouš','kalendar_cz');
	$svatek[22][9] = __('Darina','kalendar_cz');
	$svatek[23][9] = __('Berta','kalendar_cz');
	$svatek[24][9] = __('Jaromír','kalendar_cz');
	$svatek[25][9] = __('Zlata','kalendar_cz');
	$svatek[26][9] = __('Andrea','kalendar_cz');
	$svatek[27][9] = __('Jonáš','kalendar_cz');
	$svatek[28][9] = __('Václav','kalendar_cz');
	$svatek[29][9] = __('Michal','kalendar_cz');
	$svatek[30][9] = __('Jeroným','kalendar_cz');
	$svatek[1][10] = __('Igor','kalendar_cz');
	$svatek[2][10] = __('Olívie a Oliver','kalendar_cz');
	$svatek[3][10] = __('Bohumil','kalendar_cz');
	$svatek[4][10] = __('František','kalendar_cz');
	$svatek[5][10] = __('Eliška','kalendar_cz');
	$svatek[6][10] = __('Hanuš','kalendar_cz');
	$svatek[7][10] = __('Justýna','kalendar_cz');
	$svatek[8][10] = __('Věra','kalendar_cz');
	$svatek[9][10] = __('Štefan a Sára','kalendar_cz');
	$svatek[10][10] = __('Marina','kalendar_cz');
	$svatek[11][10] = __('Andrej','kalendar_cz');
	$svatek[12][10] = __('Marcel','kalendar_cz');
	$svatek[13][10] = __('Renáta','kalendar_cz');
	$svatek[14][10] = __('Agáta','kalendar_cz');
	$svatek[15][10] = __('Tereza','kalendar_cz');
	$svatek[16][10] = __('Havel','kalendar_cz');
	$svatek[17][10] = __('Hedvika','kalendar_cz');
	$svatek[18][10] = __('Lukáš','kalendar_cz');
	$svatek[19][10] = __('Michaela','kalendar_cz');
	$svatek[20][10] = __('Vendelín','kalendar_cz');
	$svatek[21][10] = __('Brigita','kalendar_cz');
	$svatek[22][10] = __('Sabina','kalendar_cz');
	$svatek[23][10] = __('Teodor','kalendar_cz');
	$svatek[24][10] = __('Nina','kalendar_cz');
	$svatek[25][10] = __('Beáta','kalendar_cz');
	$svatek[26][10] = __('Erik','kalendar_cz');
	$svatek[27][10] = __('Šarlota a Zoe','kalendar_cz');
	$svatek[28][10] = __('Statní svátek - Vznik Československa','kalendar_cz');
	$svatek[29][10] = __('Silvie','kalendar_cz');
	$svatek[30][10] = __('Tadeáš','kalendar_cz');
	$svatek[31][10] = __('Štěpánka','kalendar_cz');
	$svatek[1][11] = __('Felix','kalendar_cz');
	$svatek[2][11] = __('Památka zesnulých','kalendar_cz');
	$svatek[3][11] = __('Hubert','kalendar_cz');
	$svatek[4][11] = __('Karel','kalendar_cz');
	$svatek[5][11] = __('Miriam','kalendar_cz');
	$svatek[6][11] = __('Liběna','kalendar_cz');
	$svatek[7][11] = __('Saskie','kalendar_cz');
	$svatek[8][11] = __('Bohumír','kalendar_cz');
	$svatek[9][11] = __('Bohdan','kalendar_cz');
	$svatek[10][11] = __('Evžen','kalendar_cz');
	$svatek[11][11] = __('Martin','kalendar_cz');
	$svatek[12][11] = __('Benedikt','kalendar_cz');
	$svatek[13][11] = __('Tibor','kalendar_cz');
	$svatek[14][11] = __('Sáva','kalendar_cz');
	$svatek[15][11] = __('Leopold','kalendar_cz');
	$svatek[16][11] = __('Otmar','kalendar_cz');
	$svatek[17][11] = __('Mahulena','kalendar_cz');
	$svatek[18][11] = __('Romana','kalendar_cz');
	$svatek[19][11] = __('Alžběta','kalendar_cz');
	$svatek[20][11] = __('Nikola','kalendar_cz');
	$svatek[21][11] = __('Albert','kalendar_cz');
	$svatek[22][11] = __('Cecílie','kalendar_cz');
	$svatek[23][11] = __('Klement','kalendar_cz');
	$svatek[24][11] = __('Emílie','kalendar_cz');
	$svatek[25][11] = __('Kateřina','kalendar_cz');
	$svatek[26][11] = __('Artur','kalendar_cz');
	$svatek[27][11] = __('Xenie','kalendar_cz');
	$svatek[28][11] = __('René','kalendar_cz');
	$svatek[29][11] = __('Zina','kalendar_cz');
	$svatek[30][11] = __('Ondřej','kalendar_cz');
	$svatek[1][12] = __('Iva','kalendar_cz');
	$svatek[2][12] = __('Blanka','kalendar_cz');
	$svatek[3][12] = __('Svatoslav','kalendar_cz');
	$svatek[4][12] = __('Barbora','kalendar_cz');
	$svatek[5][12] = __('Jitka','kalendar_cz');
	$svatek[6][12] = __('Mikuláš','kalendar_cz');
	$svatek[7][12] = __('Ambrož','kalendar_cz');
	$svatek[8][12] = __('Květoslava','kalendar_cz');
	$svatek[9][12] = __('Vratislav','kalendar_cz');
	$svatek[10][12] = __('Julie','kalendar_cz');
	$svatek[11][12] = __('Dana','kalendar_cz');
	$svatek[12][12] = __('Simona','kalendar_cz');
	$svatek[13][12] = __('Lucie','kalendar_cz');
	$svatek[14][12] = __('Lýdie','kalendar_cz');
	$svatek[15][12] = __('Radana','kalendar_cz');
	$svatek[16][12] = __('Albína','kalendar_cz');
	$svatek[17][12] = __('Daniel','kalendar_cz');
	$svatek[18][12] = __('Miloslav','kalendar_cz');
	$svatek[19][12] = __('Ester','kalendar_cz');
	$svatek[20][12] = __('Dagmar','kalendar_cz');
	$svatek[21][12] = __('Natálie','kalendar_cz');
	$svatek[22][12] = __('Šimon','kalendar_cz');
	$svatek[23][12] = __('Vlasta','kalendar_cz');
	$svatek[24][12] = __('Adam a Eva , Štědrý den','kalendar_cz');
	$svatek[25][12] = __('1. svátek vánoční','kalendar_cz');
	$svatek[26][12] = __('Štěpán , 2. svátek vánoční','kalendar_cz');
	$svatek[27][12] = __('Žaneta','kalendar_cz');
	$svatek[28][12] = __('Bohumila','kalendar_cz');
	$svatek[29][12] = __('Judita','kalendar_cz');
	$svatek[30][12] = __('David','kalendar_cz');
	$svatek[31][12] = __('Silvestr','kalendar_cz');

	$cas_ktery_se_pouziva_u_wp = get_presny_cas_z_wp();

	//rozlozeni timestamp na den a mesic
	$dnes=getdate($cas_ktery_se_pouziva_u_wp);
	$dnes_den = $dnes["mday"];
	$dnes_mesic = $dnes["mon"];

	//rozlozeni timestamp na den a mesic
	$zitra=getdate($cas_ktery_se_pouziva_u_wp + 86400);
	$zitra_den = $zitra["mday"];
	$zitra_mesic = $zitra["mon"];

	//tohle vypisuje z pole kdo ma a nebo nema svatek
	$svatek_now = $svatek[$dnes_den][$dnes_mesic];
	$svatek_now_next = $svatek[$zitra_den][$zitra_mesic];

	//vystup
	$output .= "$before";
	global $wpdb;

	$data = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE zobrazit=1 AND typ='cas' OR zobrazit=1 AND typ='den' OR zobrazit=1 AND typ='svatek' OR zobrazit=1 AND typ='svatek_zitra' OR zobrazit=1 AND typ='vanoce'  OR zobrazit=1 AND typ='novy_rok' OR zobrazit=1 AND typ='sudy_lichy_tyden' OR zobrazit=1 AND typ='cislo_tydne' ORDER BY cislo ASC");

	$radku = count($data);

	//prefix pred kdo ma dnes svatek nebo co je za den
	if($dnes_den==1 && $dnes_mesic==1 || $dnes_den==6 && $dnes_mesic==1 || $dnes_den==1 && $dnes_mesic==5 || $dnes_den==8 && $dnes_mesic==5 || $dnes_den==5 && $dnes_mesic==7 || $dnes_den==6 && $dnes_mesic==7 || $dnes_den==28 && $dnes_mesic==10 || $dnes_den==2 && $dnes_mesic==11 || $dnes_den==25 && $dnes_mesic==12){
		$vypis_pred_svatek = __('Dnes je ','kalendar_cz');
	}else{
		$vypis_pred_svatek = __('Svátek má ','kalendar_cz');
	}

	//prefix pred kdo ma zitra svatek nebo co je zitra za den
	if($zitra_den==1 && $zitra_mesic==1 || $zitra_den==6 && $zitra_mesic==1 || $zitra_den==1 && $zitra_mesic==5 || $zitra_den==8 && $zitra_mesic==5 || $zitra_den==5 && $zitra_mesic==7 || $zitra_den==6 && $zitra_mesic==7 || $zitra_den==28 && $zitra_mesic==10 || $zitra_den==2 && $zitra_mesic==11 || $zitra_den==25 && $zitra_mesic==12){
		$vypis_pred_svatek_a = __('Zítra je ','kalendar_cz');
	}else{
		$vypis_pred_svatek_a = __('Zítra má svátek ','kalendar_cz');
	}

	for($a=0;$a<=$radku;$a++):
		if($data[$a]->typ=="cas"){
			$output .= "<div id=\"kalendar_cz_cas\"><font color=\"". $barva_textu ."\">" . aktualni_cas() . "</font></div>";
			if($radku!=$data[$a]->cislo){
				$output .= "$after\n$before";
			}else{$output .= "$after\n";}
		}
		if($data[$a]->typ=="den"){
			$output .= "<div id=\"kalendar_cz_datum\"><font color=\"". $barva_textu ."\">" . get_my_today_date($cas_ktery_se_pouziva_u_wp) . "</font></div>";
			if($radku!=$data[$a]->cislo){
				$output .= "$after\n$before";
			}else{$output .= "$after\n";}
		}
		if($data[$a]->typ=="svatek"){
			$output .= "<div id=\"kalendar_cz_svatek_dnes\"><font color=\"". $barva_textu ."\">" . __($vypis_pred_svatek,'kalendar_cz') . $svatek_now  . "</font></div>";
			if($radku!=$data[$a]->cislo){
				$output .= "$after\n$before";
			}else{$output .= "$after\n";}
		}
		if($data[$a]->typ=="svatek_zitra"){
			$output .= "<div id=\"kalendar_cz_svatek_zitra\"><font color=\"". $barva_textu ."\">" . __($vypis_pred_svatek_a,'kalendar_cz') . $svatek_now_next . "</font></div>";
			if($radku!=$data[$a]->cislo){
				$output .= "$after\n$before";
			}else{$output .= "$after\n";}
		}
		if($data[$a]->typ=="vanoce"){
			$output .= "<div id=\"kalendar_cz_vanoce\"><font color=\"". $barva_textu ."\">" . get_vanoce($cas_ktery_se_pouziva_u_wp) . "</font></div>";
			if($radku!=$data[$a]->cislo){
				$output .= "$after\n$before";
			}else{$output .= "$after\n";}
		}
		if($data[$a]->typ=="novy_rok"){
			$output .= "<div id=\"kalendar_cz_novy_rok\"><font color=\"". $barva_textu ."\">" . get_novy_rok($cas_ktery_se_pouziva_u_wp) . "</font></div>";
			if($radku!=$data[$a]->cislo){
				$output .= "$after\n$before";
			}else{$output .= "$after\n";}
		}
		if($data[$a]->typ=="sudy_lichy_tyden"){
			$output .= "<div id=\"kalendar_cz_ls_tyden\"><font color=\"". $barva_textu ."\">" . get_sudy_lichy_tyden($cas_ktery_se_pouziva_u_wp) . "</font></div>";
			if($radku!=$data[$a]->cislo){
				$output .= "$after\n$before";
			}else{$output .= "$after\n";}
		}
		if($data[$a]->typ=="cislo_tydne"){
			$output .= "<div id=\"kalendar_cz_cislo_tydne\"><font color=\"". $barva_textu ."\">" . get_cislo_tydne($cas_ktery_se_pouziva_u_wp) . "</font></div>";
			if($radku!=$data[$a]->cislo){
				$output .= "$after\n$before";
			}else{$output .= "$after\n";}
		}
	endfor;

	return $output;
}

function zpetny_odkaz() {
	return '<div id="zpetny_odkaz" style="visibility: hidden;width:1px;height:1px"><a href="http://phgame.cz">PHGame.cz</a></div>';
}

function get_my_today_date($presne_datum) {
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
    $d=getdate($presne_datum);
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

function get_vanoce($dnesek){
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

function get_novy_rok($dnesek){
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

function get_sudy_lichy_tyden($caaaa){
	global $wpdb;
	$nastaveni = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='kalibrace_tydne'");
	
	$dnesek = StrFTime("%W",$caaaa) + $nastaveni->hodnota;
	if($dnesek%2==0){return __('Je sudý týden','kalendar_cz');}else{return __('Je lichý týden','kalendar_cz');}
}

function get_cislo_tydne($caaaa){
	global $wpdb;
	$nastaveni = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='kalibrace_tydne'");

	$dnesek = StrFTime("%W",$caaaa) + $nastaveni->hodnota;
	if($dnesek <=9){
		$samotny_cislo = str_replace("0","",$dnesek);
		return __('Je ','kalendar_cz') . $samotny_cislo . __('týden','kalendar_cz');
	}else{
		return __('Je ','kalendar_cz') . $dnesek . __('týden','kalendar_cz');
	}
}

function widget_kalendar_cz($args) {
	//musi se opravit vypis pro centrovani a css
	global $wpdb;
	$nastaveni = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."plugin_websters_kalendar WHERE typ='odsazeni_vrsek' OR typ='centrovani' OR typ='barva_text'");
	$pocet = count($nastaveni) - 1;
	for($a=0;$a<=$pocet;$a++):
		if($nastaveni[$a]->typ=="odsazeni_vrsek"){$kalendar_cz_vrsek = $nastaveni[$a]->hodnota;}
		if($nastaveni[$a]->typ== "centrovani"){$kalendar_cz_centrovani = $nastaveni[$a]->hodnota;}
		if($nastaveni[$a]->typ=="barva_text"){$kalendar_cz_barva = $nastaveni[$a]->hodnota;}
	endfor;

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
function kalendar_cz_admin_actions(){
    add_options_page("Kalendář CZ", "Kalendář CZ", 9,"kalendar_cz", "kalendar_cz_menu");
}
 
function kalendar_cz_dashboard_widgets_obsah() {
	?>
	<div class="kalendar_cz_dashboard" style="width:100%">
	<?php printf( __('Aktuální datum a čas:','kalendar_cz')); echo " " . Date ("d. n. Y, H:i", get_presny_cas_z_wp());printf( __(', pokud je čas špatný, přejděte prosím do nastavení pluginu.','kalendar_cz'));?>
	</div>
	<?php
}

function kalendar_cz_dashboard_widgets() {
	wp_add_dashboard_widget(
                 'kalendar_cz_dashboard_widget',         // Widget slug.
                 'Kalendář / Calendar',         // Title.
                 'kalendar_cz_dashboard_widgets_obsah' // Display function.
        );	
}

function get_presny_cas_z_wp(){
	return current_time( 'timestamp', 0 );
}

?>