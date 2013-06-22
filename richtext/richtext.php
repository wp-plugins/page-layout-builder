<?php
 

if(!class_exists('MiniMax_RichText')){ 

class MiniMax_RichText extends WP_Widget {
    
    function __construct() {   
        global $pagenow;
       // if(get_post_type()!='')
        parent::WP_Widget( /* Base ID */'MiniMax_RichText', /* Name */'Rich Text', array( 'description' => 'Rich Text Editor' ) );
        //else
        //parent::WP_Widget( /* Base ID */'MiniMax_RichText', /* Name */'Rich Text', array( 'description' => 'Rich Text Editor ( Only available with Page Layout Builder )' ) );
        $pagenow = $pagenow?$pagenow:end(explode($_SERVER[PHP_SELF]));         
       if(is_admin()){
           //if(get_post_type()!=''){
            wp_enqueue_script("ckeditor",plugins_url()."/page-layout-builder/richtext/ckeditor/ckeditor.js");
            wp_enqueue_script("jadapter",plugins_url()."/page-layout-builder/richtext/jquery-adapter.js");
           //}
        } 
        
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        extract( $args );
        
        $cssclass =  $instance['cssclass'] ;        
        $content =  $instance['content'] ;
        
        
         
        if ( !empty( $content ) && $cssclass != '' ) { echo "<div class='{$cssclass}'>" . $content . "</div>"; } 
        else if ( !empty( $content ) && $cssclass == '' ) { echo $content; } 
        ?>
        
        <?php
          
    }

    
    function update( $new_instance, $old_instance ) {
        $instance = $new_instance;
       
        return $instance;
    }

   
    function form( $instance ) {
        
        
        if ( $instance ) {
            extract($instance);
        }
        else {
            
        }
        
        ?>  
      <style type="text/css">
      
      .cke_skin_kama { z-index: 999999 !important; }
      .cke_skin_kama .cke_dialog  { z-index: 999999 !important; }
      //*.cke_skin_kama .cke_dialog .cke_dialog_body { z-index: 9999999 !important; }*/
      </style>
       
        <div id="tabpane">
 
        <p>
         
        <textarea class="<?php echo $this->get_field_id('content'); ?>"   id="<?php echo $this->get_field_id('content'); ?>" cols="40" rows="" name="<?php echo $this->get_field_name('content');?>">
        <?php
        echo $content;
        ?>
        </textarea>
        
        <script type="text/javascript">
        //<![CDATA[
            // Replace the <textarea id="editor1"> with an CKEditor instance.
            try{
                
            var editor = CKEDITOR.replace( '<?php echo $this->get_field_id('content'); ?>'/*,{
        toolbar : 'Basic',
        uiColor : '#9AB8F3'
    }*/ ); } catch(err){
        CKEDITOR.remove(editor);
        var editor = CKEDITOR.replace( '<?php echo $this->get_field_id('content'); ?>');
    }
       // ]]>
        
        
        </script> 
        
        
        </p>
         
        <p>        
        <label for="<?php echo $this->get_field_id('cssclass'); ?>"><?php _e('CSS Class Name:'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('cssclass'); ?>" name="<?php echo $this->get_field_name('cssclass'); ?>" type="text" value="<?php echo $cssclass; ?>" />
        </p>
         
        </div>
   
        <?php 
    }

} 

add_action( 'widgets_init', create_function( '', 'register_widget("MiniMax_RichText");' ) );

}
