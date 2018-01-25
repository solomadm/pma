export default {
  methods: {
    renderPosNeg: function (k, v) {
      if (v[k]) {
        return '<span class="glyphicon glyphicon-ok text-success"></span>';
      } else {
        return '<span class="glyphicon glyphicon-remove text-danger"></span>';
      }
    }
  }
}