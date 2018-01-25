<template>
    <!--<div v-if="!success">-->
    <div class="main-copy">
        <form method="post" @submit.prevent="submit" @keydown="clearErrors($event.target.name)"
              class="form-horizontal gbf-form col-md-7 col-md-offset-1 col-sm-7 col-sm-offset-1">
            <div :class="[{ 'has-error': form.errors.has('name') }]"
                 v-for="field in fields">
                <div class="form-group has-feedback"
                     :class="[{ 'has-error': form.errors.has('name') }]">
                    <label class="col-sm-7 control-label" v-if="field.type != 'boolean'"
                           :for="field.id">{{ field.name }} <sup v-if="field.required">*</sup></label>

                    <div class="col-sm-5">
                        <template v-if="field.type == 'text'">
                            <input type="text" class="form-control" placeholder="" :name="field.id"
                                   v-model="form[field.id]" :id="field.id"
                                   :required="field.required" autofocus/>
                        </template>

                        <template v-if="field.type == 'textarea'">
                                    <textarea class="form-control"
                                              :name="field.id" v-model="form[field.id]"
                                              :id="field.id" :required="field.required"
                                              rows="3"></textarea>
                        </template>

                        <template v-if="field.type == 'number'">
                            <input class="form-control" type="number" placeholder="" :name="field.id"
                                   v-model="form[field.id]" :id="field.id"
                                   :required="field.required" autofocus/>
                        </template>

                        <template v-if="field.type == 'email'">
                            <input type="email" class="form-control" placeholder="" :name="field.id"
                                   v-model="form[field.id]" :id="field.id"
                                   :required="field.required" autofocus/>
                        </template>

                        <template v-if="field.type == 'password'">
                            <input type="password" class="form-control" placeholder="" :name="field.id"
                                   v-model="form[field.id]" :id="field.id"
                                   :required="field.required" autofocus/>
                        </template>

                        <template v-if="field.type == 'select'">
                            <select class="form-control show-tick" :id="field.id" :name="field.id"
                                    v-model="form[field.id]" title="Please select"
                                    :required="field.required"
                                    :multiple="!!field.multiple"
                                    data-width="100%">
                                <option value="" selected disabled>Please select</option>
                                <option :value="option.value" v-for="option in field.values">
                                    {{ option.text }}
                                </option>
                            </select>
                        </template>

                        <template v-if="field.type == 'boolean'">
                            <p v-if="field.title">{{field.title}}</p>
                            <label class="checkbox-area" :for="field.id">
                                <input type="checkbox" :id="field.id" :name="field.id"
                                       :required="field.required"
                                       v-model="form[field.id]" value="0"/> {{field.name}}
                            </label>

                        </template>

                        <template v-if="field.type == 'asset'">
                            <div class="fileinput fileinput-new input-group" name="upload"
                                 data-provides="fileinput"
                                 :id="field.id">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                    <span class="fileinput-filename"></span>
                                </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                                <span class="fileinput-new">upload</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" :required="field.required" :name="field.id"
                                                       @change="onFileChange">
                                            </span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                   data-dismiss="fileinput">Remove</a>
                            </div>
                        </template>
                    </div>
                    <transition name="fade">
                                    <span class="help-block" :id="field.id" v-if="form.errors.has(field.id)">
                                        <span class="text-danger">{{ form.errors.get(field.id) }}</span>
                                    </span>
                    </transition>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-7 col-sm-5">
                    <button type="submit" class="btn btn-default" :disabled="busy">submit</button>
                </div>
            </div>

        </form>
    </div>
    <!--</div>-->
    <!--<div v-else>-->

    <!--<div class="container">-->
    <!--<div class="text-center bg-success"-->
    <!--v-bind:style="{-->
    <!--padding: '50px 15px',-->
    <!--margin: '50px 0',-->
    <!--borderRadius: '5px'-->
    <!--}"-->
    <!--&gt;-->
    <!--<h1>Thank you for contact us!</h1>-->
    <!--<h3>Please <a href="#" @click="refresh">refresh</a> page to continue!</h3>-->
    <!--</div>-->
    <!--</div>-->

    <!--</div>-->
</template>


<style src="../fade.css"></style>

<script>

    import Form from 'acacha-forms'
    import initialitzeIcheck from '../InitializeIcheck'
    import redirect from '../redirect'

    export default {
        mixins: [initialitzeIcheck, redirect],
        data: function () {
            return {
                busy: false,
                success: false,
                fields: [
                    {
                        id: "nature_of_enquiry",
                        name: "Nature of Enquiry ",
                        type: "select",
                        required: true,
                        values: [
                            {
                                value: 'Request to Attend',
                                text: 'Request to Attend'
                            },
                            {
                                value: 'Sponsorship Enquiry',
                                text: 'Sponsorship Enquiry'
                            },
                            {
                                value: 'General Enquiry',
                                text: 'General Enquiry'
                            },
                            {
                                value: 'Media Partnerships',
                                text: 'Media Partnerships'
                            }
                        ]
                    },
                    {
                        id: "first_name",
                        name: "First Name",
                        type: "text",
                        required: true
                    },
                    {
                        id: "last_name",
                        name: "Last Name",
                        type: "text",
                        required: true
                    },
                    {
                        id: "job_title",
                        name: "Title",
                        type: "text",
                        required: true,
                    },
                    {
                        id: "company",
                        name: "Company Name",
                        type: "text",
                        required: true,
                    },
                    {
                        id: "countries_operate",
                        name: "Countries you operate in",
                        type: "select",
                        multiple: true,
                        values: []
                    },
                    {
                        id: "country",
                        name: "Country you are based in",
                        type: "select",
                        values: []
                    },
                    {
                        id: "website",
                        name: "Website",
                        type: "text",
                    },
                    {
                        id: "industry",
                        name: "Industry",
                        type: "text",
                    },
                    {
                        id: "email",
                        name: "Email Address",
                        type: "text",
                        required: true,
                    },
                    {
                        id: "comments",
                        name: "Comments",
                        type: "textarea",
                    },
                ]
            }
        },
        props: {
            counties: {
                type: Array,
            }
        },
        computed: {
            form: function () {
                const fields = this.fields;
                const delegate = this.delegate;

                let formFields = {};

                fields.forEach(function (v) {
                    formFields[v.id] = (delegate && delegate.hasOwnProperty(v.id) ? delegate[v.id] : '')
                });
                return new Form(formFields);
            }
        },
        watch: {},
        created: function () {
            this.fields.forEach((v) => {
                if (v.id === 'countries_operate' || v.id === 'country') {
                    v.values = this.counties;
                }
            });
        },
        methods: {
            submit(e) {
                const vm = this;

                this.busy = true;

                this.form.post(window.location.href)
                    .then(response => {
                        vm.busy = false;
                        if (response.data.success) {
                            window.toastr.success('Your message was sent successfully', 'Success');
                            this.success = true;
                            this.resetForm();
                        } else {
                            //TODO: Remove console.log()
                            console.log(response);
                            window.toastr.warning('Something went wrong', 'Failed');
                        }
                    })
                    .catch(error => {
                        vm.busy = false;

                        console.log(error);

                        if (error.response.status === 422) {
                            window.toastr.warning('Please fill all required fields', 'Registration failed');
                        } else {
                            window.toastr.warning('Failed', error);
                        }

                    })
            },
            clearErrors(name) {
                if (name === 'password') {
                    this.form.errors.clear('password');
                    name = this.name
                }
                this.form.errors.clear(name)
            },
            classValue(field) {
                return 'col-md-' + (field.column || 12)
            },
            resetForm() {
                let defaults = this.form.originalFields;
                Object.keys(defaults).forEach((key, index) => {
                    this.form[key] = defaults[key];
                });
            }
        }
    }

</script>
