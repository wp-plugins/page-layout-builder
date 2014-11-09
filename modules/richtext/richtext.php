<?php
/*
  Plugin Name: Rich Text
  Plugin URI: #
  Description: Rich Text Module For MiniMax
  Author: Shaon
  Version: 1.6
  Author URI: #
 */

if (!class_exists('MiniMax_RichText')) {

    class MiniMax_RichText extends WP_Widget {

        function __construct() {
            global $pagenow;
            parent::WP_Widget(/* Base ID */'MiniMax_RichText', /* Name */ 'Rich Text', array('description' => 'Rich Text Editor'));
        }

        /** @see WP_Widget::widget */
        function widget($args, $instance) {
            extract($args);
            $cssclass = $instance['cssclass'];
            $content = $instance['content'];

            if (!empty($content) && $cssclass != '') {
                echo "<div class='{$cssclass}'>" . $content . "</div>";
            } else if (!empty($content) && $cssclass == '') {
                echo $content;
            }
         
        }

        function update($new_instance, $old_instance) {
            $instance = $new_instance;

            return $instance;
        }

        
        function form($instance) {

            if ($instance) {
                extract($instance);
            } else {
                $content = "";
                $cssclass = "";
            }
            ?>
           

            <div id="tabpane">

            <p>

            <?php
            $id = uniqid('e');
            
            wp_editor( $content, $id, array('editor_class' => 'wp-editor',
                                            'textarea_name' => $this->get_field_name('content'),
                                            'textarea_rows' => 15,
                                            'media_buttons' => true
                                            )
                     );
            ?>
                 
                <script type="text/javascript">
                    
                    tinymce.init({
                        selector: "#<?php echo $id;?>",
                        relative_urls: false,
                        plugins: "wplink"
                    });
                    
                    function load_mceeditor($element) {
                        var textfield_id = $element.attr("id");
                        //tinymce.execCommand('mceAddControl',false,textfield_id );
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
                    
            <style>
                .media-modal{ z-index: 999999; }
                .mce-panel.mce-menu { z-index: 1000000 !important; }
                #wp-link-backdrop{ z-index: 1000000 !important; }
                #wp-link-wrap{ z-index: 99999999 !important; }
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

    add_action('widgets_init', create_function('', 'register_widget("MiniMax_RichText");'));
}
