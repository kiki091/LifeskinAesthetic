<div class="main--content" id="template_role">
	<h3 class="main--content__title">Role Manager</h3>

	<div class="card form" id="toggle-open-content" style="display: none;">
		<form action="{{ route('facile.role.store') }}" method="POST" @submit.prevent>
			<div class="form--top flex vcenter between">
	            <h6 class="bold margin0">@{{ formTitle }}</h6>

	            <a href="javascript:void(0);" class="btn--primary2 close-toggle" id="toggle-menu-manager" data-cancel="Cancel" data-name="Add Role" @click="changeButton">Close</a>
	        </div>

	        <div class="form--middle">
				<div class="row">
					<ftext type='text' name="name" class="new__form__input__field" placeholder="Enter the title here" v-model="models.role_name" id="role_title" label="Role Name"></ftext>
				</div>
				<div class="row">
					<ftext type='text' name="description" class="new__form__input__field" placeholder="Enter the description here" v-model="models.description" id="role_decription" label="Description"></ftext>
				</div>
				<div class="row">
					<fcheckbox v-model="selectedcheckbox" :choices="data.privileges" id="ck" label="Privileges"></fcheckbox>
				</div>
	        </div>
	        <div class="form--bottom flex vcenter right">
				<input type="submit" value="Save and Close" @click="addRole" v-if="!edit" class="btn--primary">
				<input type="submit" value="Save and Close" @click="updateRole(models.id)" v-if="edit" class="btn--primary">
			</div>
		</form>
    </div>

    <div class="card">
        <a href="javascript:void(0);" class="minimize" data-toggle="collapse" data-target="#collapse-1"></a>
        <div class="card__header flex between vend">
            <h6 class="bold">Role List</h6>
            <a href="javascript:void(0);" class="btn--primary open-toggle" id="toggle-open">Add Role</a>
        </div>
        <div class="card__body collapse in" id="collapse-1">
        	<ul class="media__wrapper margin0 sortable" id="sort" >
				<li class="media sort-item" v-for="obj in data.roles">
					<div class="media__group flex">
                        <div class="media__text">
                            <a href="#" class="title__name content__edit__hover btn__toggle__edit" @click="editRole(obj.id)">@{{ obj.role_name }}</a>
                        </div>
                    </div>
				</li>
			</ul>
        </div>
    </div>
</div>
