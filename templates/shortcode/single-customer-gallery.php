<?php
/**
 * Theme shortcodes
 *
 * @package ThriveThemeChild
 */

 /**
  * Load child theme css and optional scripts
  *
  * @return void
  */

function single_customer_gallery_shortcode() {
	ob_start();
	
	global $post;

	$gallery_images = get_field( 'gallery_photos' );
	
	if ( $gallery_images ) :
	?>
	
		<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
		
		<style type="text/css">
			.customer-gallery-container img {
				border-radius: 10px;
			}

			.customer-gallery-nav {
				margin-top: 10px;
			}

			.customer-gallery-image-thumb {
				cursor: pointer;
				margin: 10px;
				border: 4px solid #fff;
				border-radius: 14px;
			}

			.customer-gallery-image-thumb.slick-current {
				border: 4px solid #eee !important;
			}

			.slick-arrow {
				position: absolute;
				top: 50%;
				background: none;
				border: none;
				height: 20px;
				width: 20px;
				padding: 0;
				transform: translate(0, -50%);
    			cursor: pointer;
    			z-index: 1;
    			font-size: 0;
    			line-height: 0;
			}

			.slick-prev:before, 
			.slick-next:before {
				font-size: 20px;
				line-height: 1;
				opacity: 0.8;
				color: #fff;
			}

			.slick-next {
				right: 10px;
			}

			.slick-next:before {
				content: '>';
			}

			.slick-prev {
				left: 10px;
			}

			.slick-prev:before {
				content: '<';
			}
		</style>

		<div class="customer-gallery-container">
			<div class="customer-gallery">
				<?php foreach ($gallery_images as $image) : ?>
					<div class="customer-gallery-image">
						<img src="<?php echo $image; ?>" />
					</div>
				<?php endforeach; ?>
			</div>
			<div class="customer-gallery-nav">
				<?php foreach ($gallery_images as $image) : ?>
					<div class="customer-gallery-image-thumb">
						<img src="<?php echo $image; ?>" />
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('.customer-gallery').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					fade: true,
					asNavFor: '.customer-gallery-nav'
				});
				jQuery('.customer-gallery-nav').slick({
					slidesToShow: 3,
					slidesToScroll: 1,
					asNavFor: '.customer-gallery',
					dots: false,
					centerMode: false,
					focusOnSelect: true
				});
			});
		</script>

	<?php
	endif;

	return ob_get_clean();
}

add_shortcode( 'single_customer_gallery_shortcode', 'single_customer_gallery_shortcode' );
