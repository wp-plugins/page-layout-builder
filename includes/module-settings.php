<style type="text/css">
    .btn5x{
        -webkit-border-radius: 5px !important;
        -moz-border-radius: 5px !important;
        border-radius: 5px !important;
    }
    .spacing *{
        margin: 40px 45px;
    }
    .ms-margin{
        border:1px dashed #7a7a7a;
        width: 100%;
        position: relative;
        margin: 1px;
    }
    .ms-border{
        border:1px dotted #7a7a7a;
        background: #f3f3f3;
        position: relative;
    }
    .ms-padding{
        border:1px solid #7a7a7a;
        background: #e5e5e5;
        position: relative;
    }
    .ms-core{
        border:1px solid #7a7a7a;
        background: #7A7A7A;
        text-transform: uppercase;
        text-align: center;
        color: #fff;
    }
    .top_set{
        left: 50%;
        top: 2%;
        width: 33px;
        text-align: center;
    }
    .bottom_set{
        left: 50%;
        bottom: 2%;
        width: 33px;
        text-align: center;
    }
    .right_set{
        top: 50%;
        right: 1%;
        width: 33px;
        margin-top: -10px;
        text-align: center;
    }
    .left_set{
        top: 50%;
        left: 1%;
        width: 33px;
        margin-top: -10px;
        text-align: center;
    }
    .spacing input[type="text"] {
        position: absolute;
        text-align: center;
        height: 24px;
        width: 34px;
        margin: 0px;
        border: 1px solid #BDBDBD;
        font-size: 11px;
        line-height: 11px;
        padding: 3px 0px;
        border-radius: 3px;
    }
    p,p label{
        font-size: 13px;
    }
</style>

<script type='text/javascript'>
    jQuery(document).ready(function($) {
        jQuery('.myclrpkr').wpColorPicker();
    });
</script>

    <p>
        <label> Background</label><br/>
        <input type="text" class="myclrpkr" name="ms[bg_color]" value="<?php echo $ms['bg_color'];?>"  > 
    </p>
    <p>
        <label> Text Color</label> <br/>
        <input type="text" class="myclrpkr" name="ms[tx_color]" value="<?php echo $ms['tx_color'];?>"  > 
    </p>
    <p>
        <label> Border</label> <br/>
        <input type="text" class="myclrpkr" name="ms[border_color]" value="<?php echo $ms['border_color'];?>"  > 
    </p> 
    <div class="spacing">
    <div class="ms-margin">
        <p style="position: absolute;left: 3%;margin: 0px;">Margin</p>
        <input class="top_set" type="text" name="ms[margin_top]" value="<?php echo $ms['margin_top']?$ms['margin_top']:"0";?>"  >
        <input class="right_set" type="text" name="ms[margin_right]" value="<?php echo $ms['margin_right']?$ms['margin_right']:"0";?>"  >
        <input class="bottom_set" type="text" name="ms[margin_bottom]" value="<?php echo $ms['margin_bottom']?$ms['margin_bottom']:"0";?>"  >
        <input class="left_set" type="text" name="ms[margin_left]" value="<?php echo $ms['margin_left']?$ms['margin_left']:"0";?>"  >
        
        <div class="ms-border">
            <p style="position: absolute;left: 3%;margin: 0px;">Border</p>
            <input class="top_set" type="text" name="ms[border_top]" value="<?php echo $ms['border_top']?$ms['border_top']:"0";?>"  >
            <input class="right_set" type="text" name="ms[border_right]" value="<?php echo $ms['border_right']?$ms['border_right']:"0";?>"  >
            <input class="bottom_set" type="text" name="ms[border_bottom]" value="<?php echo $ms['border_bottom']?$ms['border_bottom']:"0";?>"  >
            <input class="left_set" type="text" name="ms[border_left]" value="<?php echo $ms['border_left']?$ms['border_left']:"0";?>"  >

            <div class="ms-padding">
                <p style="position: absolute;left: 3%;margin: 0px;">Padding</p>
                <input class="top_set" type="text" name="ms[padding_top]" value="<?php echo $ms['padding_top']?$ms['padding_top']:"0";?>"  >
                <input class="right_set" type="text" name="ms[padding_right]" value="<?php echo $ms['padding_right']?$ms['padding_right']:"0";?>"  >
                <input class="bottom_set" type="text" name="ms[padding_bottom]" value="<?php echo $ms['padding_bottom']?$ms['padding_bottom']:"0";?>"  >
                <input class="left_set" type="text" name="ms[padding_left]" value="<?php echo $ms['padding_left']?$ms['padding_left']:"0";?>"  >

                <div class="ms-core">
                    <p style="padding: 5px;">MiniMax Module</p>
                </div>
            </div>
        </div>
    </div>
    </div>
    <p>
        <label>Add CSS Class to this Module:</label>
        <input class="widefat" type="text" name="ms[css_class]" value="<?php echo $ms['css_class']; ?>">
        ( If you want to apply CSS from specific class, write the class name in this field )
    </p>
