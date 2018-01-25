<template>
    <span class="conference-button-new">
        <bootstrap-modal ref="createModal" :needHeader="true" :needFooter="false">
            <div slot="title">
                Create new conference
            </div>
            <div slot="body">
                <conference-create-form :frontend_themes="frontend_themes"></conference-create-form>
            </div>
        </bootstrap-modal>
        <button @click="openCreateModal" class="btn btn-xs btn-success pull-right">Create new conference</button>
    </span>
</template>

<script>

    import BootstrapModal from 'vue2-bootstrap-modal'

    export default {
        components: {
            BootstrapModal: BootstrapModal
        },
        props: {
            frontend_themes: {
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
            openEditModal: function(){
                //TODO: get all info from ID.
                this.$refs.editModal.open();
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
