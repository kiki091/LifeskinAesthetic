<div class="card form" id="toggle-open-content" style="display: none;">
    <form action="{{ route('cms.transaction.store') }}" method="POST" id="form-transaction" enctype="multipart/form-data" @submit.prevent>
        <div class="form--top flex vcenter between">
            <h6 class="bold margin0">Edit Data</h6>
            <a href="javascript:void(0);" class="btn--primary2 close-toggle" id="toggle-menu-manager" data-cancel="Cancel" data-name="Add Data" @click="changeButton">Close</a>
        </div>
        <!-- FORM WIZARD -->

        <div class="form--middle">
            <div class="create__form">

                <div class="field">
                    <ftext type='text' class="new__form__input__field" id="registrasi_id" name="registrasi_id" v-model="models.registrasi_id" label="Registrasi Id"></ftext>
                </div>

                <div class="field">
                    <ftext type='text' class="new__form__input__field" id="package_title" name="package_title" v-model="models.package_title" label="Package Name"></ftext>
                </div>

                <div class="field">
                    <ftext type='text' class="new__form__input__field" id="member_name" name="member_name" v-model="models.member_name" label="Member Name"></ftext>
                </div>

                <div class="field">
                    <ftext type='text' class="new__form__input__field" id="member_email" name="member_email" v-model="models.member_email" label="Member Email"></ftext>
                </div>

                <div class="field">
                    <ftext type='text' class="new__form__input__field" id="phone_number" name="phone_number" v-model="models.phone_number" label="Phone Number"></ftext>
                </div>

                <div class="field">
                    <ftext type='text' class="new__form__input__field" id="price" name="price" v-model="models.price" label="Price"></ftext>
                </div>

                <div class="field">
                    <ftext type='text' class="new__form__input__field" id="status" name="status" v-model="models.status" label="Status"></ftext>
                </div>

                <div class="field">
                    <ftext type='text' class="new__form__input__field" id="book_date" name="book_date" v-model="models.book_date" label="Book Date"></ftext>
                </div>
            </div>
        </div>
        <!-- END FORM WIZARD -->
        <div class="form--bottom flex vcenter between">
            <a href="javascript:void(0);" class="btn--primary2 close-toggle" id="toggle-menu-manager" data-cancel="Cancel" data-name="Add Data" @click="changeButton">Close</a>
        </div>
    </form>
</div>