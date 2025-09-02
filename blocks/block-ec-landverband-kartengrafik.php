<?php 
if(block_lab_backend()){
	?>
	<div style="padding: 10px;"><strong>EC Kreisverband Kartengrafik</strong><br />
	<div>
	<?php 
}
?>

<style>
.lv_zeile{
	line-height: 1.5em;
}
</style>

<script>



	function karte_einblenden(id){
		
		var meineElemente = document.getElementsByClassName('kartenbild');

		for(var i = 0; i < meineElemente.length; i++) {
			meineElemente[i].style.display = "none";
		}
		
		//$('#'+id).fadeIn(100);
		document.getElementById(id).style.display = "block";
	}
</script>



<?php 
// Der Punkt steht für das Verzeichnis, in der auch dieses
// PHP-Programm gespeichert ist
$verzeichnis = "./wp-content/themes/ecjugend20192/blocks/block-ec-landverband-kartengrafik/";
 
// Test, ob es sich um ein Verzeichnis handelt
if ( is_dir ( $verzeichnis ))
{
    // öffnen des Verzeichnisses
    if ( $handle = opendir($verzeichnis) )
    {
        // einlesen der Verzeichnisses
        while (($file = readdir($handle)) !== false)
        {
			if($file != '.' && $file != '..' && $file != '00_NH_EC-Nordheide.png'){
				$a_files[] = $file;
			}
            
        }
        closedir($handle);
    }
}
natsort($a_files);
//pf($a_files);
for/*TODO:refactor each()*/ each($a_files as $karten)[
	$s_kartenbilder .= '<img id="'.$karten.'" class="kartenbild" style="display: none;width: 100%;max-width: 400px;margin-left: auto;margin-right: auto;" src="/wp-content/themes/ecjugend20192/blocks/block-ec-landverband-kartengrafik/'.$karten.'" />';
]

?>

<div class="inhalts_container_mittig_max_width">
<div class="section group">
	<div class="col span_1_of_2">
		<div id="landkarte_div" style="">
		<img id="00_NH_EC-Nordheide.png" class="kartenbild" style="display: none;width: 100%;max-width: 400px;margin-left: auto;margin-right: auto;" src="/wp-content/themes/ecjugend20192/blocks/block-ec-landverband-kartengrafik/00_NH_EC-Nordheide.png" alt="?" title="?" />
		<?php echo $s_kartenbilder; ?>
		</div>
	</div>
	<div class="col span_1_of_2">
		
				<div class="lv_zeile"><a onmouseover="karte_einblenden('01_NH_EC-Drennhausen.png');" href="https://www.instagram.com/ecwinsendrennhausen/" target="_blank" rel="noreferrer noopener" aria-label=" (öffnet in neuem Tab)">EC Drennhausen</a></div>
				<div class="lv_zeile"><a onmouseover="karte_einblenden('02_NH_EC-Winsen.png');" href="https://www.instagram.com/ecwinsendrennhausen/" target="_blank" rel="noreferrer noopener" aria-label=" (öffnet in neuem Tab)">EC Winsen</a></div>
				<div class="lv_zeile"><a onmouseover="karte_einblenden('03_NH_EC-Pattensen.png');" href="https://www.instagram.com/ec_pattensen/" target="_blank" rel="noreferrer noopener" aria-label=" (öffnet in neuem Tab)">EC Pattensen</a></div>
				<div class="lv_zeile"><a onmouseover="karte_einblenden('04_NH_EC-Ohlendorf.png');" href="https://www.instagram.com/ecohlendorf/" target="_blank" rel="noreferrer noopener" aria-label=" (öffnet in neuem Tab)">EC Ohlendorf</a></div>
				<div class="lv_zeile"><a onmouseover="karte_einblenden('05_NH_EC-Brackel.png');" href="https://www.instagram.com/ec_brackel/" target="_blank" rel="noreferrer noopener" aria-label=" (öffnet in neuem Tab)">EC Brackel</a></div>
				<div class="lv_zeile"><a onmouseover="karte_einblenden('06_NH_EC-Gödenstorf.png');" href="https://www.instagram.com/ec_goedenstorf/" target="_blank" rel="noreferrer noopener" aria-label=" (öffnet in neuem Tab)">EC Gödenstorf</a></div>
				<div class="lv_zeile"><a onmouseover="karte_einblenden('07_NH_EC-Hützel.png');" href="https://www.instagram.com/echuetzel/" target="_blank" rel="noreferrer noopener" aria-label=" (öffnet in neuem Tab)">EC Hützel</a></div>
				<div class="lv_zeile"><a onmouseover="karte_einblenden('08_NH_EC-Fintel.png');" href="https://instagram.com/ecfintel/" target="_blank" rel="noreferrer noopener" aria-label=" (öffnet in neuem Tab)">EC Fintel</a></div>
				<div class="lv_zeile"><a onmouseover="karte_einblenden('09_NH_EC-Visselhövede.png');" href="https://www.instagram.com/ec_visselhoevede/" target="_blank" rel="noreferrer noopener" aria-label=" (öffnet in neuem Tab)">EC Visselhövede</a></div>
</div>
</div>

<script>
/*initial erste leere karte einblenden*/
//$(document).ready(function(){
	karte_einblenden('00_NH_EC-Nordheide.png');
//});
</script>