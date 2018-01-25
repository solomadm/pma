<template>
    <form method="post" @submit.prevent="submit" @keydown="clearErrors($event.target.name)">
        <div class="alert alert-success text-center" v-show="busy" id="result"> Logging you in &nbsp;&nbsp;
            <i class="fa fa-refresh fa-spin"></i>
        </div>

        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('email') }">
            <input type="email" class="form-control" :placeholder="trans('message.email')" name="email" value=""
                   v-model="form.email" autofocus/>
            <span class="glyphicon form-control-feedback" :class="'glyphicon-envelope'"></span>
            <transition name="fade">
                <span class="help-block" v-if="form.errors.has('email')" v-text="form.errors.get('email')"
                      id="validation_error_email"></span>
            </transition>
        </div>

        <div class="form-group has-feedback" :class="{ 'has-error': form.errors.has('password') }">
            <input type="password" class="form-control" :placeholder="trans('message.password')" name="password"
                   v-model="form.password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <transition name="fade">
                <span class="help-block" v-if="form.errors.has('password')" v-text="form.errors.get('password')"
                      id="validation_error_password"></span>
            </transition>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat" v-text="trans('message.buttonsign')"
                        :disabled="form.errors.any() || busy"><i v-if="busy" class="fa fa-refresh fa-spin"></i>
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
            let form = new Form({email: '', password: '', remember: ''})

            return {
                form: form,
                busy: false
            }
        },
        props: {
            name: {
                type: String,
                required: true
            }
        },
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
                this.busy = true;
                this.form.post('/a/login')
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
