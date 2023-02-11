<?php
/**
 * Shortcode HTML Template.
 *
 * @package PluginDevs
 * @since 1.0.4
 */

defined( 'ABSPATH' ) || exit;

?>
<div class='hvac-calculator-container'>
	<div class='hvac-calculator-heading'>
		<h2><?php esc_html_e( 'Sizing Calculator', 'fashionist' ); ?></h2>
		<a href='#' class='hvac-more-toggle'><?php esc_html_e( 'More Options', 'fashionist' ); ?></a>
	</div>
	<div class='hvac-sizing-calculator'>
		<div class='hvac-calculator-input'>
			<label for='hvac-square-footage'><?php esc_html_e( 'Square Footage', 'fashionist' ); ?></label>
			<input type='text' id='hvac-square-footage' />
		</div>
		<div class='hvac-calculator-input'>
			<label for='hvac-zip-code'><?php esc_html_e( 'Zip Code', 'fashionist' ); ?></label>
			<input type='text' id='hvac-zip-code' />
		</div>
		<div class='hvac-advanced-options'> <!-- Start Advanced Options -->
			<div class='hvac-border'></div>
			<div class='hvac-row'>
				<div class='hvac-w-50 hvac-calculator-input border-right'>
					<label for='hvac-ceiling-height'><?php esc_html_e( 'Ceiling Height (Feet)', 'fashionist' ); ?></label>
					<input type='text' id='hvac-ceiling-height' value='<?php echo esc_attr( '8' ); ?>' />
				</div>
				<div class='hvac-w-50 hvac-row'>
					<div class='hvac-w-50 hvac-calculator-input border-right'>
						<label for='hvac-sunlight'><?php esc_html_e( 'Sunlight', 'fashionist' ); ?></label>
						<select id='hvac-sunlight'>
							<option value='<?php echo esc_attr( '-0.1' ); ?>'><?php esc_html_e( 'Low', 'fashionist' ); ?></option>
							<option value='<?php echo esc_attr( '0' ); ?>' selected='selected'><?php esc_html_e( 'Average', 'fashionist' ); ?></option>
							<option value='<?php echo esc_attr( '0.1' ); ?>'><?php esc_html_e( 'High', 'fashionist' ); ?></option>
						</select>
					</div>
					<div class='hvac-w-50 hvac-calculator-input'>
						<label for='hvac-total-window'><?php esc_html_e( 'Total Windows', 'fashionist' ); ?></label>
						<select id='hvac-total-window'>
							<option value='<?php echo esc_attr( '-0.1' ); ?>'><?php esc_html_e( 'Few', 'fashionist' ); ?></option>
							<option value='<?php echo esc_attr( '0' ); ?>' selected='selected'><?php esc_html_e( 'Average', 'fashionist' ); ?></option>
							<option value='<?php echo esc_attr( '0.1' ); ?>'><?php esc_html_e( 'Many', 'fashionist' ); ?></option>
							<option value='<?php echo esc_attr( '0.5' ); ?>'><?php esc_html_e( 'Sunrooms', 'fashionist' ); ?></option>
						</select>
					</div>
				</div>
			</div>
			<div class='hvac-border'></div>
			<div class='hvac-row'>
				<div class='hvac-w-50 hvac-calculator-input border-right'>
					<label for='hvac-wall-installation'><?php esc_html_e( 'Wall Installation', 'fashionist' ); ?></label>
					<select id='hvac-wall-installations'>
						<option value='<?php echo esc_attr( '-0.1' ); ?>'><?php esc_html_e( 'Best', 'fashionist' ); ?></option>
						<option value='<?php echo esc_attr( '-0.05' ); ?>'><?php esc_html_e( 'Good', 'fashionist' ); ?></option>
						<option value='<?php echo esc_attr( '0' ); ?>' selected='selected'><?php esc_html_e( 'Average', 'fashionist' ); ?></option>
						<option value='<?php echo esc_attr( '0.05' ); ?>'><?php esc_html_e( 'Poor', 'fashionist' ); ?></option>
						<option value='<?php echo esc_attr( '0.1' ); ?>'><?php esc_html_e( 'Worst', 'fashionist' ); ?></option>
					</select>
				</div>
				<div class='hvac-w-50 hvac-calculator-input'>
					<label for='hvac-window-installation'><?php esc_html_e( 'Window Installation', 'fashionist' ); ?></label>
					<select id='hvac-window-installations'>
						<option value='<?php echo esc_attr( '-0.1' ); ?>'><?php esc_html_e( 'Great', 'fashionist' ); ?></option>
						<option value='<?php echo esc_attr( '0' ); ?>' selected='selected'><?php esc_html_e( 'Average', 'fashionist' ); ?></option>
						<option value='<?php echo esc_attr( '0.1' ); ?>'><?php esc_html_e( 'Poor', 'fashionist' ); ?></option>
						<option value='<?php echo esc_attr( '0.2' ); ?>'><?php esc_html_e( 'Nonexistant', 'fashionist' ); ?></option>
					</select>
				</div>
			</div>
			<div class='hvac-border'></div>
			<div class='hvac-row'>
				<div class='hvac-w-50 hvac-calculator-input border-right'>
					<label for='hvac-occupants'><?php esc_html_e( 'Occupants', 'fashionist' ); ?></label>
					<input type='text' id='hvac-occupants' value='<?php echo esc_attr( '2' ); ?>' />
				</div>
				<div class='hvac-w-50 hvac-calculator-input'>
					<label for='hvac-kitchen'><?php esc_html_e( 'Kitchen', 'fashionist' ); ?></label>
					<select id='hvac-kitchens'>
						<option value='<?php echo esc_attr( '4000' ); ?>'><?php esc_html_e( 'Yes', 'fashionist' ); ?></option>
						<option value='<?php echo esc_attr( '0' ); ?>'><?php esc_html_e( 'No', 'fashionist' ); ?></option>
					</select>
				</div>
			</div>
		</div><!-- // End Advanced Options -->
		<div class='hvac-border'></div>
		<div class='hvac-row hvac-justify-center'>
			<div class='hvac-calculator-input'>
				<button id='hvac-calculate-result-btn'><?php esc_html_e( 'Calculate', 'fashionist' ); ?></button>
			</div>
			<span class='hvac-calculator-loader'></span>
		</div>

		<div class='hvac-result-output'>
			<div class='hvac-border'></div>
			<div class='hvac-row hvac-justify-center'>
				<ul>
					<li class='hvac-city-result'>
						<strong><?php esc_html_e( 'City: ', 'fashionist' ); ?></strong>
						<span></span>
					</li>
					<li class='hvac-cooling-result'>
						<strong><?php esc_html_e( 'Cooling estimate: ', 'fashionist' ); ?></strong>
						<span class='cooling-ton'></span>
						<span class='cooling-estimate'></span>
					</li>
					<li class='hvac-heating-result'>
						<strong><?php esc_html_e( 'Heating estimate: ', 'fashionist' ); ?></strong>
						<span class='heating-btu'></span>
						<span><?php esc_html_e( 'output BTU', 'fashionist' ); ?></span>
					</li>
					<li class='hvac-standard-size'>
						<strong><?php esc_html_e( 'Recommended Standard 80% AFUE Furnace Size: ', 'fashionist' ); ?></strong><span></span>
					</li>
					<li class='hvac-high-size'>
						<strong><?php esc_html_e( 'Recommended High 96+% AFUE Furnace Size: ', 'fashionist' ); ?></strong><span></span>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
