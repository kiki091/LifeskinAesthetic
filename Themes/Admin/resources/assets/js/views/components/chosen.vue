<template>
  <div class="field" v-if="type=='time'">
    <label class="">{{ label }}</label>
    <div class="input--icon icon--left">
      <select class="chosen" :name="name" :id="id">
        <option :value="obj.id" v-for="obj in options" :selected="obj.id==value">{{ obj.text ? obj.text : obj.name }}</option>
        <slot></slot>
      </select>
      <i class="ico-clock"></i>
    </div>
  </div>
  <div class="field" v-else>
    <label class="">{{ label }}</label>
    <select class="chosen" :name="name" :id="id">
      <option :value="obj.id" v-for="obj in options" :selected="obj.id==value">{{ obj.text ? obj.text : obj.name  }}</option>
      <slot></slot>
    </select>
  </div>
</template>

<script>
  export default {
    props: ['options', 'search', 'label', 'type', 'name', 'id', 'value'],
    mounted: function () {
      var vm = this
      $(this.$el).find('.chosen')
        // init chosen
        .chosen({
          max_selected_options: 5,
          disable_search_threshold: 100,
          width: "100%"
        })
        .trigger('change')
        // emit event on change.
        .on('change', function () {
          vm.$emit('input', this.value)
        })
        
        // .on('chosen:showing_dropdown', function(evt, params) {
        //   $(".chosen-results").mCustomScrollbar({
        //     axis: "y",
        //     theme: "dark"
        //   });
        // })

        // .on('chosen:hiding_dropdown', function(evt, params) {
        //   if($(".chosen-results").length) {
        //     $(".chosen-results").mCustomScrollbar("destroy");
        //   }
        // });
    },
    watch: {
      value: function (value) {
        //console.log($(this.$el).find('.chosen'))
        $(this.$el).find('.chosen').trigger("chosen:updated");
        //$(this.$el).find('.chosen').trigger('change');
      },
      options: function (options) {
        var vm = this
        var elem = $(this.$el).find('.chosen');
        $(this.$el).find('.chosen').empty();
        $(elem).append('<option value="">Choose One</option>');
        $.each(options, function (idx, obj) {
            var text = obj.text ? obj.text : obj.name
            $(elem).append('<option value="' + obj.id + '">' + text + '</option>');
        });
        elem.trigger("chosen:updated");
      }
    },
    computed: {
      equals: function(valA, valB) {
          //console.log(valA.toString(), valB)
          return valA.toString()==valB.toString()
      }
    },
    destroyed: function () {
      $(this.$el).find('.chosen').chosen('destroy');
    }
  }
</script>