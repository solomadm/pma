/* global _ Vue */

window._ = require('lodash')

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-less');
} catch (e) {
}

require('admin-lte')
window.toastr = require('toastr')
require('icheck')
require('select2/dist/js/select2.full.js')
require('vuejs-datepicker');
require('vue2-timepicker');


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue')

// Use trans function in Vue (equivalent to trans() Laravel Translations helper). See htmlheader.balde.php partial.
Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key)
}

// VUE!
Vue.component('login-form', require('../components/frontend/auth/LoginForm.vue'))
Vue.component('register-form', require('../components/frontend/auth/RegisterForm.vue'))
Vue.component('contact-form', require('../components/frontend/contact/ContactForm.vue'))
Vue.component('media-register-form', require('../components/frontend/media/RegisterForm.vue'))
Vue.component('email-reset-password-form', require('../components/frontend/auth/EmailResetPasswordForm.vue'))
Vue.component('reset-password-form', require('../components/frontend/auth/ResetPasswordForm.vue'))

const app = new Vue({
    el: '#app'
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });

require('axios')