<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */

/**
 * Implements hook_css_alter().
 */

function crimtrac_js_alter(&$js) {
  unset($js[drupal_get_path('theme', 'govcms_zen') . '/js/script.js']);
}


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function crimtrac_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  crimtrac_preprocess_html($variables, $hook);
  crimtrac_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function crimtrac_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  // $variables['classes_array'] =
  //  array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function crimtrac_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function crimtrac_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // crimtrac_preprocess_node_page() or
  // crimtrac_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function crimtrac_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function crimtrac_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] =
  // array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function crimtrac_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];
}
// */

/**
 * Implements template_preprocess_search_api_page_results to
 * wrap term by <q> tag
 *
 * @see template_preprocess_search_api_page_results
 */
function crimtrac_preprocess_search_api_page_results(&$variables) {
  // copied from template_preprocess_search_api_page_results
  // Make the help text depend on the parse mode used.
  switch ($variables['page']->options['mode']) {
    case 'direct':
      if ($variables['index']->server()->class == 'search_api_solr') {
        $variables['no_results_help'] = t('<ul>
<li>Check if your spelling is correct.</li>
<li>Remove quotes around phrases to search for each word individually. <q>bike shed</q> will often show more results than <q>&quot;bike shed&quot;</q>.</li>
<li>Consider loosening your query with <q>OR</q>. <q>bike OR shed</q> will often show more results than <q>bike shed</q>.</li>
</ul>');
      }
      else {
        $variables['no_results_help'] = t('<ul>
<li>Check if your spelling is correct.</li>
<li>Use fewer keywords to increase the number of results.</li>
</ul>');
      }
      break;
    case 'single':
      $variables['no_results_help'] = t('<ul>
<li>Check if your spelling is correct.</li>
<li>Use fewer keywords to increase the number of results.</li>
</ul>');
      break;
    case 'terms':
      $variables['no_results_help'] = t('<ul>
<li>Check if your spelling is correct.</li>
<li>Remove quotes around phrases to search for each word individually. <q>bike shed</q> will often show more results than <q>&quot;bike shed&quot;</q>.</li>
<li>Use fewer keywords to increase the number of results.</li>
</ul>');
      break;
  }
}

/*
 * Copied from search_help except we're using
 * only a very specific part of it, to wrap
 * quotes with the <q> element. This function
 * is used in the overridden search-results.tpl.php
 *
 * @see search_help
 */
function crimtrac_search_help($path, $arg) {
  switch ($path) {
    case 'search#noresults':
      return t('<ul>
<li>Check if your spelling is correct.</li>
<li>Remove quotes around phrases to search for each word individually. <q>bike shed</q> will often show more results than <q>&quot;bike shed&quot;</q>.</li>
<li>Consider loosening your query with <q>OR</q>. <q>bike OR shed</q> will often show more results than <q>bike shed</q>.</li>
</ul>');
  }
}
