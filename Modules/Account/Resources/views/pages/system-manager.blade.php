<div class="main--content" id="template_system">
	<h3 class="main--content__title">System Manager</h3>

	<div class="card form" id="toggle-open-content" style="display: none;">
		<form action="{{ route('facile.system.store') }}" method="POST" @submit.prevent>
			<div class="form--top flex vcenter between">
	            <h6 class="bold margin0">@{{ formTitle }}</h6>

	            <a href="javascript:void(0);" class="btn--primary2 close-toggle" id="toggle-menu-manager" data-cancel="Cancel" data-name="Add System" @click="changeButton">Close</a>
	        </div>

	        <div class="form--middle">
					<div class="row">
						<ftext type='text' name="name" class="new__form__input__field" placeholder="Enter the title here" v-model="models.system_name" id="system_title" label="System Name"></ftext>
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
            <h6 class="bold">System List</h6>
            <a href="javascript:void(0);" class="btn--primary open-toggle" id="toggle-open">Add System</a>
        </div>
        <div class="card__body collapse in" id="collapse-1">
        	<ul class="media__wrapper margin0 sortable" id="sort" >
				<li class="media sort-item" v-for="obj in data" v-bind:data-id="obj.id">
					<div class="media__group flex">
                        <div class="media__text">
                            <a href="#" class="title__name content__edit__hover btn__toggle__edit" @click="editData(obj.id)">@{{ obj.name }}</a>
                        </div>
                    </div>
				</li>
			</ul>
        </div>
    </div>
</div>
