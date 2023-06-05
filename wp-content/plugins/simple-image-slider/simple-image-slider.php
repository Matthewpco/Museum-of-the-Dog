<?php
/*
Plugin Name: Simple Image Slider
Plugin URI: https://github.com/Matthewpco/WP-Plugin-Webp-Image-Converter
Description: Wordpress plugin that adds a new shortcode to slide images 
Version: 1.0.0
Author: Gary Matthew Payne
Author URI: https://www.wpwebdevelopment.com
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function simple_image_slider_shortcode() {
	ob_start();
	?>
	<div class="simple-slider">
	  <button class="arrow left" onclick="slideLeft()"><</button>
	  <div class="simple-slider-container">
		<div class="slide">
		  <img src="/wp-content/uploads/2023/06/xtop-dog.jpeg.pagespeed.ic.AdJxiQKDCB.webp" alt="Image 1" width="350px" height="350px">
			<a href="/museum-attractions/exhibitions/top-dogs/">
				<p class="center">TOP DOGS</P>
			</a>
		</div>
		<div class="slide">
			<img src="/wp-content/uploads/2023/06/xStubby.jpeg.pagespeed.ic.7KoNz8FYdS.webp" alt="Image 2" width="350px" height="350px">
			<a href="/museum-attractions/exhibitions/911-remembered-search-and-rescue-dogs/">
				<p class="center">9/11 REMEMBERED: SEARCH AND RESCUE DOGS</P>
			</a>
		</div>
		<div class="slide">
		  <img src="/wp-content/uploads/2023/06/xWounded_Warrior_Dog_No._6_Blessing_and_Mercy___.JPG.pagespeed.ic.NRIJGu2hQ7.webp" alt="Image 3" width="350px" height="350px">
			<a href="/museum-attractions/exhibitions/dogs-of-war-and-peace/">
				<p class="center">DOGS OF WAR AND PEACE: WOUNDED WARRIOR DOGS</p>
			</a>
		</div>
		<div class="slide">
		  <img src="/wp-content/uploads/2023/06/xTerriers-and-Butterflies.jpg.pagespeed.ic.olNd2zUl-e.webp" alt="Image 4" width="400px" height="300px">
			<a href="/museum-attractions/exhibitions/40th-anniversary/">
				<p class="center">THE AKC MUSEUM OF THE DOG AT 40: AND THE COLLECTORS WHO MADE IT.</p>
			</a>
		</div>
	  </div>
	  <button class="arrow right" onclick="slideRight()">></button>
	</div>
	<style>
	  .simple-slider {
		position: relative;
		width: 100%;
	  }
  
	  .simple-slider-container {
		display: flex;
		overflow: hidden;
	  }
  
	  .slide {
		flex: 0 0 29%;
    	padding: 1%;
    	margin: 1%;
    	border: 1px solid lightgray;
	  }

	  .slide img {
		object-fit: contain;
	  }
  
	  .arrow {
		position: absolute;
		top: calc(50% - 20px);
		z-index: 1;
	  }
  
	  .left {
		left: -2vw;
	  }
  
	  .right {
		right: -2vw;
	  }
	</style>
	<script>
	  let slideIndex = 0;
  
	  function slideLeft() {
		const slides = document.querySelectorAll('.slide');
		const lastSlide = slides[slides.length - 1];
		lastSlide.parentNode.prepend(lastSlide);
		}

		function slideRight() {
		const firstSlide = document.querySelector('.slide');
		firstSlide.parentNode.append(firstSlide);
		}

  
	  function updateSlider() {
		const slides = document.querySelectorAll('.slide');
		
		if (slideIndex < 0) {
		  slideIndex = slides.length - 1;
		} else if (slideIndex >= slides.length) {
		  slideIndex = 0;
		}
		
		const offset = slideIndex * -33.3333;
		
		for (const slide of slides) {
		  slide.style.transform = `translateX(${offset}%)`;
		}
	  }
	</script>
	<?php
	return ob_get_clean();
  }
  add_shortcode('simple_image_slider', 'simple_image_slider_shortcode');
  