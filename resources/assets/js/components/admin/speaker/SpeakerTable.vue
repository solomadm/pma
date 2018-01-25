<template>
    <div class="speaker-table">
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

        <bootstrap-modal ref="editModal" :needHeader="true" :needFooter="false" id="editSpeakerModal">
            <div slot="title">
                Editing speaker {{ speaker.name }}
            </div>
            <div slot="body">
                <speaker-edit-form :asset-images="assetImages" :speaker-data="speaker"></speaker-edit-form>
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
        speaker: {
          id: null,
          name: null,
          company: null,
          country: null,
          type: null,
          featured: null,
          enabled: null,
        },
        columns: [
          {title: 'id'},
          {title: 'Speaker Name', name: 'name', visible: true},
          {title: 'Company', name: 'company', visible: true},
          {title: 'Country', name: 'country', visible: true},
          {title: 'Type', name: 'type', visible: true, renderfunction: this.renderSpeakerType},
          {title: 'Featured', name: 'featured', visible: true, renderfunction: this.renderPosNeg},
          {title: 'Enabled', name: 'enabled', visible: true, renderfunction: this.renderPosNeg}
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
        this.$refs.editModal.open();
      },
      renderSpeakerType: function (k, v) {
        if (v[k] == 1) {
          return 'Confirmed';
        } else {
          return 'Previous';
        }
      },
      rowClick: function (e, r) {
        if (r.id > 0) {
          const vm = this;
          axios.get('speakers/get/' + r.id).then(function (response) {
              vm.speaker = response.data;
              vm.openEditModal();
          });
        }
      }
    }
  }

</script>
