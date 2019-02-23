// Route components
import Home from '@/components/Home'
import NotFound from '@/components/404'
import DateArchive from '@/components/DateArchive'
import AuthorArchive from '@/components/AuthorArchive'
import TaxonomyArchive from '@/components/TaxonomyArchive'
import Single from '@/components/Single'
import Page from '@/components/Page'
// Route paths as formatted in WP permalink settings
import paths from './paths'
// Route composition utilities
import {
  categorySlugFromParams,
  pageFromParams,
  pageFromPath
} from './utils'


const { show_on_front, page_for_posts, page_on_front } = __VUE_WORDPRESS__.routing

const postsPageRoute = show_on_front === 'page' && page_for_posts ? {
  path: paths.postsPage(page_for_posts),
  component: Home,
  name: 'Posts',
  props: route => ({ page: pageFromPath(route.path) })
} : null

const rootRoute = show_on_front === 'page' && page_on_front ? {
  path: '/',
  component: Page,
  name: 'Home',
  props: () => ({ slug: page_on_front }),
} : {
  path: paths.postsPage(),
  component: Home,
  name: 'Home',
  props: route => ({ page: pageFromPath(route.path) }),
}

export default [
  rootRoute,
  postsPageRoute,
  {
    path: '/404',
    component: NotFound,
    name: '404'
  },
  {
    path: paths.dateArchive,
    component: DateArchive,
    name: 'DateArchive',
    props: route => (Object.assign(route.params, { page: pageFromPath(route.path) }))
  },
  {
    path: paths.authorArchive,
    component: AuthorArchive,
    name: 'AuthorArchive',
    props: route => (Object.assign(route.params, { page: pageFromPath(route.path) }))
  },
  {
    path: paths.categoryArchive,
    component: TaxonomyArchive,
    name: 'CategoryArchive',
    props: route =>  (Object.assign(route.params, { type: 'categories', slug: categorySlugFromParams(route.params), page: pageFromPath(route.path) } ))
  },
  {
    path: paths.tagArchive,
    component: TaxonomyArchive,
    name: 'TagArchive',
    props: route => (Object.assign(route.params, { type: 'tags' }, { page: pageFromPath(route.path) }))
  },
  {
    path: paths.single,
    component: Single,
    name: 'Single',
    props: route => ({ slug: route.params.slug }),
  },
  /**
   * This also functions as a catch all redirecting
   * to 404 if a page isn't found with slug prop
   */
  {
    path: '/:slugs+',
    component: Page,
    name: 'Page',
    props: route => ({ slug: route.params.slugs.split('/').filter(s => s).pop() })
  }
].filter(route => route) // Removes empty route objects
