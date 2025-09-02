<style>
.gallery-slider{
    max-width:1060px;
    width: 100%;
	height:320px;
    position:relative;
    overflow:hidden;
	
	margin-left: auto;
	margin-right: auto;
}

.images-preview{
    width:300px;
    /*height:200px;*/
    position:absolute;
    left:20px;
	line-height: 1.5em;
}

@media (max-width:480px) {
	.gallery-slider{
		width:300px;
	}
	.images-preview{
		left:-20px;
	}
}

.images-preview-div{
	position: relative;
	display: block;
	width: 300px;
	
	 float:left;
	 margin: 0 20px;
}

.images-preview img{
    width:300px;
    position:relative;
    
    
}
.control{
    width:100%;
    height:100%;
    position:relative;
}
.right-arrow, .left-arrow{
    position:absolute;
    
}
.right-arrow i, .left-arrow i{
    line-height:200px;
}
.right-arrow{
    left:0;  
	color: #4d5258;
}
.left-arrow{
    right:0;
	color: #4d5258;
}
.fas{
	color: #4d5258;
}
</style>

<?php
$heute = date("Y-m-d");
//$heute = date("2020-02-12");
//echo $heute;
$a_events = $wpdb->get_results("SELECT * FROM " . WP_CALENDAR_TABLE . " WHERE event_end >= '$heute' ORDER BY event_begin ASC");
$s .= '';

//pf($a_events);
for/*TODO:refactor each()*/ each($a_events as $z => $a_event){
	$postid = url_to_postid($a_event->event_link);
	$thumb = get_the_post_thumbnail_url($postid);

	$begin_orig = $a_event->event_begin;
	$ende_orig = $a_event->event_end;
	
	$begin_de = konvertieren_YYYY_MM_DD_nach_DEdatum($a_event->event_begin);
	$ende_de = konvertieren_YYYY_MM_DD_nach_DEdatum($a_event->event_end);
	
	$begin = '';
	$ende = '';
		
	if($begin_orig == $ende_orig){
		$begin = '<strong>Am </strong>'.$begin_de;
		$ende = "";
	} else {
		$begin = '<strong>Vom </strong>'.$begin_de;
		$ende = '<strong>bis </strong>'.$ende_de;
	}
	
	$zeit = '';
	if($a_event->event_time != "" && $a_event->event_time != "00:00:00"){
		$zeit = ' <i class="fas fa-clock"></i>' . $a_event->event_time .  '';
	}

	$s .= '<div class="images-preview-div">
		<a style="text-decoration: none;" href="'.$a_event->event_link.'">
			<div style="height: 200px; overflow: hidden;">
				<img alt="" class="img-responsive" src="'.$thumb.'">
			</div>
			
			<div class="terminvorschau_teaser">

<div class="button_runde_ecken" style="margin-top: 30px;">
								<a href="'.$a_event->event_link.'" target="_blank" title="">
								<div class="  ">'.$a_event->event_title.'</div>
							</a>
							</div>
							<!--
<div class="table-button button_mitte">
<div class="table-row-button">
<div class="table-cell-button button_zeichen"> </div>
<div class="table-cell-button button_verlauf">'.$a_event->event_title.'</div>
</div>
</div>
-->



</div>

		</a>
		'.$begin.' '.$ende.''.$zeit.'<br />
		<em>'.$a_event->event_desc.'</em>
	</div>
	';
}
?>
<div class="inhalts_container_mittig_max_width">
<div class="gallery-slider ">
           <div class="images-preview" id="images-preview">
			  <?php
echo $s;
			  ?>
           </div>
           <div class="controls">
               <div class="right-arrow"><i class="fa fa-angle-left fa-3x"></i></div>
               <div class="left-arrow"><i class="fa fa-angle-right fa-3x"></i></div>
           </div>
       </div>
</div>
	   
	   <script>
var target = $('.images-preview');
var total = $('.images-preview img').length;
var width = total * 300 + total * 40;
var c = 1;
var left = $("#images-preview").css("left");
var originalLeft = left;

//var originalLeft = 20;/*mobil -20*/
// 300 is the image size, 40 is the total margin
var totalImg = 300 + 40;
var startToEnd = width -originalLeft -340;
var a = '';
var active = false;


target.css('width', width);

 $(".left-arrow").click(function () { 
 	if (active === false){
        if (c === total){
            a = originalLeft;
            c = 1;
        }else{
            a = '-='+totalImg;
            c++;
        }
    
        active = true;
        target.animate(
            {left: a},
            {duration:500,
            complete: function(){
            	active = false;
            }
        });
    }
 });
 $(".right-arrow").click(function () { 
    if (active === false){
        if (c === 1){
            a = '-'+startToEnd;
            c = total;
        }else{
            a = '+='+totalImg;

            c--;
        }
        active = true;
    	target.animate(
            {left: a},
            {duration:500,
            complete: function(){
            	active = false;
            }
        });
    }
 });
</script>

