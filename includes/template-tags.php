<?php

function minimax_site_logo(){
    global $minimax_options;    
    if(!$minimax_options) 
    $minimax_options = get_option("wpeden_admin");
    
    $logo_url = $minimax_options['general']['logo'];
    return $logo_url;
}