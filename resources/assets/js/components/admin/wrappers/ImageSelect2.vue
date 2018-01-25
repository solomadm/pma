<template>
    <select>
        <slot></slot>
    </select>
</template>

<script>

    export default {
        mixins: [],
        props: [
            'options',
            'value'
        ],
        mounted: function () {
            var vm = this
            $(this.$el)
            // init select2
                .select2({data: this.options, minimumResultsForSearch: 5, templateResult: this.OptionTemplate, templateSelection: this.OptionTemplate, containerCssClass: 'image-selector'})
                .val(this.value)
                .trigger('change')
                // emit event on change.
                .on('change', function () {
                    vm.$emit('input', this.value)
                })
        },
        methods: {
            OptionTemplate: function(field){
                if(!field.path)return field.text;

                var template = $('<div class="media">' +
                    '<div class="media-left">' +
                    '<img src="' + field.path + '" alt="" class="media-object" style="width: auto;height:119px; max-height: 118px; max-width:300px;">' +
                    '</div>' +
                    '<div class="media-body">' +
                    '<div class="clearfix">' +
                    '<p class="pull-right"> </p>' +
                    '<p style="margin-bottom: 0"><b>Id: </b>' + field.id + '</p>' +
                    '<p style="margin-bottom: 0"><b>File: </b>' + field.text + '</p>' +
                    '<p style="margin-bottom: 0" class="dim"><b>Dimensions: </b>' + field.width + 'px x ' + field.height + 'px</p>' +
                    '<p style="margin-bottom: 0" class="size"><b>Size: </b>' + field.size / 1000 + 'kb</p>' +
                    '</div> </div> </div>');

                if (field.width == null) template.find('.dim').hide();
                if (field.size == null) template.find('.size').hide();

                return template;
            }
        },
        watch: {
            value: function (value) {
                // update value
                $(this.$el).val(value).trigger('change');
            },
            options: function (options) {
                // update options
                $(this.$el).select2({data: this.options, minimumResultsForSearch: 5, templateResult: this.OptionTemplate, templateSelection: this.OptionTemplate, containerCssClass: 'image-selector'})
            }
        },
        destroyed: function () {
            $(this.$el).off().select2('destroy')
        }
    }

</script>
