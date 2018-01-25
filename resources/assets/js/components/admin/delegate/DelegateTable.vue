<template>
    <div class="speaker-table">
        <vue-bootstrap-table
                :columns="columns"
                :values="values"
                :show-filter="false"
                :show-column-picker="false"
                :sortable="true"
                :paginated="true"
                :row-click-handler=rowClick
                :multi-column-sortable=true>
        </vue-bootstrap-table>

        <bootstrap-modal ref="editModal" :needHeader="true" :needFooter="false" id="editModal">
            <div slot="title">
                Editing speaker {{ delegate.name }}
            </div>
            <div slot="body">
                <delegate-edit-form :delegate="delegate" :asset-images="assetImages" v-on:delegateChanged="delegateChanged"></delegate-edit-form>
            </div>
            <div slot="footer">

            </div>
        </bootstrap-modal>
    </div>
</template>

<script>
import renderTick from '../mixins/renderTick'

import VueBootstrapTable from 'vue2-bootstrap-table2'
import BootstrapModal from 'vue2-bootstrap-modal'

export default {
    mixins: [renderTick],
    data: function () {
        return {
            busy: false,
            delegate: {},
            columns: [
                {title: 'id'},
                {title: 'UIC', name: 'uic'},
                {title: 'First Name', name: 'first_name'},
                {title: 'Last Name', name: 'last_name'},
                {title: 'Email', name: 'email'},
                {title: 'Country', name: 'country'},
                {title: 'Confirmed', name: 'confirmed', renderfunction: this.renderPosNeg},
                {title: 'Enabled', name: 'enabled', renderfunction: this.renderPosNeg}
            ]
        }
    },
    components: {
        VueBootstrapTable: VueBootstrapTable,
        BootstrapModal: BootstrapModal
    },
    props: [
        'values',
        'assetImages'
    ],
    methods: {
        openEditModal: function () {
            this.$refs.editModal.open()
        },
        rowClick: function (e, r) {
            if (!r.id) {
                return
            }

            const vm = this

            axios.get('delegates/' + r.id).then(function (response) {
                vm.delegate = response.data
                vm.openEditModal()
            })
        },
        delegateChanged: function (delegate) {
            this.$refs.editModal.close();
            this.$emit('delegateUpdated', delegate);
        }
    }
}

</script>
