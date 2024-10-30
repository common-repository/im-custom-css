<?php 

header("Content-type: text/css");

$css = get_option( 'im_custom_css_options' )['css_code'];

require_once( plugin_dir_path( __FILE__ ) . '../../admin/lib/csstidy/class.csstidy.php' );

$csstidy = new csstidy();

$csstidy->set_cfg( 'remove_bslash', false );
$csstidy->set_cfg( 'compress_colors', false );
$csstidy->set_cfg( 'compress_font-weight', false );
$csstidy->set_cfg( 'optimise_shorthands', 0 );
$csstidy->set_cfg( 'remove_last_;', false );
$csstidy->set_cfg( 'case_properties', false );
$csstidy->set_cfg( 'discard_invalid_properties', true );
$csstidy->set_cfg( 'css_level', 'CSS3.0' );
$csstidy->set_cfg( 'preserve_css', true );
$csstidy->set_cfg( 'template', dirname( __FILE__ ) . '/../../admin/lib/csstidy/wordpress-standard.tpl' );

$css = preg_replace( '/\\\\([0-9a-fA-F]{4})/', '\\\\\\\\$1', $prev = $css );

$css = str_replace( '<=', '&lt;=', $css );
$css = wp_kses_split( $prev = $css, array(), array() );
$css = str_replace( '&gt;', '>', $css );
$css = strip_tags( $css );

$csstidy->parse( $css );
$this->value = $csstidy->print->plain();

echo $css;

?>