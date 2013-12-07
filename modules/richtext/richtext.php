<?php
 

if(!class_exists('MiniMax_RichText')){

    

class MiniMax_RichText extends WP_Widget {
    
    function __construct() {   

        parent::WP_Widget( /* Base ID */'MiniMax_RichText', /* Name */'Rich Text', array( 'description' => 'Rich Text Editor' ) );

        
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
      /*.cke_skin_kama .cke_dialog .cke_dialog_body { z-index: 9999999 !important; }*/
      </style>

        <div id="tabpane">
 
        <p>


        <?php wp_editor($content, 'mcontent', array('editor_class' => 'wp-editor','textarea_name'=>$this->get_field_name('content'), 'media_buttons' => false ) ); ?>
<!-- textarea name="mycontent" id="mycontent"></textarea -->


            <script type="text/javascript">
function load_mceeditor($element) {
 
        var textfield_id = $element.attr("id");

        tinymce.EditorManager.execCommand('mceRemoveControl',true, textfield_id);
        window.tinyMCEPreInit.mceInit[textfield_id] = _.extend({}, tinyMCEPreInit.mceInit['content']);

        if(_.isUndefined(tinyMCEPreInit.qtInit[textfield_id])) {
            window.tinyMCEPreInit.qtInit[textfield_id] = _.extend({}, tinyMCEPreInit.qtInit['replycontent'], {id: textfield_id})
        }

        quicktags( window.tinyMCEPreInit.qtInit[textfield_id] );
        //$element.val($content_holder.val());
        //tinymce.EditorManager.execCommand('mceAddControl',true, textfield_id);
        window.switchEditors.go(textfield_id, 'tmce');
    }
 jQuery('#tabpane .wp-editor-area').each(function(){
     load_mceeditor(jQuery(this));
    });
            </script>


            <style type="text/css">

            #TB_overlay,
            #TB_load{
                z-index:4000000001 !important;
            }
            #TB_window{
                z-index:4000000001 !important;
            }
            #TB_title:not(:first-child){
                display: none;
            }
            div#mcontent_forecolor_menu{
                z-index: 4000000001 !important;
            }
             
            </style>
        
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
