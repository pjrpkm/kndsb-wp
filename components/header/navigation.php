<?php
/** @package KNDSB */
defined( 'ABSPATH' ) || exit;
$compact_logo = kndsb_header_logo( true );
$menu_tree    = kndsb_menu_tree( 'header-menu' );
?>
<div class="kndsb-header__navigation-wrap">
	<div class="kndsb-header__navigation">
		<a class="kndsb-header__compact-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?php if ( $compact_logo['url'] ) : ?><img class="kndsb-header__compact-image" src="<?php echo esc_url( $compact_logo['url'] ); ?>" alt=""><?php endif; ?>
		</a>
		<button class="kndsb-header__menu-toggle" type="button" aria-expanded="false" aria-controls="kndsb-mobile-panel"><span class="kndsb-header__menu-icon" aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'Menu openen', 'kndsb' ); ?></span></button>
		<nav class="kndsb-header__primary" aria-label="<?php esc_attr_e( 'Hoofdnavigatie', 'kndsb' ); ?>">
			<ul class="kndsb-header__menu" id="kndsb-primary-menu">
				<?php foreach ( $menu_tree as $index => $node ) : $item = $node['item']; $has_children = ! empty( $node['children'] ); $is_current = array_intersect( array( 'current-menu-item', 'current-menu-ancestor', 'current_page_item' ), (array) $item->classes ); ?>
					<li class="kndsb-header__menu-item<?php echo $has_children ? ' kndsb-header__menu-item--has-panel' : ''; ?><?php echo $is_current ? ' kndsb-header__menu-item--current' : ''; ?>">
						<a class="kndsb-header__menu-link" href="<?php echo esc_url( $item->url ); ?>"<?php if ( $has_children ) : ?> data-kndsb-mega-trigger="<?php echo esc_attr( $index ); ?>" aria-controls="kndsb-mega-panel-<?php echo esc_attr( $index ); ?>" aria-expanded="false"<?php endif; ?>><?php echo esc_html( $item->title ); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
		<button class="kndsb-header__search-toggle" type="button" aria-expanded="false" aria-controls="kndsb-header-search"><span class="kndsb-header__search-icon" aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'Zoeken', 'kndsb' ); ?></span></button>
	</div>
	<div class="kndsb-header__search" id="kndsb-header-search" hidden>
		<form class="kndsb-header__search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="kndsb-search-field"><?php esc_html_e( 'Zoeken naar', 'kndsb' ); ?></label>
			<input class="kndsb-header__search-field" id="kndsb-search-field" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Zoeken…', 'kndsb' ); ?>">
			<button class="kndsb-header__search-submit" type="submit"><?php esc_html_e( 'Zoeken', 'kndsb' ); ?></button>
		</form>
	</div>
	<?php if ( $menu_tree ) : ?>
		<div class="kndsb-mega-nav" data-kndsb-mega-nav hidden>
			<div class="kndsb-mega-nav__viewport">
				<?php foreach ( $menu_tree as $index => $node ) : ?>
					<?php if ( empty( $node['children'] ) ) { continue; } ?>
					<section class="kndsb-mega-nav__panel" id="kndsb-mega-panel-<?php echo esc_attr( $index ); ?>" data-kndsb-mega-panel="<?php echo esc_attr( $index ); ?>" aria-label="<?php echo esc_attr( $node['item']->title ); ?>" hidden>
						<div class="kndsb-mega-nav__grid">
							<?php foreach ( $node['children'] as $child ) : ?>
								<div class="kndsb-mega-nav__column">
									<a class="kndsb-mega-nav__heading" href="<?php echo esc_url( $child['item']->url ); ?>"><?php echo esc_html( $child['item']->title ); ?></a>
									<?php if ( $child['children'] ) : ?>
										<ul class="kndsb-mega-nav__links">
											<?php foreach ( $child['children'] as $grandchild ) : ?>
												<li><a class="kndsb-mega-nav__link" href="<?php echo esc_url( $grandchild['item']->url ); ?>"><?php echo esc_html( $grandchild['item']->title ); ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
