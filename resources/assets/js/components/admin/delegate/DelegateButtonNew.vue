<template>
    <span class="conference-button-new">
        <bootstrap-modal ref="modal" :needHeader="true" :needFooter="false">
            <div slot="title">
                Create new delegate
            </div>
            <div slot="body">
                <delegate-edit-form :delegate="delegate" :isEditForm=false v-on:delegateChanged="delegateChanged"></delegate-edit-form>
            </div>
        </bootstrap-modal>
        <button @click="open" class="btn btn-xs btn-success">Create new delegate</button>
    </span>
</template>

<script>
    import BootstrapModal from 'vue2-bootstrap-modal'

    export default {
        components: {
            BootstrapModal: BootstrapModal
        },
        props: {},
        data: function data() {
            return {
                delegate: {},
                isOpen: false,
                isShow: false
            };
        },
        methods: {
            open: function open() {
                this.isShow = true;
                this.$refs.modal.open();
                this.$nextTick(function () {
                    this.isOpen = true;
                });
            },
            close: function close() {
                this.isOpen = false;
                this.$refs.modal.close();
                this.$nextTick(function () {
                    const _this = this;

                    setTimeout(function () {
                        _this.isShow = false;
                    }, 500);
                });
            },
            delegateChanged: function (delegate) {
                this.$emit('delegateChanged', delegate);
                this.close();
            }
        }
    }
</script>
