<div class="main--content" id="template_controller">
	<h3 class="main--content__title">Controller Manager</h3>

	<div class="card form" id="toggle-open-content" style="display: none;">
		<form action="{{ route('facile.controller.store') }}" method="POST" @submit.prevent>
			<div class="form--top flex vcenter between">
	            <h6 class="bold margin0">Add Controller</h6>

	            <a href="javascript:void(0);" class="btn--primary2 close-toggle" id="toggle-menu-manager" data-cancel="Cancel" data-name="Add Controller" @click="changeButton">Close</a>
	        </div>

	        
	        <div class="form--middle">
					<div class="row">
						<ftext type='text' name="name" class="new__form__input__field" placeholder="Enter the menu controller here" v-model="models.controller_name" id="controller_title" label="Controller Name"></ftext>
					</div>
					<div class="row">
						<ftext type='text' name="display_name" class="new__form__input__field" placeholder="Enter the screen name here" v-model="models.display_name" label="Screen Name"></ftext>
					</div>
	        </div>
	        <div class="form--bottom flex vcenter right">
				<input type="submit" value="Save and Close" @click="addData" class="btn--primary">
			</div>
		</form>
    </div>

    <div class="card">
        <a href="javascript:void(0);" class="minimize" data-toggle="collapse" data-target="#collapse-1"></a>
        <div class="card__header flex between vend">
            <h6 class="bold">Controller List</h6>
            <a href="javascript:void(0);" class="btn--primary open-toggle" id="toggle-open">Add Content</a>
        </div>
        <div class="card__body collapse in" id="collapse-1">
        	<ul class="media__wrapper margin0 sortable" >
				<li class="media sort-item" v-for="obj in data" v-bind:data-id="obj.id">
					<div class="media__group flex">
                        <div class="media__text">
                            <a href="#" class="title__name content__edit__hover btn__toggle__edit" @click="editData(obj.id)">@{{ obj.name }}</a>
                            <small class="s10">Scrren name: <b>@{{ obj.display_name }}</b></small>
                        </div>
                    </div>
                    <div class="media__control">
                        <a href="#" class="ico-delete margin-x5" @click="showDeleteForm(obj.id)">@include('svg-logo.ico-delete')</a>
                    </div>
				</li>
			</ul>
        </div>
    </div>
</div>

