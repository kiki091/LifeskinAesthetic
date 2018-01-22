<template>
    <div :class="fieldclass" v-if="limit">
        <label class="">{{ label }}</label>
        <div class="flex">
            <textarea :name="name" :id="'txtarea_'+name" @input="updateField($event)" :value="content" :types="types" :config="config" class="ckeditor-withlimit" :data-length="limit"></textarea>
            <span class="tips">Maximum <span class="chars">{{ limitchr }}</span> character</span>
        </div>
    </div>
    <div :class="fieldclass" v-else>
        <label class="">{{ label }}</label>
        <div class="">
            <textarea :name="name" :id="'txtarea_'+name" @input="updateField($event)" :value="content" :types="types" :config="config" class="ckeditor" cols="300" rows="10"></textarea>
        </div>
    </div>
</template>

<script>
export default {
  data () {
    return {
      content: '',
      limitchr : this.limit !== undefined ? this.limit : '',
      fieldclass : 'field width-auto',
    }
  },
  props: {
    name: { type: String },
    error: { type: String },
    limit: { type: String },
    label: { type: String },
    value: { type: String },
    id: { type: String },
  },
  computed: {
    
  },
  /*beforeUpdate () {
    if (this.value !== this.instance.getData()) {
        this.instance.setData(this.value)
    }
  },*/
  mounted () {
    var vm = this;

    this.limitchr = this.limit - this.unescapeHTML(this.value).length;
    this.content = this.value
    autosize($(this.$el).find('textarea'));
    //check error
    if(this.error)
      this.fieldclass = this.fieldclass + ' has-error';
  },
  beforeDestroy () {
    var evt = document.createEvent('Event');
    evt.initEvent('autosize:destroy', true, false);
  },
  methods: {
    updateField: function(event) {
      if(this.limitchr > -1 && this.limit)
        this.$emit('input',String(event.target.value));
      else if(isNaN(this.limitchr))
        this.$emit('input',String(event.target.value));
    },
    unescapeHTML: function(str) {
      str  = $.trim(str)
      return str.replace(/<[^>]*>|\n/g, '').replace(/\&([^;]+);/g, function (entity, entityCode) {
          
          var match;

          var htmlEntities = {
              nbsp: ' ',
              rsquo: '’',
              cent: '¢',
              pound: '£',
              yen: '¥',
              euro: '€',
              copy: '©',
              reg: '®',
              lt: '<',
              gt: '>',
              quot: '"',
              amp: '&',
              apos: '\''
          };

          if (entityCode in htmlEntities) {
              return htmlEntities[entityCode];
              /*eslint no-cond-assign: 0*/
          } else if (match = entityCode.match(/^#x([\da-fA-F]+)$/)) {
              return String.fromCharCode(parseInt(match[1], 16));
              /*eslint no-cond-assign: 0*/
          } else if (match = entityCode.match(/^#(\d+)$/)) {
              return String.fromCharCode(~~match[1]);
          } else {
              return entity;
          }
      });
    }
  },
  watch: {
    value: function(newValue, oldValue) {
      if(this.limit)
      {
        this.limitchr = this.limit - this.unescapeHTML(this.value).length;  
        if(this.limitchr >= 0 )
          this.content = this.value;
        else
          this.limitchr = 0;
      }
      else if(isNaN(this.limitchr))
      {
        this.content = this.value;
      }
      /*if (this.value !== this.instance.getData()) {
        this.instance.setData(this.value)
      }*/
    }
  }
}
</script>
