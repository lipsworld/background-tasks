<?php
/*
* Plugin Name: Background Tasks
* Plugin URI:
* Description: Adds background tasks functionality to your website.
* Version:     0.0.1
* Author:      Serge Liatko
* Author URI:  http://sergeliatko.com/?utm_source=background-tasks&utm_medium=textlink&utm_content=authorlink&utm_campaign=wpplugins
* License:     GPL2
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Domain Path: /languages
* Text Domain: background-tasks
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*
* Copyright 2017 Serge Liatko <contact@sergeliatko.com> https://sergeliatko.com
*/

defined( 'ABSPATH' ) or die( sprintf( 'Please, do not load this file directly. File: %s', __FILE__ ) );

if ( ! function_exists( 'wp_add_background_task' ) ) {
	/**
	 * @param callable $task
	 * @param array    $args
	 *
	 * @return bool
	 */
	function wp_add_background_task( $task, array $args = array() ) {
		return ! ( false === wp_schedule_single_event( time(), 'wp_background_task', array( $task, $args ) ) );
	}
}

if ( ! function_exists( 'wp_execute_background_task' ) ) {
	/**
	 * @param callable $task
	 * @param array    $args
	 */
	function wp_execute_background_task( $task, array $args = array() ) {
		if( is_callable( $task ) ) {
			call_user_func_array( $task, $args );
		}
	}
}

add_action( 'wp_background_task', 'wp_execute_background_task', 10, 2 );
