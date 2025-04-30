export default function useLayout(h, page, Layout, Create , Edit) {
  if(page.props.method === 'edit')
    return h(Layout, page.props, () => h(Edit, () => page))
  return h(Layout, page.props, () => h(Create, () => page))
}

