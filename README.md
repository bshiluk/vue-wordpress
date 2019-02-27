![Vue.wordpress icon](http://vue-wordpress.com/wp-content/uploads/2019/02/iconcomb3-1-2-e1551047832430.png)
# Vue.wordpress

> A Wordpress starter theme built using the WP REST API and Vue.js. Optimized for SEO, performance, and ease of development.

*This theme is intended to be used as a foundation for creating sites that function as a single-page application (SPA) on the front-end, while using Wordpress and the WP REST API to manage content and fetch data.*

**Check out [a demo of the theme](http://vue-wordpress.com)**

# Table of Contents

  - [Features](#features)
  - [Libraries](#libraries)
  - [Usage](#usage)
    - [Development](#development)
    - [Deployment](#deployment)
  - [How it Works](#how-it-works)
  - [Routing](#routing)
    - [Permalinks to Routes](#permalinks-to-routes)
    - [Exceptions](#exceptions)
    - [Notes on Permalink Structure](#notes-on-permalink-structure)
    - [Category and Tag Base](#category-and-tag-base)
    - [Homepage and Posts Per Page](#homepage-and-posts-per-page)
    - [Internal Link Delegation](#internal-link-delegation)
  - [State Management](#state-management)
    - [Store Initialization and Structure](#store-initialization-and-structure)
    - [Requesting Data](#requesting-data)
    - [Request Caching](#request-caching)
    - [Actions Api Reference](#actions-api-reference)
      - [Request an item of type by its slug](#request-an-item-of-type-by-its-slug)
      - [Request an item of type by its id](#request-an-item-of-type-by-its-id)
      - [Request a list of items](#request-a-list-of-items)
    - [Getters Api Reference](#getters-api-reference)
      - [Get an item of type by slug](#get-an-item-of-type-by-slug)
      - [Get an item of type by id](#get-an-item-of-type-by-id)
      - [Get a list of items](#get-a-list-of-items)
  - [SEO](#seo)
    
## Features
* Front and Back-End run on same host
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

## Libraries
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
2. Only include Wordpress theme files ( i.e. `style.css`, `functions.php`, `index.php`, `screenshot.png` e.t.c.) and the `/dist/` directory
3. Edit `functions.php` so Wordpress enqueues the bundle served from your `/dist/` directory
````php
// Enable For Production - Disable for Development
wp_enqueue_script('vue_wordpress.js', get_template_directory_uri() . '/dist/vue-wordpress.js', array(), null, true);
````

## How it Works

General Overview:
1. Wordpress creates initial content and localizes a `__VUE_WORDPRESS__` variable with initial state, routing info, and any client side data not accessible through the WP REST API.
2. Client renders initial content, and once js is parsed, `__VUE_WORDPRESS__` is used to create the Vuex store, Vue Router routes, and the app is mounted.
3. Vue takes over all future in-site navigation, using the WP_REST_API to request data, essentially transforming the site into a SPA.

## Routing

### Permalinks to Routes

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

### Notes on Permalink Structure

- Using `/%category%/%postname%/` or `/%tag%/%postname%/` will cause problems with nested pages
- Problems with the permalink structure are generally because the router can't differentiate between a post and a page. While this may be solved with Navigation Guards and in component logic to check data and redirect when necessary, the introduced complexity is out of scope for this starter theme.
- Routes for custom post types will be needed to be added as necessary.
- Routing is by default dynamic, however when a structure is defined it is probably in the best interest of the developer to refactor and simplify the routing to be static.

### Category and Tag Base

If you want to edit the category and tag permalink bases within the same Settings > Permalinks screen, that is supported as well.

### Homepage and Posts Per Page

Additionally, in Settings > Reading you can adjust what your home page displays and posts shown per page ( labeled 'Blog pages to show at most' ).

### Internal Link Delegation

Within a Vue application, all links not implemented with `<router-link />` trigger a full page reload. Since content is dynamic and managed using Wordpress, links within content are unavoidable and it would be impractical to try and convert all of them to `<router-link />`. To handle this, an event listener is bound to the root app component, so that all links referencing internal resources are delegated to Vue Router.

*Adapted from Dennis Reimann's [Delegating HTML links to vue-router](https://dennisreimann.de/articles/delegating-html-links-to-vue-router.html)*

This has the added benefit of being able to compose components using the 'link' property returned from WP REST API resources without having to convert to a relative format corresponding to the router base for `<router-link />`.

Instead of:
````html
<router-link :to="convertToRelative(tag.link)">{{ tag.name }}</router-link>
````
You can do: 
````html
<a :href="tag.link">{{ tag.name }}</a>
````

## State Management

A Vuex store is used to manage the state for this theme, so it is recommended at the very least to know [what it is](https://vuex.vuejs.org/) and become familiar with some of the [core concepts](https://vuex.vuejs.org/guide/state.html). That said, you'd be surprised at the performant and user-friendly themes you can build without even modifying the Vuex files in `/src/store/`.

### Store Initialization and Structure

Normally, you would find the structure of a Vuex store in the file that initializes it. Even though it is initialized in `/src/store/index.js`, the schema is defined in `functions.php`. This allows you to use the use the [REST API Data Localizer](https://github.com/bucky355/rest-api-data-localizer) to prepopulate the store with both WP REST API data in addition to any other data you may need for your state not available through the WP REST API.

````php
// functions.php 

new RADL( '__VUE_WORDPRESS__', 'vue_wordpress.js', array(
    'routing' => RADL::callback( 'vue_wordpress_routing' ),
    'state' => array(
        'categories' => RADL::endpoint( 'categories'),
        'media'      => RADL::endpoint( 'media' ),
        'menus'      => RADL::callback( 'vue_wordpress_menus' ),
        'pages'      => RADL::endpoint( 'pages' ),
        'posts'      => RADL::endpoint( 'posts' ),
        'tags'       => RADL::endpoint( 'tags' ),
        'users'      => RADL::endpoint( 'users' ),
        'site'       => RADL::callback( 'vue_wordpress_site' ),
    ),
) );
````

As you can see below, the `__VUE_WORDPRESS__.state` key is used for the store.

````js
// src/store/index.js

const { state } = __VUE_WORDPRESS__

export default new Vuex.Store({
  state,
  getters,
  mutations,
  actions
})
````
*You may want to decouple this localized store from your Vuex store at some point, but I think it decreases the initial complexity.*

### Requesting Data

You will not see any WP REST API requests within the components of the theme. Instead, Vuex actions are dispatched signalling a need for asynchronous data. If the data is not available in the store, only then is a request made. When the request is returned the response data is added to the store.

### Request Caching

Every time there is a request for a list of items, a request object is generated once the response is received.
````js
// Example request object
{
  data: [ 121, 221, 83, 4, 23, 76 ], // ids of items 
  params: { page: 1, per_page: 6 }, 
  total: 21,
  totalPages: 4 
}
````
This object is added to the store and next time a list of items of the same type and params are requested, the data key is used to create the response instead of querying the server.

Note that these request objects are not created for requests for a single resource by its identifier because checking the store for them before making a request is trivial.

### Actions Api Reference

#### Request an item of type by its slug

````js
this.$store.dispatch('getSingleBySlug', { type, slug, showLoading })
````
- `type` is the key in the store and the endpoint for the resource
  - `string`
  - required
- `slug` is the alphanumeric identifier for the resource
  - `string`
  - required
- `showLoading` indicates whether a loading indicator should be shown
  - `boolean`
  - default: `false`

##### Example
```` js
// request a page with slug 'about' and show loading indicator
this.$store.dispatch('getSingleBySlug', { type: 'pages', slug: 'about', showLoading: true })
````

#### Request an item of type by its id

````js
this.$store.dispatch('getSingleById', { type, id, batch })
````
- `type` is the key in the store and the endpoint for the resource
  - `string`
  - required
- `id` is the numeric identifier for the resource
  - `number`
  - required
- `batch` indicates whether a short delay will be added before making the request. During this delay any requests with duplicate ids are ignored and ids of the same type are consolidated into a single request using the `include` WP REST API argument.
  - `boolean`
  - default: `false`
  
*View the [theme demo](http://vue-wordpress.com), open the Network panel of your browser, and navigate to a posts feed to see the batch feature in action.*

##### Examples
```` js
// request a tag with an id of 13 with batching
this.$store.dispatch('getSingleById', { type: 'tags', id: 13, batch: true })
// request a tag with an id of 21 with batching
this.$store.dispatch('getSingleById', { type: 'tags', id: 21, batch: true })

// Even if these are called from different components or instances of the same component, the batched request would look like /wp/v2/tags/?include[]=13&include[]=21&per_page=100
````

#### Request a list of items

````js
this.$store.dispatch('getItems', { type, params, showLoading })
````
- `type` is the key in the store and the endpoint for the resource
  - `string`
  - required
- `params` are the parameters to use for the request
  - `Object`
  - required
- `showLoading` indicates whether a loading indicator should be shown
  - `boolean`
  - default: `false`

##### Example
````js
// request the first page of the most recent posts limited to 10 posts per page
this.$store.dispatch('getItems', { type: 'posts', params: [ page: 1, per_page: 10, orderby: 'date', order: 'desc' ] })
````

### Getters Api Reference

You'll notice the arguments for the getters are a subset of their corresponding action arguments. This is because the actions use the getters themeselves to make sure the data is not already in the store before making a request.

#### Get an item of type by slug

````js
this.$store.getters.singleBySlug({ type, slug })
````

#### Get an item of type by id

````js
this.$store.getters.singleById({ type, id })
````

#### Get a list of items 

````js
this.$store.getters.requestedItems({ type, params })
````


## SEO

TODO...
