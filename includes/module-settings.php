<style type="text/css">
.btn5x{
    -webkit-border-radius: 5px !important;
    -moz-border-radius: 5px !important;
    border-radius: 5px !important;
}

.top_set{
    position: absolute;
    left: 50%;
    top: 2%;
    width: 33px;
}
.bottom_set{
    position: absolute;
    left: 50%;
    bottom: 2%;
    width: 33px;
}
.right_set{
    top: 50%;
    position: absolute;
    right: 1%;
    width: 33px;
    margin-top: -10px;
}
.left_set{
    position: absolute;
    top: 50%;
    left: 1%;
    width: 33px;
    margin-top: -10px;
}
</style>

<script type='text/javascript'>
	jQuery(document).ready(function($) {
		$('.myclrpkr').wpColorPicker();
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
    <div style="border:1px dashed #7a7a7a;width: 600px;height: 300px;position: relative;">
        <p style="position: absolute;left: 3%;">Margin</p>
        <input class="top_set" style="height: 25px;line-height:25px;" type="text" name="ms[margin_top]" value="<?php echo $ms['margin_top']?$ms['margin_top']:"0";?>"  >
        <input class="right_set" style="height: 25px;line-height:25px;" type="text" name="ms[margin_right]" value="<?php echo $ms['margin_right']?$ms['margin_right']:"0";?>"  >
        <input class="bottom_set" style="height: 25px;line-height:25px;" type="text" name="ms[margin_bottom]" value="<?php echo $ms['margin_bottom']?$ms['margin_bottom']:"0";?>"  >
        <input class="left_set" style="height: 25px;line-height:25px;" type="text" name="ms[margin_left]" value="<?php echo $ms['margin_left']?$ms['margin_left']:"0";?>"  >
        
        <div style="border:1px dotted #7a7a7a;margin: 40px 45px;background: #f3f3f3;position: relative;">
            <p style="position: absolute;left: 3%;">Border</p>
            <input class="top_set" style="height: 25px;line-height:25px;" type="text" name="ms[border_top]" value="<?php echo $ms['border_top']?$ms['border_top']:"0";?>"  >
            <input class="right_set" style="height: 25px;line-height:25px;" type="text" name="ms[border_right]" value="<?php echo $ms['border_right']?$ms['border_right']:"0";?>"  >
            <input class="bottom_set" style="height: 25px;line-height:25px;" type="text" name="ms[border_bottom]" value="<?php echo $ms['border_bottom']?$ms['border_bottom']:"0";?>"  >
            <input class="left_set" style="height: 25px;line-height:25px;" type="text" name="ms[border_left]" value="<?php echo $ms['border_left']?$ms['border_left']:"0";?>"  >

            <div style="border:1px solid #7a7a7a;margin: 40px 45px;background: #e5e5e5;position: relative;">
                <p style="position: absolute;left: 3%;">Padding</p>
                <input class="top_set" style="height: 25px;line-height:25px;" type="text" name="ms[padding_top]" value="<?php echo $ms['padding_top']?$ms['padding_top']:"0";?>"  >
                <input class="right_set" style="height: 25px;line-height:25px;" type="text" name="ms[padding_right]" value="<?php echo $ms['padding_right']?$ms['padding_right']:"0";?>"  >
                <input class="bottom_set" style="height: 25px;line-height:25px;" type="text" name="ms[padding_bottom]" value="<?php echo $ms['padding_bottom']?$ms['padding_bottom']:"0";?>"  >
                <input class="left_set" style="height: 25px;line-height:25px;" type="text" name="ms[padding_left]" value="<?php echo $ms['padding_left']?$ms['padding_left']:"0";?>"  >

                <div style="border:1px solid #7a7a7a;margin: 40px 45px;background: #3276d2;text-transform: uppercase;">
                    <p style="text-align: center;padding: 5px;color: #fff;">MiniMax Module</p>
                </div>
            </div>
        </div>
    </div>

    <p>
        <label>Add CSS Class to this Module:</label>
        <input class="widefat" type="text" name="ms[css_class]" value="<?php echo $ms['css_class']; ?>">
        ( If you want to apply css from specific class, write the class name in this field )
    </p>
