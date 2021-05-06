<?php if ( ! defined( 'ABSPATH' ) ) exit;

$unique_hash = substr( md5( $args['form_id'] ), 10, 5 );
$no_results_content = get_field('no_results_content','option'); ?>

<script type="text/template" id="tmpl-um-member-grid-<?php echo esc_attr( $unique_hash ) ?>">
	<div class="um-members um-members-grid">
		<div class="um-gutter-sizer"></div>

		<# if ( data.length > 0 ) { #>
			<# _.each( data, function( user, key, list ) { #>

				<div id="um-member-{{{user.card_anchor}}}-<?php echo esc_attr( $unique_hash ) ?>" class="um-member um-role-{{{user.role}}} {{{user.account_status}}} ">

					<div class="member-card" data-member-id="{{{ user.id }}}">

						<?php if ( $profile_photo ) { ?>
							<div class="member-card__photo radius-<?php echo esc_attr( UM()->options()->get( 'profile_photocorner' ) ); ?>">
								<a href="{{{user.profile_url}}}" title="{{{user.display_name}}}">
									{{{user.avatar}}}
								</a>
							</div>
						<?php } ?>
						
						{{{ console.log(user) }}}
						<div class="member-card__inner">

							<div class="member-card__name">
								<a href="{{{user.profile_url}}}" title="{{{user.display_name}}}">
									{{{ user.breeder_company_name ? user.breeder_company_name : user.display_name_html }}}
								</a>
							</div>

							<# if ( user.animals_bred != null) { #>
							<div class="member-card__breed">
								{{{ user.animals_bred }}}: 

								<# if ( user.Dogs ) { #>
									<span>{{{ user.Dogs }}}</span>
								<# } #>
								<# if ( user.Cats ) { #>
									<span>{{{ user.Cats }}}</span>
								<# } #>
								<# if ( user.horses ) { #>
									<span>{{{ user.horses }}}</span>
								<# } #>
								<# if ( user.Birds ) { #>
									<span>{{{ user.Birds }}}</span>
								<# } #>
								<# if ( user.reptiles ) { #>
									<span>{{{ user.reptiles }}}</span>
								<# } #>
								<# if ( user.small_pets ) { #>
									<span>{{{ user.small_pets }}}</span>
								<# } #>
								<# if ( user.farm_life ) { #>
									<span>{{{ user.farm_life }}}</span>
								<# } #>

							</div>
							<# } #>

							<div class="member-card__location">
								<address>{{{ user.city ? user.city : null }}}{{{ user.user_state && user.city ? ', ' : null }}} {{{ user.user_state ? user.user_state : null }}}</address>
							</div>

							<div class="member-card__icons">
								<ul>
									<!-- user.other_awards -->
									<# if ( user.other_awards === 'Yes') { #>
									<li><img style="width:25px;" src="<?= get_stylesheet_directory_uri() ?>/img/icon-awards.png" alt="Breeder has award-winning pets" /></li>
									<# } #>

									<# if ( user.registration === 'Yes') { #>
									<li><img style="width:21px;" src="<?= get_stylesheet_directory_uri() ?>/img/icon-certified.png" alt="Breeder has certified pets" /></li>
									<# } #>
									
									<# if ( user.health_guarantee === 'Yes') { #>
									<li><img style="width:16px;" src="<?= get_stylesheet_directory_uri() ?>/img/icon-health.png" alt="Breeder has healthy pets" /></li>
									<# } #>

									<# if ( user.free_shipping === 'Yes') { #>
									<li><img style="width:54px;" src="<?= get_stylesheet_directory_uri() ?>/img/icon-free-shipping.png" alt="Breeder offers free shipping" /></li>
									<# } #>
								</ul>
							</div>
							
							<div class="member-card__btn">
								<a class="button button--primary" href="{{{user.profile_url}}}" title="{{{user.display_name}}}">View Breeder Details</a>
							</div>

						</div>

					</div>

				</div>

			<# }); #>
		<# } else { #>

			<div class="um-members-none">
				<?= $no_results_content; ?>
			</div>

		<# } #>

		<div class="um-clear"></div>
	</div>
</script>