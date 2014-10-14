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
    <div class="spacing">
    <div class="ms-margin">
        <p style="position: absolute;left: 3%;margin: 0px;">Margin</p>
        <input class="top_set" type="text" name="ls[margin_top]" value="<?php echo $ls['margin_top']?$ls['margin_top']:"0";?>"  >
        <input class="right_set" type="text" name="ls[margin_right]" value="<?php echo $ls['margin_right']?$ls['margin_right']:"0";?>"  >
        <input class="bottom_set" type="text" name="ls[margin_bottom]" value="<?php echo $ls['margin_bottom']?$ls['margin_bottom']:"0";?>"  >
        <input class="left_set" type="text" name="ls[margin_left]" value="<?php echo $ls['margin_left']?$ls['margin_left']:"0";?>"  >
        
        <div class="ms-border">
            <p style="position: absolute;left: 3%;margin: 0px;">Border</p>
            <input class="top_set" type="text" name="ls[border_top]" value="<?php echo $ls['border_top']?$ls['border_top']:"0";?>"  >
            <input class="right_set" type="text" name="ls[border_right]" value="<?php echo $ls['border_right']?$ls['border_right']:"0";?>"  >
            <input class="bottom_set" type="text" name="ls[border_bottom]" value="<?php echo $ls['border_bottom']?$ls['border_bottom']:"0";?>"  >
            <input class="left_set" type="text" name="ls[border_left]" value="<?php echo $ls['border_left']?$ls['border_left']:"0";?>"  >

            <div class="ms-padding">
                <p style="position: absolute;left: 3%;margin: 0px;">Padding</p>
                <input class="top_set" type="text" name="ls[padding_top]" value="<?php echo $ls['padding_top']?$ls['padding_top']:"0";?>"  >
                <input class="right_set" type="text" name="ls[padding_right]" value="<?php echo $ls['padding_right']?$ls['padding_right']:"0";?>"  >
                <input class="bottom_set" type="text" name="ls[padding_bottom]" value="<?php echo $ls['padding_bottom']?$ls['padding_bottom']:"0";?>"  >
                <input class="left_set" type="text" name="ls[padding_left]" value="<?php echo $ls['padding_left']?$ls['padding_left']:"0";?>"  >

                <div class="ms-core">
                    <p style="padding: 5px;">Row Contents</p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <p>
        <label>Row CSS Class:</label>
        <input class="widefat" type="text" name="ls[css_class]" value="<?php echo $ls['css_class']; ?>">
        ( If you want to apply CSS from specific class, write the class name in this field )
    </p>

    <p>
        <input type="submit" class="ui-button ui-widget ui-state-default ui-corner-all btn5x" value="Save Settings" />
        <input type="button" onclick='jQuery("#dialog").dialog("close");jQuery("#dialog").html("Loading...");' class="ui-button ui-widget ui-state-default ui-corner-all" value="Cancel" />
    </p>

</form>