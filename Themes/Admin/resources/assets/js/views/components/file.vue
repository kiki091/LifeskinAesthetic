<template>
<div class="field width-auto">
    <label class="">{{ label }}</label>
    <div class="">
        <div class="upload--file__wrapper flex vcenter">
            <input type="file" :name="name" class="upload--file" :id="'file-'+id" @click="clearValue()" @change="onFileUpload($event)">
            <label :for="'file-'+id" class="upload--button">Upload file</label>
            <small class="s11 upload--placeholder">{{ filename }}</small>
        </div>
        <small class="s10 tips textonly"><b>Upload tip: </b>Acceptable files format are {{ accept }}</small>
        <small class="s9">{{ error }}</small>
    </div>
</div>
</template>

<script>
export default {
        data() {
            return {
                acceptfiles: '',
                error: '',
                filename: '',
            };
        },
        props: ['id', 'name', 'label', 'accept', 'value'],
        mounted() {
            var vm = this
            this.acceptfiles = this.accept.split(',');
            //console.log(this.value);
            try {
                this.filename = this.value.name;
            } catch (err) {
                this.filename = "No File Chosen";
            }
            
        },
        watch: {
          value: function (value) {
            // update value
            this.filename = value
          },
        },
        destroyed: function () {
          
        },
        methods: {
            clearFilename: function() {
                this.filename = '';
            },
            clearValue: function() {
                $(this.$el).find('input[type=file]').val(null)
            },
            onFileUpload: function(e) {
                var files = e.target.files || e.dataTransfer.files

                if (!files.length)
                    return;

                var splitname = files[0].name.split('.')
                
                if(this.acceptfiles.indexOf(splitname[splitname.length-1]) <= -1)
                    this.error = 'No Valid Extention';
                else
                    this.filename = files[0].name;
                //this.models['filename'] = files[0]
                //console.log(files[0])
                

                
            },
        },
    }
</script>