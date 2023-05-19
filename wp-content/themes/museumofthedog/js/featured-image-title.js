let featuredImagePostTitle = document.querySelector('.featured-image-post-title');
if (featuredImagePostTitle) {
    featuredImagePostTitle.remove();
    let motdFeaturedImage = document.querySelector('.motd-featured-image');
    if (motdFeaturedImage) {
        motdFeaturedImage.appendChild(featuredImagePostTitle);
        featuredImagePostTitle.classList.add('hero-image-title');
		featuredImagePostTitle.classList.remove('featured-image-post-title');
    }
}