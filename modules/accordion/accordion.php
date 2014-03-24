<?php
/*
Plugin Name: Accordion 
Plugin URI: #
Description: Accordion For MiniMax
Author: Shaon
Version: 1.6
Author URI: #
*/

/**
 * Foo_Widget Class
 */
if(!class_exists('MiniMax_accordion')){
class MiniMax_accordion extends WP_Widget {
    /** constructor */
    function __construct() {
        parent::WP_Widget( /* Base ID */'MiniMax_accordion', /* Name */'Accordion', array( 'description' => 'Accordion Widget' ) );        
        if(is_admin()){
           // wp_enqueue_style("minimax-accordion",base_theme_url.'/modules/accordion/css/accordion.css'));
           wp_enqueue_style('accor-css',base_theme_url.'/modules/accordion/my.css');
        }
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        extract( $args );
        //$title = apply_filters( 'widget_title', $instance['title'] );
        $title =  $instance['title'] ;
        
        //$content = apply_filters( 'widget_title', $instance['content'] );
        $content =  $instance['content'] ;
        $pid = $instance['pid'] ;
        $accordion_style = $instance['accordion_style'] ;
        
        
        $minimax_options = get_option("wpeden_admin");
        $ui = $minimax_options['general']['ui'];
       
        //print_r($title);
        echo $before_widget;
        
        if($ui=="jquery")include("jquery_accordion.php");
        else include("bootstrap_accordion.php");
        
        echo $after_widget;
    }

    function preview($instance){

        $title =  $instance['title'] ;

        $content =  $instance['content'] ;
        $pid = $instance['pid'] ;
        $accordion_style = $instance['accordion_style'] ;


        $minimax_options = get_option("wpeden_admin");
        $ui = $minimax_options['general']['ui'];

        echo $before_widget;

        if($ui=="jquery")include("jquery_accordion.php");
        else include("accordion_preview.php");

        echo $after_widget;
    }

    /** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
        $instance = $new_instance;
       
        return $instance;
    }

    /** @see WP_Widget::form */
    function form( $instance ) {
        //print_r($instance);
        extract($instance);
        //if ( $instance ) {
            /*$title =  $instance['title'];
            $content=  $instance['content'] ;
            $pid = $instance['pid'] ;
            $accordion_style = $instance['accordion_style'] ; */
        /*}
        else { */
            //$title1 = __( 'New title', 'text_domain' );
        //}
        //print_r($instance['content']);
        ?>
       <?php
    //get all the images from minimax_accordion post type
    $accordion_posts = get_posts("post_type=minimax_accordion&posts_per_page=-1");
    //print_r($accordion_posts);
    
?>
<!--left box-->
<div style="padding-top: 0;" id="poststuff" class="left_box postbox ">
<h3 class="hndle"><span>Inactive accordion</span></h3>
<ul class="accordion_ul" id="inactive_accordion">
<?php
    foreach($accordion_posts as $key=>$accordion_post){
        $flag=0;
       if($pid){
           for($i=0;$i<count($pid);$i++ ){
               if($accordion_post->ID == $pid[$i]){$flag=1;break;}
           }
       }
        
       
        if($flag==0)
        echo "<li class='ui-state-default' rel='".$accordion_post->ID."' id='p_".$accordion_post->ID."'><accordionle style='padding:0px;margin:0px;'><tr><td style='padding-right:10px;' valign='top'>".$accordion_post->post_title."</td></tr><tr><td style='padding-right:10px;' valign='top'><small class='accordion-small'></small></td></tr></accordionle></li>";
    }
?>
</ul>
</div>
<div  style="padding-top: 0;" id="poststuff" class="right_box postbox " >
<h3 class="hndle"><span>Active accordion</span></h3>
<ul class="accordion_ul" id="active_accordion">
 <?php
        //print_r($pid);
        if(!empty($pid)>0){
    for($i=0;$i<count($pid);$i++ ){
        //saved accordion 
        $pimg = get_post($pid[$i]);
        ?>
        <li class='ui-state-default' rel='<?php echo $pid[$i];?>'><table style='padding:0px;margin:0px;'><tr><td style='padding-right:10px;' valign='top'><?php echo $pimg->post_title; ?></td></tr><tr><td style='padding-right:10px;' valign='top'><small class='accordion-small'></small></td></tr></table><input id="i_<?php echo $pid[$i];?>" name="<?php echo $this->get_field_name('pid'); ?>[]" type="hidden" value="<?php echo $pid[$i]; ?>" /></li>
        
        <?php
    }
        }
?>
</ul>
</div>
Accordion Style <select name="<?php echo $this->get_field_name('accordion_style');?>">
<option value="">Default</option>
<option value="whead-style-2" <?php if(isset($accordion_style) && $accordion_style=="whead-style-2")echo 'selected="selected"';?>>Style1</option>


</select><br />
<div style="clear: both;"></div>
        <script type="text/javascript">                        
        jQuery(document).ready(function(){
            var c = <?php echo count($title)>0?count($title):0; ?>;
            jQuery( "#inactive_accordion, #active_accordion" ).sortable({
                connectWith: ".accordion_ul"
               
            }).disableSelection();
            
            jQuery( "#active_accordion" ).sortable({
                receive: handlereceiveEvent,
                remove: handleremoveEvent
            })
        
            function handlereceiveEvent( event, ui ) {
              var item = ui.item;
              //append item for the slide
              jQuery('#active_accordion').append('<input id="i_' + item.attr('rel') + '" name="<?php echo $this->get_field_name('pid');?>[]" type="hidden" value="' + item.attr('rel') + '" />');
             /* jQuery('#active_accordion').append('<div style="display: none" id="slideinfo_"><input name="<?php echo $this->get_field_name('nivo_title');?>[]" type="hidden" value="' + item.attr('rel_title') + '" /> <input type="hidden"  name="<?php echo $this->get_field_name('nivo_content');?>[]" value="' + item.attr('rel_desc') + '" /><input name="<?php echo $this->get_field_name('nivo_img_url');?>[]" type="hidden" value="' + item.attr('rel_imgurl') + '" /><input   name="<?php echo $this->get_field_name('nivo_link');?>[]" type="hidden" value="' + item.attr('rel_link') + '" /></div>');*/
              //alert( 'The square with class "' + item.attr('id') + '" was dropped onto me!' );
            }
            
            function handleremoveEvent(event, ui){
                 var item = ui.item;
                 //alert( 'The square with class "' + item.attr('rel') + '" was dropped onto me!' );
                jQuery('#i_'+item.attr('rel')).remove();
            }
            window.onload = select_slide('<?php echo $accordion_name;?>');
            
            function select_slide(id){
                
                jQuery('.control').fadeOut();
                jQuery('#'+id+"_control").fadeIn();
            }
            
            jQuery('#<?php echo $this->get_field_id('accordion_name'); ?>').change(function(){
                    jQuery('.control').fadeOut();
                    select_slide(jQuery(this).val());
            });
        
        });
        </script> 
        
        <?php 
    }

} // class Foo_Widget

function accordion_script(){
    ?>
     
<!--<script type="text/javascript">
jQuery(documentready(function() {
       
    jQuery(".accordion"accordion({ header: "h3",autoHeight: false, navigation: true });
    
});
</script>-->
    <?php
}

 

// register Foo_Widget widget

add_action( 'widgets_init', create_function( '', 'register_widget("MiniMax_accordion");' ) );
 
add_action("wp_head","accordion_script");
}