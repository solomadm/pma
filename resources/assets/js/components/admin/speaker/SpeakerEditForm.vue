<template>
    <form method="post" @submit.prevent="submit" @keydown="clearErrors($event.target.name)"
          @change="clearErrors($event.target.name)">

        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('name') }">
            <label>Speaker name</label>
            <input type="text" class="form-control" placeholder="Speaker name" name="name" value=""
                   v-model="form.name" autofocus/>
            <transition name="fade">
                <span class="help-block" v-if="form.errors.has('name')" v-text="form.errors.get('name')"
                      id="validation_error_name"></span>
            </transition>
        </div>

        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('company') }">
            <label>Company name</label>

            <autocomplete
                    url="/a/speakers/company-list"
                    anchor="company"
                    class-name="auto-form"
                    ref="autocomplete"
                    placeholder="Company name"
                    :on-select="getSelect"
                    :on-focus="getData"
                    :on-input="getData"
                    name="company"
                    label="company">
            </autocomplete>

            <transition name="fade">
                <span class="help-block" v-if="form.errors.has('company')" v-text="form.errors.get('company')"
                      id="validation_error_company"></span>
            </transition>
        </div>

        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('company_title') }">
            <label>Company title</label>
            <input type="text" class="form-control" placeholder="Company title" name="company_title" value=""
                   v-model="form.company_title" autofocus/>
            <transition name="fade">
                <span class="help-block" v-if="form.errors.has('company_title')"
                      v-text="form.errors.get('company_title')"
                      id="validation_error_company_title"></span>
            </transition>
        </div>

        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('country') }">
            <label>Country</label>
            <input type="text" class="form-control" placeholder="Country" name="country" value=""
                   v-model="form.country" autofocus/>
            <transition name="fade">
                <span class="help-block" v-if="form.errors.has('country')" v-text="form.errors.get('country')"
                      id="validation_error_country"></span>
            </transition>
        </div>

        <div class="form-group has-feedback"
             :class="{ 'has-error': form.errors.has('photo') }">
            <label>Speaker photo</label>

            <image-select2 style="width:100%;" :options="assetImages" :selected="form.photo" name="photo" v-model="form.photo">
                <option value="">Select an image</option>
            </image-select2>

            <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('photo')"
                              v-text="form.errors.get('photo')"
                              id="validation_error_photo"></span>
            </transition>
        </div>


        <div class="form-group has-feedback"
             :class="{ 'has-error': form.errors.has('bio') }">
            <label>Speaker bio (HTML allowed)</label>

            <editor :value.sync="form.bio"
                    @input="form.bio = $event"
                    @init="editorInit();" lang="html" theme="chrome" width="100%"
                    height="80px"></editor>


            <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('bio')"
                              v-text="form.errors.get('bio')"
                              id="validation_error_bio"></span>
            </transition>
        </div>

        <div class="form-group has-feedback"
             :class="{ 'has-error': form.errors.has('type') }">
            <label>Speaker type</label>

            <select2 style="width:100%;" v-model="form.type">
                <option value="1" selected>Confirmed Speaker</option>
                <option value="2">Previous Speaker</option>
            </select2>

            <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('type')"
                              v-text="form.errors.get('type')"
                              id="validation_error_type"></span>
            </transition>
        </div>

        <div class="form-group col-md-12">

            <div class="col-md-6 checkbox checkbox-slider--b-flat checkbox-slider-md">
                <label>
                    <input type="checkbox" value="true" name="enabled" v-model="form.enabled"><span><h4
                        class="box-title">Enabled</h4></span>
                </label>
            </div>

            <div class="col-md-6 checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top:10px;">
                <label>
                    <input type="checkbox" value="true" name="featured" v-model="form.featured"><span><h4
                        class="box-title">Featured</h4></span>
                </label>
            </div>

        </div>

        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat" :disabled="busy">Save Speaker</button>
            </div>
        </div>
    </form>
</template>


<style src="../fade.css"></style>


<script>
    import Form from 'acacha-forms'
    import redirect from '../redirect'

    export default {
        mixins: [redirect],
        components: {},
        data: function () {
            return {
                busy: false,
                hostname: 'https://' + window.location.hostname + "/",
                showModal: false
            }
        },
        computed: {
            form: function () {
                return new Form({
                    id: this.speakerData.id,
                    name: this.speakerData.name,
                    company: this.speakerData.company,
                    company_title: this.speakerData.company_title,
                    country: this.speakerData.country,
                    photo: this.speakerData.photo,
                    featured: this.speakerData.featured,
                    enabled: this.speakerData.enabled,
                    type: this.speakerData.type,
                    bio: this.speakerData.bio || ''
                })
            }
        },

        props: [
            'assetImages',
            'speakerData'
        ],
        watch: {
            'form.company': function (e) {
                this.$refs.autocomplete.setValue(e);
            }
        },
        methods: {
            getSelect(d) {
                this.form.company = d.company;
                console.log(d);
            },
            getData(d) {
                this.form.company = d;
                console.log(d);
            },
            editorInit: function (editor) {
                require('vue2-ace-editor/node_modules/brace/mode/html');
                require('vue2-ace-editor/node_modules/brace/theme/chrome');
            },
            submit() {
                const vm = this;
                this.busy = true;
                this.form.post('/a/speakers/edit/' + this.form.id)
                    .then(response => {
                        vm.busy = false;
                        vm.$parent.close();
                        window.toastr.success('Speaker profile updated', this.form.name);
                    })
                    .catch(error => {
                        this.busy = false;
                    })
            },

            clearErrors(name) {
                this.form.errors.clear(name)
            }
        }
    }

</script>
