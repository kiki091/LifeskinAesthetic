<div class="main--content" id="template_function">
	<h3 class="main--content__title">Function Manager</h3>

	<div class="card form" id="toggle-open-content" style="display: none;">
		<form action="{{ route('facile.function.store') }}" method="POST" @submit.prevent>
			<div class="form--top flex vcenter between">
	            <h6 class="bold margin0">Add System Function</h6>
	            <a href="javascript:void(0);" class="btn--primary2 close-toggle" id="toggle-menu-manager" data-cancel="Cancel" data-name="Add Function" @click="changeButton">Close</a>
	        </div>
	        
	        <div class="form--middle">
				<div class="row">
					<fchosen name="controller" id="select" label="Controller name" :options="controller_manager" v-model="selected"></fchosen>
				</div>
				<div class="row">
					<ftext type='text'  class="new__form__input__field" placeholder="Enter the function name here" v-model="models.name" label="Function Name"></ftext>
				</div>
				<div class="row">
					<ftexteditor v-model="models.description" limit="20" label="Description"></ftexteditor>
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
            <h6 class="bold">Function List</h6>
            <a href="javascript:void(0);" class="btn--primary open-toggle" id="toggle-open">Add Content</a>
        </div>
        <div class="card__body collapse in" id="collapse-1">
        	<table align="center" cellpadding="0" cellspacing="0" >
				<tbody>
					<!-- header tabel -->
					<tr>
						<th class="text__center">No</th>
						<th>Controller Name</th>
						<th>Function Name</th>
						<th class="text__center">Action</th>
					</tr>
					<!-- isi tabel -->
					<tr v-for="(obj, index) in data">
						<td class="text__center">@{{ index+1 }}</td>
						<td>@{{ obj.controller }}</td>
						<td>@{{ obj.name }}</td>
						<td class="text__center">
							<a href="#" @click="editData(obj.id)" class="btn__toggle__edit"><i class="ico-pencil">@include('svg-logo.ico-pencil')</i></a>
							<a href="#" @click="showDeleteForm(obj.id)"><i class="ico-delete">@include('svg-logo.ico-delete')</i></a>
						</td>
					</tr>
					<!-- isi tabel -->
				</tbody>
			</table>
        </div>
    </div>
</div>

