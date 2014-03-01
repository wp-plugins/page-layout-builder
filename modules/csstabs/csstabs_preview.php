<?php
/*
Plugin Name: CSS Tab widget
Plugin URI: #
Description: CSS Tab widget
Author: Shaon
Version: 1.6
Author URI: #
*/

/**
 * Foo_Widget Class
 */
class MiniMax_tabwidget extends WP_Widget {
    /** constructor */
    function __construct() {
        parent::WP_Widget( /* Base ID */'minimax_tabwidget', /* Name */'Tabs', array( 'description' => 'Tab Panel' ) );
        if(is_admin()){
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'jquery-ui-core' );
            wp_enqueue_script( 'jquery-ui-sortable' );
            wp_enqueue_style('tab-css',base_theme_url.'/modules/csstabs/csstabs.css');
        }
        
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        
        extract( $args );
        //$title = apply_filters( 'widget_title', $instance['title'] );
        $title =  $instance['title'] ;
        
        //$content = apply_filters( 'widget_title', $instance['content'] );
        $content =  $instance['content'] ;
        $pid =  $instance['pid'] ;
        $tab_style = $instance['tab_style'] ;
        $tab_position = $instance['tab_position'] ;
        
        //print_r($pid);
        echo $before_widget;
        if ( !empty( $title1 ) ) { echo $before_title . $title . $after_title; } 
        ?>
        <div align="center" class="row-fluid <?php echo $tab_style;?> tabbable tabs-<?php echo $tab_position; ?>">
        
       
                <?php
            if($pid){
                $cnt=uniqid();
                $temp=$cnt;
                foreach($pid as $key=>$val){
                   $pimg = get_post($val);
                   if($cnt==$temp) $cls = 'active'; else $cls = "";
                   $ztabs .= "<li class='{$cls}'><a data-toggle='tab' href='#tab{$cnt}' title='{$pimg->post_title}'>{$pimg->post_title}</a></li>";
        ?>
         <?php ++$cnt;
                }
                $ztabs = "<ul id='tabs' class='nav nav-tabs'>{$ztabs}</ul>";
            }
        ?>
           
        <?php if($tab_position!='below') echo $ztabs; ?>
         
        <div class="tab-content <?php if($tab_style) echo "tab-content-3";?>">
                <?php
            if($pid){
                $cntt=$temp;
                foreach($pid as $key=>$val){   
                    $pimg = get_post($val);
        ?>
            <div class="tab-pane <?php if($cntt==$temp)echo 'active';?>" id="tab<?php echo $cntt;?>"><?php echo $pimg->post_content;?></div>
            
          <?php ++$cntt;
                }
            }
        ?>  
        </div>
       <?php if($tab_position=='below') echo $ztabs; ?> 
</div>
<style type="text/css">
.nav-tabs li{
    list-style:none !important;
}
</style>
 
        <?php
         echo $after_widget;
    }

    /** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
        $instance = $new_instance;
       
        return $instance;
    }

    /** @see WP_Widget::form */
    function form( $instance ) {
         extract($instance);  
        /*if ( $instance ) {
            $title =  $instance['title'];
            $content=  $instance['content'] ;
            $pid = $instance['pid'] ;
            $tab_style = $instance['tab_style'] ;
        }
        else {*/
            //$title1 = __( 'New title', 'text_domain' );
        //}
        //print_r($instance['content']);
        ?>
        
        
        
                <?php
    //get all the images from minimax_tabs post type
    $tab_posts = get_posts("post_type=minimax_tabs&posts_per_page=-1");
    //print_r($tabs_posts);
    
?>
<!--left box-->
<div style="padding-top: 0;" id="poststuff" class="left_box postbox ">
<h3 class="hndle"><span>Inactive tabs</span></h3>
<ul class="tab_ul" id="inactive_tabs">
<?php
    foreach($tab_posts as $key=>$tab_post){
        $flag=0;
       if($pid){
           for($i=0;$i<count($pid);$i++ ){
               if($tab_post->ID == $pid[$i]){$flag=1;break;}
           }
       }
        
      
        if($flag==0)
        echo "<li class='ui-state-default' rel='".$tab_post->ID."' id='p_".$tab_post->ID."'><table style='padding:0px;margin:0px;'><tr><td style='padding-right:10px;' valign='top'>".$tab_post->post_title."</td></tr><tr><td style='padding-right:10px;' valign='top'><small class='tab-small'></small></td></tr></table></li>";
    }
?>
</ul>
</div>
<div  style="padding-top: 0;" id="poststuff" class="right_box postbox " >
<h3 class="hndle"><span>Active tabs</span></h3>
<ul class="tab_ul" id="active_tabs">
 <?php
        if(!empty($pid)){
    for($i=0;$i<count($pid);$i++ ){
        //saved tabs 
        $pimg = get_post($pid[$i]);
        ?>
        <li class='ui-state-default' rel='<?php echo $pid[$i];?>'><table style='padding:0px;margin:0px;'><tr><td style='padding-right:10px;' valign='top'><?php echo $pimg->post_title; ?></td></tr><tr><td style='padding-right:10px;' valign='top'><small class='tab-small'></small></td></tr></table><input id="i_<?php echo $pid[$i];?>" name="<?php echo $this->get_field_name('pid'); ?>[]" type="hidden" value="<?php echo $pid[$i]; ?>" /></li>
        
        <?php
    }
        }
?>
</ul>
</div>

Tab Style <select name="<?php echo $this->get_field_name('tab_style');?>">
<option value="">Default</option>
<option value="tab-style-1" <?php if(isset($tab_style) && $tab_style=="tab-style-1")echo 'selected="selected"';?>>Style1</option>
<option value="tab-style-2" <?php if(isset($tab_style) && $tab_style=="tab-style-2")echo 'selected="selected"';?>>Style2</option>
</select><br />
Tab Position <select name="<?php echo $this->get_field_name('tab_position');?>">
<option value="top">Top</option>
<option value="left" <?php if(isset($tab_position) && $tab_position=="left")echo 'selected="selected"';?>>Left</option>
<option value="right" <?php if(isset($tab_position) && $tab_position=="right")echo 'selected="selected"';?>>Right</option>
<option value="below" <?php if(isset($tab_position) && $tab_position=="below")echo 'selected="selected"';?>>Bottom</option>
</select><br />
<div style="clear: both;"></div>
        <script type="text/javascript">                        
        jQuery(document).ready(function(){
            var c = <?php if(isset($title))echo count($title); else echo "0"; ?>;
            jQuery( "#inactive_tabs, #active_tabs" ).sortable({
                connectWith: ".tab_ul"
               
            }).disableSelection();
            
            jQuery( "#active_tabs" ).sortable({
                receive: handlereceiveEvent,
                remove: handleremoveEvent
            })
        
            function handlereceiveEvent( event, ui ) {
              var item = ui.item;
              //append item for the slide
              jQuery('#active_tabs').append('<input id="i_' + item.attr('rel') + '" name="<?php echo $this->get_field_name('pid');?>[]" type="hidden" value="' + item.attr('rel') + '" />');
            
              //alert( 'The square with class "' + item.attr('id') + '" was dropped onto me!' );
            }
            
            function handleremoveEvent(event, ui){
                 var item = ui.item;
                 //alert( 'The square with class "' + item.attr('rel') + '" was dropped onto me!' );
                jQuery('#i_'+item.attr('rel')).remove();
            }
            window.onload = select_slide('<?php echo $tabs_name;?>');
            
            function select_slide(id){
                
                jQuery('.control').fadeOut();
                jQuery('#'+id+"_control").fadeIn();
            }
            
            jQuery('#<?php echo $this->get_field_id('tabs_name'); ?>').change(function(){
                    jQuery('.control').fadeOut();
                    select_slide(jQuery(this).val());
            });
        
        });
        </script>
        <?php 
    }

} // class Foo_Widget

function myscript(){
    ?>
    <link href="<?php echo base_theme_url.'/modules/csstabs/tab-style.css';?>" type="text/css" rel="stylesheet" />
     
<script type="text/javascript">
jQuery(document).ready(function() {
        jQuery("#mcontent div").hide(); // Initially hide all content
        jQuery("#tabs li:first").attr("id","current"); // Activate first tab
        jQuery("#tab1").fadeIn(); // Show first tab content

    jQuery('#tabs a').click(function(e) {
        e.preventDefault();
        jQuery("#mcontent div").hide(); //Hide all content
        jQuery("#tabs li").attr("id",""); //Reset id's
        jQuery(this).parent().attr("id","current"); // Activate this
        jQuery('#' + jQuery(this).attr('title')).fadeIn(); // Show content for current tab
    });
});
</script>
    <?php
}

function my_menu(){
    add_options_page('tab options', 'tab options', 'manage_options', 'tab-options', 'wptab_admin_option1');
}

function wptab_admin_option1(){
    
}

// register Foo_Widget widget
add_action( 'widgets_init', create_function( '', 'register_widget("minimax_tabwidget");' ) );
add_action("admin_menu","my_menu");
add_action("wp_head","myscript");