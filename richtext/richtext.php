<?php
 

if(!class_exists('MiniMax_RichText')){

    function get_all_images(){
        if($_REQUEST['imagejson']!=1) return;
        $query_images_args = array(
            'post_type' => 'attachment', 'post_mime_type' =>'image', 'post_status' => 'inherit', 'posts_per_page' => -1,
        );

        $query_images = new WP_Query( $query_images_args );
        $images = array();
        foreach ( $query_images->posts as $image) {
            //print_r($image); die();
            $images[]= array('thumb'=>plugins_url('/page-layout-builder/timthumb.php?w=100&h=70&src=').wp_get_attachment_url( $image->ID ),'image'=>wp_get_attachment_url( $image->ID ),'folder'=>'');
            //print_r($images); die();
        }
        echo json_encode($images); die();
    }

    get_all_images();

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

            <a  href="#" class="button" id="iimg" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a>
        <textarea class="<?php echo $this->get_field_id('content'); ?>"   id="<?php echo $this->get_field_id('content'); ?>" cols="40" rows="" name="<?php echo $this->get_field_name('content');?>">
        <?php
        echo $content;
        ?>
        </textarea>
        <!--<div id="poststuff">
        <?php /*the_editor("a123","a123"); */?>

         </div>-->

            <script type="text/javascript">
                //<![CDATA[
                var fcbase = '<?php echo plugins_url('page-layout-builder/richtext/ckeditor/plugins'); ?>';
                // Replace the <textarea id="editor1"> with an CKEditor instance.
                try{

                    var editor = CKEDITOR.replace( '<?php echo $this->get_field_id('content'); ?>'/*,{
                        //customConfig : '<?php echo plugins_url('page-layout-builder/richtext/ckeditor/plugins/kcfinder/config.js'); ?>'
                        //"extraPlugins": "imagebrowser",
                        //"imageBrowser_listUrl": "<?php echo home_url('/?imagejson=1');?>"
                    }*/); } catch(err){
                    CKEDITOR.remove(editor);
                    var editor = CKEDITOR.replace( '<?php echo $this->get_field_id('content'); ?>');
                }



                // ]]>


            </script>
            <script type="text/javascript">

                jQuery(document).ready(function() {

                    // Uploading files
                    var file_frame;

                    jQuery('#iimg').live('click', function( event ){

                        event.preventDefault();

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
                        file_frame.open();
                    });





                });



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

add_action( 'init', 'get_all_images');
add_action( 'widgets_init', create_function( '', 'register_widget("MiniMax_RichText");' ) );

}
