<template>
    <div class="conference-table">
        <vue-bootstrap-table
                :columns="columns"
                :values="values"
                :show-filter="false"
                :show-column-picker="false"
                :sortable="true"
                :paginated="false"
                :row-click-handler=rowClick
                :multi-column-sortable=true>
        </vue-bootstrap-table>
        <bootstrap-modal ref="editModal" :needHeader="true" :needFooter="false">
            <div slot="title">
                Editing conference {{this.selectedConference}}
            </div>
            <div slot="body">
                <conference-edit-form :conference-data="conference"
                                      :frontend_themes="frontend_themes"></conference-edit-form>
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
        selectedConference: null,
        conference: {
          id: null,
          name: null,
          url_slug: null,
          frontend_theme: null,
          admin_theme: null,

        },
        columns: [
          {title: 'id'},
          {title: 'Conference Name', name: 'name', visible: true},
          {title: 'Enabled', name: 'enabled', visible: true, renderfunction: this.renderPosNeg},
          {title: 'Published', name: 'published', visible: true, renderfunction: this.renderPosNeg},
          {title: 'Date Created', name: 'created_at', visible: true}
        ]
      }
    },
    components: {
      VueBootstrapTable: VueBootstrapTable,
      BootstrapModal: BootstrapModal
    },
    props:[
      'values',
      'frontend_themes'
    ],
    methods: {
      openEditModal: function () {
        this.$refs.editModal.open();
      },
      rowClick: function (e, r) {
        if (r.id > 0) {
          const vm = this;
          axios.get('conference/get/' + r.url_slug).then(function (response) {
            vm.conference = response.data
          });

          this.openEditModal();
        }
      }
    }
  }

</script>
