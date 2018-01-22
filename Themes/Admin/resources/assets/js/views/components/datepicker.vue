<template>
	<div class="field">
        <label class="">{{ label }}</label>
        <div class="input--icon icon--right input--date">
            <input type="text" :placeholder="placeholder" :name="name" :id="id" :value="value" class="datepick">
            <i class="icon-date"></i>
        </div>
    </div>
</template>

<script>
	export default {
		data() {
	        return {
	            format : this.placeholder,
	            time_picker: false,
	            time_format: 'hh:ii',
	        };
	    },
		props: ['placeholder', 'name', 'id', 'label', 'value', 'classname', 'timepicker'],
	    mounted() {
			var vm = this

			if(!this.placeholder)
				this.format = 'dd-mm-yyyy';
			
			if(this.timepicker)
				this.time_picker = true;

			var dateformat = this.format;

			$(this.$el).find('.datepick')
				.datepicker({
					timepicker: vm.time_picker,
					timeFormat: vm.time_format,
					language: 'en',
					dateFormat: dateformat,
					navTitles: {days: 'MM <i>yyyy</i>'},
					autoClose: true,
					toggleSelected: false,
					onSelect: vm.onSelect
				})

			//$(this.$el).find('.datepick').data('datepicker').selectDate(this.value)

	       	$(this.$el).find('.icon-date')
	       		.on('click', function() {
		       		$(this).parent('.input--date').find('.datepick').datepicker({
						language: 'en',
						dateFormat: dateformat,
						navTitles: {days: 'MM <i>yyyy</i>'},
						autoClose: true,
						toggleSelected: false,
						onSelect: vm.onSelect
					}).focus();
		       	});
	    },
	    watch: {
	      value: function (value) {
	        // update value
	        if(value) {
	        	if(this.time_picker)
	        		var dt = moment(value, this.format.toUpperCase()+" HH:mm").format('YYYY-MM-DD HH:mm')
	        	else
	        		var dt = moment(value, this.format.toUpperCase()).format('YYYY-MM-DD')

	        	$(this.$el).find('.datepick').data('datepicker').selectDate(new Date(dt));
	        }
	        else
	        	$(this.$el).find('.datepick').data('datepicker').clear();
	        //$(this.$el).find('.datepick').val(value).trigger('onSelect');
	      },
	    },
	    destroyed: function () {
	      
	    },
	    methods: {
	    	onSelect(date) {
		      this.$emit('input', date);
		    }
	    }
	}
</script>