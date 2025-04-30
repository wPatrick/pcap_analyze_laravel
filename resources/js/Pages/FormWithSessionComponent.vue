<script>
import useLayout from '../lib/FormLayout'

export default {
  name: 'FormWithSessionComponent',
  layout: (h, page) => useLayout(h, page, Layout, Create, Edit),
}
</script>
