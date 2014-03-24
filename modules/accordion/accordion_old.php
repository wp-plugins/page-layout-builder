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
class MiniMax_accordion extends WP_Widget {
    /** constructor */
    function __construct() {
        parent::WP_Widget( /* Base ID */'MiniMax_accordion', /* Name */'Accordion', array( 'description' => 'Accordion Widget' ) );        
        if(!is_admin()){
           // wp_enqueue_style("minimax-accordion",base_theme_url.'/modules/accordion/css/accordion.css'));
        }
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        extract( $args );
        //$title = apply_filters( 'widget_title', $instance['title'] );
        $title =  $instance['title'] ;
        
        //$content = apply_filters( 'widget_title', $instance['content'] );
        $content =  $instance['content'] ;
        
        $minimax_options = get_option("wpeden_admin");
        $ui = $minimax_options['general']['ui'];
       
        //print_r($title);
        echo $before_widget;
        
        if($ui=="jquery")include("jquery_accordion.php");
        else include("bootstrap_accordion.php");
        
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
            $content=  $instance['content'] ;
        }
        else {
            //$title1 = __( 'New title', 'text_domain' );
        }
        //print_r($instance['content']);
        ?>
        <div id="tabpane">
        <?php
        if($title){
    for($i=0;$i<count($title);$i++ ){
?>
        <p>
        <label for="<?php echo $this->get_field_id('title1'); ?>"><?php _e('title:'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title'); ?>[]" type="text" value="<?php echo htmlspecialchars(stripcslashes($title[$i])); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('content1'); ?>"><?php _e('Content:'); ?></label> 
        <textarea class="widefat" id="<?php echo $this->get_field_id('content1'); ?>" name="<?php echo $this->get_field_name('content'); ?>[]" ><?php echo htmlspecialchars(stripcslashes($content[$i])); ?></textarea>
        </p>
        <?php
    }
        }else{
            ?>
        <p>
        <label for="<?php echo $this->get_field_id('title1'); ?>"><?php _e('Title:'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title'); ?>[]" type="text" value="" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('content1'); ?>"><?php _e('Content:'); ?></label> 
        <textarea class="widefat" id="<?php echo $this->get_field_id('content1'); ?>" name="<?php echo $this->get_field_name('content'); ?>[]" ></textarea>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('title1'); ?>"><?php _e('Title:'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title'); ?>[]" type="text" value="" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('content1'); ?>"><?php _e('Content:'); ?></label> 
        <textarea class="widefat" id="<?php echo $this->get_field_id('content1'); ?>" name="<?php echo $this->get_field_name('content'); ?>[]" ></textarea>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('title1'); ?>"><?php _e('Title:'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title'); ?>[]" type="text" value="" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('content1'); ?>"><?php _e('Content:'); ?></label> 
        <textarea class="widefat" id="<?php echo $this->get_field_id('content1'); ?>" name="<?php echo $this->get_field_name('content'); ?>[]" ></textarea>
        </p>
        <?php
        }
?>
        
        </div>
        <input type="button" id="addtab_" value="Add Another Accordion" class="button"> 
        <script type="text/javascript">
       
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