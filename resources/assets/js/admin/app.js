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
} catch (e) {}

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
Vue.component('login-form', require('../components/admin/auth/LoginForm.vue'))
Vue.component('email-reset-password-form', require('../components/admin/auth/EmailResetPasswordForm.vue'))
Vue.component('reset-password-form', require('../components/admin/auth/ResetPasswordForm.vue'))

Vue.component('select2', require('../components/admin/wrappers/Select2.vue'))
Vue.component('image-select2', require('../components/admin/wrappers/ImageSelect2.vue'))
Vue.component('editor', require('vue2-ace-editor'))
Vue.component('autocomplete', require('vue2-autocomplete-js'))

Vue.component('conference-switcher', require('../components/admin/conference/ConferenceSwitcher.vue'))

Vue.component('conference-table', require('../components/admin/conference/ConferenceTable.vue'))
Vue.component('conference-button-new', require('../components/admin/conference/ConferenceButtonNew.vue'))
Vue.component('conference-create-form', require('../components/admin/conference/ConferenceCreateForm.vue'))
Vue.component('conference-edit-form', require('../components/admin/conference/ConferenceEditForm.vue'))

Vue.component('speaker-table', require('../components/admin/speaker/SpeakerTable.vue'))
Vue.component('speaker-button-new', require('../components/admin/speaker/SpeakerButtonNew.vue'))
Vue.component('speaker-create-form', require('../components/admin/speaker/SpeakerCreateForm.vue'))
Vue.component('speaker-edit-form', require('../components/admin/speaker/SpeakerEditForm.vue'))

Vue.component('media-manager', require('../components/admin/content/MediaManager.vue'))

Vue.component('content-global', require('../components/admin/content/ContentGlobal.vue'))

Vue.component('content-base-home', require('../components/admin/content/base/ContentBaseHome.vue'))
Vue.component('content-base-speakers', require('../components/admin/content/base/ContentBaseSpeakers.vue'))
Vue.component('content-base-programme', require('../components/admin/content/base/ContentBaseProgramme.vue'))
Vue.component('content-base-register', require('../components/admin/content/base/ContentBaseRegister.vue'))
Vue.component('content-base-login', require('../components/admin/content/base/ContentBaseLogin.vue'))

Vue.component('delegate-list', require('../components/admin/delegate/DelegateList.vue'))
Vue.component('delegate-table', require('../components/admin/delegate/DelegateTable.vue'))
Vue.component('delegate-edit-form', require('../components/admin/delegate/DelegateEditForm.vue'))
Vue.component('delegate-button-new', require('../components/admin/delegate/DelegateButtonNew.vue'))
//Vue.component('delegate-upload-csv', require('../components/admin/speaker/SpeakerButtonNew.vue'))
//Vue.component('delegate-create-form', require('../components/admin/speaker/SpeakerCreateForm.vue'))

Vue.component('contacts-list', require('../components/admin/contact/ContactsList.vue'))
Vue.component('media-list', require('../components/admin/media/MediaList.vue'))

const app = new Vue({
    el: '#app',
    data: function () {
      return {
        urlService: window.urlService
      }
    }
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

require('brace');
require('axios');
