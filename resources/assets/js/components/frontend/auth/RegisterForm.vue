<template>
    <div v-if="!registered">
        <form method="post" @submit.prevent="submit" @keydown="clearErrors($event.target.name)"
              enctype="multipart/form-data">
            <div class="main-copy">
                <div class="form-horizontal col-md-7 col-md-offset-1">
                    <div class="form-group">
                        <label for="uic" class="col-sm-7 control-label">Unique Invitation Code <sup>*</sup></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="uic" name="uic" required v-model="form.uic">
                            <small>If you don't have a Unique Invitation Code and would like to register, please <a
                                    href="contact">click here</a>.
                            </small>
                            <transition name="fade">
                                    <span class="help-block" :id="uic" v-if="form.errors.has('uic')">
                                        <span class="text-danger">{{ form.errors.get('uic') }}</span>
                                    </span>
                            </transition>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-7 col-sm-5">
                            <button type="submit" class="btn btn-default" :disabled="busy">submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-copy" style="display: block;">

                <div class="container">
                    <div class="form-horizontal">


                        <div class="row flex-grid">
                            <div :class="[{ 'has-error': form.errors.has('name') }, classValue(field)]"
                                 v-for="field in fields">
                                <div class="form-group has-feedback"
                                     :class="[{ 'has-error': form.errors.has('name') }]">
                                    <label class="col-sm-5 control-label" v-if="field.type != 'boolean'"
                                           :for="field.id">{{ field.name }} <sup v-if="field.required">*</sup></label>

                                    <div class="col-sm-7">
                                        <template v-if="field.type == 'text'">
                                            <input type="text" class="form-control" placeholder="" :name="field.id"
                                                   v-model="form[field.id]" :id="field.id"
                                                   :required="field.required" autofocus/>
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
                                                       :id="field.id" @change="fileFieldChanged">

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
                        </div>

                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-default" :disabled="busy">submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div v-else>

        <div class="container">
            <div class="text-center bg-success"
                 v-bind:style="{
                    padding: '50px 15px',
                    margin: '50px 0',
                    borderRadius: '5px'
                }"
            >
                <h1>
                    Thank you for registration!
                </h1>
                <h3>Please <a href="#" @click="refresh">refresh</a> page to continue!</h3>
            </div>
        </div>

    </div>
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
                registered: false,
                fields: [
                    {
                        id: "email",
                        name: "Email Address",
                        type: "email",
                        column: '12',
                        required: true
                    },
                    {
                        id: "password",
                        name: "Password",
                        type: "password",
                        column: '6',
                        required: true
                    },
                    {
                        id: "password_confirmation",
                        name: "Password Confirmation",
                        type: "password",
                        column: '6',
                        required: true
                    },
                    {
                        id: "first_name",
                        name: "First Name",
                        type: "text",
                        column: '6',
                        required: true
                    },
                    {
                        id: "last_name",
                        name: "Last Name",
                        type: "text",
                        column: '6',
                        required: true
                    },
                    {
                        id: "title",
                        name: "Title",
                        type: "select",
                        column: '6',
                        required: true,
                        values: [
                            {
                                value: 'Mr',
                                text: 'Mr'
                            },
                            {
                                value: 'Mrs',
                                text: 'Mrs'
                            },
                            {
                                value: 'Miss',
                                text: 'Miss'
                            },
                            {
                                value: 'Dr',
                                text: 'Dr'
                            }
                        ]
                    },
                    {
                        id: "age_group",
                        name: "Age group",
                        type: "select",
                        column: '6',
                        required: true,
                        values: [
                            {
                                value: '20',
                                text: '15 - 24'
                            },
                            {
                                value: '30',
                                text: '25 - 34'
                            },
                            {
                                value: '40',
                                text: '35 - 54'
                            },
                            {
                                value: '60',
                                text: '55 - 64'
                            },
                            {
                                value: '70',
                                text: '65+'
                            }
                        ]
                    },
                    {
                        id: "nationality",
                        name: "Nationality",
                        type: "text",
                        column: '6',
                        required: true
                    },
                    {
                        id: "address1",
                        name: "Address Line 1",
                        type: "text",
                        column: '6',
                        required: true
                    },
                    {
                        id: "address2",
                        name: "Address Line 2",
                        type: "text",
                        column: '6'
                    },
                    {
                        id: "postcode",
                        name: "Postcode",
                        type: "text",
                        column: '6',
                        required: true
                    },
                    {
                        id: "city",
                        name: "City",
                        type: "text",
                        column: '6'
                    },
                    {
                        id: "country",
                        name: "Country Line 1",
                        type: "text",
                        column: '6',
                        required: true
                    },
                    {
                        id: "job_title",
                        name: "Job Title",
                        type: "text",
                        column: '6',
                        required: true
                    },
                    {
                        id: "organisation",
                        name: "Organisation Name",
                        type: "text",
                        column: '6',
                        required: true
                    },
                    {
                        id: "phone_mobile",
                        name: "Mobile Number",
                        type: "text",
                        column: '6',
                        required: true
                    },
                    {
                        id: "phone_company",
                        name: "Company Phone",
                        type: "text",
                        column: '6'
                    },
                    {
                        id: "industry",
                        name: "Industry",
                        type: "text",
                        column: '12',
                        required: true
                    },
                    {
                        id: "photo",
                        name: "Please upload your high-quality head shot photo for delegate badge and networking area (jpeg or png)",
                        type: "asset",
                        column: '12',
                    },
                    {
                        id: "visa_check",
                        name: "I need assistance with organising a visa, booking travel or accommodation.",
                        title: 'Do I need a Visa?',
                        type: "boolean",
                        column: '12'
                    },
                ]
            }
        },
        props: {
            delegate: {},
            registerUrl: ''
        },
        computed: {
            form: function () {
                const fields = this.fields;
                const delegate = this.delegate;

                let formFields = {};

                fields.forEach(function (v) {
                    formFields[v.id] = (delegate && delegate.hasOwnProperty(v.id) ? delegate[v.id] : '')
                });
                formFields['uic'] = '';
                formFields['photo_name'] = '';

                //TODO: dummy data remove
//                formFields['email'] = 'test.1@gmail.com';
//                formFields['uic'] = '2141241';
//                formFields['first_name'] = 'qweqwe';
//                formFields['last_name'] = 'qweqwe';
//                formFields['postcode'] = 'qweqwe';
//                formFields['address1'] = 'qweqwe';
//                formFields['country'] = 'qweqwe';
//                formFields['industry'] = 'qweqwe';
//                formFields['phone_mobile'] = 'qweqwe';
//                formFields['organisation'] = 'qweqwe';
//                formFields['job_title'] = 'qweqwe';
//                formFields['nationality'] = 'qweqwe';
//                formFields['age_group'] = '30';
//                formFields['title'] = 'Mr';

                return new Form(formFields);
            }
        },
        watch: {},
        methods: {
            submit () {
                console.log("submitting");
                const vm = this;

                this.busy = true;

                this.form.post(vm.registerUrl)
                    .then(response => {
                        vm.busy = false;
                        if (response.data.success) {
                            window.toastr.success('Success');
                            this.registered = true;
                            this.delegate = response.data.delegate;
                        } else {
                            window.toastr.warning('Registration failed', 'Something went wrong');
                        }
                    })
                    .catch(error => {
                        vm.busy = false;

                        if (error.response.status === 422) {
                            window.toastr.warning('Please fill all required fields', 'Registration failed');
                        } else {
                            window.toastr.warning('Failed', error);
                        }

                    })
            },
            clearErrors (name) {
                if (name === 'password') {
                    this.form.errors.clear('password');
                    name = this.name
                }
                this.form.errors.clear(name)
            },
            classValue(field) {
                return 'col-md-' + (field.column || 12)
            },
            fileFieldChanged(e) {
                let files = e.target.files || e.dataTransfer.files;
                let field = e.target.name || e.target.id;
                //TODO: Remove console.log()
                console.log(field + ' -> changed');
                if (!files.length) {
                    this.form[field] = null;
                    return;
                }
                this.createImage(files[0], field);
            },
            onFileChange(e) {
                this.clearErrors('photo');
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file, field) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.form[field] = {
                        file: e.target.result,
                        name: file.name
                    };
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                this.form.photo = '';
            },
            refresh: function () {
                window.location.reload();
            }
        }
    }

</script>
