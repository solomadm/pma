<template>
    <form>
        <div class="conference-switcher">

            <select2 style="width:100%;" :options="listData" v-model="selected">
                <option value="0" v-if="selected==0">SELECT A CONFERENCE</option>
                <option value="manage">MANAGE CONFERENCES</option>
            </select2>

        </div>
    </form>
</template>

<script>

    export default {
        mixins: [],
        data: function () {
            return {
                busy: false,
                selected: this.currentConference,
                listData: this.conferenceList,
                //selected: this.currentConference
            }
        },
        props: [
            'currentConference',
            'conferenceList',
        ],
        watch: {
            selected: function (b) {
                if(b == "0"){
                    return false;
                }
                if(b == "manage"){
                    window.location.href = '/a/conference';
                }else {
                    window.location.href = '/a/switch/' + b;
                }
            }
        }
    }

</script>
