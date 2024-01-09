<?php
/**
 * Page Template Financing shortcodes
 *
 * @package ThriveThemeChild
 */

 /**
  * Load child theme css and optional scripts
  *
  * @return
  */

function financing_form() {
	ob_start();
    	
    if (function_exists('tve_leads_form_display')) { 
        tve_leads_form_display(0, 23048145); 
    }
	return ob_get_clean();
}

add_shortcode( 'financing_form', 'financing_form' );

