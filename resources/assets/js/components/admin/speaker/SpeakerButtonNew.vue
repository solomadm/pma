<template>
    <span class="speaker-button-new">
        <bootstrap-modal ref="createModal" :needHeader="true" :needFooter="false">
            <div slot="title">
                Create new speaker
            </div>
            <div slot="body">
                <speaker-create-form :asset-images="assetImages"></speaker-create-form>
            </div>
        </bootstrap-modal>
        <button @click="openCreateModal" class="btn btn-xs btn-success pull-right">Create new speaker</button>

    </span>
</template>

<script>

    import BootstrapModal from 'vue2-bootstrap-modal'

    export default {
        components: {
            BootstrapModal: BootstrapModal
        },
        props: {
            assetImages: {
                type: Array
            },
            needHeader: {
                type: Boolean,
                default: true
            },
            needFooter: {
                type: Boolean,
                default: true
            }
        },
        data: function data() {
            return {
                isOpen: false,
                isShow: false
            };
        },

        methods: {
            openCreateModal: function() {
                this.$refs.createModal.open();
            },

            open: function open() {
                this.isShow = true;
                this.$nextTick(function () {
                    this.isOpen = true;
                    this.$refs.modal.focus();
                });
            },
            close: function close() {
                this.isOpen = false;
                this.$nextTick(function () {
                    var _this = this;

                    setTimeout(function () {
                        _this.isShow = false;
                    }, 500);
                });
            }
        }
    }

</script>
