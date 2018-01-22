<template>
	<div :class="fieldclass" v-if="limit">
		<label>{{ label }}</label> 
		<div class="flex">
			 <div class="flex">
			 	<input type="text" @input="$emit('input', $event.target.value)" :id="id" :value="value" :name="name" class="width-default limit-char" :placeholder="placeholder" :disabled="readonly" :data-length="limit" :maxlength="limit">
                <span class="tips">Maximum <span class="chars">{{ limitchr }}</span> character</span>
            </div>
		</div>
	</div>
	<div :class="fieldclass" v-else>
		<label>{{ label }}</label> 
		<div v-if="type=='text' || type==''">
			<input :type="typeofinput" @input="$emit('input', $event.target.value)" :id="id" :value="value" :name="name" :class="classname" :placeholder="placeholder" :disabled="readonly">
			<small class="s9">{{ error }}</small>
		</div>

		<div class="input--icon icon--left" v-else-if="type=='email'">
            <input :type="typeofinput" @input="$emit('input', $event.target.value)" :id="id" :value="value" :name="name" :class="classname" :placeholder="placeholder" :disabled="readonly">
            <i class="ico-email"></i>
            <small class="s9">{{ error }}</small>
        </div>

        <div class="input--icon icon--left button-inside show-password" v-else-if="type=='password'">
            <input :type="typeofinput" @input="$emit('input', $event.target.value)" :id="id" :value="value" :name="name" :class="classname" :placeholder="placeholder" :disabled="readonly">
            <i class="ico-password"></i>
            <a href="#" v-on:click="showpassword" id="show-hide-pass">SHOW</a>
            <small class="s9">{{ error }}</small>
        </div>
	</div>
</template>
<script>
	export default  {
		name: 'ftext',
	    data() {
	        return {
	            limitchr : this.limit,
	            typeofinput : this.type,
	            fieldclass : 'field',
	        };
	    },
	    props: ['id', 'label', 'name', 'classname', 'placeholder', 'readonly', 'limit', 'type', 'error', 'value', 'width'],
	    mounted() {
	    	if(this.width == 'auto')
	    		this.fieldclass = this.fieldclass + ' width-auto'

	    	if(this.limit)
	    		this.limitchr = this.limit - this.value.length;

	    	if(!this.type)
	    		this.typeofinput = 'text';

	    	//check error
	    	if(this.limit)
	    		this.fieldclass = this.fieldclass + ' width-auto';
	    	
	    	if(this.error)
	    		this.fieldclass = this.fieldclass + ' has-error';
	    },
	    watch: {
	    	value: function() {
	    		if(this.limit)
	    			this.limitchr = this.limit - this.value.length;
	    	}
	    },
	    methods: {
	    	showpassword: function() {
	    		if(this.typeofinput == 'text')
	    			this.typeofinput = 'password';
	    		else
	    			this.typeofinput = 'text';
	    	}
	    }
	};
</script>