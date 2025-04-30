import ziggyroute from 'ziggy-js'
import {Ziggy} from '@/ziggy.generated'
const route = (name, params?, absolute?, config = Ziggy) => ziggyroute(name, params, absolute, config);

export default route
