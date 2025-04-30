import {Inertia} from '@inertiajs/inertia'
import _ from 'lodash'

const useFormWithSession=(data, options, props)=> {
    const visit = (url) => {
        for(const [dataKey, element] of Object.entries(options.sessionRestorings)) {
            let value = JSON.stringify(_.get(data, dataKey))
            if(value !== null) {
                sessionStorage.setItem(element, value )
            }
        }
        let headers = {}
        if(props.hasOwnProperty('wizardRedirect')) {
            headers = { 'wizard-redirect': props.wizardRedirect }
        }

        Inertia.visit(route(url),{
            headers: headers,

        })
    }
    const patch = () => {
        //let headers
        //if(props.hasOwnProperty('redirectTo')) {
        //    headers = { 'wizard-redirect': props.redirectTo }
        //}
        //console.log(options.route)
        data.form.patch(options.route,
            {
                headers: headers,
                onSuccess: () => {
                    sessionStorage.setItem(options.sessionName, JSON.stringify(props.responseData))
                    Inertia.visit(props.redirectTo)
                },
            },
        )
    }
    const post = () => {
        let headers
        if(props.hasOwnProperty('redirectTo')) {
            headers = { 'wizard-redirect': props.redirectTo }
        }
        console.log(options.route)
        data.form.post(options.route,
            {
                headers: headers,
                onSuccess: () => {
                    sessionStorage.setItem(options.sessionName, JSON.stringify(props.responseData))
                    Inertia.visit(props.redirectTo)
                },
            },
        )
    }

    for(const [dataKey, propertyName] of Object.entries(options.sessionRestorings)) {
        let sessionValue = JSON.parse(sessionStorage.getItem(propertyName))
        if(sessionValue !== null) {
            data = _.set(data, dataKey, sessionValue)
            sessionStorage.removeItem(propertyName)
        }
    }

    return {
        visit, post, patch,
    }
}

export default useFormWithSession

