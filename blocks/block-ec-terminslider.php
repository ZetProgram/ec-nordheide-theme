<style>
.gallery-slider{
    max-width:1060px;
    width:100%;
    height:320px;
    position:relative;
    overflow:hidden;
    margin-left:auto;
    margin-right:auto;
}
.images-preview{
    position:absolute;
    left:20px; /* Initial-Offset für die JS-Berechnung */
    line-height:1.5em;
    display:block;
    height:100%;
    white-space:nowrap; /* verhindert Umbruch */
}
@media (max-width:480px) {
    .gallery-slider{ width:300px; }
    .images-preview{ left:-20px; }
}
.images-preview-div{
    position:relative;
    display:inline-block; /* statt float + clearfix */
    width:300px;
    margin:0 20px;
    vertical-align:top;
}
.images-preview img{
    width:300px;
    height:auto;
    position:relative;
    display:block;
}
.controls{
    width:100%;
    height:100%;
    position:relative;
}
.right-arrow, .left-arrow{
    position:absolute;
    top:0;
    bottom:0;
    width:48px;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    user-select:none;
}
.right-arrow{ right:0; color:#4d5258; }
.left-arrow{ left:0;  color:#4d5258; }
.fas, .fa{ color:#4d5258; }
.terminvorschau_teaser{ margin-top:12px; }
.button_runde_ecken a{
    display:inline-block;
    text-decoration:none;
}
</style>

<?php
// Sicherheitshalber $wpdb einbinden
global $wpdb;

$heute = date("Y-m-d");

// Events holen (nur zukünftige/aktuelle)
$a_events = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM " . WP_CALENDAR_TABLE . " WHERE event_end >= %s ORDER BY event_begin ASC",
        $heute
    )
);

$s = '';

// HTML-Builder
if (!empty($a_events)) {
    foreach ($a_events as $z => $a_event) {
        // Post/Thumb
        $postid = url_to_postid($a_event->event_link);
        $thumb  = get_the_post_thumbnail_url($postid, 'medium');
        if (!$thumb) {
            // Fallback (1x1 transparentes GIF) – gerne ersetzen durch eigenes Placeholder-Bild
            $thumb = 'data:image/gif;base64,R0lGODlhAQABAAAAACw=';
        }

        // Datumsteile
        $begin_orig = $a_event->event_begin;
        $ende_orig  = $a_event->event_end;

        // Erwarte vorhandene Helperfunktionen
        $begin_de = function_exists('konvertieren_YYYY_MM_DD_nach_DEdatum') ? konvertieren_YYYY_MM_DD_nach_DEdatum($begin_orig) : esc_html($begin_orig);
        $ende_de  = function_exists('konvertieren_YYYY_MM_DD_nach_DEdatum') ? konvertieren_YYYY_MM_DD_nach_DEdatum($ende_orig)   : esc_html($ende_orig);

        $begin = '';
        $ende  = '';
        if ($begin_orig === $ende_orig) {
            $begin = '<strong>Am </strong>' . esc_html($begin_de);
        } else {
            $begin = '<strong>Vom </strong>' . esc_html($begin_de);
            $ende  = ' <strong>bis </strong>' . esc_html($ende_de);
        }

        $zeit = '';
        if (!empty($a_event->event_time) && $a_event->event_time !== '00:00:00') {
            $zeit = ' <i class="fas fa-clock" aria-hidden="true"></i>' . esc_html($a_event->event_time);
        }

        // Bereite Werte (Escaping)
        $event_link  = esc_url($a_event->event_link);
        $event_title = esc_html($a_event->event_title);
        $event_desc  = wp_kses_post($a_event->event_desc); // Beschreibung kann HTML enthalten

        // EIN Link um das gesamte Kärtchen (keine verschachtelten <a>)
        $s .= '
        <div class="images-preview-div">
            <a style="text-decoration:none;" href="' . $event_link . '" target="_blank" rel="noopener">
                <div style="height:200px; overflow:hidden;">
                    <img alt="" class="img-responsive" src="' . esc_url($thumb) . '">
                </div>

                <div class="terminvorschau_teaser">
                    <div class="button_runde_ecken" style="margin-top:20px;">
                        <span class="">' . $event_title . '</span>
                    </div>
                </div>

                <div class="terminvorschau_meta" style="margin-top:8px;">' . $begin . ' ' . $ende . $zeit . '</div>
                <em>' . $event_desc . '</em>
            </a>
        </div>';
    }
}
?>

<div class="inhalts_container_mittig_max_width">
  <div class="gallery-slider">
    <div class="images-preview" id="images-preview">
      <?php echo $s; ?>
    </div>
    <div class="controls" aria-label="Galerie Navigation">
      <div class="left-arrow"  aria-label="Vorheriges"><i class="fa fa-angle-left fa-3x" aria-hidden="true"></i></div>
      <div class="right-arrow" aria-label="Nächstes"><i class="fa fa-angle-right fa-3x" aria-hidden="true"></i></div>
    </div>
  </div>
</div>

<script>
jQuery(function($){
    const $track = $('#images-preview');
    const $items = $track.find('.images-preview-div');
    const total  = $items.length;

    if (total === 0) return;

    // Maße
    const itemWidth = 300;   // Bildbreite
    const gap       = 40;    // Summe der horizontalen Abstände (links+rechts)
    const step      = itemWidth + gap; // 340px
    const viewportW = $track.closest('.gallery-slider').innerWidth();

    // Track-Breite setzen
    const totalWidth = total * step;
    $track.css('width', totalWidth + 'px');

    // Start-Offset lesen/normalisieren
    const cssLeft = String($track.css('left') || '20px');
    const leftStart = parseInt(cssLeft, 10);
    let index = 0; // aktives Element (0-basiert)
    let animating = false;

    function clamp(val, min, max){ return Math.max(min, Math.min(max, val)); }

    function gotoIndex(newIndex){
        if (animating) return;
        newIndex = clamp(newIndex, 0, total - 1);

        // Zielposition: Start-Offset minus (index * step)
        const targetLeft = leftStart - (newIndex * step);
        animating = true;
        $track.stop(true).animate(
            { left: targetLeft + 'px' },
            {
                duration: 500,
                complete: function(){ animating = false; index = newIndex; }
            }
        );
    }

    // Buttons
    $('.right-arrow').on('click', function(){
        // nach rechts = nächstes Element
        const next = (index + 1) % total; // Loop
        gotoIndex(next);
    });
    $('.left-arrow').on('click', function(){
        const prev = (index - 1 + total) % total; // Loop rückwärts
        gotoIndex(prev);
    });

    // Resize-Handling: Track-Position halten
    let resizeTO;
    $(window).on('resize', function(){
        clearTimeout(resizeTO);
        resizeTO = setTimeout(function(){
            // Nur die Left-Pos neu berechnen, damit die Karte im Viewport bleibt
            gotoIndex(index);
        }, 150);
    });
});
</script>
