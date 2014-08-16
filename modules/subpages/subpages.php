<?php
/*
Plugin Name: List Sub-Pages
Plugin URI: #
Description: List Sub-Pages
Author: Shaon
Version: 1.6
Author URI: #
*/  
class MiniMax_subpage extends WP_Widget {
    /** constructor */
    function __construct() {
        parent::WP_Widget( /* Base ID */'minimax_subpage', /* Name */'Subpages', array( 'description' => 'List Sub-Pages' ) );
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        extract( $args );
        $title =  $instance['title'];
        $pageid =  $instance['pageid'];
        $sicon = $instance['sicon'];   
        $xid = uniqid();

        echo $before_widget;
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
        
        if(empty($pageid))$pageid=get_the_ID();
        ?>
        <style type="text/css">.widget_minimax_subpage ul li{list-style:none;}.page-list-<?php echo $xid; ?> li{ list-style:none;padding:0px;margin:0px;padding-left: 20px; background: url('<?php echo base_theme_url.'/modules/subpages/icons/'.$sicon; ?>') left center no-repeat; line-height: 22px; }</style>
        <ul class="page-list-<?php echo $xid; ?>">
        <?php wp_list_pages("title_li=&child_of=$pageid&show_date=modified&date_format=$date_format"); ?>
        </ul>
    
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
        if ( $instance ) {
            $title =  $instance['title'];
            $pageid =  $instance['pageid'];
            $sicon = $instance['sicon'];
            
        }
        else {
           
        }
        //print_r($instance['content']);
        ?>
        <style type="text/css">.icon { cursor: pointer; padding:5px; margin: 5px; border: 1px solid transparent; }.selected{border:1px solid #E77825;background:#FFC7A0;}</style>
        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
       <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" > 
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('pageid_'); ?>"><?php _e('Page Id (Keep empty if you want to show supbpages of current page):'); ?></label> 
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('pageid'); ?>" name="<?php echo $this->get_field_name('pageid'); ?>" value="<?php echo $pageid; ?>" >
        </p>
        <p>
        <label>Icon:</label> <br/>
        <?php 
                $data = scandir(dirname(__FILE__).'/icons'); 
                array_shift($data);
                array_shift($data);                 
                foreach($data as $icon){
                 $sel = $icon==$sicon?'selected':'';
                 echo   "<img class='icon $sel' rel='$icon' src='".base_theme_url.'/modules/subpages/icons/'.$icon."' />";
                }
        ?>
        <input type="hidden" id="<?php echo $this->get_field_id('sicon'); ?>" name="<?php echo $this->get_field_name('sicon'); ?>" value="<?php echo $sicon; ?>" />
        </p> 
        <script language="JavaScript">
        <!--
          jQuery(function(){
              jQuery('img.icon').unbind('click');
              jQuery('img.icon').click(function(){
                  jQuery('#<?php echo $this->get_field_id('sicon'); ?>').val(jQuery(this).attr('rel'));                   
                  jQuery('.icon').removeClass('selected');
                  jQuery(this).addClass('selected');
              });
              
          });
        //-->
        </script>    
        <?php 
    }

} 

add_action( 'widgets_init', create_function( '', 'register_widget("minimax_subpage");' ) );