<template>
    <form autocomplete="off" @submit.prevent="submit" @keydown="clearErrors($event.target.name)"
          @change="clearErrors($event.target.name)">
        <!-- fake fields are a workaround for chrome autofill getting the wrong fields -->
        <input class="hidden" type="text" name="fakeusernameremembered"/>
        <input class="hidden" type="password" name="fakepasswordremembered"/>

        <div class="alert alert-success text-center" v-show="busy" v-if="isEditForm">
            Editing delegate &nbsp;&nbsp;
            <i class="fa fa-refresh fa-spin"></i>
        </div>

        <div class="alert alert-success text-center" v-show="busy" v-else>
            Adding delegate &nbsp;&nbsp;
            <i class="fa fa-refresh fa-spin"></i>
        </div>

        <div class="row">
            <div class="form-group has-feedback"
                 :class="[{ 'has-error': form.errors.has('name') }, classValue(field)]"
                 v-for="field in fields">
                <label v-if="field.type != 'boolean'">{{ field.name }}</label>

                <template v-if="field.type == 'text'">
                    <input class="form-control" placeholder="" :name="field.id" v-model="form[field.id]" autofocus/>
                </template>

                <template v-if="field.type == 'number'">
                    <input class="form-control" type="number" placeholder="" :name="field.id" v-model="form[field.id]"
                           autofocus/>
                </template>

                <template v-if="field.type == 'email'">
                    <input type="email" class="form-control" placeholder="" :name="field.id" v-model="form[field.id]"
                           autofocus/>
                </template>

                <template v-if="field.type == 'password'">
                    <input type="password" class="form-control" placeholder="" :name="field.id" v-model="form[field.id]"
                           autofocus/>
                </template>

                <template v-if="field.type == 'boolean'">
                    <div class="box-header with-border">
                        <div class="checkbox checkbox-slider--b-flat checkbox-slider-md">
                            <label>
                                <input type="checkbox" value="0" :name="field.id" v-model="form[field.id]">
                                <span>
                                <h3 class="box-title">{{ field.name }}</h3>
                            </span>
                            </label>
                        </div>
                    </div>
                </template>

                <template v-if="field.type == 'asset'">
                    <image-select2 style="width:100%;" :options="assetImages" :selected="form.photo" name="photo"
                                   v-model="form.photo">
                        <option value="">Select an image</option>
                    </image-select2>
                </template>

                <transition name="fade">
                <span class="help-block" :id="field.id" v-if="form.errors.has(field.id)">
                    <span class="text-danger">{{ form.errors.get(field.id) }}</span>
                </span>
                </transition>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <button class="btn btn-primary btn-block btn-flat" :disabled="busy" v-if="!isEditForm">Save</button>
                <button class="btn btn-primary btn-block btn-flat" :disabled="busy" v-else>Submit</button>
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
        data: function () {
            return {
                busy: false,
                patchUrl: 'delegates/',
                putUrl: 'delegates/',
                fields: [
                    {
                        id: "email",
                        name: "Email",
                        type: "email",
                        column: '6'
                    },
                    {
                        id: "password",
                        name: "Password",
                        type: "password",
                        column: '6'
                    },
                    {
                        id: "uic",
                        name: "User Identification Code",
                        type: "text",
                    },
                    {
                        id: "title",
                        name: "Title",
                        type: "text",
                    },
                    {
                        id: "first_name",
                        name: "First Name",
                        type: "text",
                        column: '6'
                    },
                    {
                        id: "last_name",
                        name: "Last Name",
                        type: "text",
                        column: '6'
                    },
                    {
                        id: "age_group",
                        name: "Age group",
                        type: "number",
                    },
                    {
                        id: "nationality",
                        name: "Nationality",
                        type: "text",
                    },
                    {
                        id: "address1",
                        name: "Address",
                        type: "text",
                        column: '6'
                    },
                    {
                        id: "address2",
                        name: "Address",
                        type: "text",
                        column: '6'
                    },
                    {
                        id: "postcode",
                        name: "Postcode",
                        type: "text",
                        column: '4'
                    },
                    {
                        id: "city",
                        name: "City",
                        type: "text",
                        column: '4'
                    },
                    {
                        id: "country",
                        name: "Country",
                        type: "text",
                        column: '4'
                    },
                    {
                        id: "job_title",
                        name: "Job Title",
                        type: "text",
                        column: '6'
                    },
                    {
                        id: "organisation",
                        name: "Organisation",
                        type: "text",
                        column: '6'
                    },
                    {
                        id: "phone_mobile",
                        name: "Phone Mobile",
                        type: "text",
                        column: '6'
                    },
                    {
                        id: "phone_company",
                        name: "Phone company",
                        type: "text",
                        column: '6'
                    },
                    {
                        id: "industry",
                        name: "Industry",
                        type: "text",
                    },
                    {
                        id: "photo",
                        name: "Photo",
                        type: "asset",
                    },
                    {
                        id: "visa_check",
                        name: "Visa Check",
                        type: "boolean",
                        column: '6'
                    },
                    {
                        id: "photography_check",
                        name: "Photography Check",
                        type: "boolean",
                        column: '6'
                    },
                    {
                        id: "confirmed",
                        name: "Confirmed",
                        type: "boolean",
                        column: '6'
                    },
                    {
                        id: "enabled",
                        name: "Enabled",
                        type: "boolean",
                        column: '6'
                    },
                ]
            }
        },
        props: {
            delegate: {},
            assetImages: {
                type: Array,
                'default': function () {
                    return []
                }
            },
            isEditForm: {
                type: Boolean,
                'default': true
            }
        },
        computed: {
            form: function () {
                const fields = this.fields;
                const delegate = this.delegate;

                let formFields = {};

                fields.forEach(function (v) {
                    formFields[v.id] = (delegate && delegate.hasOwnProperty(v.id) ? delegate[v.id] : '')
                })

                return new Form(formFields)
            }
        },
        methods: {
            classValue(field) {
                return 'col-md-' + (field.column || 12)
            },
            submit () {
                if (this.isEditForm) {
                    return this.patch();
                } else {
                    return this.put();
                }
            },
            patch() {
                const vm = this;

                this.busy = true;

                this.form.patch(vm.patchUrl + vm.delegate.id)
                    .then(response => {
                        vm.busy = false;

                        if (response.data.success) {
                            window.toastr.success('Delegate updated', vm.delegate.email);
                            // TODO: apply updates to $parent
                            vm.$emit('delegateChanged', response.data.delegate);
                        }
                    })
                    .catch(error => {
                        vm.busy = false

                        console.log(error)

                        window.toastr.error('Server error', error)
                    })
            },
            put() {
                const vm = this;

                this.busy = true;

                this.form.put(vm.putUrl)
                    .then(response => {
                        vm.busy = false;

                        if (response.data.success) {
                            window.toastr.success('Delegate added', vm.delegate.email);
                            vm.$emit('delegateChanged', response.data.delegate);
                        }
                    })
                    .catch(error => {
                        vm.busy = false
                        window.toastr.error('Server error', error);
                    })
            },
            clearErrors (name) {
                this.form.errors.clear(name)
            }
        }
    }
</script>