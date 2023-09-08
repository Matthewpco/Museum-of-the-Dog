![](https://raw.githubusercontent.com/Matthewpco/Museum-of-the-Dog/main/wp-content/themes/museumofthedog/imgs/motd-page-speed.png)
![](https://raw.githubusercontent.com/Matthewpco/Museum-of-the-Dog/main/wp-content/themes/museumofthedog/imgs/motd-security-score.png)

# Musuem-of-the-Dog

## Project Summary:
All applicable pages and templates completed including: Header, mobile header, mobile navigation, footer, mobile footer, page, news archive, news single.
54 Pages created and built to work with minimal coding knowledge with the main parts functioning in Gutenberg editor.
Any customizations are classes added to the editor and styles added to the standard theme stylesheet.
Responsive media queries created for mobile viewing.

New website scores a 97 on mobile and 100 on desktop on page speed insights and is passing all Google core web vitals.
Old sites fails all core web vitals at 38 and 71.

New website has a security score of B with the final security headers to be implemented when site is fully transferred and will go to an A.
Old website security score was a D with many security holes.

New website is built to Wordpress and PHP best practices, minimizing any customization, and following standards for use and placement.
All content is built within the standard Gutenberg theme editor aside from any customized content that is not supported by default. Any further customizations can be easily done by a competent developer with basic education in html and css.

Created 5 custom plugins since there were no iframes in the old site for the advanced content.

Form Modal Shortcode is for user submissions on /museum-attractions/art-submissions/. entries appear in the dashboard under FMS entries and can also be sent via email through the settings there as well.

Hero Image Slider is for the sliding images on the front page. To add or modify images go to the plugin page in dashboard under tools. There is an input area for an image url and the title that gets displayed below it.

Plugin Modal list is for the display of popup lists on /get-involved/wall-of-fame/ and /get-involved/corporate-giving/. This creates a page called Wall of Fame in the dashboard that has two input boxes, one for the wall of fame, and one for corporate giving. The first input is a list of comma separated names that is then divided into two lists and displayed in two columns. The second input for corporate giving is a list of names with comma separated urls for images and the line breaks separate those items automatically.

Posts category filter is for displaying news posts with a selector for categories that then dynamically shows posts matching that category with navigation.

Simple image slider is for the past exhibitions on /museum-attractions/exhibitions/. Content can be changed inside the main plugin file inside the function simple_image_slider_shortcode.

Additional plugins:
WP Mail SMTP is installed for the final configuration of the client's desired email system. Wordpress alone just sends mail through a basic php function and this is needed to configure for proper routing and filtering of emails.

WP Forms is used for contact and submission forms so they can simply be modified or created in the future, and directly hooks into the previous plugin for actual smtp routing without any further customization that would normally be needed.

### Install instructions:
To import the site simply take a backup from wp all in one migration and import it onto a clean site with the plugin installed. This plugin is free and transfers the files as well as database in one click within minutes. Site is also on Github at https://github.com/Matthewpco/Museum-of-the-Dog and can be forked from there, but that does not contain the database. Website is currently located at https://project-motd.cloud/ and can be accessed with the following credentials.

#### Will host current site at project-motd.cloud for 90 days.

![](https://raw.githubusercontent.com/Matthewpco/Museum-of-the-Dog/main/wp-content/themes/museumofthedog/imgs/motd-old-score.png)
![](https://raw.githubusercontent.com/Matthewpco/Museum-of-the-Dog/main/wp-content/themes/museumofthedog/imgs/motd-old-security-score.png)
