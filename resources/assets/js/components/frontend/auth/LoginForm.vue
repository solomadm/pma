<template>
    <form method="post" @submit.prevent="submit" @keydown="clearErrors($event.target.name)">
        <div class="alert alert-success text-center" v-show="busy" id="result"> Logging you in &nbsp;&nbsp;
            <i class="fa fa-refresh fa-spin"></i>
        </div>

        <div class="main-copy">
            <div class="form-horizontal gbf-form col-md-7 col-md-offset-1 col-sm-7 col-sm-offset-1">
                <div class="form-group">
                    <label for="email1" class="col-sm-7 control-label">Email Address <sup>*</sup></label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" id="email1" name="email" v-model="form.email" required>
                    </div>
                    <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('email')">
                            <span class="text-danger">{{ form.errors.get('email') }}</span>
                        </span>
                    </transition>
                </div>
                <div class="form-group">
                    <label for="password1" class="col-sm-7 control-label">Password <sup>*</sup></label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="password1" name="password" v-model="form.password" required>
                    </div>
                    <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('password')">
                            <span class="text-danger">{{ form.errors.get('password') }}</span>
                        </span>
                    </transition>
                </div>
                <div class="form-group inner-link">
                    <div class="col-sm-offset-7 col-sm-5">
                        <a href="forgot_password.html" class="form-link">forgotten password?</a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-7 col-sm-5">
                        <button type="submit" class="btn btn-default">submit</button>
                    </div>
                </div>
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
            let form = new Form({email: '', password: '', remember: ''});

            return {
                form: form,
                busy: false
            }
        },
        props: [
            'ajaxPath'
        ],
        computed: {
        },
        watch: {
            'form.remember': function (value) {
                if (value) {
                    $('input').iCheck('check')
                } else {
                    $('input').iCheck('uncheck')
                }
            }
        },
        methods: {
            submit () {
                console.log("submitting");
                console.log(this.form);
                this.busy = true;
                this.form.post(this.ajaxPath)
                    .then(response => {
                        var component = this;
                        this.busy = false;
                        component.redirect(response)
                    })
                    .catch(error => {
                        this.busy = false;
                        console.log(this.trans('message.loginerror') + ':' + error)
                    })
            },
            clearErrors (name) {
                if (name === 'password') {
                    this.form.errors.clear('password')
                    name = this.name
                }
                this.form.errors.clear(name)
            }
        }
    }

</script>
