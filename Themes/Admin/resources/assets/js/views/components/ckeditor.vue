<template>
    <div :class="fieldclass" v-if="limit">
        <label class="">{{ label }}</label>
        <div class="flex">
            <textarea :name="name" :id="id" @input="updateField" :value="value" :types="types" :config="config" class="ckeditor-withlimit" :data-length="limit"></textarea>
            <span class="tips">Maximum <span class="chars">{{ limitchr }}</span> character</span>
        </div>
    </div>
    <div :class="fieldclass" v-else>
        <label class="">{{ label }}</label>
        <div class="">
            <textarea :name="name" :id="id" @input="updateField" :value="value" :types="types" :config="config" class="ckeditor" cols="300" rows="10"></textarea>
        </div>
    </div>
</template>

<script>
let inc = 0

export default {
  data () {
    return {
      content: '',
      limitchr : this.limit !== undefined ? this.limit : '',
      fieldclass : 'field width-auto',
    }
  },
  props: {
    name: {
      type: String
    },
    error: {
      type: String
    },
    limit: {
      type: String
    },
    label: {
      type: String
    },
    value: {
      type: String
    },
    id: {
      type: String,
      default: () => `editor-${++inc}`
    },
    types: {
      type: String,
      default: () => `classic`
    },
    mode: {
      type: String,
      default: () => 'simple'
    },
    config: {
      type: Object,
      default: function() {
        return {
          width: 500,
          contentsCss: [
            '../../../themes/admin/css/facile_editor.css'
          ],
          filebrowserBrowseUrl: '/vendor/ckfinder/ckfinder.html',
          filebrowserImageBrowseUrl: '/vendor/ckfinder/ckfinder.html?Type=Images',
          filebrowserUploadUrl: '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
          filebrowserImageUploadUrl: '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
          filebrowserWindowWidth : '1000',
          filebrowserWindowHeight : '700',
          extraPlugins: '',
        }
      }
    }
  },
  computed: {
    instance() {
      return CKEDITOR.instances[this.id]
    }
  },
  /*beforeUpdate () {
    if (this.value !== this.instance.getData()) {
        this.instance.setData(this.value)
    }
  },*/
  mounted () {
    var vm = this;
    if (typeof CKEDITOR === 'undefined') {
      console.log('CKEDITOR is missing (http://ckeditor.com/)')
    } else {
      var config = this.config;
      if(this.limitchr)
      {
          config.wordcount =  {
                maxCharCount: parseInt(vm.limitchr),
                showParagraphs: false,
                showWordCount: true,
                showCharCount: true,
                countSpacesAsChars: true,
                countHTML: false,
          }
      }

      if(this.mode === 'simple')
      {
          config.toolbar = [
            { name: 'document', items: [ 'Source', '-',  'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Link', 'Unlink','-', 'Image', 'Table'] }, 
          ]  
      }
      else if(this.mode === 'standard')
      {
          config.toolbar = [
            { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
            { name: 'tools', items: [ 'Maximize' ] },
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
            { name: 'others', items: [ '-' ] },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
            { name: 'styles', items: [ 'Styles', 'Format' ] },
            { name: 'about', items: [ 'About' ] }
          ];
      }
      

      if (this.types === 'inline') {
        CKEDITOR.inline(this.id, config)
      } else {
        CKEDITOR.replace(this.id, config)
      }

      this.instance.on('change', () => {

        var data = vm.unescapeHTML(this.instance.getData());
        this.limitchr = this.limit - data.length;
        if(this.limitchr <= 0 ) {
            this.limitchr = 0
        }

        let html = this.instance.getData()

        if (html !== this.value) {
          if(this.limitchr >= 0 && this.limit && data.length <= this.limit)
            this.$emit('input', html)
          else if(isNaN(this.limitchr))
          {
            this.$emit('input', html)
          }
        }
      })

      if(this.limit)
      {
        this.instance.on('contentDom', function() {
          vm.instance.on('focus', function(event) {
              vm.compute(vm.instance)
          });
          vm.instance.on('blur', function(event) {
              vm.compute(vm.instance)
          });
        });  
      }
      
    }

    this.limitchr = this.limit - this.unescapeHTML(this.value).length;

    setTimeout(function() {
        $('.cke_bottom').css('display', 'none');
    }, 1500);

    //check error
    if(this.error)
      this.fieldclass = this.fieldclass + ' has-error';
  },
  beforeDestroy () {
    if (this.instance) {
      this.instance.focusManager.blur(true)
      this.instance.removeAllListeners()
      this.instance.destroy()
      this.instance = null
    }
  },
  methods: {
    updateField: function() {
      if(this.limitchr > -1 && this.limit)
        this.$emit('input',String(this.content));
      else if(isNaN(this.limitchr))
        this.$emit('input',String(this.content));
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
    },
    compute: function(editor) {
      if (this.limitchr == 0) {
        editor.setData(this.unescapeHTML(editor.getData()).substr(0,this.limit));
        editor.focus();
      }
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
      if (this.value !== this.instance.getData()) {
        this.instance.setData(this.value)
      }
    }
  }
}
</script>
<style>
.ckeditor::after {
  content: "";
  display: table;
  clear: both;
}
</style>


