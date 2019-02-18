
function categorySlugFromParams({ cat1, cat2, cat3 }) {
  if (cat3 && (cat3 !== 'page' && cat2 !== 'page')) {
    return cat3
  } else if(cat2 && cat2 !== 'page') {
    return cat2
  } else {
    return cat1
  }
}

function pageFromParams({ page }) {
  return page ? parseInt(page.replace('page/', '')) : 1
}

function pageFromPath(path) {
  let p = path.split('/').filter(i => i)
  if (p.length > 1 && p[p.length - 2] === 'page') {
    return parseInt(p[p.length - 1])
  } else {
    return 1
  }
}

export {
  categorySlugFromParams,
  pageFromParams,
  pageFromPath
}
