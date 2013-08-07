<?php
/*
Plugin Name: Rich Text
Plugin URI: #
Description: Rich Text Module For MiniMax
Author: Shaon
Version: 1.6
Author URI: #
*/

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
      //*.cke_skin_kama .cke_dialog .cke_dialog_body { z-index: 9999999 !important; }*/
      </style>

        <div id="tabpane">
 
        <p>

            <a  href="#" class="button" id="iimg" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a><br/>
        <textarea style="width: 100%;height:300px" class="<?php echo $this->get_field_id('content'); ?>"   id="<?php echo $this->get_field_id('content'); ?>" cols="40" rows="" name="<?php echo $this->get_field_name('content');?>">
        <?php
        echo $content;
        ?>
        </textarea>
        <!--<div id="poststuff">
        <?php /*the_editor("a123","a123"); */?>

         </div>-->

            <script type="text/javascript">
                <?php /*
                //<![CDATA[
                var fcbase = '<?php echo plugins_url('minimax/modules/richtext/ckeditor/plugins'); ?>';
                // Replace the <textarea id="editor1"> with an CKEditor instance.
                try{

                    var editor = CKEDITOR.replace( '<?php echo $this->get_field_id('content'); ?>'); } catch(err){
                    CKEDITOR.remove(editor);
                    var editor = CKEDITOR.replace( '<?php echo $this->get_field_id('content'); ?>');
                }



                // ]]>
                */ ?>



            </script>
            <script type="text/javascript">
                tinymce.init({
                    selector: "#<?php echo $this->get_field_id('content'); ?>",
                    relative_urls: false,
                    remove_script_host: false,
                    convert_urls: false
                });
            </script>

            <script type="text/javascript">

                jQuery(document).ready(function() {

                    // Uploading files
                    var file_frame;
                    jQuery('#TB_closeWindowButton').live('click',function(){
                        tb_remove();
                        jQuery('#TB_window').remove(); 
                    });
                    jQuery('#iimg').live('click', function( event ){
                        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');return false;

                        /*event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if ( file_frame ) {
                            file_frame.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame = wp.media.frames.file_frame = wp.media({
                            title: jQuery( this ).data( 'uploader_title' ),
                            button: {
                                text: jQuery( this ).data( 'uploader_button_text' ),
                            },
                            multiple: false  // Set to true to allow multiple files to be selected
                        });

                        // When an image is selected, run a callback.
                        file_frame.on( 'select', function() {
                            // We set multiple to false so only get one image from the uploader
                            attachment = file_frame.state().get('selection').first().toJSON();

                            editor.insertHtml("<img src='"+attachment.url+"' style='max-width:100%'/>");

                            file_frame.close();

                            // Do something with attachment.id and/or attachment.url here
                        });

                        // Finally, open the modal
                        file_frame.open();*/
                    });

                    window.send_to_editor = function(html) {
                        tinymce.activeEditor.execCommand('mceInsertContent', false, html);
                        //editor.insertHtml(html);
                        //jQuery('#upload_image').val(imgurl);
                        tb_remove();
                        jQuery('#TB_window').remove();
                    }





                });



            </script>
            <style type="text/css">
            #TB_overlay,
            #TB_load{
                z-index:302 !important;
            }
            #TB_window{
                z-index:303 !important;
            }
            #TB_title:not(:first-child){
                display: none;
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

add_action( 'init', 'get_all_images');
add_action( 'widgets_init', create_function( '', 'register_widget("MiniMax_RichText");' ) );

}
