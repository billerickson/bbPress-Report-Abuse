<?php
/**
 * Plugin Name: bbPress Report Abuse
 * Plugin URI:  http://github.com/billerickson/bbpress-report-abuse
 * Description: Provides a "Report Abuse" link in replies
 * Version:     1.0.0
 * Author:      Bill Erickson
 * Author URI:  http://www.billerickson.net
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * @author     Bill Erickson
 * @version    1.0.0
 * @package    bbPressReportAbuse
 * @copyright  Copyright (c) 2013, Bill Erickson
 * @link       http://billerickson.net
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * bbPress Report Abuse init class
 *
 * @since 1.0.0
 */
class bbp_Report_Abuse {

	/**
	 * We hook into plugin-specific filters so that our code
	 * only runs if those plugins are active.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		add_action( 'bbp_theme_before_reply_admin_links', array( $this, 'abuse_link_in_forum' ) );
		add_filter( 'gform_pre_render', array( $this, 'abuse_link_in_form' ) );
	}

	/**
	 * Abuse Link defaults to '/report-abuse' but is filterable
	 *
	 * @since 1.0.0
	 */
	function abuse_link_in_forum() {
		// Label, filterable
		$label = apply_filters( 'bbpress_report_abuse_label', 'Report Abuse' );
		// Default url
		$url = site_url( 'report-abuse' );
		// Make it filterable
		$url = apply_filters( 'bbpress_report_abuse_url', $url );
		// Add the topic ID
		$url = add_query_arg( 'bbp_report_topic', get_the_ID(), $url );
		echo '<a class="bbp-report-abuse" href="' . $url . '">' . $label . '</a>';
	}
	
	/**
	 * Add the abuse link to a Gravity form field with a 
	 * parameter name of 'bbp_report_abuse'
	 *
	 * @param object $form
	 * @return object $form
	 *
	 * @since 1.0.0
	 */
	function abuse_link_in_form( $form ) {

		// check for a topic
		$topic = (int) $_GET['bbp_report_topic'];
		if( empty( $topic ) )
			return $form;
					
		foreach( $form['fields'] as &$field ) {
			if( $field['allowsPrepopulate'] && isset( $field['inputName'] ) && 'bbp_report_abuse' == $field['inputName'] ) {
				$field['defaultValue'] = get_permalink( $topic );
			}
		}
		return $form;
	}
}

new bbp_Report_Abuse();
