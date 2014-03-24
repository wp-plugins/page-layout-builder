<?php
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-accordion');
?>
<div class="accordion">
        <?php
    if($title){
        $cnt=0;
        foreach($title as $key=>$val){ 
            if($val!='')  {
                 $pimg = get_post($val);
?>
    <h3><a href="#" title="tab<?php echo ++$cnt;?>"><?php echo $pimg->post_title;?></a></h3>
    <div id="tab<?php echo $cnt;?>"><?php echo htmlspecialchars_decode(stripcslashes($pimg->post_content));?></div>
 <?php
            }
        }
    }
?>
   

</div>
<script>
    jQuery(function() {
        //jQuery( "#accordion" accordion();
        jQuery(".accordion").accordion({ header: "h3",autoHeight: false, navigation: true });
    });
</script>