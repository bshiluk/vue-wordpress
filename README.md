![Vue.wordpress icon](http://vue-wordpress.com/wp-content/uploads/2019/02/iconcomb3-1-2-e1551047832430-300x300.png)
# Vue.wordpress

> A Wordpress starter theme built using the WP REST API and Vue.js. Optimized for SEO, performance, and ease of development.

*This theme is intended to be used as a foundation for creating sites that function as a single-page application (SPA) on the front-end, while using Wordpress and the WP REST API to manage content and fetch data.*

**Check out [a demo of the theme](http://vue-wordpress.com)**

## Features
* Front and Back-End run on same host ( excluding development with HMR )
* Supports various client/server code partitioning strategies for optional SEO optimization 
* Hot Module Replacement ( HMR ) for development
* Vue.js Single File Components
* Production / Development Webpack configurations
* Dynamic routing as set up in WP Dashboard ( Settings > Permalinks )
* Vue Router internal link delegation ( no need to use `<router-link />` in components )
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
### Deployment

1. Build the theme `npm run build`
2. Remember to include Wordpress theme files ( i.e. `style.css`, `functions.php`, `index.php`, `screenshot.png` e.t.c.) and the `/dist/` directory
3. Edit `functions.php` so Wordpress enqueues the bundle served from your `/dist/` directory
````php
// Enable For Production - Disable for Development
wp_enqueue_script('vue_wordpress.js', get_template_directory_uri() . '/dist/vue-wordpress.js', array(), null, true);
````

# How it Works

General Overview:
1. Wordpress creates initial content and localizes `__VUE_WORDPRESS__` with initial state, routing info, and any client side data not accessible through the WP REST API.
2. Client renders initial content and once js is parsed, `__VUE_WORDPRESS__` is used to create the Vuex store, Vue Router routes, and the app is mounted.
3. Vue takes over all future in-site navigation, using the WP_REST_API to request data, essentially transforming the site into a SPA.


## Routing

By default, routing works as defined in Settings > Permalinks. You can even define a custom structure.

![Settings > Permalinks Screenshot](http://vue-wordpress.com/wp-content/uploads/2019/02/vue-wordpress.com_wp-admin_options-permalink.php_.png)

✔️ 'Day and Name' `/%monthnum%/%day%/%postname%/`

✔️ 'Month and Name' `/%year%/%monthnum%/%day%/%postname%/`

✔️ `/my-blog/%category%/%postname%/`

✔️ `/%postname%/%author%/%category%/%year%/%monthnum%/`

### Exceptions

Using 'Plain', 'Numeric', or any custom structure that uses `%post_id%` as the sole identifier.

❌ `/%year%/%monthnum%/%post_id%/`

❌ `/archives/%post_id%/`

*However, if you combine the `%post_id%` tag with the `%postname%` tag it will work.*

✔️ `/%author%/%post_id%/%category%/%postname%/`

*If for some reason you're set on using the post id in your permalink structure, editing the `Single.vue` component to use id as a prop and fetching the post by id instead of slug should make it work.*

Using 'Post name'

❌ `/%postname%/`

*However, you can add a base to make it work*

✔️ `/some-base/%postname%/`

#### Additional Notes

- Using `/%category%/%postname%/` or `/%tag%/%postname%/` will cause problems with nested pages
- Problems with the permalink structure are generally because the router can't differentiate between a post and a page. While this may be solved with Navigation Guards and in component logic to check data and redirect when necessary, the introduced complexity is out of scope for this starter theme.
- Routes for custom post types will needed to be added as necessary.
- Routing is by default dynamic, however when a structure is defined it is probably in the best interest of the developer to refactor and simplify the routing to be static.

### Category and Tag Base

If you want to edit the category and tag permalink bases within the same Settings > Permalinks screen, that is supported as well.

### Homepage and Posts Per Page

Additionally, in Settings > Reading you can adjust what your home page displays and posts shown per page ( labeled 'Blog pages to show at most' ).

### Internal Link Delegation

Within a Vue application, all links not implemented with `<router-link />` trigger a full page reload. Since content is dynamic and managed using Wordpress, links within content are unavoidable and it would be impractical to try and convert all of them to `<router-link />`. To handle this, an event listener is bound to the root app component, so that all links referencing internal resources are delegated to Vue Router.

*Adapted from Dennis Reimann's [Delegating HTML links to vue-router](https://dennisreimann.de/articles/delegating-html-links-to-vue-router.html)*

This has the added benefit of being able to compose components using the 'link' property returned from WP REST API resources ( i.e. `<a :href="post.link">{{ post.title }}</a>` ) without having to convert to a relative format corresponding to the router base for `<router-link />`.

````html
<a :href="tag.link">{{ tag.name }}</a>
````
Instead of:

````html
<router-link :to="convertToRelative(tag.link)">{{ tag.name }}</router-link>
````

## Requesting Data

TODO...

## State Management

TODO...

## Creating Components

TODO...

## SEO

TODO...
