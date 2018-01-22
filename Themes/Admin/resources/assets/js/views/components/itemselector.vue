<template>
	<div class="field widthfull">
        <label class="">{{ label }}</label>
        <div class="checkbox--item-select">
            <div class="item-selected">
                <div class="item-selected__header"><h6 class="margin0">Selected Item</h6></div>
                <div class="item-selected__body">
                    <div class="item-selected__placeholder" v-if="value.length == 0">
                        <svg width="50px" height="50px" viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					    <defs></defs>
					    <g id="Wedding-Packages" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" fill-opacity="0.2">
					        <g id="Pages-Edit-Wedding-Package" transform="translate(-330.000000, -435.000000)" fill="#F95959">
					            <path d="M375.454545,435 L343.636364,435 C341.136364,435 339.090909,437.045455 339.090909,439.545455 L339.090909,471.363636 C339.090909,473.863636 341.136364,475.909091 343.636364,475.909091 L375.454545,475.909091 C377.954545,475.909091 380,473.863636 380,471.363636 L380,439.545455 C380,437.045455 377.954545,435 375.454545,435 L375.454545,435 Z M343.636364,439.545455 L375.454545,439.545455 L375.454545,471.363636 L343.636364,471.363636 L343.636364,439.545455 Z M334.545455,444.090909 L330,444.090909 L330,480.454545 C330,482.954545 332.045455,485 334.545455,485 L370.909091,485 L370.909091,480.454545 L334.545455,480.454545 L334.545455,444.090909 L334.545455,444.090909 Z M366.363636,462.272727 L366.363636,458.863636 C366.363636,456.977273 364.840909,455.454545 362.954545,455.454545 C364.840909,455.454545 366.363636,453.931818 366.363636,452.045455 L366.363636,448.636364 C366.363636,446.113636 364.318182,444.090909 361.818182,444.090909 L352.727273,444.090909 L352.727273,448.636364 L361.818182,448.636364 L361.818182,453.181818 L357.272727,453.181818 L357.272727,457.727273 L361.818182,457.727273 L361.818182,462.272727 L352.727273,462.272727 L352.727273,466.818182 L361.818182,466.818182 C364.318182,466.818182 366.363636,464.795455 366.363636,462.272727 L366.363636,462.272727 Z" id="Fill-364"></path>
					        </g>
					    </g>
					   </svg>
                        <p>Select items from the list</p>
                    </div>
                    <ul id="item-checked" v-else >
                        <li :id="'isel-selected-'+id" v-for="(itemselected,indexselected) in value">
                            <div class="checkbox__wrapper d-inline-block margin-r20">
                                <input type="checkbox" :id="'chkmulti-selected-'+id+'-'+indexselected" class="check" :value="itemselected.id" :name="name" @click="removeItem(itemselected, $event)" :checked="!inArray(itemselected.id)">
                                <label :for="'chkmulti-selected-'+id+'-'+indexselected" class="">{{ itemselected.text }}</label>
                                <span class="handle"></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="item-list">
                <div class="item-list__header"><h6 class="margin0">Item List</h6></div>
                <div class="item-list__body">
                    <ul>
                        <li :id="'isel-list-'+id" v-for="(item,index) in items">
                            <div class="checkbox__wrapper d-inline-block margin-r20">
                                <input type="checkbox" :id="'chkmulti-list-'+id +'-'+index" class="check" :value="item.id" @click="addItem(item, $event)" :disabled="item.disabled==1" :checked="inArray(item.id)">
                                <label :for="'chkmulti-list-'+id+'-'+index" class="">{{ item.text }}</label>
                                <span class="handle"></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        data() {
            return {
            	listSelector: this.items,
            };
        },
        props: ['id', 'name', 'label', 'items', 'value'],
        mounted() {
            var vm = this
        },
        watch: {
          value: function (value) {
            // update value
            
          },
          items: function (options) {
            //console.log(options);
          },
        },
        destroyed: function () {
          
        },
        methods: {
        	addItem: function(item, e) {
        		var vm = this;
        		if($(e.target).is(':checked'))
        		{
        			this.value.push(item)
        			$.each(this.items, function(index, object) {
        			 	if(object.id == item.id)
        			 	{
        			 		vm.items.splice(index, 1)
        			 		return false;
        			 	}
        			})
        		}
        	},
        	removeItem: function(item, e) {
        		var vm = this;
        		if(!$(e.target).is(':checked'))
        		{
        			this.items.push(item)
        			$.each(this.value, function(index, object) {
        			 	if(object.id == item.id)
        			 	{
        			 		vm.value.splice(index, 1)
        			 		return false;
        			 	}
        			})
        		}
        	},
            inArray: function (checkVal) {
            	$.each(this.value, function(index, object) {
            		if(object.id == checkVal)
            			return true;
            	})
                return false;
            }
        },
    }
</script>