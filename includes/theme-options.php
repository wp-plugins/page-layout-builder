<div class="wrap">
    <h2>MiniMax Modules</h2>
</div>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">

<style>
    .w3eden{
        font-family: 'Open Sans', serif;
        font-size: 10pt;
        color: #555555;
    }
    .w3eden .panel-heading .mod_status{
        width:70px;font-size:9pt;font-weight:300;border-radius:2px;padding:5px;
        margin-top: -1px;
    }
    .w3eden .panel-heading{
        font-size: 11pt;
        font-weight: 900;
        color: #333333;
        line-height: normal;
    }
    .icon-ok{
        color: #008800;
    }
    .icon-remove{
        color: #ff0000;
    }
    a{
        outline: none !important;
    }
    #modpreview .btn,
    #cache .btn{
        opacity: 1 !important;
        width: 80px !important;
    }
    .popover .arrow{
        margin-left: 0 !important;
    }
    .panel-footer .btn{
        width: 90px;
        font-size: 11px;
    }
</style>

<div id="avmodules" class="w3eden">

    <br/>


    <ul class="nav nav-tabs" style="margin-left:-20px;padding-left:20px;">
        <li class="active"><a href="#available" data-toggle="tab">Available Modules</a></li>
        <li><a href="#settings" data-toggle="tab">Settings</a></li>
        <li><a href="#store" data-toggle="tab">Module Store</a></li>
    </ul>
    <div class="tab-content"><br/>
        <div class="container-fluid tab-pane fade in active" id="available">
            <div class="row">
                <!-- div class="col-md-12" -->

                    <!--table class="table table-striped" style="border: 1px solid #dddddd" -->

                        <?php
                        //print_r($minimax_options);
                        $module_dir = MX_THEME_DIR . '/modules/';
                        $modules = scandir($module_dir);
                        $active_modules = get_option("minimax_allowed_modules");
                        foreach ($modules as $module) {
                            $moduledata = array();

                            if ($module != "." && $module != "..") {
                            if (is_dir($module_dir . $module)) {
                                $moduledata = get_plugin_data($module_dir . $module . "/" . $module . ".php");
                            if($moduledata['Version']=='pro_only')
                                $um[] = $module;
                            else
                                $am[] = $module;
                            }}
                        }
                        $modules = array_merge($am, $um);

                        foreach ($modules as $module) {
                            $moduledata = array();

                            if ($module != "." && $module != "..") {
                                if (is_dir($module_dir . $module)) {
                                    $moduledata = get_plugin_data($module_dir . $module . "/" . $module . ".php");

                                    //preg_match("/Plugin([\s]+)Name([\s]+)\:/",$moduledata, $module_name);
                                    //print_r($moduledata);
                                    if ($active_modules[$module]) {
                                        $mod_status = "power_on";
                                        $mod_status_appear = "Active";
                                        $mod_status_cls = "success";
                                        $mod_panel_cls = "default";
                                        $icon = 'Deactivate';
                                    } else {
                                        $mod_status = "power_off";
                                        $mod_status_appear = "Inactive";
                                        $mod_status_cls = "danger";
                                        $mod_panel_cls = "default";
                                        $icon = 'Activate';
                                    }
                                    echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><div class="panel panel-'.$mod_panel_cls." ".str_replace(".","_",$moduledata['Version']).'">'
                                    . '<div class="panel-heading"><b>' . $moduledata['Name'] . '</b> <small id="st_' . $module . '" class="label label-' . $mod_status_cls . ' mod_status mod_status_' . $mod_status_appear . '">' . $mod_status_appear . '</small></div>'
                                    . '<div class="panel-body">' . substr($moduledata['Description'], 0, strpos($moduledata['Description'], "By")) . '</b></div>'
                                    . '<div class = "panel-footer">';
                                    if($moduledata['Version']=='pro_only'){
                                      echo "<button disabled='disabled' class='btn btn-danger btn-xs' style='width: 150px'>Available With Pro Only</button> <a  href='http://wpeden.com/minimax-wordpress-page-layout-builder-plugin/' target='_blank' class='btn btn-primary btn-xs pull-right'>Get Pro <i class='icon icon-chevron-sign-right'></i></a> ";
                                    } else {
                                    echo '<button style="width:80px" status="' . $mod_status . '" type="button" class="mod_name btn btn-xs btn-default text-primary" rel="' . $module . '">' . $icon . '</button>'
                                    . '&nbsp;<a href = "#" class="check-update btn btn-xs btn-default" rel="' . $module . '">Check Update</a>';
                                    }
                                    echo  '</div>'
                                    . '</div>'
                                    . '</div>';
                                    //. '<td>'
                                    //. '<h3 class="widget-title" style="margin: 0px"></h3><small></small></td><td></td></tr>';
                                }
                            }
                        }
                        ?>
                    <!-- /table -->


                <!--/div -->
            </div>
        </div>
        <div class="container-fluid  tab-pane fade" id="settings">
            <div class="row">
                <div class="col-md-12">
                    <label>Module Caching &nbsp;</label>
                    <div class="btn-group" id="cache">
                        <button class="btn btn-<?php echo get_option('minimax_cache_status',0)==1?'success':'default'; ?>" <?php echo get_option('minimax_cache_status',0)==1?'disabled=disabled':''; ?> data-cache="1" id="icahce_1">Active</button>
                        <button class="btn btn-<?php echo get_option('minimax_cache_status',0)==0?'danger':'default'; ?>" <?php echo get_option('minimax_cache_status',0)==0?'disabled=disabled':''; ?> data-cache="0" id="icache_0">Inactive</button>
                    </div>
                </div>
                <div class="col-md-12"><br/>
                    <label>Module Preview &nbsp;</label>
                    <div class="btn-group" id="modpreview">
                        <button class="btn btn-<?php echo get_option('minimax_module_preview',0)==1?'success':'default'; ?>" <?php echo get_option('minimax_module_preview',0)==1?'disabled=disabled':''; ?> data-mpv="1" id="modpreview_1">Active</button>
                        <button class="btn btn-<?php echo get_option('minimax_module_preview',0)==0?'danger':'default'; ?>" <?php echo get_option('minimax_module_preview',0)==0?'disabled=disabled':''; ?> data-mpv="0" id="modpreview_0">Inactive</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid  tab-pane fade" id="store">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">Take MiniMax Builder to a new level of awesomeness with following extensions</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="mxaddon" style="max-width: 251px; background: #fff;padding: 10px; border-radius:4px; margin-right: 45px;border: 1px solid #f3f3f3">
                        <a target="blank" href="http://wpeden.com/product/minimax-modules-pack-1/">
                            <img style="height:auto; max-width: 100%;"class="" alt="MiniMax Modules Pack 1" src="http://cdn.wpeden.com/wp-content/uploads/2014/06/minimax-modules-pack-1-250x250.png">
                        </a>
                        <div class="addon-info" style="background:#F8F8F8;margin-top: 20px;padding: 10px;">
                            <a target="blank" href="http://wpeden.com/product/minimax-modules-pack-1/">
                                <b>MiniMax Modules Pack 1</b>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/template" id="updatenotice">
    Update Available.<br/>
    Current Version: [version]<br/><br/>
    <a href="#" class="btn update-now btn-success" rel="[modulename]">Update Now</a> <a href="#" class="btn close-update-notice">Update Later</a>
</script>  

<script type="text/template" id="noupdate">
    No update available. You are using the latest version.<br/><br/>
    <a href="#" class="btn btn-default btn-sm close-update-notice">Close</a>
</script>

<script type="text/template" id="update-completed">
    MiniMax [modulename] Module has been successfully updated.<br/><br/>
    <a href="#" class="btn close-update-completed-notice">Okay</a>
</script>


<script>
    jQuery('.dropdown-toggle').dropdown();
    jQuery('#cache .btn').on('click', function(){
        var cache = jQuery(this).attr('data-cache');
        var abc = jQuery(this);
        abc.html('<i class="icon icon-spin icon-spinner"></i>').attr('disabled','disabled');
        if(cache==1){
            jQuery.post(ajaxurl, {action:'minimax_cache',cache_status:1}, function(){
                jQuery('#cache .btn-danger').addClass('btn-default').removeClass('btn-danger').removeAttr('disabled');
                abc.addClass('btn-success').removeClass('btn-default').html('Active');
            });
        }
        if(cache==0){
            jQuery.post(ajaxurl, {action:'minimax_cache',cache_status:0}, function(){
                jQuery('#cache .btn-success').addClass('btn-default').removeClass('btn-success').removeAttr('disabled');
                abc.addClass('btn-danger').removeClass('btn-default').html('Inactive');
            });

        }
    });

    jQuery('#modpreview .btn').on('click', function(){
        var cache = jQuery(this).attr('data-mpv');
        var abc = jQuery(this);
        abc.html('<i class="icon icon-spin icon-spinner"></i>').attr('disabled','disabled');
        if(cache==1){
            jQuery.post(ajaxurl, {action:'minimax_module_preview',module_preview:1}, function(){
                jQuery('#modpreview .btn-danger').addClass('btn-default').removeClass('btn-danger').removeAttr('disabled');
                abc.addClass('btn-success').removeClass('btn-default').html('Active');
            });
        }
        if(cache==0){
            jQuery.post(ajaxurl, {action:'minimax_module_preview',module_preview:0}, function(){
                jQuery('#modpreview .btn-success').addClass('btn-default').removeClass('btn-success').removeAttr('disabled');
                abc.addClass('btn-danger').removeClass('btn-default').html('Inactive');
            });

        }
    });

    jQuery('.check-update').click(function(e) {
        var o = this;
        var oc = jQuery("button[rel=" + this.rel + "]").html();
        //jQuery("button[rel=" + this.rel + "]").find('.icon').removeClass('icon-ok icon-remove').addClass('icon-spinner icon-spin');
        jQuery(o).html('<i class="icon-spinner icon-spin"></i>');
        e.preventDefault();
        var module = this.rel;
        jQuery.post(ajaxurl, {action: 'check_module_update', module: module}, function(res) {
        
        /*Module Update available*/   
        if (res != 0) {
            var content = jQuery('#updatenotice').html().replace("[version]", res.version).replace("[modulename]", res.module);
            jQuery(o).html('Check Update');
            jQuery(o).popover({html: true, title: 'Update Notification', content: content}).popover('show');
            
            /*Update Now*/
            jQuery('.update-now').click(function(e) {
                jQuery(o).find('.icon').removeClass('icon-ok icon-remove').addClass('icon-spinner icon-spin');
                e.preventDefault();
                jQuery(o).popover('destroy');
                
                jQuery.post(ajaxurl, {action: 'update_module', module: this.rel}, function(res) {
                    var content = jQuery('#update-completed').html().replace("[modulename]",module);
                    jQuery(o).popover({html: true, title: 'Update Notification', content: content}).popover('show');
                    jQuery(o).html('Check Update');
                    jQuery('.close-update-completed-notice').click(function (e){
                        e.preventDefault();
                        jQuery(o).popover('destroy');
                    });
            });
            });
            /*Update Later*/
            jQuery('.close-update-notice').click(function(e) {
                jQuery(o).popover('destroy');
                return false;
            });
            }
        /*No update available*/
        else {
            var content = jQuery('#noupdate').html();
            jQuery(o).html('Check Update');
            jQuery(o).popover({html: true, title: 'Update Notification', content: content}).popover('show');
            jQuery('.close-update-notice').click(function(e) {
            jQuery(o).popover('destroy');
            return false;
            });

            }
        }, "json");

    });

</script>
