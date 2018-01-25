<template>
    <div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Images</a></li>
                <li><a href="#tab_2" data-toggle="tab">Files</a></li>
                <li><a href="#tab_3" data-toggle="tab">Speakers</a></li>
                <li><a href="#tab_4" data-toggle="tab">Delegates</a></li>
                <li><a href="#tab_5" data-toggle="tab">Gallery</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <dropzone id="dropzoneimages" ref="dropzoneimages" :showRemoveLink="false" :useFontAwesome="true" url="/a/content/media-manager" v-on:vdropzone-success="showSuccess">
                        <!-- Optional parameters if any! -->
                        <input type="hidden" name="type" value="images">
                    </dropzone>

                    <div class="row media-container" style="margin-top:30px;">

                        <div class="col-md-4 media-preview" v-for="asset in this.assets.images">
                            <div class="thumbnail">
                                <a href="#" class="btn btn-danger pull-right hover-visible" style="position:absolute;margin:5px;" @click.prevent="deleteMedia"><i class="fa fa-trash"></i></a>
                                <img :src="asset.path" :alt="asset.filename" class="img-responsive" style="width:auto;max-height:200px;display:block;">
                                <div class="caption">

                                    <form method="post" @submit.prevent="saveAltText">

                                        <div class="form-group">
                                            <label>Filename</label>
                                            <input class="form-control" :value="asset.filename" name="filename" disabled type="text">
                                        </div>

                                        <div class="form-group">
                                            <label>Alt Text</label>
                                            <div class="input-group">
                                                <input type="hidden" name="id" :value="asset.id">
                                                <input class="form-control" v-model="asset.alt_text" :disabled="busy == asset.id" name="alt_text" placeholder="Alt text" type="text">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="submit" :disabled="busy == asset.id"> <i v-if="busy != asset.id" class="fa fa-save"></i> <i v-if="busy == asset.id" class="fa fa-spinner fa-spin"></i> </button>
                                                </span>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <dropzone id="dropzonefile" ref="dropzonefile" :parallelUploads="1" :showRemoveLink="false" :useFontAwesome="true" url="/a/content/media-manager"
                              v-on:vdropzone-success="showSuccess">
                        <!-- Optional parameters if any! -->
                        <input type="hidden" name="type" value="file">
                    </dropzone>

                    <div class="row media-container" style="margin-top:30px;">

                        <div class="col-md-4 media-preview" v-for="asset in this.assets.file">
                            <div class="thumbnail">
                                <a href="#" class="btn btn-danger pull-right hover-visible" style="position:absolute;margin:5px;" @click.prevent="deleteMedia"><i class="fa fa-trash"></i></a>
                                <img :src="asset.path+'_THUMB.png'" :alt="asset.filename" class="img-responsive" style="width:auto;max-height:200px;display:block;">
                                <div class="caption">

                                    <form method="post" @submit.prevent="saveAltText">

                                        <div class="form-group">
                                            <label>Filename</label>
                                            <input class="form-control" :value="asset.filename" name="filename" disabled type="text">
                                        </div>

                                        <div class="form-group">
                                            <label>Public Filename</label>
                                            <div class="input-group">
                                                <input type="hidden" name="id" :value="asset.id">
                                                <input class="form-control" v-model="asset.alt_text" :disabled="busy == asset.id" name="alt_text" placeholder="Public Filename" type="text">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="submit" :disabled="busy == asset.id"> <i v-if="busy != asset.id" class="fa fa-save"></i> <i
                                                            v-if="busy == asset.id" class="fa fa-spinner fa-spin"></i> </button>
                                                </span>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="tab_3">
                    <dropzone id="dropzonespeaker" ref="dropzonespeaker" :parallelUploads="1" :showRemoveLink="false" :useFontAwesome="true" url="/a/content/media-manager"
                              v-on:vdropzone-success="showSuccess">
                        <!-- Optional parameters if any! -->
                        <input type="hidden" name="type" value="speaker">
                    </dropzone>

                    <div class="row media-container" style="margin-top:30px;">

                        <div class="col-md-4 media-preview" v-for="asset in this.assets.speaker">
                            <div class="thumbnail">
                                <a href="#" class="btn btn-danger pull-right hover-visible" style="position:absolute;margin:5px;" @click.prevent="deleteMedia"><i class="fa fa-trash"></i></a>
                                <img :src="asset.path" :alt="asset.filename" class="img-responsive" style="width:auto;max-height:200px;display:block;">
                                <div class="caption">

                                    <form method="post" @submit.prevent="saveAltText">

                                        <div class="form-group">
                                            <label>Filename</label>
                                            <input class="form-control" :value="asset.filename" name="filename" disabled type="text">
                                        </div>

                                        <div class="form-group">
                                            <label>Alt Text</label>
                                            <div class="input-group">
                                                <input type="hidden" name="id" :value="asset.id">
                                                <input class="form-control" v-model="asset.alt_text" :disabled="busy == asset.id" name="alt_text" placeholder="Alt text" type="text">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="submit" :disabled="busy == asset.id"> <i v-if="busy != asset.id" class="fa fa-save"></i> <i v-if="busy == asset.id" class="fa fa-spinner fa-spin"></i> </button>
                                                </span>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="tab_4">
                    <dropzone id="dropzonedelegate" ref="dropzonedelegate" :parallelUploads="1" :showRemoveLink="false" :useFontAwesome="true" url="/a/content/media-manager"
                              v-on:vdropzone-success="showSuccess">
                        <!-- Optional parameters if any! -->
                        <input type="hidden" name="type" value="delegate">
                    </dropzone>

                    <div class="row media-container" style="margin-top:30px;">

                        <div class="col-md-4 media-preview" v-for="asset in this.assets.delegate">
                            <div class="thumbnail">
                                <a href="#" class="btn btn-danger pull-right hover-visible" style="position:absolute;margin:5px;" @click.prevent="deleteMedia"><i class="fa fa-trash"></i></a>
                                <img :src="asset.path" :alt="asset.filename" class="img-responsive" style="width:auto;max-height:200px;display:block;">
                                <div class="caption">

                                    <form method="post" @submit.prevent="saveAltText">

                                        <div class="form-group">
                                            <label>Filename</label>
                                            <input class="form-control" :value="asset.filename" name="filename" disabled type="text">
                                        </div>

                                        <div class="form-group">
                                            <label>Alt Text</label>
                                            <div class="input-group">
                                                <input type="hidden" name="id" :value="asset.id">
                                                <input class="form-control" v-model="asset.alt_text" :disabled="busy == asset.id" name="alt_text" placeholder="Alt text" type="text">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="submit" :disabled="busy == asset.id"> <i v-if="busy != asset.id" class="fa fa-save"></i> <i
                                                            v-if="busy == asset.id" class="fa fa-spinner fa-spin"></i> </button>
                                                </span>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="tab_5">
                    <dropzone id="dropzonegallery" ref="dropzonegallery" :parallelUploads="1" :showRemoveLink="false" :useFontAwesome="true" url="/a/content/media-manager"
                              v-on:vdropzone-success="showSuccess">
                        <!-- Optional parameters if any! -->
                        <input type="hidden" name="type" value="gallery">
                    </dropzone>

                    <div class="row media-container" style="margin-top:30px;">

                        <div class="col-md-4 media-preview" v-for="asset in this.assets.gallery">
                            <div class="thumbnail">
                                <a href="#" class="btn btn-danger pull-right hover-visible" style="position:absolute;margin:5px;" @click.prevent="deleteMedia"><i class="fa fa-trash"></i></a>
                                <img :src="asset.path" :alt="asset.filename" class="img-responsive" style="width:auto;max-height:200px;display:block;">
                                <div class="caption">

                                    <form method="post" @submit.prevent="saveAltText">

                                        <div class="form-group">
                                            <label>Filename</label>
                                            <input class="form-control" :value="asset.filename" name="filename" disabled type="text">
                                        </div>

                                        <div class="form-group">
                                            <label>Alt Text</label>
                                            <div class="input-group">
                                                <input type="hidden" name="id" :value="asset.id">
                                                <input class="form-control" v-model="asset.alt_text" :disabled="busy == asset.id" name="alt_text" placeholder="Alt text" type="text">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="submit" :disabled="busy == asset.id"> <i v-if="busy != asset.id" class="fa fa-save"></i> <i
                                                            v-if="busy == asset.id" class="fa fa-spinner fa-spin"></i> </button>
                                                </span>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
    </div>

</template>

<style src="../fade.css"></style>

<script>

    import Dropzone from 'vue2-dropzone'
    import Form from 'acacha-forms'

    export default {
        data: function () {

            return {
                form: null,
                assets: this.assetList,
                busy: 0
            }
        },
        components: {
            dropzone: Dropzone
        },
        props: [
            'assetList'
        ],
        mounted: function(){
            console.log(this.assets);
        },
        watch: {

        },
        methods: {
            'showSuccess': function (file) {
                console.log(file);
                var res = JSON.parse(file.xhr.response);
                this.$refs['dropzone'+res.asset.type].removeFile(file);
                this.assets[res.asset.type].unshift({filename: res.asset.filename, path: res.asset.path, id: res.asset.id});
                window.toastr.success('Media uploaded', res.asset.filename);
            },
            'deleteMedia': function(e){
                console.log("deleting image ");
                console.log(e);
            },
            'saveAltText': function(e){
                this.busy = e.target[1].value;

                this.form = new Form({id: e.target[1].value, alt_text: e.target[2].value});

                this.form.post('/a/content/media-manager/save-alt')
                    .then(response => {
                        var component = this;
                        this.busy = 0;
                        window.toastr.success('Alt text saved', 'Success');
                    })
                    .catch(error => {
                        this.busy = 0;
                        console.log(this.trans('message.loginerror') + ':' + error)
                    })
            }
        }
    }

</script>
