<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-white text-gray-900 antialiased' ); ?>>

<?php do_action( 'football_site_before' ); ?>

<div id="page" class="min-h-screen flex flex-col">

	<?php do_action( 'football_header' ); ?>

	


	<header id="site-header" class=" z-50 w-full">
		<?php

		get_template_part('template-parts/banner');
		?>


	 <!-- Main menu Header -->
		<div class="">
			<div class="border-b py-8">
				<div class="flex flex-row lg:gap-4 justify-between lg:justify-start items-center">
					<div class="logo w-[200px]">
						<?php if ( has_custom_logo() ) { ?>
                            <?php the_custom_logo(); ?>
						<?php } else { ?>
							<a href="<?php echo get_bloginfo( 'url' ); ?>" class="font-extrabold text-lg uppercase">
								<?php echo get_bloginfo( 'name' ); ?>
							</a>

							<p class="text-sm font-light text-gray-600">
								<?php echo get_bloginfo( 'description' ); ?>
							</p>

						<?php } ?>
					</div>

					<div class="iconsandnav flex flex-row-reverse items-center">	
						<div class= "icons ml-auto flex flex-row items-center">
							<ul class="flex lg:absolute lg:right-10 items-center gap-4 lg:gap-12 py-3">
							<a href= "https://stlpartners.com/member-login/" class= "text-base font-outfit cursor-pointer">
								<li class="flex flex-row items-center">
									<i class="fa-regular fa-user text-yellow-500"></i>
									<p class="hidden lg:block text-black font-semibold">Login</p>
										<!-- <?php esc_html_e( 'My Account', 'trinity' ); ?> -->	
								</li>
								</a>
								<li class="mr-4">
									<a href= "#" class= "search-toggle flex items-center text-base gap-1 font-outfit cursor-pointer">
										<i class="fa-solid fa-magnifying-glass text-yellow-500"></i>
										<p class="hidden lg:block text-black font-semibold">Search</p>
										<!-- <span><?php esc_html_e( 'Search', 'trinity' ); ?></span> -->
									</a>
								</li>
							</ul>
						

							<div class="lg:hidden">
								<a href="#" aria-label="Toggle navigation" id="primary-menu-toggle">
									<svg viewBox="0 0 20 20" class="inline-block w-6 h-6" version="1.1"
										xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
										<g stroke="none" stroke-width="1" fill="currentColor" fill-rule="evenodd">
											<g id="icon-shape">
												<path d="M0,3 L20,3 L20,5 L0,5 L0,3 Z M0,9 L20,9 L20,11 L0,11 L0,9 Z M0,15 L20,15 L20,17 L0,17 L0,15 Z"
													id="Combined-Shape"></path>
											</g>
										</g>
									</svg>
								</a>
							</div>
						</div>
					
						<div>

							<?php
							wp_nav_menu(
								array(
									'container_id'    => 'primary-menu',
									'container_class' => 'hidden bg-gray-100 mt-4 p-4 lg:mt-0 lg:p-0 lg:bg-transparent lg:block',
									'menu_class'      => 'lg:gap-2 lg:flex lg:-mx-4',
									'theme_location'  => 'primary',
									'li_class'        => 'lg:mx-4 font-semibold',
									'fallback_cb'     => false,
								)
							);
							?>
						</div>
					</div>		
				</div>
			</div>
			<div id= "search-form" class= "hidden absolute right-0 top-[10px] p-4 lg:pr-10 bg-white translate-x-full transform ease-in-out duration-150 ">
				<?php get_search_form(); ?>
			</div>
		</div>
		<!-- Pop out menu  -->

		<div id="mobile-pop-out" class="flex flex-col items-start absolute h-screen right-0 top-0 w-1/2 hidden bg-white z-10">
			<div class="search-close absolute right-0 cursor-pointer top-[40px] pr-3">
			<i class="fa-solid fa-x "></i>
			</div>
			<div class="mobile-menu">

				<?php
					wp_nav_menu(
						array(
							'container_id'    => 'mobile-menu',
							'container_class' => 'mt-4 p-4',
							'menu_class'      => 'flex flex-col lg:-mx-4 gap-4',
							'theme_location'  => 'mobile',
							'li_class'        => 'lg:mx-4 font-semibold',
							'fallback_cb'     => false,
							)
						);
				?>
			</div>
			<div class="login">
				<div class="flex flex-row items-center">
					<i class="fa-regular fa-user text-yellow-500"></i>
					<p class=" text-black font-semibold">Login</p>
						<!-- <?php esc_html_e( 'My Account', 'trinity' ); ?> -->	
				</div>
			</div>
		</div>
	</header>

	<div id="content" class="site-content flex-grow">

		<?php if ( is_front_page() ) { ?>
		
		<?php } ?>

		<?php do_action( 'football_content_start' ); ?>

		<main>
