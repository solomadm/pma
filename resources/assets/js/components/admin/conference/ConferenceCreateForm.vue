<template>
    <form method="post" @submit.prevent="submit" @keydown="clearErrors($event.target.name)" @change="clearErrors($event.target.name)">
        <div class="alert alert-success text-center" v-show="busy" id="result"> Creating conference &nbsp;&nbsp;
            <i class="fa fa-refresh fa-spin"></i>
        </div>

        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('name') }">
            <label>Conference name</label>
            <input type="text" class="form-control" placeholder="Conference name" name="name" value=""
                   v-model="form.name" autofocus/>
            <transition name="fade">
                <span class="help-block" v-if="form.errors.has('name')" v-text="form.errors.get('name')"
                      id="validation_error_name"></span>
            </transition>
        </div>

        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('url_slug') }">
            <label>URL Slug</label>

            <div class="input-group">
                <span class="input-group-addon" v-text="hostname"></span>
                <input class="form-control" placeholder="URL Slug" name="url_slug" value=""
                       v-model="form.url_slug">
            </div>

            <transition name="fade">
                <span class="help-block" v-if="form.errors.has('url_slug')" v-text="form.errors.get('url_slug')"
                      id="validation_error_url_slug"></span>
            </transition>
        </div>

        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('frontend_theme') }">
            <label>Frontend Theme</label>

            <select2 style="width:100%;" class="form-control" :options="frontend_themes" :selected="form.frontend_theme" name="frontend_theme" v-model="form.frontend_theme">
                <option value="">Select a frontend theme</option>
            </select2>

            <transition name="fade">
                <span class="help-block" v-if="form.errors.has('frontend_theme')" v-text="form.errors.get('frontend_theme')"
                      id="validation_error_frontend_theme"></span>
            </transition>
        </div>

        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('admin_theme') }">
            <label>Admin theme colour</label>

            <select2 style="width:100%;" class="form-control" :options="admin_themes" :selected="form.admin_theme" name="admin_theme" v-model="form.admin_theme">
                <option value="">Select an admin theme colour</option>
            </select2>

            <transition name="fade">
                <span class="help-block" v-if="form.errors.has('admin_theme')" v-text="form.errors.get('admin_theme')"
                      id="validation_error_admin_theme"></span>
            </transition>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat" :disabled="busy">Create
                </button>
            </div>
        </div>
    </form>
</template>

<style src="../fade.css"></style>

<script>

    import Form from 'acacha-forms'
    import initialitzeIcheck from '../InitializeIcheck'
    import redirect from '../redirect'

    export default {
        mixins: [initialitzeIcheck, redirect],
        data: function () {
            let form = new Form({name: '', admin_theme: '', url_slug: '', frontend_theme: ''})

            return {
                form: form,
                busy: false,
                hostname: 'https://'+window.location.hostname+"/",
                admin_themes: [
                    {
                        text: "Blue",
                        id: "blue"
                    },
                    {
                        text: "Purple",
                        id: "purple"
                    },
                    {
                        text: "Red",
                        id: "red"
                    },
                    {
                        text: "White",
                        id: "black"
                    },
                    {
                        text: "Green",
                        id: "green"
                    },
                    {
                        text: "Yellow",
                        id: "yellow"
                    }
                ]
            }
        },
        props: [
            'frontend_themes'
        ],
        computed: {

        },
        watch: {
            'form.name': function (value) {

            },
            'form.admin_theme': function(value){
                this.form.errors.clear('admin_theme'); //FIXME: This is a hack to clear errors for select2 components in forms.
                this.form.errors.clear('frontend_theme');
            }
        },
        methods: {
            submit () {
                console.log("submitting");
                this.busy = true;
                this.form.post('/a/conference/create')
                    .then(response => {
                        var component = this;
                        this.busy = false;
                        component.redirect('/a')
                    })
                    .catch(error => {
                        this.busy = false;
                    })
            },
            clearErrors (name) {
                this.form.errors.clear(name)
            }
        }
    }

</script>
