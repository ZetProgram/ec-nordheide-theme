<?php
		$a_ls = hole_lichstrahlen( 1000, 'ec' );

?>
		

		
	<div class="hintergrund_hexagone_gruenverlauf_trapez" id="ec_lichtstrahlen_div" style="margin-bottom: 100px;">
	<div id="dev_out"></div>

		<div class="inhalts_container_mittig_max_width inhalt_auf_hintergrund_mit_hexagonen">
		<div class="section group" style="padding: 0;">
							
					<div class="col span_2_of_2 lichtstrahlen_ueberschrift">
						Lichtstrahlen von heute!
					</div>  
				   

			</div>
		 
			<div class="section group" style="padding: 0;">
					<div class="col span_2_of_2" style="text-align: right;">
						<div class="button_rechts">
							<div class="button_runde_ecken_hell">
								<a href="<?php echo $a_ls['link']; ?>" target="_blank" title="">
								<div class="  "><?php echo $a_ls['bibelstelle']; ?></div>
							</a>
							</div>
						</div>
						
					</div>		
			</div>
			
			<div class="section group" style="padding: 0;">
					<div class="col span_2_of_2 lichtstrahlen_auszug" style="">
						<p>
						<div style="display: block;font-weight: bold;">
						<?php
							echo $a_ls['ueberschrift'];
						?>
						</div>
						<?php
						echo $a_ls['text'];

						?>
						</p>
					</div>		
			</div>
			<div style="font-style: italic;text-align: center;">
			Die "Lichtstrahlen" sind eine tägliche Bibellesehilfe, die der EC schon seit über 100 Jahren veröffentlicht.
			<div >
			<a href="https://play.google.com/store/search?q=lichtstrahlen&c=apps&hl=de" target="_blank"><img src="/wp-content/uploads/2020/03/lichtstrahlen-google-play-store.png" alt="Lichtstrahlen Google Play" title="Lichtstrahlen Google Play" /></a>
			<a href="https://www.apple.com/de/search/Lichtstrahlen?src=serp" target="_blank"><img src="/wp-content/uploads/2020/03/lichtstrahlen-ios-app-store-itunes.png" alt="Lichtstrahlen Apple ITunes" title="Lichtstrahlen Apple ITunes" /></a>
			</div>
			
			</div>
			
		</div>
	</div>
