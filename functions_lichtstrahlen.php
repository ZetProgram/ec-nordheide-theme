<?php
/*
error_reporting(E_ALL ^ E_NOTICE);
	ini_set("display_errors",true);
*/
function hole_lichstrahlen( $wortanzahl = 31, $version = '' ) {

	if ( $version == 'ec' ) {

		$s_ls_link_bibelserver = file_get_contents( 'http://www.ec-jugend.de/public/lichtstrahlen/lichtstrahlen_apis_3.php?ls_bibleserver_url=1' );
		$s_ls_ueberschrift     = file_get_contents( 'http://www.ec-jugend.de/public/lichtstrahlen/lichtstrahlen_apis_3.php?ls_text_ueberschrift=1' );
		$s_ls_text_ganz        = file_get_contents( 'http://www.ec-jugend.de/public/lichtstrahlen/lichtstrahlen_apis_3.php?ls_text_text=1&ls_allow_br=1' );
		$s_ls_bibelstelle      = file_get_contents( 'http://www.ec-jugend.de/public/lichtstrahlen/lichtstrahlen_apis_3.php?ls_text_link=1&ls_no_striptags=1' );
		$s_text                = $s_ls_text_ganz;

		$a_text['ueberschrift'] = $s_ls_ueberschrift;
		$a_text['link']         = $s_ls_link_bibelserver;
		$a_text['text']         = utf8_encode( $s_text );
		$a_text['bibelstelle']  = $s_ls_bibelstelle;
		return $a_text;

	} else {

		$s_ls           = file_get_contents( 'http://www.ec-jugend.de/public/lichtstrahlen/lichtstrahlen_apis_3.php?ls_text_link=1' );
		$s_ls_text_ganz = file_get_contents( 'http://www.ec-jugend.de/public/lichtstrahlen/lichtstrahlen_apis_3.php?ls_text_text=1' );

		$s_text             = '<p class="ls_bibelstelle">' . $s_ls . '</p>';
		$a_ls_text          = explode( ' ', $s_ls_text_ganz );
		$s_ls_text          = implode( ' ', array_slice( $a_ls_text, 0, $wortanzahl ) );
		$s_ls_text_bis_ende = $s_ls_text_ganz;
		$s_text            .= '<p class="ls_text" id="text_teil">' . $s_ls_text . ' ...<br /> <br /><span onclick="ls_einausblenden();"><a href="" onclick="return false">[Weiterlesen]</a></span></p>
		<p class="ls_text" id="text_ganz" style="display: none;">' . $s_ls_text_bis_ende . '<br /> <br /><span onclick="ls_einausblenden();"><a href="" onclick="return false">[Weniger]</a></span></p>';

		return utf8_encode( $s_text );
	}
}
