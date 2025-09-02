<!--
<div class="inhalt_begrenzte_breite_zentriert">
<div class="table-button <?php block_field('ec-button-ausrichtung'); ?>">
	<div class="table-row-button">
		<div class="table-cell-button button_zeichen"></div>
		<a href="<?php block_field('ec-button-url'); ?>" target="<?php block_field('ec-button-link-target'); ?>" title="<?php block_field('ec-button-link-title'); ?>">
			<div class="table-cell-button button_verlauf "><?php block_field('ec-button-beschriftung'); ?></div>
		</a>
	</div>
</div>
</div>
-->
<?php 
$theme = block_field('ec-button-theme',false);
if($theme == ""){
	$theme = 'button_runde_ecken';
}
?>
<div class="inhalt_begrenzte_breite_zentriert">
<div class="<?php block_field('ec-button-ausrichtung'); ?>">
	<div class="<?php echo $theme; ?>">
		<a href="<?php block_field('ec-button-url'); ?>" target="<?php block_field('ec-button-link-target'); ?>" title="<?php block_field('ec-button-link-title'); ?>">
			<div class="  "><?php block_field('ec-button-beschriftung'); ?></div>
		</a>
	</div>
</div>
</div>
