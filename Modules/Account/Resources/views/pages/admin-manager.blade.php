<div class="main--content" id="template_admin">
	<h3 class="main--content__title">Admin Manager</h3>

	<div class="card form" id="toggle-open-content" style="display: none;">
		<form action="{{ route('facile.admin.store') }}" method="POST" @submit.prevent>
			<div class="form--top flex vcenter between">
	            <h6 class="bold margin0">@{{ formTitle }}</h6>

	            <a href="javascript:void(0);" class="btn--primary2 close-toggle" id="toggle-menu-manager" data-cancel="Cancel" data-name="Add Role" @click="changeButton">Close</a>
	        </div>

	        <div class="form--middle">
				<div class="row">
					<ftext type='text' name="name" class="new__form__input__field" placeholder="Enter admin name here" v-model="models.admin_name" id="name-field" label="Admin Name"></ftext>

					<ftext type='text' name="email" class="new__form__input__field" placeholder="Enter the menu title here" v-model="models.admin_email" id="email-field" label="Admin Email"></ftext>
				</div>
				<div class="row">

					<ftext type='password' name="password" class="new__form__input__field" placeholder="Enter password" v-model="models.password" id="password-field" label="Password"></ftext>

					<ftext type='password' name="confirm_password" class="new__form__input__field" placeholder="Enter confirm password" v-model="models.confirm_password" id="confirmpassword-field" label="Confirm Password"></ftext>
				</div>
				<div class="row">
					<fcheckbox v-model="selectedrole" :choices="roles" id="ck" label="Roles"></fcheckbox>
				</div>
	        </div>
	        <div class="form--bottom flex vcenter right">
				<input type="submit" value="Save and Close" @click="addAdmin" v-if="!edit" class="btn--primary">
				<input type="submit" value="Save and Close" @click="updateAdmin(models.id)" v-if="edit" class="btn--primary">
			</div>
		</form>
    </div>

    <div class="card">
        <a href="javascript:void(0);" class="minimize" data-toggle="collapse" data-target="#collapse-1"></a>
        <div class="card__header flex between vend">
            <h6 class="bold">Admin List</h6>
            <a href="javascript:void(0);" class="btn--primary open-toggle" id="toggle-open">Add Admin</a>
        </div>
        <div class="card__body collapse in" id="collapse-1">
        	<ul class="media__wrapper margin0" id="sort" >
				<li class="media sort-item" v-for="item in data" >
					<div class="media__group flex">
                        <div class="media__text">
                            <a href="#" class="title__name content__edit__hover btn__toggle__edit" @click="editAdmin(item.id)">@{{ item.admin_name }}</a>
                            <small class="s10">Role: <b>@{{ item.roles }}</b></small>
                        </div>
                        
                    </div>
                    <div class="media__control">
                        <label class="switch margin-x5">
                            <input class="switch-input" :id="'check_'+item.id" name="is_active" id="check_1" :checked="item.is_active == 1" v-model="item.is_active" @change="changeStatus(item.id)" type="checkbox">
                            <span class="switch-label"></span><span class="switch-handle"></span>
                        </label>
                	</div>
				</li>
			</ul>
        </div>
    </div>

    
</div>