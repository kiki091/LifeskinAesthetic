<template>
    <div class="field width-auto">
        <label>{{ label }}</label> 
        <div class="flex">
            <div class="upload--img" v-show="image">
                <img :src="image" id="upload--img--preview">
                <input type="hidden" :name="'image_'+ id"  :value="edit ? '': image" />
                <a href="javascript:void(0);" class="upload--img--remove" @click="removeImage($event)" v-if="image"></a>
            </div>

            <div class="upload--img" v-show="!image">
                <input class="" type="file" :name="name" :id="id" @click="clearValue()"  @change="onFileChangeImage($event)" >
                <label :for="id" class=""></label>
            </div>
            <small class="s10 tips big" v-if="options"><b>Upload Tip: </b>Please upload high resolution photo only with format of {{ ext }}. {{ tip }}</small>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                image: this.value,
                imagedata: this.data,
                edit: false,
                url: '',
                tip: '',
                ext: '',
            };
        },
        props: ['id', 'name', 'label', 'options', 'value', 'data', 'src'],
        mounted() {
            var vm = this
            this.ext = 'jpeg,jpg,png'
            this.createMessage()
        },
        watch: {
            value: function (imageval) {
                if(!imageval)
                    this.image = ''
                else if(typeof(imageval) !== 'object')
                    this.image = imageval
                
            },
            data: function(val) {
                this.imagedata = this.data
            },
            options: function(val) {
                this.createMessage()
            },
            
        },
        destroyed: function () {
          
        },
        methods: {
            createMessage: function() {
                this.tip = "( With dimension of "
                
                if(this.options)
                {
                    var array = [];
                    if(this.options.width && this.options.height)
                        array.push(this.options.width +"px x "+ this.options.height +"px ")
                    else if(this.options.width)
                        array.push("width "+ this.options.width +"px ")
                    else if(this.options.height)
                        array.push("height "+ this.options.height +"px ")
                    
                    if(this.options.max_width)
                        array.push("max width " + this.options.max_width + "px")

                    if(this.options.max_height)
                        array.push("max height " + this.options.max_height + "px")

                    if(this.options.min_width)
                        array.push("min width " + this.options.min_width + "px")

                    if(this.options.min_height)
                        array.push("min height " + this.options.min_height + "px")

                    if(this.options.size)
                        array.push("max " + this.options.size +" kb in size")

                    this.tip = this.tip +  array.join(" and ") + " )"

                    if(this.options.ext)
                        this.ext = this.options.ext
                }
            },
            clearValue: function() {
                $(this.$el).find("input[type='file']").val(null)
            },
            clearImage: function() {
                this.image = '';
                $(this.$el).find("input[type='file']").val(null)
            },
            createImage: function(file, setterTo) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = function (e) {
                    vm[setterTo] = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                if(this.removeImageFromServer())
                {
                    this.image = '';
                    this.imagedata = '';
                    this.$emit('input', '')
                    this.clearValue()
                }
            },
            onFileChangeImage: function(e) {
                //this.removeImage()
                var files = e.target.files || e.dataTransfer.files

                if( (this.ext.split(',')).indexOf(files[0].type.split("/")[1]) < 0)
                    return;

                if (!files.length)
                    return;

                //this.models['filename'] = files[0]
                // var updatedCopy = Object.assign({}, this.value, {
                //     image: files[0]
                // })
                // this.$emit('input', updatedCopy)
                this.$emit('input', files[0])
                this.edit = true
                //this.imagedata = null
                this.createImage(files[0], 'image');
            },
            removeImageFromServer: function(e) {
                try {
                    return this.$parent.removeImageFromServer()
                }
                catch(err) {
                    return true;
                }
                    
            },
        },
    }
</script>