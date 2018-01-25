<template>
    <form method="post" @submit.prevent="submit"
          @keydown="clearErrors($event.target.name)"
          @change="clearErrors($event.target.name)">

        <div class="box">
            <div class="box-header with-border">
                <span><h3 class="box-title">Global Meta</h3></span>
            </div>
            <div class="box-body">
                <div class="col-md-12">

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('meta_title') }">
                        <label>Meta title suffix (Appears after the page title in the browser bar)</label>

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
                        <label>Meta description fallback (if page has no meta description, it will use this)</label>

                        <input type="text" class="form-control" placeholder="Meta description" name="meta_description" value=""
                               v-model="form.meta_description" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('meta_description')"
                              v-text="form.errors.get('meta_description')"
                              id="validation_error_meta_description"></span>
                        </transition>
                    </div>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Website Colours</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">

                    <div class="col-md-3 form-group"
                         :class="{ 'has-error': form.errors.has('primary_color_1') }">
                        <label>Primary color 1</label>

                        <input class="form-control" type="color" name="primary_color_1" v-model="form.primary_color_1" />

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('primary_color_1')"
                              v-text="form.errors.get('primary_color_1')"
                              id="validation_error_primary_color_1"></span>
                        </transition>
                    </div>

                    <div class="col-md-3 form-group"
                         :class="{ 'has-error': form.errors.has('primary_color_2') }">
                        <label>Primary color 2</label>

                        <input class="form-control" type="color" name="primary_color_2" v-model="form.primary_color_2" />

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('primary_color_2')"
                              v-text="form.errors.get('primary_color_2')"
                              id="validation_error_primary_color_2"></span>
                        </transition>
                    </div>

                    <div class="col-md-3 form-group"
                         :class="{ 'has-error': form.errors.has('primary_text_1') }">
                        <label>Primary text color 1</label>

                        <input class="form-control" type="color" name="primary_text_1" v-model="form.primary_text_1" />

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('primary_text_1')"
                              v-text="form.errors.get('primary_text_1')"
                              id="validation_error_primary_text_1"></span>
                        </transition>
                    </div>

                    <div class="col-md-3 form-group"
                         :class="{ 'has-error': form.errors.has('primary_text_2') }">
                        <label>Primary text color 2</label>

                        <input class="form-control" type="color" name="primary_text_2" v-model="form.primary_text_2" />

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('primary_text_2')"
                              v-text="form.errors.get('primary_text_2')"
                              id="validation_error_primary_text_2"></span>
                        </transition>
                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>


        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Website Header</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('forum_title') }">
                        <label>Forum title (appears on homepage header, HTML allowed)</label>

                        <editor v-model="form.forum_title" @init="editorInit();" lang="html" theme="chrome" width="100%" height="80px"></editor>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('forum_title')"
                              v-text="form.errors.get('forum_title')"
                              id="validation_error_forum_title"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('header_banner') }">
                        <label>Header Banner (html allowed)</label>

                        <!--<textarea name="header_banner" class="form-control" style="resize: none;height:75px;" placeholder="Header banner text"></textarea>-->

                        <editor v-model="form.header_banner" @init="editorInit();" lang="html" theme="chrome" width="100%" height="80px"></editor>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('header_banner')"
                              v-text="form.errors.get('header_banner')"
                              id="validation_error_header_banner"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('forum_date') }">
                        <label>Forum date (free text, appears in website header)</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Forum date"
                               name="forum_date"
                               value=""
                               v-model="form.forum_date"
                        />

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('forum_date')"
                              v-text="form.errors.get('forum_date')"
                              id="validation_error_forum_date"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('forum_venue') }">
                        <label>Forum venue (appears in website header)</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Forum venue"
                               name="forum_venue"
                               value=""
                               v-model="form.forum_venue"
                        />

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('forum_venue')"
                              v-text="form.errors.get('forum_venue')"
                              id="validation_error_forum_venue"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('event_logo') }">
                        <label>Event Logo</label>

                        <image-select2 style="width:100%;" :options="assetImages" :selected="form.event_logo" name="event_logo" v-model="form.event_logo">
                            <option value="">Select an image</option>
                        </image-select2>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('event_logo')"
                              v-text="form.errors.get('event_logo')"
                              id="validation_error_event_logo"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('header_image') }">
                        <label>Header Image</label>

                        <image-select2 style="width:100%;" :options="assetImages" :selected="form.header_image" name="header_image" v-model="form.header_image">
                            <option value="">Select an image</option>
                        </image-select2>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('header_image')"
                              v-text="form.errors.get('header_image')"
                              id="validation_error_header_image"></span>
                        </transition>
                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Website Footer</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('footer_copyright_text') }">
                        <label>Footer copyright text</label>

                        <input type="text"
                               class="form-control"
                               placeholder="Footer copyright text"
                               name="footer_copyright_text"
                               value=""
                               v-model="form.footer_copyright_text"
                        />

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('footer_copyright_text')"
                              v-text="form.errors.get('footer_copyright_text')"
                              id="validation_error_footer_copyright_text"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('footer_background_image') }">
                        <label>Footer background image</label>

                        <image-select2 style="width:100%;" :options="assetImages" :selected="form.footer_background_image" name="footer_background_image" v-model="form.footer_background_image">
                            <option value="">Select an image</option>
                        </image-select2>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('footer_background_image')"
                              v-text="form.errors.get('footer_background_image')"
                              id="validation_error_footer_background_image"></span>
                        </transition>
                    </div>

                    <div class="col-md-3 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('footer_left_text') }">
                        <label>Footer left text (leave blank to not display)</label>

                        <input type="text"
                               class="form-control"
                               placeholder="Footer left text"
                               name="footer_left_text"
                               value=""
                               v-model="form.footer_left_text"
                        />

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('footer_left_text')"
                              v-text="form.errors.get('footer_left_text')"
                              id="validation_error_footer_footer_left_text"></span>
                        </transition>
                    </div>

                    <div class="col-md-3 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('footer_left_link') }">
                        <label>Footer left link</label>

                        <input type="text"
                               class="form-control"
                               placeholder="Footer left link"
                               name="footer_left_link"
                               value=""
                               v-model="form.footer_left_link"
                        />

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('footer_left_link')"
                              v-text="form.errors.get('footer_left_link')"
                              id="validation_error_footer_left_link"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('footer_left_image') }">
                        <label>Footer left image (leave blank to not display)</label>

                        <image-select2 style="width:100%;" :options="assetImages" :selected="form.footer_left_image" name="footer_left_image" v-model="form.footer_left_image">
                            <option value="">Select an image</option>
                        </image-select2>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('footer_left_image')"
                              v-text="form.errors.get('footer_left_image')"
                              id="validation_error_footer_left_image"></span>
                        </transition>
                    </div>

                    <div class="col-md-3 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('footer_right_text') }">
                        <label>Footer right text (leave blank to not display)</label>

                        <input type="text"
                               class="form-control"
                               placeholder="Footer right text"
                               name="footer_right_text"
                               value=""
                               v-model="form.footer_right_text"
                        />

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('footer_right_text')"
                              v-text="form.errors.get('footer_right_text')"
                              id="validation_error_footer_right_text"></span>
                        </transition>
                    </div>

                    <div class="col-md-3 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('footer_right_link') }">
                        <label>Footer right link</label>

                        <input type="text"
                               class="form-control"
                               placeholder="Footer right link"
                               name="footer_right_link"
                               value=""
                               v-model="form.footer_right_link"
                        />

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('footer_right_link')"
                              v-text="form.errors.get('footer_right_link')"
                              id="validation_error_footer_right_link"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('footer_right_image') }">
                        <label>Footer right image (leave blank to not display)</label>

                        <image-select2 style="width:100%;" :options="assetImages" :selected="form.footer_right_image" name="footer_right_image" v-model="form.footer_right_image">
                            <option value="">Select an image</option>
                        </image-select2>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('footer_right_image')"
                              v-text="form.errors.get('footer_right_image')"
                              id="validation_error_footer_right_image"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('footer_social_text') }">
                        <label>Footer social text (leave blank to not display)</label>

                        <input type="text"
                               class="form-control"
                               placeholder="Footer social text"
                               name="footer_social_text"
                               value=""
                               v-model="form.footer_social_text"
                        />

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('footer_social_text')"
                              v-text="form.errors.get('footer_social_text')"
                              id="validation_error_footer_social_text"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Facebook link (leave blank to not display)</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Facebook link"
                               name="footer_social_link_fb"
                               value=""
                               v-model="form.footer_social_link_fb"
                        />
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Twitter link (leave blank to not display)</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Twitter link"
                               name="footer_social_link_tw"
                               value=""
                               v-model="form.footer_social_link_tw"
                        />
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Linkedin link (leave blank to not display)</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Linkedin link"
                               name="footer_social_link_ln"
                               value=""
                               v-model="form.footer_social_link_ln"
                        />
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Youtube link (leave blank to not display)</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Youtube link"
                               name="footer_social_link_yt"
                               value=""
                               v-model="form.footer_social_link_yt"
                        />
                    </div>



                </div>
            </div>
            <!-- /.box-body -->
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

<style src="../fade.css"></style>

<script>

    import Form from 'acacha-forms'
    import initialitzeIcheck from '../InitializeIcheck'
    import redirect from '../redirect'
    import valueOrEmpty from '../valueOrEmpty'

    export default {
        mixins: [initialitzeIcheck, redirect, valueOrEmpty],
        data: function () {
            let form = new Form({
                meta_title: this.valueOrEmpty(this.content.meta_title),
                meta_description: this.valueOrEmpty(this.content.meta_description),
                primary_color_1: this.valueOrEmpty(this.content.primary_color_1),
                primary_color_2: this.valueOrEmpty(this.content.primary_color_2),
                primary_text_1: this.valueOrEmpty(this.content.primary_text_1),
                primary_text_2: this.valueOrEmpty(this.content.primary_text_2),
                forum_title: this.valueOrEmpty(this.content.forum_title),
                forum_date: this.valueOrEmpty(this.content.forum_date),
                forum_venue: this.valueOrEmpty(this.content.forum_venue),
                event_logo: this.valueOrEmpty(this.content.event_logo),
                header_banner: this.valueOrEmpty(this.content.header_banner),
                header_image: this.valueOrEmpty(this.content.header_image),
                footer_background_image: this.valueOrEmpty(this.content.footer_background_image),
                footer_copyright_text: this.valueOrEmpty(this.content.footer_copyright_text),
                footer_left_text: this.valueOrEmpty(this.content.footer_left_text),
                footer_left_link: this.valueOrEmpty(this.content.footer_left_link),
                footer_left_image: this.valueOrEmpty(this.content.footer_left_image),
                footer_right_text: this.valueOrEmpty(this.content.footer_right_text),
                footer_right_link: this.valueOrEmpty(this.content.footer_right_link),
                footer_right_image: this.valueOrEmpty(this.content.footer_right_image),
                footer_social_text: this.valueOrEmpty(this.content.footer_social_text),
                footer_social_link_fb: this.valueOrEmpty(this.content.footer_social_link_fb),
                footer_social_link_tw: this.valueOrEmpty(this.content.footer_social_link_tw),
                footer_social_link_ln: this.valueOrEmpty(this.content.footer_social_link_ln),
                footer_social_link_yt: this.valueOrEmpty(this.content.footer_social_link_yt),
            })

            return {
                form: form,
                busy: false
            }
        },
        components: [
            'editor',
            'color'
        ],
        props: [
            'assetImages',
            'content'
        ],
        computed: {},
        watch: {
            'form.admin_theme': function (value) {
                this.form.errors.clear('admin_theme'); //FIXME: This is a hack to clear errors for select2 components in forms.
                this.form.errors.clear('frontend_theme');
            }
        },
        mounted: function(){
            console.log(this.content);
        },
        methods: {
            editorInit:function (editor) {
                require('vue2-ace-editor/node_modules/brace/mode/html');
                require('vue2-ace-editor/node_modules/brace/theme/chrome');
            },
            submit () {
                this.busy = true;
                this.form.post('/a/content/global')
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
