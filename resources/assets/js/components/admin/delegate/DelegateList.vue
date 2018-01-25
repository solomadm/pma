<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Delegates</h3>

            <div class="pull-right">
                <delegate-button-new v-on:delegateChanged="delegateChanged"></delegate-button-new>

                <a class="btn btn-xs btn-success" v-bind:href="linkUploadCsv">Upload CSV</a>

                <a class="btn btn-xs btn-primary" v-bind:href="linkGetCsv">Get CSV template</a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-12">
                <delegate-table :values="valuesList"
                                :asset-images="assetImages"
                                v-on:delegateUpdated="delegateUpdated"></delegate-table>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data: function () {
        return {
            valuesList: []
        }
    },
    props: [
        'values',
        'assetImages',
        'linkUploadCsv',
        'linkGetCsv'
    ],
    created: function () {
        this.valuesList = this.values;
    },
    methods: {
        delegateChanged: function (delegate) {
            this.valuesList.push(delegate);
        },
        delegateUpdated: function (delegate) {
            this.valuesList = this.valuesList.map(function (val) {
                return val.id === delegate.id ? delegate : val;
            })
        }
    }
}

</script>
