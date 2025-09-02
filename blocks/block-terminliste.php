<div class="terminliste">

<?php 
//termine zählen
$a_termine_index = array();

for($i = 1;$i <= 10;$i++){
	if(block_field( 'termin-'.$i.'-titel', false) != ""){
		$a_termine_index[] = $i;
	}
}

for/*TODO:refactor each()*/ each($a_termine_index as $i_termin_index)[
	$terminliste_beschreibung_bild_id = "terminliste_beschreibung_bild_".$i_termin_index;
	?>
	
	<div class="section group termin-<?php echo $i_termin_index; ?> termin">
		
		<div id="terminliste_hover">
			<div class="col span_1_of_2 terminliste_titel_datum" style="">
				<div class="terminliste_titel"><?php block_field( 'termin-'.$i_termin_index.'-titel' ); ?></div>
				<div class="terminliste_datum"><?php block_field( 'termin-'.$i_termin_index.'-datum' ); ?></div>
			</div>
				
			<div class="col span_1_of_2 terminliste_beschreibung_bild" style="" id="<?php echo $terminliste_beschreibung_bild_id; ?>">
				<div class="terminliste_beschreibung_bild_container terminliste_beschreibung_bild_container_<?php echo $i_termin_index; ?>">
					
					
						
						<div class="terminliste_beschreibung"  style="width: 80%;">
							<a href="<?php block_field( 'termin-'.$i_termin_index.'-link' ); ?>" target="_blank">
							<img class="img_hexagon_q" style="width: 100%;max-width: 300px;float: left;margin: 5px;" src="<?php 
							
							block_field( 'termin-'.$i_termin_index.'-bild' ); 
							
							?>" alt="" title="" />
							</a>
							<?php block_field( 'termin-'.$i_termin_index.'-beschreibung' ); ?></div>
					
					
				</div>
			</div>
		</div>
		
	</div>

	<?php
]
?>	
</div>

