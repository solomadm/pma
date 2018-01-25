export default {
    methods: {
        valueOrEmpty (object) {
            if (!object)return '';
            return object.value != null ? object.value : '';
        }
    }
}
