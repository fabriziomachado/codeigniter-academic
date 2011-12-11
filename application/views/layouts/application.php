<!DOCTYPE html>
<html lang="pt-br">
    <head>
         <meta charset="utf-8">
         <title>{title_for_layout}</title>
         {css_for_layout}
         {js_for_layout}
         <!--[if lt IE 8]><link rel="stylesheet" href="assets/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
    </head>
    <body>
    <div id="all">	
         <?= render_partial('layouts/_notify.php'); ?>
         <div id="head">

	        <div class="container">
		        <div class="span-10 append-3">App Demo</div>
		        <div class="span-11 last"></div>
	        </div>
        </div>
        <div id="main" class="container showgrid">{content_for_layout}</div>
        
        <div id="footer">
		    <div class="container">
			    <div class="span-21">Av. Universitária, Criciúma - SC</div>
			    <div class="span-3 last">
			     <a href="/codeigniter-academic/index.php/session/twitter">
                    <img src="<?=  base_url() ?>assets/images/sign-in-with-twitter-d.png" /></a>
			    </div>
		    </div>
	    </div>
    </div>
    </body>
</html>
