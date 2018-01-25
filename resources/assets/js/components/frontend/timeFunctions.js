export default {
    methods: {
        timeObjectFromString (string) {

            if (!string) {
                return {HH: 0, mm: 0};
            }

            string = string.toString(); //Because javascript doesn't give loose strings..

            var o = string.split(":");
            return {HH: o[0], mm: o[1]};
        },
        timeObjectToString(object){
            return object.data.HH + ":" + object.data.mm;
        }
    }
}
