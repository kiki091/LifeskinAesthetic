<template>
	<div class="field width-auto">
	    <label>{{ label }}</label>
	    <div class="upload--img--multiple">
	        <small class="s11">Drop <b>Main image</b> in this area. Sort images by "draging and droping" in the desired position</small>
	        <div class="flex flex-align-center">
	            <ul class="img-sortable" id="html-card-photo-uploader-en">

	                <!-- CARD UPLOAD -->
					<li class="sort-item-images-slider" v-for="(detailImage, index ) in total_slider_image" >
	                    <div class="handle">
	                        <svg width="11px" height="18px" viewBox="0 0 11 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							    <!-- Generator: Sketch 3.7.1 (28215) - http://www.bohemiancoding.com/sketch -->
							    <title>Group 6 Copy 15</title>
							    <desc>Created with Sketch.</desc>
							    <defs></defs>
							    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" opacity="0.5">
							        <g id="Home-Banner" transform="translate(-330.000000, -411.000000)" fill="#D8D8D8">
							            <g id="Group-6-Copy-15" transform="translate(330.000000, 411.000000)">
							                <rect id="Rectangle-962" x="0" y="0" width="4" height="4"></rect>
							                <rect id="Rectangle-962" x="7" y="14" width="4" height="4"></rect>
							                <rect id="Rectangle-962" x="7" y="7" width="4" height="4"></rect>
							                <rect id="Rectangle-962" x="7" y="0" width="4" height="4"></rect>
							                <rect id="Rectangle-962" x="0" y="14" width="4" height="4"></rect>
							                <rect id="Rectangle-962" x="0" y="7" width="4" height="4"></rect>
							            </g>
							        </g>
							    </g>
							</svg>
	                    </div>
	                    <div class="img--multiple__group">
	                        <div class="upload--img--card">
	                            <div class="upload--img" v-if="!slider_edit[index]">
	                                <input class="" type="file" id="input-img-single" :name="'mimage-dektop-edit-'+name+'['+index+']'" @change="onImageChange('slider_edit', index, $event)" :id="'fmimg-edit-'+ id + '-' + index +  '-desktop'">
	                                <label :for="'fmimg-edit-'+ id + '-' + index +  '-desktop'" class=""></label>

	                            </div>
	                            <div class="upload--img" v-else>
	                                <img :src="slider_edit[index].image_desktop" id="upload--img--preview">
	                                <a href="javascript:void(0);" class="upload--img--remove"></a>
	                                
	                                <a href="javascript:void(0);" class="preview--show" id="img-preview" @click="previewImage(slider_edit[index].image_desktop)"></a> 
	                            </div>
	                            <span class="img--multiple__title">Desktop</span>
	                        </div>
	                        <div class="upload--img--card">
	                            <div class="upload--img" v-if="!slider_edit[index]">
	                                <input class="" type="file" @change="onImageChange('slider_edit', index, $event)" :id="'fmimg-edit-'+ id + '-' + index +  '-mobile'" :name="'mimage-mobile-edit-'+name+'['+index+']'">
	                                <label :for="'fmimg-edit-'+ id + '-' + index +  '-mobile'" class=""></label>
	                            </div>
	                            <div class="upload--img" v-else>
	                                <img :src="slider_edit[index].image_mobile" id="upload--img--preview">

	                                <a href="javascript:void(0);" class="upload--img--remove"></a> 
	                                <a href="javascript:void(0);" @click="previewImage(slider_edit[index].image_mobile)" class="preview--show" id="img-preview"></a> 
	                            </div>
	                            <span class="img--multiple__title">Mobile</span>
	                        </div>
	                    </div>
	                    <a href="javascript:void(0);" class="img--card__remove" @click="removeImage(slider_edit[index].id, detailImage, index)"></a>
	                </li>


	                <li class="" v-for="(detailImage,index) in default_total_slider_image" >
	                    <div class="handle">
	                        <svg width="11px" height="18px" viewBox="0 0 11 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							    <!-- Generator: Sketch 3.7.1 (28215) - http://www.bohemiancoding.com/sketch -->
							    <title>Group 6 Copy 15</title>
							    <desc>Created with Sketch.</desc>
							    <defs></defs>
							    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" opacity="0.5">
							        <g id="Home-Banner" transform="translate(-330.000000, -411.000000)" fill="#D8D8D8">
							            <g id="Group-6-Copy-15" transform="translate(330.000000, 411.000000)">
							                <rect id="Rectangle-962" x="0" y="0" width="4" height="4"></rect>
							                <rect id="Rectangle-962" x="7" y="14" width="4" height="4"></rect>
							                <rect id="Rectangle-962" x="7" y="7" width="4" height="4"></rect>
							                <rect id="Rectangle-962" x="7" y="0" width="4" height="4"></rect>
							                <rect id="Rectangle-962" x="0" y="14" width="4" height="4"></rect>
							                <rect id="Rectangle-962" x="0" y="7" width="4" height="4"></rect>
							            </g>
							        </g>
							    </g>
							</svg>
	                    </div>
	                    <div class="img--multiple__group">
	                        <div class="upload--img--card" >
	                            <div class="upload--img" v-if="!slider_desktop[index]">
	                                <input class="" type="file" id="input-img-single" @change="onImageChange('slider_desktop', index, $event)" :id="'fmimg-'+ id + '-' + index +  '-desktop'">
	                                <label :for="'fmimg-'+ id + '-' + index +  '-desktop'" class=""></label>

	                            </div>

	                            <div class="upload--img" v-else>
	                                <img :src="slider_desktop[index]" id="upload--img--preview">
	                                <a href="javascript:void(0);" class="upload--img--remove" @click="removeMultipleImage('slider_desktop', index)"></a>
	                                <a href="javascript:void(0);" class="preview--show" id="img-preview" @click="previewImage(slider_desktop[index])"></a> 
	                            </div>
	                            <span class="img--multiple__title">Desktop</span>
	                        </div>
	                        <div class="upload--img--card">
	                            <div class="upload--img" v-if="!slider_mobile[index]">
	                                <input class="" type="file" id="input-img-single" @change="onImageChange('slider_mobile', index, $event)" :id="'fmimg-'+ id + '-' + index +  '-mobile'">
	                                <label :for="'fmimg-'+ id + '-' + index +  '-mobile'" class=""></label>
	                            </div>
	                            <div class="upload--img" v-else>
	                                <img :src="slider_mobile[index]" id="upload--img--preview">

									<a href="javascript:void(0);" class="upload--img--remove" @click="removeMultipleImage('slider_mobile', index)"></a> 
									<a href="javascript:void(0);" class="preview--show" id="img-preview" @click="previewImage(slider_mobile[index])"></a> 
	                            </div>
	                            <span class="img--multiple__title">Mobile</span>
	                        </div>
	                    </div>
	                    <a href="javascript:void(0);" class="img--card__remove" @click="removeImageWrapper(detailImage, index)"></a>

	                    
	                </li>

	            </ul>

	            <div class="upload--img--preview">
                    <div class="preview--overlay" id="img-preview-popup">
                        <div class="preview--popup">
                            <div class="preview--popup--inner">
                                <a href="javascript:void(0);" class="preview--close">&times;</a>
                                <img class="preview--image" :src="image_preview" />
                            </div>
                        </div>
                    </div>
                </div>

	            <a href="javascript:void(0);" class="img--multiple__placeholder" id="add-card-photo-uploader-en" @click="addMoreImage" v-if="default_total_slider_image.length + total_slider_image.length != max_image"><i>&plus;</i><span>Add New</span></a>
	        </div>

	        <small class="s11"><b>Upload tip:</b> Please upload high resolution photo only with format of *jpeg.(With maximum width of 750px on landscape)</small>
	    </div>
	</div>
</template>


<script>
	export default {
		data() {
            return {
            	max_image : this.max ? this.max : 4,
                image: '',
                url: '',
                total_slider_image: [],
                total_slider_images: 0,
                default_total_slider_image: [0],
                slider_desktop : {0: '', 1:'', 2:'', 3: ''},
	            slider_mobile : {0: '', 1:'', 2:'', 3: ''},
	            slider_edit : {0: '', 1:'', 2:'', 3: ''},
	            image_preview: '',
            };
        },
        props: ['id', 'name', 'label', 'max', 'value'],
        mounted() {
            var vm = this

            if(this.value)
            {
            	this.total_slider_images = (this.value).length
            	this.slider_edit = this.value
            }
            
            if(this.total_slider_images > 0) 
            {

                this.default_total_slider_image = [];
                for(var i=0;i<this.total_slider_images;i++)
                    this.total_slider_image.push({});
            }
        },
        watch: {
          value: function (value) {
            // update value
            
          },
        },
        destroyed: function () {
          
        },
        methods: {
            createImage: function(file, setterTo, index, type) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = function (e) {
                    if(type) vm[setterTo][index][type] = e.target.result
                    vm[setterTo][index] = e.target.result
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (id, item, index) {
                if(this.removeMultipleImageFromServer())
                {
                    this.removeMultipleImage('slider_edit', index)
                    this.total_slider_image.splice(index, 1);
                }
            },
            removeImageWrapper: function(item, index) {
                this.removeMultipleImage('slider_desktop', index)
                this.removeMultipleImage('slider_mobile', index)
                this.default_total_slider_image.splice(index, 1);
            },
            removeMultipleImage: function (element, index) {
                this[element][index] = '';
            },
            previewImage: function (image_url) {
                this.image_preview = image_url
            },
            onImageChange: function(element, index, e) {
                var files = e.target.files || e.dataTransfer.files

                if (!files.length)
                    return;
                this[element][index] = files[0]
                this.createImage(files[0], element, index);
            },
            onFileChangeImage: function(e) {
                var files = e.target.files || e.dataTransfer.files

                if (!files.length)
                    return;

                //this.models['filename'] = files[0]
                this.value.image = files[0];
                this.createImage(files[0], 'image');
            },
            removeMultipleImageFromServer: function(e) {
                try {
                    return this.$parent.removeMultipleImageFromServer()
                }
                catch(err) {
                    return true;
                }
            },  
          	addMoreImage: function() {
                this.default_total_slider_image.splice(this.default_total_slider_image.length + 1, 0, {});
            },
            sortableImages: function() {
                var vm = this;
                setTimeout(function(){
                    $('.photo-sortable').each(function(){
                        Sortable.create(this, {
                            draggable: 'li.sort-item-images-slider',
                            ghostClass: "sort-ghost",
                            handle: '.handle',
                            animation: 300,
                            onUpdate: function(evt) {
                                vm.reorderImages();
                            },
                            onChange: function(evt) {
                                vm.reorderImages();
                            }
                        });
                        console.log('ready for order images...')
                    });

                }, 5000);

            },
            reorderImages: function() {
                var ids = document.getElementsByClassName('sort-item-images-slider'),
                    image_id  = [].map.call(ids, function(input) {
                        return input.getAttribute('data-image_id');
                    });

                var domain  = laroute.url(ayana.currentSystem + '/accommodation/room/order-images', []);

                var payload = {image_id: image_id, id: this.modelsRoom.id, _token:ayana.token };

                this.$http.post(domain, payload).then(function(response) {
                    if (response.data.status == false) {
                        this.fetchData()
                        pushNotif(response.status, response.message);
                    }
                });
            },
        },
	}
</script>