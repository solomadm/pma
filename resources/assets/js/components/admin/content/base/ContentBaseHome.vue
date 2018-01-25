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
                        <label>Meta title suffix</label>

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
                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <div class="checkbox checkbox-slider--b-flat checkbox-slider-md pull-left">
                    <label>
                        <input type="checkbox" value="true" name="countdown_enabled" v-model="form.countdown_enabled"><span><h3 class="box-title">Countdown Block</h3></span>
                    </label>
                </div>
            </div>
            <div class="box-body" :class="{'disabled': !form.countdown_enabled}">
                <div class="col-md-12">

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('countdown_heading') }">
                        <label>Heading (html allowed)</label>

                        <editor v-model="form.countdown_heading" @init="editorInit();" lang="html" theme="chrome" width="100%" height="80px"></editor>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('countdown_heading')"
                              v-text="form.errors.get('countdown_heading')"
                              id="validation_error_countdown_heading"></span>
                        </transition>
                    </div>


                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('countdown_background') }">
                        <label>Background Image</label>

                        <image-select2 style="width:100%;" :options="assetImages" :selected="form.countdown_background" name="countdown_background" v-model="form.countdown_background">
                            <option value="">Select an image</option>
                        </image-select2>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('countdown_background')"
                              v-text="form.errors.get('countdown_background')"
                              id="validation_error_countdown_background"></span>
                        </transition>
                    </div>

                    <div class="col-md-2 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('countdown_time') }">
                        <label>Countdown End Time</label>

                        <timepicker hide-clear-button :value="this.timeObjectFromString(form.countdown_time)" @change="timeChange"></timepicker>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('countdown_time')"
                              v-text="form.errors.get('countdown_time')"
                              id="validation_error_countdown_time"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('countdown_date') }">
                        <label>Countdown End Date</label>

                        <datepicker v-model="form.countdown_date"></datepicker>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('countdown_date')"
                              v-text="form.errors.get('countdown_date')"
                              id="validation_error_countdown_date"></span>
                        </transition>
                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>

        <div class="box">
            <div class="box-header with-border">
                <div class="checkbox checkbox-slider--b-flat checkbox-slider-md pull-left">
                    <label>
                        <input type="checkbox" value="true" name="numbers_enabled" v-model="form.numbers_enabled"><span><h3 class="box-title">Numbers Block</h3></span>
                    </label>
                </div>
            </div>
            <div class="box-body" :class="{'disabled': !form.numbers_enabled}">
                <div class="col-md-12">

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('numbers_heading') }">
                        <label>Heading (html allowed)</label>

                        <editor v-model="form.numbers_heading" @init="editorInit();" lang="html" theme="chrome" width="100%" height="80px"></editor>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('numbers_heading')"
                              v-text="form.errors.get('numbers_heading')"
                              id="validation_error_numbers_heading"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('numbers_background') }">
                        <label>Background Image</label>

                        <image-select2 style="width:100%;" :options="assetImages" :selected="form.numbers_background" name="numbers_background" v-model="form.numbers_background">
                            <option value="">Select an image</option>
                        </image-select2>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('numbers_background')"
                              v-text="form.errors.get('numbers_background')"
                              id="validation_error_numbers_background"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_1_heading') }">
                        <label>Figure 1 Heading</label>
                        <input type="text" class="form-control" placeholder="Heading" name="numbers_figure_1_heading" value=""
                               v-model="form.numbers_figure_1_heading" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_1_heading')" v-text="form.errors.get('numbers_figure_1_heading')"
                                id="validation_error_numbers_figure_1_heading"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_1_value') }">
                        <label>Figure 1 Value</label>
                        <input type="text" class="form-control" placeholder="Value" name="numbers_figure_1_value" value=""
                               v-model="form.numbers_figure_1_value" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_1_value')" v-text="form.errors.get('numbers_figure_1_value')"
                              id="validation_error_numbers_figure_1_value"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_1_percent') }">
                        <label>Figure 1 Percent (1 - 100)</label>
                        <input type="text" class="form-control" placeholder="Value" name="numbers_figure_1_percent" value=""
                               v-model="form.numbers_figure_1_percent" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_1_percent')" v-text="form.errors.get('numbers_figure_1_percent')"
                              id="validation_error_numbers_figure_1_percent"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_2_heading') }">
                        <label>Figure 2 Heading</label>
                        <input type="text" class="form-control" placeholder="Heading" name="numbers_figure_2_heading" value=""
                               v-model="form.numbers_figure_2_heading" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_2_heading')" v-text="form.errors.get('numbers_figure_2_heading')"
                              id="validation_error_numbers_figure_2_heading"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_2_value') }">
                        <label>Figure 2 Value</label>
                        <input type="text" class="form-control" placeholder="Value" name="numbers_figure_2_value" value=""
                               v-model="form.numbers_figure_2_value" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_2_value')" v-text="form.errors.get('numbers_figure_2_value')"
                              id="validation_error_numbers_figure_2_value"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_2_percent') }">
                        <label>Figure 2 Percent (1 - 100)</label>
                        <input type="text" class="form-control" placeholder="Value" name="numbers_figure_2_percent" value=""
                               v-model="form.numbers_figure_2_percent" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_2_percent')" v-text="form.errors.get('numbers_figure_2_percent')"
                              id="validation_error_numbers_figure_2_percent"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_3_heading') }">
                        <label>Figure 3 Heading</label>
                        <input type="text" class="form-control" placeholder="Heading" name="numbers_figure_3_heading" value=""
                               v-model="form.numbers_figure_3_heading" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_3_heading')" v-text="form.errors.get('numbers_figure_3_heading')"
                              id="validation_error_numbers_figure_3_heading"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_3_value') }">
                        <label>Figure 3 Value</label>
                        <input type="text" class="form-control" placeholder="Value" name="numbers_figure_3_value" value=""
                               v-model="form.numbers_figure_3_value" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_3_value')" v-text="form.errors.get('numbers_figure_3_value')"
                              id="validation_error_numbers_figure_3_value"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_3_percent') }">
                        <label>Figure 3 Percent (1 - 100)</label>
                        <input type="text" class="form-control" placeholder="Value" name="numbers_figure_3_percent" value=""
                               v-model="form.numbers_figure_3_percent" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_3_percent')" v-text="form.errors.get('numbers_figure_3_percent')"
                              id="validation_error_numbers_figure_3_percent"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_4_heading') }">
                        <label>Figure 4 Heading</label>
                        <input type="text" class="form-control" placeholder="Heading" name="numbers_figure_4_heading" value=""
                               v-model="form.numbers_figure_4_heading" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_4_heading')" v-text="form.errors.get('numbers_figure_4_heading')"
                              id="validation_error_numbers_figure_4_heading"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_4_value') }">
                        <label>Figure 4 Value</label>
                        <input type="text" class="form-control" placeholder="Value" name="numbers_figure_4_value" value=""
                               v-model="form.numbers_figure_4_value" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_4_value')" v-text="form.errors.get('numbers_figure_4_value')"
                              id="validation_error_numbers_figure_4_value"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_4_percent') }">
                        <label>Figure 4 Percent (1 - 100)</label>
                        <input type="text" class="form-control" placeholder="Value" name="numbers_figure_4_percent" value=""
                               v-model="form.numbers_figure_4_percent" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_4_percent')" v-text="form.errors.get('numbers_figure_4_percent')"
                              id="validation_error_numbers_figure_4_percent"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_5_heading') }">
                        <label>Figure 5 Heading</label>
                        <input type="text" class="form-control" placeholder="Heading" name="numbers_figure_5_heading" value=""
                               v-model="form.numbers_figure_5_heading" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_5_heading')" v-text="form.errors.get('numbers_figure_5_heading')"
                              id="validation_error_numbers_figure_5_heading"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_5_value') }">
                        <label>Figure 5 Value</label>
                        <input type="text" class="form-control" placeholder="Value" name="numbers_figure_5_value" value=""
                               v-model="form.numbers_figure_5_value" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_5_value')" v-text="form.errors.get('numbers_figure_5_value')"
                              id="validation_error_numbers_figure_5_value"></span>
                        </transition>
                    </div>

                    <div class="col-md-4 form-group has-feedback" :class="{ 'has-error': form.errors.has('numbers_figure_5_percent') }">
                        <label>Figure 5 Percent (1 - 100)</label>
                        <input type="text" class="form-control" placeholder="Value" name="numbers_figure_5_percent" value=""
                               v-model="form.numbers_figure_5_percent" autofocus/>
                        <transition name="fade">
                        <span class="help-block" v-if="form.errors.has('numbers_figure_5_percent')" v-text="form.errors.get('numbers_figure_5_percent')"
                              id="validation_error_numbers_figure_5_percent"></span>
                        </transition>
                    </div>

                </div>

            </div>
            <!-- /.box-body -->
        </div>

        <div class="box">
            <div class="box-header with-border">
                <div class="checkbox checkbox-slider--b-flat checkbox-slider-md pull-left">
                    <label>
                        <input type="checkbox" value="true" name="speakers_enabled" v-model="form.speakers_enabled"><span><h3 class="box-title">Speakers Block</h3></span>
                    </label>
                </div>
            </div>
            <div class="box-body" :class="{'disabled': !form.speakers_enabled}">
                <div class="col-md-12">

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('speakers_heading') }">
                        <label>Heading</label>

                        <input type="text" class="form-control" placeholder="Heading" name="speakers_heading" value=""
                               v-model="form.speakers_heading" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('speakers_heading')"
                              v-text="form.errors.get('speakers_heading')"
                              id="validation_error_speakers_heading"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('speakers_copy') }">
                        <label>Copy (html allowed)</label>

                        <editor v-model="form.speakers_copy" @init="editorInit();" lang="html" theme="chrome" width="100%" height="80px"></editor>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('speakers_copy')"
                              v-text="form.errors.get('speakers_copy')"
                              id="validation_error_speakers_copy"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('speakers_button_copy') }">
                        <label>Button copy</label>

                        <input type="text" class="form-control" placeholder="Button copy" name="speakers_button_copy" value=""
                               v-model="form.speakers_button_copy" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('speakers_button_copy')"
                              v-text="form.errors.get('speakers_button_copy')"
                              id="validation_error_speakers_button_copy"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('speakers_button_link') }">
                        <label>Button link</label>

                        <input type="text" class="form-control" placeholder="Button link" name="speakers_button_link" value=""
                               v-model="form.speakers_button_link" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('speakers_button_link')"
                              v-text="form.errors.get('speakers_button_link')"
                              id="validation_error_speakers_button_link"></span>
                        </transition>
                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>

        <div class="box">
            <div class="box-header with-border">
                <div class="checkbox checkbox-slider--b-flat checkbox-slider-md pull-left">
                    <label>
                        <input type="checkbox" value="true" name="programme_enabled" v-model="form.programme_enabled"><span><h3 class="box-title">Programme Block</h3></span>
                    </label>
                </div>
            </div>
            <div class="box-body" :class="{'disabled': !form.programme_enabled}">
                <div class="col-md-12">

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('programme_heading') }">
                        <label>Heading</label>

                        <input type="text" class="form-control" placeholder="Heading" name="programme_heading" value=""
                               v-model="form.programme_heading" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('programme_heading')"
                              v-text="form.errors.get('programme_heading')"
                              id="validation_error_programme_heading"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('programme_copy') }">
                        <label>Right Copy (html allowed)</label>

                        <editor v-model="form.programme_copy" @init="editorInit();" lang="html" theme="chrome" width="100%" height="80px"></editor>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('programme_copy')"
                              v-text="form.errors.get('programme_copy')"
                              id="validation_error_programme_copy"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('programme_copy_2') }">
                        <label>Left Copy (html allowed)</label>

                        <editor v-model="form.programme_copy_2" @init="editorInit();" lang="html" theme="chrome" width="100%" height="80px"></editor>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('programme_copy_2')"
                              v-text="form.errors.get('programme_copy_2')"
                              id="validation_error_programme_copy_2"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('programme_button_copy') }">
                        <label>Button copy</label>

                        <input type="text" class="form-control" placeholder="Button copy" name="programme_button_copy" value=""
                               v-model="form.programme_button_copy" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('programme_button_copy')"
                              v-text="form.errors.get('programme_button_copy')"
                              id="validation_error_programme_button_copy"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('programme_button_link') }">
                        <label>Button link</label>

                        <input type="text" class="form-control" placeholder="Button link" name="programme_button_link" value=""
                               v-model="form.programme_button_link" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('programme_button_link')"
                              v-text="form.errors.get('programme_button_link')"
                              id="validation_error_programme_button_link"></span>
                        </transition>
                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>

        <div class="box">
            <div class="box-header with-border">
                <div class="checkbox checkbox-slider--b-flat checkbox-slider-md pull-left">
                    <label>
                        <input type="checkbox" value="true" name="push_enabled" v-model="form.push_enabled"><span><h3 class="box-title">Content Push Block</h3></span>
                    </label>
                </div>
            </div>
            <div class="box-body" :class="{'disabled': !form.push_enabled}">
                <div class="col-md-12">

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('push_heading') }">
                        <label>Heading</label>

                        <input type="text" class="form-control" placeholder="Heading" name="push_heading" value=""
                               v-model="form.push_heading" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('push_heading')"
                              v-text="form.errors.get('push_heading')"
                              id="validation_error_push_heading"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('push_background') }">
                        <label>Background Image</label>

                        <image-select2 style="width:100%;" :options="assetImages" :selected="form.push_background" name="push_background" v-model="form.push_background">
                            <option value="">Select an image</option>
                        </image-select2>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('push_background')"
                              v-text="form.errors.get('push_background')"
                              id="validation_error_push_background"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('push_left_heading') }">
                        <label>Left Push Heading</label>

                        <input type="text" class="form-control" placeholder="Heading" name="push_left_heading" value=""
                               v-model="form.push_left_heading" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('push_left_heading')"
                              v-text="form.errors.get('push_left_heading')"
                              id="validation_error_push_left_heading"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('push_left_image') }">
                        <label>Left Push Image</label>

                        <image-select2 style="width:100%;" :options="assetImages" :selected="form.push_left_image" name="push_left_image" v-model="form.push_left_image">
                            <option value="">Select an image</option>
                        </image-select2>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('push_left_image')"
                              v-text="form.errors.get('push_left_image')"
                              id="validation_error_push_left_image"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('push_left_copy') }">
                        <label>Left Push Copy (html allowed)</label>

                        <editor v-model="form.push_left_copy" @init="editorInit();" lang="html" theme="chrome" width="100%" height="80px"></editor>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('push_left_copy')"
                              v-text="form.errors.get('push_left_copy')"
                              id="validation_error_push_left_copy"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('push_left_link_copy') }">
                        <label>Left Push link copy</label>

                        <input type="text" class="form-control" placeholder="Button copy" name="push_left_link_copy" value=""
                               v-model="form.push_left_link_copy" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('push_left_link_copy')"
                              v-text="form.errors.get('push_left_link_copy')"
                              id="validation_error_push_left_link_copy"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('push_left_link_link') }">
                        <label>Left Push link</label>

                        <input type="text" class="form-control" placeholder="Button link" name="push_left_link_link" value=""
                               v-model="form.push_left_link_link" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('push_left_link_link')"
                              v-text="form.errors.get('push_left_link_link')"
                              id="validation_error_push_left_link_link"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('push_right_heading') }">
                        <label>Right Push Heading</label>

                        <input type="text" class="form-control" placeholder="Heading" name="push_right_heading" value=""
                               v-model="form.push_right_heading" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('push_right_heading')"
                              v-text="form.errors.get('push_right_heading')"
                              id="validation_error_push_right_heading"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('push_right_image') }">
                        <label>Right Push Image</label>

                        <image-select2 style="width:100%;" :options="assetImages" :selected="form.push_right_image" name="push_right_image" v-model="form.push_right_image">
                            <option value="">Select an image</option>
                        </image-select2>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('push_right_image')"
                              v-text="form.errors.get('push_right_image')"
                              id="validation_error_push_right_image"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('push_right_copy') }">
                        <label>Right Push Copy (html allowed)</label>

                        <editor v-model="form.push_right_copy" @init="editorInit();" lang="html" theme="chrome" width="100%" height="80px"></editor>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('push_right_copy')"
                              v-text="form.errors.get('push_right_copy')"
                              id="validation_error_push_right_copy"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('push_right_link_copy') }">
                        <label>Right Push link copy</label>

                        <input type="text" class="form-control" placeholder="Button copy" name="push_right_link_copy" value=""
                               v-model="form.push_right_link_copy" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('push_right_link_copy')"
                              v-text="form.errors.get('push_right_link_copy')"
                              id="validation_error_push_right_link_copy"></span>
                        </transition>
                    </div>

                    <div class="col-md-6 form-group has-feedback"
                         :class="{ 'has-error': form.errors.has('push_right_link_link') }">
                        <label>Right Push link</label>

                        <input type="text" class="form-control" placeholder="Button link" name="push_right_link_link" value=""
                               v-model="form.push_right_link_link" autofocus/>

                        <transition name="fade">
                        <span class="help-block"
                              v-if="form.errors.has('push_right_link_link')"
                              v-text="form.errors.get('push_right_link_link')"
                              id="validation_error_push_right_link_link"></span>
                        </transition>
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

<style src="../../fade.css"></style>

<script>

    import Form from 'acacha-forms'
    import redirect from '../../redirect'
    import valueOrEmpty from '../../valueOrEmpty'
    import timeFunctions from '../../timeFunctions'
    import Datepicker from 'vuejs-datepicker';
    import Timepicker from 'vue2-timepicker';

    export default {
        mixins: [redirect, valueOrEmpty, timeFunctions],
        data: function () {
            let form = new Form({
                meta_title: this.valueOrEmpty(this.content.meta_title),
                meta_description: this.valueOrEmpty(this.content.meta_description),
                countdown_enabled: this.valueOrEmpty(this.content.countdown_enabled),
                countdown_heading: this.valueOrEmpty(this.content.countdown_heading),
                countdown_background: this.valueOrEmpty(this.content.countdown_background),
                countdown_time: this.valueOrEmpty(this.content.countdown_time),
                countdown_date: this.valueOrEmpty(this.content.countdown_date),
                numbers_enabled: this.valueOrEmpty(this.content.numbers_enabled),
                numbers_heading: this.valueOrEmpty(this.content.numbers_heading),
                numbers_background: this.valueOrEmpty(this.content.numbers_background),
                numbers_figure_1_heading: this.valueOrEmpty(this.content.numbers_figure_1_heading),
                numbers_figure_1_value: this.valueOrEmpty(this.content.numbers_figure_1_value),
                numbers_figure_1_percent: this.valueOrEmpty(this.content.numbers_figure_1_percent),
                numbers_figure_2_heading: this.valueOrEmpty(this.content.numbers_figure_2_heading),
                numbers_figure_2_value: this.valueOrEmpty(this.content.numbers_figure_2_value),
                numbers_figure_2_percent: this.valueOrEmpty(this.content.numbers_figure_2_percent),
                numbers_figure_3_heading: this.valueOrEmpty(this.content.numbers_figure_3_heading),
                numbers_figure_3_value: this.valueOrEmpty(this.content.numbers_figure_3_value),
                numbers_figure_3_percent: this.valueOrEmpty(this.content.numbers_figure_3_percent),
                numbers_figure_4_heading: this.valueOrEmpty(this.content.numbers_figure_4_heading),
                numbers_figure_4_value: this.valueOrEmpty(this.content.numbers_figure_4_value),
                numbers_figure_4_percent: this.valueOrEmpty(this.content.numbers_figure_4_percent),
                numbers_figure_5_heading: this.valueOrEmpty(this.content.numbers_figure_5_heading),
                numbers_figure_5_value: this.valueOrEmpty(this.content.numbers_figure_5_value),
                numbers_figure_5_percent: this.valueOrEmpty(this.content.numbers_figure_5_percent),
                speakers_enabled: this.valueOrEmpty(this.content.speakers_enabled),
                speakers_heading: this.valueOrEmpty(this.content.speakers_heading),
                speakers_copy: this.valueOrEmpty(this.content.speakers_copy),
                speakers_button_copy: this.valueOrEmpty(this.content.speakers_button_copy),
                speakers_button_link: this.valueOrEmpty(this.content.speakers_button_link),
                programme_enabled: this.valueOrEmpty(this.content.programme_enabled),
                programme_heading: this.valueOrEmpty(this.content.programme_heading),
                programme_copy: this.valueOrEmpty(this.content.programme_copy),
                programme_copy_2: this.valueOrEmpty(this.content.programme_copy_2),
                programme_button_copy: this.valueOrEmpty(this.content.programme_button_copy),
                programme_button_link: this.valueOrEmpty(this.content.programme_button_link),
                push_enabled: this.valueOrEmpty(this.content.push_enabled),
                push_heading: this.valueOrEmpty(this.content.push_heading),
                push_background: this.valueOrEmpty(this.content.push_background),
                push_left_image: this.valueOrEmpty(this.content.push_left_image),
                push_left_heading: this.valueOrEmpty(this.content.push_left_heading),
                push_left_copy: this.valueOrEmpty(this.content.push_left_copy),
                push_left_link_copy: this.valueOrEmpty(this.content.push_left_link_copy),
                push_left_link_link: this.valueOrEmpty(this.content.push_left_link_link),
                push_right_image: this.valueOrEmpty(this.content.push_right_image),
                push_right_heading: this.valueOrEmpty(this.content.push_right_heading),
                push_right_copy: this.valueOrEmpty(this.content.push_right_copy),
                push_right_link_copy: this.valueOrEmpty(this.content.push_right_link_copy),
                push_right_link_link: this.valueOrEmpty(this.content.push_right_link_link),
            })

            return {
                form: form,
                busy: false
            }
        },
        components: {
            'datepicker': Datepicker,
            'timepicker': Timepicker
        },
        props: [
            'assetImages',
            'content'
        ],
        computed: {},
        watch: {
        },
        mounted: function(){
            console.log(this.content);
        },
        methods: {
            timeChange: function(object){
                this.form.countdown_time = this.timeObjectToString(object);
                console.log(this.form.countdown_time);
            },
            editorInit:function (editor) {
                require('vue2-ace-editor/node_modules/brace/mode/html');
                require('vue2-ace-editor/node_modules/brace/theme/chrome');
            },
            submit () {
                this.busy = true;
                this.form.post('/a/content/base/home')
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
