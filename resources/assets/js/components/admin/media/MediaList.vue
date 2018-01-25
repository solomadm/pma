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
                    {title: 'Title', name: 'title'},
                    {title: 'Age Group', name: 'age_group'},
                    {title: 'Nationality', name: 'nationality'},
                    {title: 'Country Of Residence', name: 'country_of_residence'},
                    {title: 'Phone Mobile', name: 'phone_mobile'},
                    {title: 'Job Title', name: 'job_title'},
                    {title: 'Industry', name: 'industry'},
                    {title: 'Photo', name: 'photo', renderfunction: this.renderPhoto},

                    {title: 'Organisation', name: 'organisation'},
                    {title: 'Designation', name: 'designation'},
                    {title: 'Address1', name: 'address1'},
                    {title: 'Address2', name: 'address2'},
                    {title: 'City', name: 'city'},
                    {title: 'Country', name: 'country'},
                    {title: 'PO Box', name: 'po_box'},
                    {title: 'Company Phone', name: 'phone_company'},
                    {title: 'Website', name: 'website'},
                    {title: 'Twitter', name: 'twitter'},

                    {title: 'Articles', name: 'articles', renderfunction: this.renderArticles},
                    {title: 'Links', name: 'links', renderfunction: this.renderLinks},

                    {title: 'Visa Check', name: 'visa_check', renderfunction: this.renderPosNeg},
                    {title: 'Confirm Photo Notice', name: 'confirm_photo_notice', renderfunction: this.renderPosNeg},
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
        methods: {
            renderArticles: function (k, v) {
                let articles = v[k];
                let result = '';
                Object.keys(articles).forEach(key => {
                    result += `<p><a href="${articles[key].path}" download="">${articles[key].filename}</a></p>`;
                });
                return result;
            },
            renderLinks: function (k, v) {
                let links = v[k];
                let result = '';
                Object.keys(links).forEach(key => {
                    result += `<p><a href="${links[key]}" target="_blank">${links[key]}</a></p>`;
                });
                return result;
            },
            renderPhoto: function (k, v) {
                let photo = v[k];
                let result = '';
                if (photo) {
                    result += `<img src="${photo.path}" alt="${photo.filename}" class="img-responsive" style="max-width:200px;max-height:100px;display:block;">`;
                }
                return result;
            }
        }
    }

</script>
