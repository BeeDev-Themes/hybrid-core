<?php
/**
 * Attribute functions.
 *
 * HTML attribute functions and filters.  The purposes of this is to provide a
 * way for theme/plugin devs to hook into the attributes for specific HTML
 * elements and create new or modify existing attributes. This is sort of like
 * `body_class()`, `post_class()`, and `comment_class()` on steroids.  Plus, it
 * handles attributes for many more elements.  The biggest benefit of using this
 * is to provide richer microdata while being forward compatible with the
 * ever-changing Web.
 *
 * @package   HybridCore
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2018, Justin Tadlock
 * @link      https://themehybrid.com/hybrid-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid;

/**
 * `<html>` element attributes.
 *
 * @since  5.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function attr_html( $attr ) {

	$attr = [];

	$parts = wp_kses_hair( get_language_attributes(), [ 'http', 'https' ] );

	if ( $parts ) {

		foreach ( $parts as $part ) {

			$attr[ $part['name'] ] = $part['value'];
		}
	}

	return $attr;
}

/**
 * `<body>` element attributes.
 *
 * @since  5.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function attr_body( $attr ) {

	$class = isset( $attr['class'] ) ? $attr['class'] : '';

	$attr['class'] = join( ' ', get_body_class( $class ) );
	$attr['dir']   = is_rtl() ? 'rtl' : 'ltr';

	return $attr;
}

/**
 * Post `<article>` element attributes.
 *
 * @since  5.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function attr_post( $attr ) {

	$post  = get_post();
	$class = isset( $attr['class'] ) ? $attr['class'] : '';

	$attr['id']    = ! empty( $post ) ? sprintf( 'post-%d', get_the_ID() ) : 'post-0';
	$attr['class'] = join( ' ', get_post_class( $class ) );

	return $attr;
}

/**
 * Comment wrapper attributes.
 *
 * @since  5.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function attr_comment( $attr ) {

	$class = isset( $attr['class'] ) ? $attr['class'] : '';

	$attr['id']    = 'comment-' . get_comment_ID();
	$attr['class'] = join( ' ', get_comment_class( $class ) );

	return $attr;
}
