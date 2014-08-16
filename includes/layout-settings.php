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
    padding: 0px;
    height: 25px;
}
.bottom_set{
    position: absolute;
    left: 50%;
    bottom: 2%;
    width: 33px;
    padding: 0px;
    height: 25px;
}
.right_set{
    top: 50%;
    position: absolute;
    right: 1%;
    width: 33px;
    margin-top: -10px;
    padding: 0px;
    height: 25px;
}
.left_set{
    position: absolute;
    top: 50%;
    left: 1%;
    width: 33px;
    margin-top: -10px;
    padding: 0px;
    height: 25px;
}
</style>

<script type='text/javascript'>
	jQuery(document).ready(function($) {
		$('.myclrpkr').wpColorPicker();
	});
</script>

<form method="post" action="admin-ajax.php" id="layout-settings-form" rel="<?php echo $_GET['layout_settings_id']; ?>" >
    <p>
        <label> Background</label><br/>
        <input type="text" class="myclrpkr" name="ls[bg_color]" value="<?php echo $ls['bg_color'];?>"  > 
    </p>
    <p>
        <label> Text Color</label> <br/>
        <input type="text" class="myclrpkr" name="ls[tx_color]" value="<?php echo $ls['tx_color'];?>"  > 
    </p>
    <p>
        <label> Border</label> <br/>
        <input type="text" class="myclrpkr" name="ls[border_color]" value="<?php echo $ls['border_color'];?>"  > 
    </p>    
    <div style="border:1px dashed #7a7a7a;width: 600px;height: 300px;position: relative;">
        <p style="position: absolute;left: 3%;">Margin</p>
        <input class="top_set" type="text" name="ls[margin_top]" value="<?php echo $ls['margin_top'];?>"  >
        <input class="right_set" type="text" name="ls[margin_right]" value="<?php echo $ls['margin_right'];?>"  >
        <input class="bottom_set" type="text" name="ls[margin_bottom]" value="<?php echo $ls['margin_bottom'];?>"  >
        <input class="left_set" type="text" name="ls[margin_left]" value="<?php echo $ls['margin_left'];?>"  >
        
        <div style="border:1px dotted #7a7a7a;margin: 40px 45px;background: #f3f3f3;position: relative;">
            <p style="position: absolute;left: 3%;">Border</p>
            <input class="top_set" type="text" name="ls[border_top]" value="<?php echo $ls['border_top'];?>"  >
            <input class="right_set" type="text" name="ls[border_right]" value="<?php echo $ls['border_right'];?>"  >
            <input class="bottom_set" type="text" name="ls[border_bottom]" value="<?php echo $ls['border_bottom'];?>"  >
            <input class="left_set" type="text" name="ls[border_left]" value="<?php echo $ls['border_left'];?>"  >

            <div style="border:1px solid #7a7a7a;margin: 40px 45px;background: #e5e5e5;position: relative;">
                <p style="position: absolute;left: 3%;">Padding</p>
                <input class="top_set" type="text" name="ls[padding_top]" value="<?php echo $ls['padding_top'];?>"  >
                <input class="right_set" type="text" name="ls[padding_right]" value="<?php echo $ls['padding_right'];?>"  >
                <input class="bottom_set" type="text" name="ls[padding_bottom]" value="<?php echo $ls['padding_bottom'];?>"  >
                <input class="left_set" type="text" name="ls[padding_left]" value="<?php echo $ls['padding_left'];?>"  >

                <div style="border:1px solid #7a7a7a;margin: 40px 45px;background: #3276d2;text-transform: uppercase;">
                    <p style="text-align: center;padding: 5px;color: #fff;">MiniMax Row Contents</p>
                </div>
            </div>
        </div>
    </div>

    <p>
        <label>Row CSS Class:</label>
        <input class="widefat" type="text" name="ls[css_class]" value="<?php echo $ls['css_class']; ?>">
        ( If you want to apply css from specific class, write the class name in this field )
    </p>

    <p>
        <input type="submit" class="ui-button ui-widget ui-state-default ui-corner-all btn5x" value="Save Settings" />
        <input type="button" onclick='jQuery("#dialog").dialog("close");jQuery("#dialog").html("Loading...");' class="ui-button ui-widget ui-state-default ui-corner-all" value="Cancel" />
    </p>

</form>