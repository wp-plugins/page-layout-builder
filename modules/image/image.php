<?php
 

class MiniMax_Image extends WP_Widget {
    /** constructor */
    function __construct() {
        parent::WP_Widget( /* Base ID */'MiniMax_Image', /* Name */'Image', array( 'description' => 'Image Module for Page Layout Builder' ) );
         if(!is_admin()){
            wp_enqueue_style("minimax-image",  plugins_url().'/page-layout-builder/modules/image/image.css');
        }
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
         
         $style =  $instance['style'] ;
         $fn = "image_$style";
         $this->{$fn}($args, $instance);
    }

    function preview($instance){
        extract($instance);
        echo "<div class='widget'>";

        ?>

        <div class="media">
            <a href="#" class="pull-left thumbnail" style="margin-right: 5px !important;">
                <img class="imgbr" src="<?php echo MX_THEME_URL."timthumb.php?src=".urlencode($url)."&w=50&h=50"; ?>" title="<?php echo $title; ?>" alt="<?php echo $alt; ?>">
            </a>
            <div class="meida-body" style="padding-top:5px !important;">
                <h3 class='media-heading'><i class="icon icon-th"></i> <?php echo $title; ?></h3>
                <?php /* <p><?php echo $desc; ?></p> */ ?>
                <i class="icon icon-link"></i> <?php echo $link; ?><br/>
                <i class='icon icon-resize-horizontal'></i> Width: <?php echo $imgw;?> <i class='icon icon-resize-vertical'></i> Height: <?php echo $imgh;?>
            </div>

        </div>
        <div style="clear: both;"></div>

        <?php
        echo "</div>";
    }
    
    function image_2l($args, $instance){
        extract( $args );       
        $title =  $instance['title'] ;
        $desc =  $instance['desc'] ;
        $url =  $instance['url'] ;
        $link =  $instance['link'] ;
        $w =  $instance['imgw'] ;
        $h =  $instance['imgh'] ;        
        $titleh =  $instance['titleh'] ;        
        $content =  $instance['content'] ;        
        $id = uniqid();
        echo $before_widget;
        if ( !empty( $title1 ) ) { echo $before_title . $title . $after_title; } 
        ?>
        <div class="media">
        <a href="<?php echo $link; ?>" class="pull-left">
        <img class="img-<?php echo $instance['bootstrap_style'];?>" src="<?php if($w && $h)echo base_theme_url."/includes/timthumb.php?src={$url}&w={$w}&h={$h}";else echo $url; ?>" title="<?php echo $title; ?>" alt="<?php echo $alt; ?>">
        </a>
        
        <div  class="media-body" id="mx-img-txt-<?php echo $id; ?>">
        <<?php echo $titleh; ?>><a href="<?php echo $link; ?>"><?php echo $title; ?></a></<?php echo $titleh; ?>>
        <p><?php echo $desc; ?></p>         
        </div>
        </div>          
        <?php
         echo $after_widget;         
    }
    
    function image_2r($args, $instance){
        extract( $args );       
        $title =  $instance['title'] ;
        $desc =  $instance['desc'] ;
        $url =  $instance['url'] ;
        $link =  $instance['link'] ;
        $w =  $instance['imgw'] ;
        $h =  $instance['imgh'] ;        
        $titleh =  $instance['titleh'] ;        
        $content =  $instance['content'] ;        
        $id = uniqid();
        echo $before_widget;
        if ( !empty( $title1 ) ) { echo $before_title . $title . $after_title; } 
        ?>
        <div class="media">
        <a href="<?php echo $link; ?>" class="pull-right">
        <img class="img-<?php echo $instance['bootstrap_style'];?>" src="<?php if($w && $h)echo base_theme_url."/includes/timthumb.php?src={$url}&w={$w}&h={$h}";else echo $url; ?>" title="<?php echo $title; ?>" alt="<?php echo $alt; ?>">
        </a>
        
        <div  class="media-body" id="mx-img-txt-<?php echo $id; ?>">
        <<?php echo $titleh; ?>><a href="<?php echo $link; ?>"><?php echo $title; ?></a></<?php echo $titleh; ?>>
        <p><?php echo $desc; ?></p>         
        </div>
        </div>
        <?php
         echo $after_widget;         
    }
    
  function image_1t($args, $instance){
        extract( $args );       
        $title =  $instance['title'] ;
        $desc =  $instance['desc'] ;
        $url =  $instance['url'];
        $link =  $instance['link'] ;
        $w =  $instance['imgw'] ;
        $h =  $instance['imgh'] ;        
        $titleh =  $instance['titleh'] ;        
        $content =  $instance['content'] ;        
        $id = uniqid();
        echo $before_widget;
        if ( !empty( $title1 ) ) { echo $before_title . $title . $after_title; } 
        ?>
           
        <a href="<?php echo $link; ?>">
        <img class="img-<?php echo $instance['bootstrap_style'];?>" src="<?php if($w && $h)echo base_theme_url."/includes/timthumb.php?src={$url}&w={$w}&h={$h}";else echo $url; ?>" title="<?php echo $title; ?>" alt="<?php echo $title; ?>">
        </a>         
        <<?php echo $titleh; ?>><a href="<?php echo $link; ?>"><?php echo $title; ?></a></<?php echo $titleh; ?>>
        <p><?php echo $desc; ?></p>                  
        <?php
         echo $after_widget;         
    }
    
  
  function image_1l($args, $instance){
        extract( $args );       
        $title =  $instance['title'] ;
        $desc =  $instance['desc'] ;
        $url =  $instance['url'] ;
        $link =  $instance['link'] ;
        $w =  $instance['imgw'] ;
        $h =  $instance['imgh'] ;        
        $titleh =  $instance['titleh'] ;        
        $content =  $instance['content'] ;        
        $id = uniqid();
        echo $before_widget;
        if ( !empty( $title1 ) ) { echo $before_title . $title . $after_title; } 
        ?>
        <<?php echo $titleh; ?>><a href="<?php echo $link; ?>"><?php echo $title; ?></a></<?php echo $titleh; ?>> 
        <a href="<?php echo $link; ?>" class="pull-left" style="margin-right: 10px;margin-top: 5px;">
        <img class="img-<?php echo $instance['bootstrap_style'];?>" src="<?php if($w && $h)echo base_theme_url."/includes/timthumb.php?src={$url}&w={$w}&h={$h}";else echo $url; ?>" title="<?php echo $title; ?>" alt="<?php echo $title; ?>">
        </a>                 
        <p><?php echo $desc; ?></p>                  
        <?php
         echo $after_widget;         
    }
    
  
 function image_1r($args, $instance){
        extract( $args );       
        $title =  $instance['title'] ;
        $desc =  $instance['desc'] ;
        $url =  $instance['url'] ;
        $link =  $instance['link'] ;
        $w =  $instance['imgw'] ;
        $h =  $instance['imgh'] ;        
        $titleh =  $instance['titleh'] ;        
        $content =  $instance['content'] ;        
        $id = uniqid();
        echo $before_widget;
        if ( !empty( $title1 ) ) { echo $before_title . $title . $after_title; } 
        ?>
        <<?php echo $titleh; ?>><a href="<?php echo $link; ?>"><?php echo $title; ?></a></<?php echo $titleh; ?>> 
        <a href="<?php echo $link; ?>" class="pull-right" style="margin-left: 10px;margin-top: 5px;">
        <img class="img-<?php echo $instance['bootstrap_style'];?>" src="<?php if($w && $h)echo base_theme_url."/includes/timthumb.php?src={$url}&w={$w}&h={$h}";else echo $url; ?>" title="<?php echo $title; ?>" alt="<?php echo $title; ?>">
        </a>                 
        <p><?php echo $desc; ?></p>                  
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
            extract($instance);
        }
        else {
            //$title1 = __( 'New title', 'text_domain' );
        }
        //print_r($instance['content']);
        ?>
        <style type="text/css">
        #TB_window{
            z-index:99999999;
        }
        </style>
        <div id="tabpane">
 
        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('titleh'); ?>"><?php _e('Title Tag:'); ?></label> 
        <select class="widefat" id="<?php echo $this->get_field_id('titleh'); ?>" name="<?php echo $this->get_field_name('titleh'); ?>">
        <option value="h1">H1</option>
        <option value="h2" <?php if($titleh=='h2') echo 'selected=selected'; ?> >H2</option>
        <option value="h3" <?php if($titleh=='h3') echo 'selected=selected'; ?> >H3</option>
        <option value="h4" <?php if($titleh=='h4') echo 'selected=selected'; ?> >H4</option>
        </select>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Description:'); ?></label> 
        <textarea class="widefat" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>" ><?php echo $desc; ?></textarea>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Image URL:'); ?></label> <Br/>
        <input style="width: 90%" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" /><input type="button" style="font-size: 10px;" value="Browse" onclick="mediaupload('<?php echo $this->get_field_id('url'); ?>')" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link URL:'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
        </p>
        <p>
        <label><?php _e('Dimension :'); ?></label> <br/>
        Width: <input id="<?php echo $this->get_field_id('imgw'); ?>" name="<?php echo $this->get_field_name('imgw'); ?>" type="text" value="<?php echo $imgw; ?>" />
        Height: <input id="<?php echo $this->get_field_id('imgh'); ?>" name="<?php echo $this->get_field_name('imgh'); ?>" type="text" value="<?php echo $imgh; ?>" />
        </p>
        <p>
        Template:
        <select class="widefat" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="text">
        <option value="2l" <?php if($style=='2l') echo 'selected=selected'; ?> >Style 1 (2 col, Image Left)</option>
        <option value="1t" <?php if($style=='1t') echo 'selected=selected'; ?> >Style 2 (1 col, Image Top)</option>
        <option value="2r" <?php if($style=='2r') echo 'selected=selected'; ?> >Style 3 (2 col, Image Right)</option>
        <option value="1l" <?php if($style=='1l') echo 'selected=selected'; ?> >Style 4 (1 Col, Image Left)</option>
        <option value="1r" <?php if($style=='1r') echo 'selected=selected'; ?> >Style 5 (1 Col, Image Right)</option>
        </select>
        </p>
        <p>
        Image Style:
        <select class="widefat" id="<?php echo $this->get_field_id('bootstrap_style'); ?>" name="<?php echo $this->get_field_name('bootstrap_style'); ?>" type="text">
        <option value="rounded" <?php if($bootstrap_style=='rounded') echo 'selected=selected'; ?> >Rounded</option>
        <option value="circle" <?php if($bootstrap_style=='circle') echo 'selected=selected'; ?> >Circle </option>
        <option value="polaroid" <?php if($bootstrap_style=='polaroid') echo 'selected=selected'; ?> >Polaroid </option>
        
        </select>
        </p>
        </div>
   
        <?php 
    }

} // class Foo_Widget


add_action( 'widgets_init', create_function( '', 'register_widget("minimax_image");' ) );
 
