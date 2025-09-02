<div class="terminliste">
<?php 
// termine zählen
$a_termine_index = array();

for ($i = 1; $i <= 10; $i++) {
    // block_field(..., false) gibt den Wert zurück (echo't nicht)
    if (block_field('termin-' . $i . '-titel', false) != "") {
        $a_termine_index[] = $i;
    }
}

foreach ($a_termine_index as $i_termin_index) {
    $terminliste_beschreibung_bild_id = 'terminliste_beschreibung_bild_' . $i_termin_index;
    ?>
    
    <div class="section group <?php echo 'termin-' . $i_termin_index; ?> termin">
        <div id="<?php echo 'terminliste_hover_' . $i_termin_index; ?>">
            <div class="col span_1_of_2 terminliste_titel_datum">
                <div class="terminliste_titel">
                    <?php block_field('termin-' . $i_termin_index . '-titel'); ?>
                </div>
                <div class="terminliste_datum">
                    <?php block_field('termin-' . $i_termin_index . '-datum'); ?>
                </div>
            </div>

            <div class="col span_1_of_2 terminliste_beschreibung_bild" id="<?php echo $terminliste_beschreibung_bild_id; ?>">
                <div class="terminliste_beschreibung_bild_container <?php echo 'terminliste_beschreibung_bild_container_' . $i_termin_index; ?>">
                    <div class="terminliste_beschreibung" style="width: 80%;">
                        <a href="<?php block_field('termin-' . $i_termin_index . '-link'); ?>" target="_blank" rel="noopener">
                            <img
                                class="img_hexagon_q"
                                style="width: 100%; max-width: 300px; float: left; margin: 5px;"
                                src="<?php block_field('termin-' . $i_termin_index . '-bild'); ?>"
                                alt="<?php echo esc_attr(block_field('termin-' . $i_termin_index . '-titel', false)); ?>"
                                title="<?php echo esc_attr(block_field('termin-' . $i_termin_index . '-titel', false)); ?>"
                            />
                        </a>
                        <?php block_field('termin-' . $i_termin_index . '-beschreibung'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
} // end foreach
?>
</div>
