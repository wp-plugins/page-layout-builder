<style>
    .widget_minimax_accordion .panel-group .panel{
        border-radius: 0px;
    }
    .widget_minimax_accordion .panel .panel-heading{
        padding: 6px 15px;
    }
    .widget_minimax_accordion .panel-group .panel + .panel{
        margin-top: 2px;
    }
    .widget_minimax_accordion .panel .panel-heading{
        border-radius: 0px;
    }
    .widget_minimax_accordion .panel-heading a:hover,
    .widget_minimax_accordion .panel-heading a:focus{
        text-decoration: none;
        color: #000;
    }
    .widget_minimax_accordion .panel-primary .panel-heading a{
        color: #fff;
    }
</style>
<?php $aid = uniqid(); ?>
<div class="panel-group <?php if($accordion_style)echo $accordion_style;?>" id="accordion<?php echo $aid;?>">
    <?php
    if($pid){
        $cnt = uniqid(); 
        $zi = $xi = 0;
        foreach($pid as $key=>$val){
            if($val!=''){
                $pimg = get_post($val);
        ?>
        <div class="panel panel-<?php echo $accordion_style; ?>">
            <div class="panel-heading">
                <a class="accordion-toggle <?php if($xi++>0) echo "collapsed"; ?>" data-toggle="collapse" data-parent="#accordion<?php echo $aid;?>" href="#collapse<?php echo ++$cnt;?>" ><?php echo $pimg->post_title;?></a>
            </div>
            <div id="collapse<?php echo $cnt;?>" class="panel-body collapse <?php if($zi++==0) echo "in"; ?>">
                    <?php echo wpautop(htmlspecialchars_decode(stripcslashes($pimg->post_content)));?>
            </div>
        </div>
         <?php
            }
        }
    }
?>
   
</div>
