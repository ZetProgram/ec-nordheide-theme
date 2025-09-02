<!-- start search form -->
<form method="get" id="searchform" class="searchform" name="searchform" action="<?php bloginfo('url'); ?>/" style="padding: 5px;">
<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="suche_input" />
<i class="fas fa-search pointer" onclick="searchform.submit();"></i>
</form>

<!-- end search form  -->
