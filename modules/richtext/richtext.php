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
        global $pagenow;
       // if(get_post_type()!='')
        parent::WP_Widget( /* Base ID */'MiniMax_RichText', /* Name */'Rich Text', array( 'description' => 'Rich Text Editor' ) );
        //else
        //parent::WP_Widget( /* Base ID */'MiniMax_RichText', /* Name */'Rich Text', array( 'description' => 'Rich Text Editor ( Only available with Page Layout Builder )' ) );
        //$pagenow = $pagenow?$pagenow:end(explode($_SERVER[PHP_SELF]));         
       if(is_admin() && ($pagenow=='post-new.php' || $pagenow == 'post.php')){
           //if(get_post_type()!=''){
            wp_enqueue_script("ckeditor",plugins_url()."/page-layout-builder/modules/richtext/ckeditor/ckeditor.js");
            wp_enqueue_script("jadapter",plugins_url()."/page-layout-builder/modules/richtext/jquery-adapter.js");

           //}
        } 
        
    }



    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        extract( $args );
        
        $cssclass =  $instance['cssclass'] ;        
        $content =  $instance['content'] ;
        
        
         
        if ( !empty( $content ) && $cssclass != '' ) { echo "<div class='{$cssclass}'>" . $content . "</div>"; } 
        else if ( !empty( $content ) && $cssclass == '' ) { echo wpautop($content); } 
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


                <?php wp_editor($content, 'mcontent', array('editor_class' => 'wp-editor','textarea_name'=>$this->get_field_name('content'), 'media_buttons' => true ) ); ?>
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
    function form1( $instance ) {
        
        
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
                var fcbase = '<?php echo plugins_url('page-layout-builder/modules/richtext/ckeditor/plugins'); ?>';
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

add_action( 'widgets_init', create_function( '', 'register_widget("MiniMax_RichText");' ) );

}
