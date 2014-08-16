 jQuery('#addtab_').live("click",function(){            
           jQuery('#tabpane').after(' <p><label>Title for Tab:</label><input class="widefat"  name="title[] type="text" value="" /></p><p><label>Content for Tab:</label> <textarea class="widefat"  name="content[]" ></textarea></p>'); 
        });