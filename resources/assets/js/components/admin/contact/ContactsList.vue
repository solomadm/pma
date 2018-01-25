<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Contacts</h3>

            <div class="pull-right">
                <a class="btn btn-xs btn-primary" v-bind:href="linkExportCsv">Export csv</a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-12">
                <div class="speaker-table">
                    <div class="table-responsive">
                        <vue-bootstrap-table
                                :columns="columns"
                                :values="valuesList"
                                :show-filter="false"
                                :show-column-picker="false"
                                :sortable="true"
                                :paginated="true"
                                :multi-column-sortable=true>
                        </vue-bootstrap-table>
                    </div>
                </div>
            </div>
        </div>
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
                valuesList: [],
                columns: [
                    {title: 'id'},
                    {title: 'First Name', name: 'first_name'},
                    {title: 'Last Name', name: 'last_name'},
                    {title: 'Email', name: 'email'},
                    {title: 'Nature Of Enquiry', name: 'nature_of_enquiry'},
                    {title: 'Job Title', name: 'job_title'},
                    {title: 'Company', name: 'company'},
                    {title: 'Industry', name: 'industry'},
                    {title: 'Countries Operate', name: 'countries_operate'},
                    {title: 'Country', name: 'country'},
                    {title: 'Website', name: 'website'},
                    {title: 'Comments', name: 'comments'},
                ]
            }
        },
        components: {
            VueBootstrapTable: VueBootstrapTable,
            BootstrapModal: BootstrapModal
        },
        props: [
            'values',
            'linkExportCsv'
        ],
        created: function () {
            this.valuesList = this.values;
        },
        methods: {}
    }

</script>
