<?php
$onepress_hero_id         = get_theme_mod( 'onepress_hero_id', esc_html__('hero', 'onepress') );
$onepress_hero_disable    = get_theme_mod( 'onepress_hero_disable' ) == 1 ? true : false ;
$onepress_hero_fullscreen = get_theme_mod( 'onepress_hero_fullscreen' );
$onepress_hero_pdtop      = get_theme_mod( 'onepress_hero_pdtop', '10' );
$onepress_hero_pdbotom    = get_theme_mod( 'onepress_hero_pdbotom', '10' );

if ( onepress_is_selective_refresh() ) {
    $onepress_hero_disable = false;
}

$hero_content_style = '';
if ( $onepress_hero_fullscreen != '1' ) {
	$hero_content_style = ' style="padding-top: '. $onepress_hero_pdtop .'%; padding-bottom: '. $onepress_hero_pdbotom .'%;"';
}

$_images = get_theme_mod('onepress_hero_images');
if (is_string($_images)) {
	$_images = json_decode($_images, true);
}

if ( empty( $_images ) || !is_array( $_images ) ) {
    $_images = array();
}

$images = array();

foreach ( $_images as $m ) {
	$m  = wp_parse_args( $m, array('image' => '' ) );
	$_u = onepress_get_media_url( $m['image'] );
	if ( $_u ) {
		$images[] = $_u;
	}
}

if ( empty( $images ) ){
	$images = array( get_template_directory_uri().'/assets/images/hero5.jpg' );
}

$is_parallax =  get_theme_mod( 'onepress_hero_parallax' ) == 1 && ! empty( $images ) ;

if ( $is_parallax ) {
    echo '<div id="parallax-hero" class="parallax-hero parallax-window" data-over-scroll-fix="true" data-z-index="1" data-speed="0.3" data-image-src="'.esc_attr( $images[0] ).'" data-position="center" data-bleed="0">';
}

?>
<?php if ( ! $onepress_hero_disable && ! empty ( $images ) ) : ?>
	<!--  -->
    <section id="header_logo">
    	<div class="hero"> 
    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/primetime_logo.png">
    	</div>

     <!--    <div class="sk-cube-grid ">
            <div class="sk-cube sk-cube1"></div>
            <div class="sk-cube sk-cube2"></div>
            <div class="sk-cube sk-cube3"></div>
            <div class="sk-cube sk-cube4"></div>
            <div class="sk-cube sk-cube5"></div>
            <div class="sk-cube sk-cube6"></div>
            <div class="sk-cube sk-cube7"></div>
            <div class="sk-cube sk-cube8"></div>
            <div class="sk-cube sk-cube9"></div>
        </div>
 -->
        <?php
		$layout = get_theme_mod( 'onepress_hero_layout', 1 );
		switch( $layout ) {
			case 2:
				$hcl2_content =  get_theme_mod( 'onepress_hcl2_content', wp_kses_post( '<h1>Business Website'."\n".'Made Simple.</h1>'."\n".'We provide creative solutions to clients around the world,'."\n".'creating things that get attention and meaningful.'."\n\n".'<a class="btn btn-secondary-outline btn-lg" href="#">Get Started</a>' ) );
				$hcl2_image   =  get_theme_mod( 'onepress_hcl2_image', get_template_directory_uri().'/assets/images/onepress_responsive.png' );
				?>
				<div class="container"<?php echo $hero_content_style; ?>>
					<div class="hero__content hero-content-style<?php echo esc_attr( $layout ); ?>">
						<div class="col-md-12 col-lg-6">
							<?php if ( $hcl2_content ) { echo '<div class="hcl2-content">'.apply_filters( 'the_content', wp_kses_post( $hcl2_content ) ).'</div>' ; }; ?>
						</div>
						<div class="col-md-12 col-lg-6">
							<?php if ( $hcl2_image ) { echo '<img class="hcl2-image" src="'.esc_url( $hcl2_image ).'" alt="">' ; }; ?>
						</div>
					</div>
				</div>
				<?php
			break;
			default:
				$hcl1_largetext  = get_theme_mod( 'onepress_hcl1_largetext', wp_kses_post('We are Primetime, 'onepress' ));
				$hcl1_smalltext  = get_theme_mod( 'onepress_hcl1_smalltext', wp_kses_post('Site is currently under construction. Thanks!', 'onepress') );
				$hcl1_btn1_text  = get_theme_mod( 'onepress_hcl1_btn1_text', esc_html__('Our Services', 'onepress') );
				$hcl1_btn1_link  = get_theme_mod( 'onepress_hcl1_btn1_link', esc_url( home_url( '/' )).esc_html__('#services', 'onepress') );
				$hcl1_btn2_text  = get_theme_mod( 'onepress_hcl1_btn2_text', esc_html__('Get Started', 'onepress') );
				$hcl1_btn2_link  = get_theme_mod( 'onepress_hcl1_btn2_link', esc_url( home_url( '/' )).esc_html__('#contact', 'onepress') );

                $btn_1_style = get_theme_mod( 'onepress_hcl1_btn1_style', 'btn-theme-primary' );
                $btn_2_style = get_theme_mod( 'onepress_hcl1_btn2_style', 'btn-secondary-outline' );
				?>
				<div class="container">
					<div class="hero__content hero-content-style<?php echo esc_attr( $layout ); ?>">
						<?php if ($hcl1_largetext != '') echo '<h2 class="hero-large-text">' . wp_kses_post($hcl1_largetext) . '</h2>'; ?>
						<?php if ($hcl1_smalltext != '') echo '<p class="hero-small-text"> ' . wp_kses_post( $hcl1_smalltext ) . '</p>' ?>
						<?php if ($hcl1_btn1_text != '' && $hcl1_btn1_link != '') echo '<a href="' . esc_url($hcl1_btn1_link) . '" class="btn '.esc_attr( $btn_1_style ).' btn-lg">' . wp_kses_post($hcl1_btn1_text) . '</a>'; ?>
						<?php if ($hcl1_btn2_text != '' && $hcl1_btn2_link != '') echo '<a href="' . esc_url($hcl1_btn2_link) . '" class="btn '.esc_attr( $btn_2_style ).' btn-lg">' . wp_kses_post($hcl1_btn2_text) . '</a>'; ?>
					</div>
				</div>
				<?php
		}

	?>
	</section>
<?php endif;

if ( $is_parallax ) {
    echo '</div>'; // end parallax
}
