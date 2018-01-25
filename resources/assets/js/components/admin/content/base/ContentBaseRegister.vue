<template>
    <form method="post" @submit.prevent="submit"
          @keydown="clearErrors($event.target.name)"
          @change="clearErrors($event.target.name)">

        <div class="box">
            <div class="box-header with-border">
                <span><h3 class="box-title">Page Meta</h3></span>
            </div>
            <div class="box-body">
                <div class="col-md-12">

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('meta_title') }">
                        <label>Meta title</label>

                        <input type="text" class="form-control" placeholder="Meta title" name="meta_title" value=""
                               v-model="form.meta_title" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('meta_title')"
                              v-text="form.errors.get('meta_title')"
                              id="validation_error_meta_title"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('meta_description') }">
                        <label>Meta description</label>

                        <input type="text" class="form-control" placeholder="Meta description" name="meta_description" value=""
                               v-model="form.meta_description" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('meta_description')"
                              v-text="form.errors.get('meta_description')"
                              id="validation_error_meta_description"></span>
                        </transition>
                    </div>

                    <div class="col-md-3 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('menu_title') }">
                        <label>Navigation Label</label>

                        <input type="text" class="form-control" placeholder="Navigation label" name="menu_title" value=""
                               v-model="form.menu_title" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('menu_title')"
                              v-text="form.errors.get('menu_title')"
                              id="validation_error_menu_title"></span>
                        </transition>
                    </div>

                    <div class="col-md-3 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('menu_order') }">
                        <label>Navigation Order</label>

                        <input type="text" class="form-control" placeholder="Navigation order" name="menu_order" value=""
                               v-model="form.menu_order" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('menu_order')"
                              v-text="form.errors.get('menu_order')"
                              id="validation_error_menu_order"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('header_image_override') }">
                        <label>Override header image (leave blank to use global header image)</label>

                        <image-select2 style="width:100%;" :options="assetImages" :selected="form.header_image_override" name="header_image_override" v-model="form.header_image_override">
                            <option value="">Select an image</option>
                        </image-select2>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('header_image_override')"
                              v-text="form.errors.get('header_image_override')"
                              id="validation_error_header_image_override"></span>
                        </transition>
                    </div>

                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <span><h3 class="box-title">Page Content</h3></span>
            </div>
            <div class="box-body">
                <div class="col-md-12">

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('page_heading') }">
                        <label>Page heading</label>

                        <input type="text" class="form-control" placeholder="Page heading" name="page_heading" value=""
                               v-model="form.page_heading" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('page_heading')"
                              v-text="form.errors.get('page_heading')"
                              id="validation_error_page_heading"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('page_subheading') }">
                        <label>Subheading (html allowed)</label>

                        <editor v-model="form.page_subheading" @init="editorInit();" lang="html" theme="chrome" width="100%" height="80px"></editor>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('page_subheading')"
                              v-text="form.errors.get('page_subheading')"
                              id="validation_error_page_subheading"></span>
                        </transition>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                        :disabled="busy"><span v-if="!busy">Save</span><i v-if="busy" class="fa fa-spinner fa-spin"></i>
                </button>
            </div>
        </div>

    </form>
</template>

<style src="../../fade.css"></style>

<script>

    import Form from 'acacha-forms'
    import redirect from '../../redirect'
    import valueOrEmpty from '../../valueOrEmpty'
    import timeFunctions from '../../timeFunctions'
    import Datepicker from 'vuejs-datepicker';
    import Timepicker from 'vue2-timepicker';

    export default {
        mixins: [redirect, valueOrEmpty],
        data: function () {
            let form = new Form({
                meta_title: this.valueOrEmpty(this.content.meta_title),
                meta_description: this.valueOrEmpty(this.content.meta_description),
                header_image_override: this.valueOrEmpty(this.content.header_image_override),
                menu_title: this.valueOrEmpty(this.content.menu_title),
                menu_order: this.valueOrEmpty(this.content.menu_order),
                page_heading: this.valueOrEmpty(this.content.page_heading),
                page_subheading: this.valueOrEmpty(this.content.page_subheading)
            })

            return {
                form: form,
                busy: false
            }
        },
        components: {
            'datepicker': Datepicker,
            'timepicker': Timepicker,
        },
        props: [
            'assetImages',
            'content'
        ],
        computed: {},
        watch: {},
        mounted: function () {
            console.log(this.content);
        },
        methods: {
            editorInit: function (editor) {
                require('vue2-ace-editor/node_modules/brace/mode/html');
                require('vue2-ace-editor/node_modules/brace/theme/chrome');
            },
            submit () {
                this.busy = true;
                this.form.post('/a/content/base/register')
                    .then(response => {
                        var component = this;
                        this.busy = false;
                        //component.redirect('/a')
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
