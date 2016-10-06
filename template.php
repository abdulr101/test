<?php
// ibm_apim_theme
// based on sky by Adaptivethemes.com

/**
 * Override or insert variables into the html template.
 */
function ibm_apim_theme_preprocess_html(&$vars) {
  global $theme_key;
  $theme_name = $theme_key;

  // Add a class for the active color scheme
  if (module_exists('color')) {
    $class = check_plain(get_color_scheme_name($theme_name));
    $vars['classes_array'][] = 'color-scheme-' . drupal_html_class($class);
  }

  // Add class for the active theme
  $vars['classes_array'][] = drupal_html_class($theme_name);

  // Add theme settings classes
  $settings_array = array(
    'box_shadows',
    'body_background',
    'menu_bullets',
    'menu_bar_position',
    'content_corner_radius',
    'tabs_corner_radius');
  foreach ($settings_array as $setting) {
    $vars['classes_array'][] = at_get_setting($setting);
  }
  // add class for role
  if (isset($vars['user']) && isset($vars['user']->roles)) {
    foreach($vars['user']->roles as $role){
      $vars['classes_array'][] = 'role-' . drupal_html_class($role);
    }
  }
}

/**
 * Override or insert variables into the html template.
 */
function ibm_apim_theme_process_html(&$vars) {
  // Hook into the color module.
  if (module_exists('color')) {
    _color_html_alter($vars);
  }
}


function ibm_apim_theme_get_login_block(){
	$form = drupal_get_form('user_login_block');
	return theme_status_messages().$form;
}
/**
* Add placeholder to login block input fields - Rahul
*/

function ibm_apim_theme_form_user_login_alter(&$form, &$form_state, $form_id) {
	
	$form['name']['#attributes']['placeholder'] = t('User Id');
	$form['name']['#attributes']['class'][] = 'login-form-inputs';
	$form['name']['#description'] = t('');
	$form['pass']['#attributes']['placeholder'] = t('Password');
	$form['pass']['#attributes']['class'][] = 'login-form-inputs';
	$form['pass']['#description'] = t('');
	$form['name']['#attributes']['required'] = 'required';
    $form['pass']['#attributes']['required'] = 'required';
	$form['actions']['submit']['#value'] = t('Log In');
	$form['actions']['submit']['#attributes']['class'] = array('btn', 'btn-info', 'continue', 'sandbox-login');
	
	return $form;
}

function ibm_apim_theme_form_alter(&$form, &$form_state, $form_id){	
	if($form_id=="user_name"){
		$form['name']['#attributes']['placeholder'] = t('User Id');
		$form['name']['#attributes']['class'][] = 'login-form-inputs';
		 $form['pass']['#attributes']['placeholder'] = t('Password');
		 $form['mail']['#attributes']['placeholder'] = t('mail');
		 $form['name']['#attributes']['required'] = 'required';
        	$form['pass']['#attributes']['required'] = 'required';
	}
	if($form_id=="application_node_form"){
		//echo "<pre>";
		//print_r($form);          
		$form['title']['#attributes']['placeholder'] = t('Application Name');
		$form['title']['#attributes']['class'] =array('application-name','form-control','input-lg');
		 $form['application_description'][und][0]['value']['#attributes']['placeholder'] = t('Description');
		$form['application_description'][und][0]['value']['#attributes']['class'] =array('application-name','form-control','input-lg');
		 $form['application_oauthredirecturi'][und][0]['value']['#attributes']['placeholder'] = t('OAuth Redirect URL');
		$form['application_oauthredirecturi'][und][0]['value']['#attributes']['class'] =array('application-name','form-control','input-lg');
		 $form['field_callback_url'][und][0]['value']['#attributes']['placeholder'] = t('Callback URL');
        	$form['field_callback_url'][und][0]['value']['#attributes']['class'] =array('application-name','form-control','input-lg');
		 $form['actions']['submit']['#attributes']['class'] =array('btn','btn-primary','btn-block','btn-lg','rectangle-1-copy','appSubmit');
		$form['actions']['submit']['#value'] = t('Register');

	}
	// Delete Popup form
	if($form_id=="_application_delete_application"){
		$form['description']['#markup'] = t('<h1 class="are-you-sure">Are you sure?</h1><p class="common-text">This action cannot be undone. </p>');
		$form['actions']['submit']['#value'] = t('Remove');
		$form['actions']['submit']['#weight'] = 101;		
		$form['actions']['submit']['#attributes']['class'] = array('btn', 'remove-registered', 'modal-fonts');
		$form['actions']['cancel']['#type'] = 'button';
		$form['actions']['cancel']['#button_type'] = 'button';
		$form['actions']['cancel']['#submit'] = false;
		$form['actions']['cancel']['#value'] = t('Cancel');
		$form['actions']['cancel']['#attributes']['data-dismiss'] = 'modal';
		/*$form['actions']['cancel']['#attributes'] => array(
		'data-dismiss' => 'modal',
          'onclick' => '$(this).parents("form").attr("allowSubmission", "false");
                window.location = "'.$href[1].'";'));
      // Prevent the form submission via our button
		$form['#attributes']['onsubmit'] = 'if ($(this).attr("allowSubmission") == "false") return false;';
    */
		$form['actions']['cancel']['#attributes']['class'] = array('btn', 'cancel-registered');
		$form['actions']['#attributes']['class'] = array('modal-btns');
	
		
	}
	// regenerate Popup form
	if($form_id=="application_reset_application_clientid"){
		$form['description']['#markup'] = t('<h1 class="are-you-sure">Are you sure?</h1><p class="common-text">This action cannot be undone. </p>');
		$form['actions']['submit']['#value'] = t('Reset');
		$form['actions']['submit']['#weight'] = 101;		
		$form['actions']['submit']['#attributes']['class'] = array('btn', 'remove-registered', 'modal-fonts');
		$form['actions']['cancel']['#type'] = 'button';
		$form['actions']['cancel']['#button_type'] = 'button';
		$form['actions']['cancel']['#submit'] = false;
		$form['actions']['cancel']['#value'] = t('Cancel');
		$form['actions']['cancel']['#attributes']['data-dismiss'] = 'modal';
		$form['actions']['cancel']['#attributes']['class'] = array('btn', 'cancel-registered');
		$form['actions']['#attributes']['class'] = array('modal-btns');	
	}
	
	// verify Popup form
	if($form_id=="_application_verify_application_secret_form"){
		$form['title']['#markup'] = t('');
		$form['secret']['#attributes']['class'] = array('vcsk');
		$form['secret']['#attributes']['class'] = array('vcsk');
		$form['secret']['#attributes']['placeholder'] = t('Client Secret Key');
		$form['actions']['cancel']['#type'] = 'button';
		$form['actions']['cancel']['#button_type'] = 'button';
		$form['actions']['cancel']['#submit'] = false;
		$form['actions']['cancel']['#value'] = t('Cancel');
		$form['actions']['cancel']['#attributes']['data-dismiss'] = 'modal';
		$form['actions']['cancel']['#attributes']['class'] = array('btn', 'cancel-registered');
		$form['actions']['#attributes']['class'] = array('modal-btns');
		$form['actions']['cancel']['#weight'] = 3;
		$form['actions']['submit']['#value'] = t('Submit'); 
		$form['actions']['submit']['#weight'] = 10;		
		$form['actions']['submit']['#attributes']['class'] = array('btn', 'remove-registered', 'modal-fonts');
		
		
	}
	
	// verify regenerate Popup form
	if($form_id=="application_reset_application_secret"){
		$form['description']['#markup'] = t('<h1 class="are-you-sure">Are you sure?</h1><p class="common-text">This action cannot be undone. </p>');
		$form['actions']['submit']['#value'] = t('Reset');
		$form['actions']['submit']['#weight'] = 101;		
		$form['actions']['submit']['#attributes']['class'] = array('btn', 'remove-registered', 'modal-fonts');
		$form['actions']['cancel']['#type'] = 'button';
		$form['actions']['cancel']['#button_type'] = 'button';
		$form['actions']['cancel']['#submit'] = false;
		$form['actions']['cancel']['#value'] = t('Cancel');
		$form['actions']['cancel']['#attributes']['data-dismiss'] = 'modal';	
		$form['actions']['cancel']['#attributes']['class'] = array('btn', 'cancel-registered');
		$form['actions']['#attributes']['class'] = array('modal-btns');
	}
	
	
	if($form_id=='ibm_apim_activate_create_account_form'){
	  
	  /*echo"<pre>from->";
	  print_r($form);
	  echo"<pre>";
	  
	  echo"<pre>form_state->";
	  print_r($form_state);
	  echo"<pre>";
	  exit;*/
	  
	  $form['actions']['submit']['#submit'][]='formblock_submit';
	 // $form['#action']='/ibm_apim/activate/success';	
  }

}

function formblock_submit($form, &$form_state) {
      $form_state['redirect'] = '/ibm_apim/activate/success';   
  }

function ibm_apim_theme_element_info_alter(&$type) {
	if(isset($type['password_confirm']['#process'])) {
		$type['password_confirm']['#process'][] = 'password_confirm_custom_process';
	}
	return $type;
}

function password_confirm_custom_process($elements) {
	
	$elements['pass1']['#attributes']['placeholder'] = t('Password');
	$elements['pass2']['#attributes']['placeholder'] = t('Confirm password');
	$elements['pass1']['#title_display'] = 'invisible';
	$elements['pass2']['#title_display'] = 'invisible';
	$elements['pass1']['#attributes']['class'][] = 'form-control one';
	$elements['pass2']['#attributes']['class'][] = 'form-control one';
	return $elements;
}
/*
function ibm_apim_theme_css_alter(&$css){	

	 if (drupal_is_front_page()){
    $css_to_remove = array(); 
    $themepath = path_to_theme();
    $css_to_remove[] = drupal_get_path($themepath.'/css/forms.css'); 
    $css_to_remove[] = drupal_get_path($themepath.'/css/html-elements.css'); 

    // now we can remove the contribs from the array 
    foreach ($css_to_remove as $index => $css_file) { 
 
    unset($css[$css_file]); 
    } 
  }	

}*/

function ibm_apim_theme_css_alter(&$css)
{
    if (drupal_is_front_page()) { //Unset CSS file if the current page is your custom page
        $path = drupal_get_path('theme', 'ibm_apim_theme');
        unset($css[$path . '/css/forms.css']);
	 unset($css[$path . '/css/html-elements.css']);
	 unset($css[$path . '/css/ibm_apim.settings.style.css']);

    }
}


/*
function will_css_alter(&$css)
{
    if () { //Unset CSS file if the current page is your custom page
        $path = drupal_get_path('theme', 'will');
        unset($css[$path . '/css/main.css']);
    }
} */

/**
* Add placeholder and class tothe forgot password input fields

function ibm_apim_theme_form_user_pass_alter(&$form, &$form_state, $form_id){
	
	$form['name]['#attributes']['placeholder'] = t('User Id or Email Address');
	$form['name']['#attributes']['required'] = 'required'];
	$form['name']['#attributes']['class'] = 'form-control margin-top-20';
	//return $form;
}*/

/**
 * Implementation of hook_preprocess_page().
 
function mytheme_preprocess_page(&$vars) {

  // Node template suggestions like page--node--blog.tpl.php
  if (isset($vars['node'])) {
     $vars['theme_hook_suggestions'][] = 'page__node__' . str_replace('_', '--', $vars['node']->type);
  }

}*/
/**
 * Override or insert variables into the page template.
*/
function ibm_apim_theme_preprocess_page(&$vars, $hook) {
  //print '<pre>';
  //print_r($vars['page']['header']);exit;
  if ($vars['page']['footer'] || $vars['page']['four_first'] || $vars['page']['four_second'] || $vars['page']['four_third'] || $vars['page']['four_fourth']) {
    $vars['classes_array'][] = 'with-footer';
  } 
 $vars['show_messages'] = FALSE;
  if (isset($vars['node']->type)) {
    // If the content type's machine name is "my_machine_name" the file
    // name will be "page--my-machine-name.tpl.php".
   // $vars['theme_hook_suggestions'][] = 'page__' . $vars['node']->type;
   $vars['theme_hook_suggestions'][] = 'page__node__' . str_replace('_', '--', $vars['node']->type);
    if (isset($vars['view_mode'])) {
      // If the content type's machine name is "my_machine_name" and the view mode is "teaser" the file
      // name will be "page--my-machine-name--teaser.tpl.php".
      //$vars['theme_hook_suggestions'][] = 'page__' . $vars['node']->type;
	  $vars['theme_hook_suggestions'][] = 'page__node__' . str_replace('_', '--', $vars['node']->type);
    }
   if($vars['node']->type == 'contact') {
     drupal_add_css('FINDME1'. 'page__node__' . str_replace('_', '--', $vars['node']->type) .'FINDME.min.css');
     $vars['theme_hook_suggestions'][] = 'page__' . $vars['node']->type;
   }
  }

//print_r($vars['theme_hook_suggestions']);
  //added front page spesific js and css
   if (drupal_is_front_page() || (arg(0) == 'user' && arg(1) == 'login') || (arg(0) == 'ibm_apim' && arg(1) == 'activate')) {
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/bootstrap.min.css');
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/font-awesome.min.css');
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/easy-responsive-tabs.css');
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/homepagestyle.css');
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/activation_pop.css');
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/ddlbase.css');
    
    
    drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/bootstrap.min.js');
    drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/easyResponsiveTabs.js');
    drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/front.js');
	drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/activation.js');
  }
  if(arg(0) == 'myorg') {
	drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/bootstrap.min.css');
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/font-awesome.min.css');
	drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/myorg_style.css');
    drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/bootstrap.min.js');	 
  }
  if(arg(0) == 'user' && arg(1) == 'reset') {
	drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/bootstrap.min.css');
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/font-awesome.min.css');
	drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/myorg_style.css');
    drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/bootstrap.min.js');	 
  }
  if(arg(0) == 'ibm_apim') {
	drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/bootstrap.min.css');
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/font-awesome.min.css');
    drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/bootstrap.min.js');	 
  }
  if(arg(0) == 'terms') {
	drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/terms_style.css');
	drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/bootstrap.min.css');
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/font-awesome.min.css');
    drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/bootstrap.min.js');	 
  }
  if(arg(0) == 'ibm_apim' && arg(1) == 'forgotpwd') {
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/myorg_style.css');
  }
  if(arg(0) == 'myprofile')
  {
	drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/bootstrap.min.css');
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/font-awesome.min.css');
	drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/myprofile_style.css');
    drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/bootstrap.min.js');	 
    drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/myprofile.js');	 

  }
  if(arg(0) == 'api') {
	 /*drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/bootstrap.min.css');
	 drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/font-awesome.min.css');
	 drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/catalog_style.css');*/
     //drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/bootstrap.min.js');
     //drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/api.js');*/
	//drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/docs/swagger-ui-master/dist/lib/handlebars-2.0.0.js');
	//drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/docs/citi/scripts/DocsHelper.js');
	//drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/docs/steal/steal.js?APIDoc.js');*/
	
  }
  if(arg(1) == '12'){
	drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/bootstrap.min.css');
    drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/font-awesome.min.css');
	drupal_add_css(drupal_get_path('theme','ibm_apim_theme'). '/css/help_support_style.css');
    drupal_add_js(drupal_get_path('theme','ibm_apim_theme'). '/js/bootstrap.min.js');
  }
}

/**
 * Override or insert variables into the page template.
 */
function ibm_apim_theme_process_page(&$vars) {
  // Hook into the color module.
  if (module_exists('color')) {
    _color_page_alter($vars);
  }
}

/**
 * Override or insert variables into the block template.
 */
function ibm_apim_theme_preprocess_block(&$vars) {
  if ($vars['block']->module == 'superfish' || $vars['block']->module == 'nice_menu') {
    $vars['content_attributes_array']['class'][] = 'clearfix';
  }
  if (!$vars['block']->subject) {
    $vars['content_attributes_array']['class'][] = 'no-title';
  }
  if ($vars['block']->region == 'menu_bar' || $vars['block']->region == 'top_menu') {
    $vars['title_attributes_array']['class'][] = 'element-invisible';
  }
}

/**
 * Override or insert variables into the node template.
 */
function ibm_apim_theme_preprocess_node(&$vars) {
  // Add class if user picture exists
  if (!empty($vars['submitted']) && $vars['display_submitted']) {
    if ($vars['user_picture']) {
      $vars['header_attributes_array']['class'][] = 'with-picture';
    }
  }
	$vars['messages'] = theme('status_messages');
}

/**
 * Override or insert variables into the comment template.
 */
function ibm_apim_theme_preprocess_comment(&$vars) {
  // Add class if user picture exists
  if ($vars['picture']) {
    $vars['header_attributes_array']['class'][] = 'with-user-picture';
  }
}

/**
 * Process variables for region.tpl.php
 */
function ibm_apim_theme_process_region(&$vars) {
  // Add the click handle inside region menu bar
  if ($vars['region'] === 'menu_bar') {
    $vars['inner_prefix'] = '<h2 class="menu-toggle"><a href="#">' . t('Menu') . '</a></h2>';
  }
}

function ibm_apim_theme_menu_alter(&$items) {
  $items['user']['title callback'] = 'ibm_apim_theme_user_menu_title';
}

function ibm_apim_theme_user_menu_title() {
  global $user;
  return user_is_logged_in() ? $user->name : t('User account');
}

function ibm_apim_theme_menu_tree__user_menu(&$variables) {
  global $user;
  drupal_add_js('jQuery(document).ready(function(){
      jQuery(".dropitmenu").dropit();
    });', 'inline');
  $output = '<ul class="dropitmenu"><li title="' . $user->name . '"><a href="#"><div class="elipsis-names">' . $user->name . '</div> <span class="dropit-icon ui-icon-triangle-1-s" style="display: inline-block;"></span></a><ul id="dropdown-menu" class="dropdown-menu">' . $variables['tree'] . '</ul></li></ul>';

  return $output;
}

function ibm_apim_theme_theme(&$existing, $type, $theme, $path) {
  $hooks['ibm_apim_activate_create_account_form'] = array(
    'template' => 'templates/user-activation',
    'render element' => 'form',
  );  
  
  return $hooks;
}


function ibm_apim_theme_preprocess_ibm_apim_activate_create_account_form(&$variables) {
	
  $form = $variables['form'];
  
  $variables['name'] = render($form['account']['name']);
  $variables['mail'] = render($form['account']['mail']);
  $variables['first_name'] = render($form['field_first_name']);
  $variables['last_name'] = render($form['field_last_name']);
  $variables['password'] = render($form['account']['pass']);
  $variables['actions'] = render($form['actions']);
  
  $variables['children'] = drupal_render_children($form);
  
  
}



