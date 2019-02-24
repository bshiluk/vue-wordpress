# Vue.wordpress

> A Wordpress starter theme built using the WP REST API and Vue.js. Optimized for SEO, performance, and ease of development.

*This theme is intended to be used as a foundation for creating sites that function as a single-page application (SPA) on the front-end, while using Wordpress and the WP REST API to manage content and fetch data.*

## Features
* Front and Back-End run on same host ( excluding development with HMR )
* Supports various client/server code partitioning strategies for optional SEO optimization 
* Hot Module Replacement ( HMR ) for development
* Vue.js Single File Components
* Production / Development Webpack configurations
* Dynamic routing as set up in WP Dashboard ( Settings > Permalinks )
* Vue Router internal link delegation ( no need to use `<router-link />` )
* Document title tag update on route change
* Consistent in-component REST API data fetching
* Integrated REST API request caching and batching
* [REST API Data Localizer](https://github.com/bucky355/rest-api-data-localizer) for state initialization and making back-end REST API requests
* Normalized data structure
* Pagination enabled
* Utility components, including ResponsiveImage, SiteLoading, ArchiveLink, e.t.c.


To promote flexibility in implementation, styling and dependencies are limited. That said, the theme requires the following libraries:
* [Axios](https://github.com/axios/axios)
* [Vue.js](https://vuejs.org/v2/guide/)
* [Vue Router](https://router.vuejs.org/)
* [Vuex](https://vuex.vuejs.org/)

## Usage

1. Clone or download this repo in your `/wp-content/themes` directory and activate
2. Clone or download the [REST API Data Localizer](https://github.com/bucky355/rest-api-data-localizer) companion plugin in your `/wp-content/plugins` directory and activate.
3. Ensure settings in Settings > Permalinks do not violate rules as described in [Routing](#routing).
4. Install dependencies `npm install`.
5. Build the theme `npm run build`

### Development

1. Start development with HMR `npm run dev`
2. Edit `functions.php` so Wordpress enqueues the bundle served from webpack dev server
````php
// Enable For Production - Disable for Development
// wp_enqueue_script('vue_wordpress.js', get_template_directory_uri() . '/dist/vue-wordpress.js', array(), null, true);

// Enable For Development - Remove for Production
wp_enqueue_script( 'vue_wordpress.js', 'http://localhost:8080/vue-wordpress.js', array(), false, true );

````

## Client / Server Code Partitioning

TODO...

## Routing

TODO...

## State Management

TODO...

