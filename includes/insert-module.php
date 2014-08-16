<script type="text/javascript" charset="utf-8">
    jQuery(document).ready(function($) {
        
        $("#smdl").keyup(function(){
            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val(), count = 0;

            // Loop through the comment list
            $("#modules li").each(function(){

                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).fadeOut();

                    // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $(this).fadeIn();
                    count++;
                }
            });
            // Update the count
            var numberItems = count;
        });
    });
</script>
<style>

    #modules li{
        -webkit-transition: all 600ms ease-in-out;
        -moz-transition: all 600ms ease-in-out;
        -o-transition: all 600ms ease-in-out;
        transition: all 600ms ease-in-out;
    }

</style>
<input type="text" class="widefat" style="padding: 5px 10px;font-size: 12pt" id="smdl" placeholder="Search Module">
<div class="w3eden">
<div class="container-fluid">
<ul id="modules" class="row">
<?php
global $mxwidgets;

foreach($mxwidgets as $id=>$widget){
if($id)    {
?>
<li class="widget col-lg-3 col-md-3 col-sm-6 col-xs-12 mxwdgt" id="<?php echo $id; ?>">
<a href="#" class="insert" rel="<?php echo $id; ?>" wname="<?php echo $widget->name; ?>" title="<?php echo $widget->name; ?>">
<h3 style="margin: 0px" class="widget-title"><?php echo ucfirst($widget->name); ?></h3>
 
<em><small><?php echo $widget->widget_options['description'] ?></small></em>
<div style="clear: both;"></div>
 
</a>
</li>
<?php    
}}
?>
</ul>
</div>
</div>