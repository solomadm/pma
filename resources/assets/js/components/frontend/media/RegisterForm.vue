<template>
    <div v-if="!success">
        <div class="main-copy">
            <form class="form-horizontal media-register col-md-11"
                  enctype="multipart/form-data"
                  id="mediaRegister"
                  @submit.prevent="submit"
                  @keydown="clearErrors($event.target.name)">
                <div class="personal-section">
                    <h3>personal details</h3>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="title" class="col-sm-5 control-label">Title <sup>*</sup></label>
                            <div class="col-sm-7">
                                <select class="form-control show-tick" id="title" name="title"
                                        title="Please select" data-width="100%"
                                        v-model="form['title']" required>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Dr">Dr</option>
                                </select>

                                <transition name="fade">
                                    <span class="help-block" :id="'title'" v-if="form.errors.has('title')">
                                        <span class="text-danger">{{ form.errors.get('title') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstName1" class="col-sm-5 control-label">First Name <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="firstName1" name="first_name"
                                       v-model="form['first_name']" required>

                                <transition name="fade">
                                    <span class="help-block" :id="'first_name'" v-if="form.errors.has('first_name')">
                                        <span class="text-danger">{{ form.errors.get('first_name') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastName1" class="col-sm-5 control-label">Last Name <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="lastName1" name="last_name"
                                       v-model="form['last_name']" required>

                                <transition name="fade">
                                    <span class="help-block" :id="'last_name'" v-if="form.errors.has('last_name')">
                                        <span class="text-danger">{{ form.errors.get('last_name') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="age_group" class="col-sm-5 control-label">Age Group <sup>*</sup></label>
                            <div class="col-sm-7">
                                <select class="form-control show-tick" id="age_group" name="title" title="Please select"
                                        v-model="form['age_group']" data-width="100%" required>
                                    <option value="20">0 - 18</option>
                                    <option value="30">19 - 29</option>
                                    <option value="40">30 - 45</option>
                                    <option value="50">45+</option>
                                </select>

                                <transition name="fade">
                                    <span class="help-block" :id="'age_group'" v-if="form.errors.has('age_group')">
                                        <span class="text-danger">{{ form.errors.get('age_group') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nationality1" class="col-sm-5 control-label">Nationality <sup>*</sup></label>
                            <div class="col-sm-7">
                                <select class="form-control show-tick" id="nationality1" name="title"
                                        title="Please select"
                                        v-model="form['nationality']" data-width="100%" required>
                                    <option :value="country.value" v-for="country in countries">{{country.text}}
                                    </option>
                                </select>

                                <transition name="fade">
                                    <span class="help-block" :id="'nationality'" v-if="form.errors.has('nationality')">
                                        <span class="text-danger">{{ form.errors.get('nationality') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country_of_residence"
                                   class="col-sm-5 control-label">Country of Residence <sup>*</sup></label>
                            <div class="col-sm-7">
                                <select class="form-control" id="country_of_residence" name="country_of_residence"
                                        title="Please select"
                                        v-model="form['country_of_residence']" data-width="100%">
                                    <option :value="country.value" v-for="country in countries">{{country.text}}
                                    </option>
                                </select>

                                <transition name="fade">
                                    <span class="help-block" :id="'country_of_residence'"
                                          v-if="form.errors.has('country_of_residence')">
                                        <span class="text-danger">{{ form.errors.get('country_of_residence') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-5 control-label">Email Address <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control" id="email" name="email"
                                       v-model="form['email']" required>

                                <transition name="fade">
                                    <span class="help-block" :id="'email'" v-if="form.errors.has('email')">
                                        <span class="text-danger">{{ form.errors.get('email') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_mobile" class="col-sm-5 control-label">Mobile Number <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="phone_mobile" name="phone_mobile"
                                       v-model="form['phone_mobile']" required>

                                <transition name="fade">
                                    <span class="help-block" :id="'phone_mobile'"
                                          v-if="form.errors.has('phone_mobile')">
                                        <span class="text-danger">{{ form.errors.get('phone_mobile') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="jobTitle1" class="col-sm-5 control-label">Job Title <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="jobTitle1" name="job_title"
                                       v-model="form['job_title']" required>

                                <transition name="fade">
                                    <span class="help-block" :id="'job_title'" v-if="form.errors.has('job_title')">
                                        <span class="text-danger">{{ form.errors.get('job_title') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="industry" class="col-sm-5 control-label">Industry <sup>*</sup></label>
                            <div class="col-sm-7">
                                <select class="form-control show-tick" id="industry" name="industry"
                                        title="Please select"
                                        v-model="form['industry']" data-width="100%" required>
                                    <option value="Main">Main</option>
                                    <option value="Other">Other</option>
                                </select>

                                <transition name="fade">
                                    <span class="help-block" :id="'industry'" v-if="form.errors.has('industry')">
                                        <span class="text-danger">{{ form.errors.get('industry') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="photo" class="col-sm-5 control-label">
                                Please upload your high-quality head shot photo for delegate badge and networking area (jpeg or png) <sup>*</sup>
                            </label>
                            <div class="col-sm-7">
                                <div class="fileinput fileinput-new input-group" name="upload" data-provides="fileinput"
                                     id="photo">
                                    <div class="form-control" data-trigger="fileinput">
                                        <i class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                            class="fileinput-filename"></span>
                                    </div>
                                    <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new">upload</span><span
                                            class="fileinput-exists">Change</span>
                                        <input type="file" name="photo" @change="fileFieldChanged">
                                    </span>
                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>

                                <transition name="fade">
                                    <span class="help-block" :id="'photo'" v-if="form.errors.has('photo')">
                                        <span class="text-danger">{{ form.errors.get('photo') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-7">

                                <p>do i need a visa</p>
                                <label class="checkbox-area" for="visa_check">
                                    <input type="checkbox" name="visa_check" id="visa_check"
                                           v-model="form['visa_check']"/>
                                    I need assistance with organising a visa, booking travel or accommodation.
                                </label>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-7">
                                <p>filming and photography</p>
                                <label class="checkbox-area" for="ajaxFilmPhotography">
                                    <input type="checkbox" id="ajaxFilmPhotography"
                                           value="1" v-model="form['confirm_photo_notice']"/>
                                    I have read and consent to the filming and photography
                                    <a href="#" data-toggle="modal" data-target="#film-photography-modal">notice</a>.
                                </label>

                                <transition name="fade">
                                    <span class="help-block" :id="'confirm_photo_notice'"
                                          v-if="form.errors.has('confirm_photo_notice')">
                                        <span class="text-danger">{{ form.errors.get('confirm_photo_notice') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="organisation-section">
                    <h3>organisational details</h3>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="organisation"
                                   class="col-sm-5 control-label">Organisation Name <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="organisation" name="organisation"
                                       v-model="form['organisation']" required>

                                <transition name="fade">
                                    <span class="help-block" :id="'organisation'"
                                          v-if="form.errors.has('organisation')">
                                        <span class="text-danger">{{ form.errors.get('organisation') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="designation" class="col-sm-5 control-label">Designation <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="designation" name="designation"
                                       v-model="form['designation']" required>

                                <transition name="fade">
                                    <span class="help-block" :id="'designation'" v-if="form.errors.has('designation')">
                                        <span class="text-danger">{{ form.errors.get('designation') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address1" class="col-sm-5 control-label">Address Line 1 <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="address1" name="address1"
                                       v-model="form['address1']" required>
                                <transition name="fade">
                                    <span class="help-block" :id="'address1'" v-if="form.errors.has('address1')">
                                        <span class="text-danger">{{ form.errors.get('address1') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address2" class="col-sm-5 control-label">Address Line 2 <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="address2" name="address2"
                                       v-model="form['address2']">
                                <transition name="fade">
                                    <span class="help-block" :id="'address2'" v-if="form.errors.has('address2')">
                                        <span class="text-danger">{{ form.errors.get('address2') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-5 control-label">City <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="city" name="city" v-model="form['city']">
                                <transition name="fade">
                                    <span class="help-block" :id="'city'" v-if="form.errors.has('city')">
                                        <span class="text-danger">{{ form.errors.get('city') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="country" class="col-sm-5 control-label">Country <sup>*</sup></label>
                            <div class="col-sm-7">
                                <select class="form-control" id="country" name="country" title="Please select"
                                        v-model="form['country']" data-width="100%" required>
                                    <option :value="country.value" v-for="country in countries">{{country.text}}
                                    </option>
                                </select>
                                <transition name="fade">
                                    <span class="help-block" :id="'country'" v-if="form.errors.has('country')">
                                        <span class="text-danger">{{ form.errors.get('country') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="po_box" class="col-sm-5 control-label">PO Box <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="po_box" name="po_box"
                                       v-model="form['po_box']" required>
                                <transition name="fade">
                                    <span class="help-block" :id="'po_box'" v-if="form.errors.has('po_box')">
                                        <span class="text-danger">{{ form.errors.get('po_box') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_company" class="col-sm-5 control-label">Company Phone <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="phone_company" name="phone_company"
                                       v-model="form['phone_company']" required>
                                <transition name="fade">
                                    <span class="help-block" :id="'phone_company'"
                                          v-if="form.errors.has('phone_company')">
                                        <span class="text-danger">{{ form.errors.get('phone_company') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="website" class="col-sm-5 control-label">Website <sup>*</sup></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="website" name="website"
                                       v-model="form['website']" required>
                                <transition name="fade">
                                    <span class="help-block" :id="'website'" v-if="form.errors.has('website')">
                                        <span class="text-danger">{{ form.errors.get('website') }}</span>
                                    </span>
                                </transition>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="twitter" class="col-sm-5 control-label">Twitter</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="twitter" name="twitter"
                                       v-model="form['twitter']">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="accreditation-section">
                    <h3>accreditation</h3>
                    <div class="col-md-6 col-sm-6">
                        <h4>articles</h4>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Upload 2-3 copies of recent articles that you have had published.</label>
                            <div class="col-sm-7">
                                <div class="fileinput fileinput-new input-group article-upload" name="upload"
                                     data-provides="fileinput" id="articleUpload1">
                                    <div class="form-control" data-trigger="fileinput"><i
                                            class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                            class="fileinput-filename"></span></div>
                                    <span class="input-group-addon btn btn-default btn-file"><span
                                            class="fileinput-new">upload</span><span
                                            class="fileinput-exists">Change</span>
                                        <input type="file" name="article1" id="article1"
                                               @change="fileFieldChanged"></span>
                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                                <div class="fileinput fileinput-new input-group article-upload" name="upload"
                                     data-provides="fileinput" id="articleUpload2">
                                    <div class="form-control" data-trigger="fileinput"><i
                                            class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                            class="fileinput-filename"></span></div>
                                    <span class="input-group-addon btn btn-default btn-file"><span
                                            class="fileinput-new">upload</span><span
                                            class="fileinput-exists">Change</span>
                                        <input type="file" name="article2" id="article2"
                                               @change="fileFieldChanged"></span>
                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                                <div class="fileinput fileinput-new input-group article-upload" name="upload"
                                     data-provides="fileinput" id="articleUpload3">
                                    <div class="form-control" data-trigger="fileinput"><i
                                            class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                            class="fileinput-filename"></span></div>
                                    <span class="input-group-addon btn btn-default btn-file"><span
                                            class="fileinput-new">upload</span><span
                                            class="fileinput-exists">Change</span>
                                        <input type="file" name="article3" id="article3"
                                               @change="fileFieldChanged"></span>
                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <h4>links</h4>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">If you're a blogger, please forward the links to the legitimate business blog on which your work is posted and bylined.</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control links" id="link1" name="link1"
                                       placeholder="Link 1" v-model="form['link1']">
                                <input type="text" class="form-control links" id="link2" name="link2"
                                       placeholder="Link 2" v-model="form['link2']">
                                <input type="text" class="form-control links" id="link3" name="link3"
                                       placeholder="Link 3" v-model="form['link3']">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-7">
                                <button type="submit" class="btn btn-default" :disabled="busy">submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
                <h1>Thank you for registration</h1>
                <h3>We will contact you</h3>
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
                success: false,
                country_list: []
            }
        },
        props: {
            countries: {
                type: Array,
            }
        },
        computed: {
            form: function () {
                let formFields = {
                    'title': '',
                    'job_title': '',
                    'first_name': '',
                    'last_name': '',
                    'age_group': '',
                    'nationality': '',
                    'country_of_residence': '',
                    'phone_mobile': '',
                    'industry': '',
                    'photo': '',
                    'email': '',
                    'visa_check': false,
                    'confirm_photo_notice': '',

                    'organisation': '',
                    'designation': '',
                    'address1': '',
                    'address2': '',
                    'city': '',
                    'country': '',
                    'po_box': '',
                    'phone_company': '',
                    'website': '',

                    'article1': '',
                    'article2': '',
                    'article3': '',

                    'link1': '',
                    'link2': '',
                    'link3': '',
                };
                return new Form(formFields);
            }
        },
        watch: {},
        created: function () {
            this.country_list = this.countries;

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
                //TODO: Remove console.log()
                console.log(e.target);
                this.form.photo = '';
            },
            classValue(field) {
                return 'col-md-' + (field.column || 12)
            },
            resetForm() {
                let defaults = this.form.originalFields;
                Object.keys(defaults).forEach((key, index) => {
                    this.form[key] = defaults[key];
                });
            },
            checkboxTrigger(e) {
                let field = $(e.target).attr('for');
                if (field) {
                    this.form[field] = this.form[field];
                }
            }
        },
        mounted: function () {
            const vm = this;
            $('input').on('ifChecked', function (e) {
                let field = $(this).attr('name');
                //TODO: Remove console.log()
                console.log(1, $(this), field, vm.form, vm.form[field]);
                vm.form[field] = true;
            }).on('ifUnchecked', function (e) {
                let field = $(this).attr('name');
                console.log(2, field, vm.form, vm.form[field]);
                vm.form[field] = false;
            });
        }
    }

</script>
