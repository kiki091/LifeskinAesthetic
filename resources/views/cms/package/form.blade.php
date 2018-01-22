<div class="card form" id="toggle-open-content" style="display: none;">
    <form action="{{ route('cms.package.store') }}" method="POST" id="form-package" enctype="multipart/form-data" @submit.prevent>
        <div class="form--top flex vcenter between">
            <h6 class="bold margin0">Edit Data</h6>
            <a href="javascript:void(0);" class="btn--primary2 close-toggle" id="toggle-menu-manager" data-cancel="Cancel" data-name="Add Data" @click="changeButton">Close</a>
        </div>
        <!-- FORM WIZARD -->
        <div class="wizard--tab" id="menu">
            <ul class="wizard--tab--ul" >
                <li class="wizard--tab--li" v-for="(supportedLang, supportedLangKey, index) in supported_language" :class="last_language_key == supportedLangKey? 'lastTab': ( !index ? 'firstTab active__tab' : 'inactive__tab')">
                    <a :href="'#lang-'+supportedLangKey" class="wizard--tab--link">@{{ supportedLang.name }}</a>

                </li>
               
            </ul>
        </div>
        <div class="form--middle">
            <div class="create__form content__tab" v-for="(supportedLang, supportedLangKey, index) in supported_language" :class="!index ? 'active__content' : ''" :id="'lang-'+supportedLangKey">

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="title" placeholder="Enter the title title here" name="title" v-model="models.title" label="Title Package"></ftext>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="price" placeholder="Enter the price here" name="price" v-model="models.price" label="Price"></ftext>
                </div>

                <div class="field width-auto" v-if="showElementByDefaultLang(supportedLangKey) && list_product != ''">
                    <fcheckbox v-model="product_selector" name="product_id[]" :choices="list_product" id="ck" label="List Product"></fcheckbox>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <fimage id="thumbnail" name="thumbnail" v-model="thumbnail.image_url" label="Thumbnail Images" :ref="'thumbnail'" :options="thumbnail.options"></fimage>
                </div>

                <div class="field">
                    <ftexteditor name="description" v-model="models.description" label="Description" id="description"></ftexteditor>
                </div>
            </div>
        </div>

        <div class="form--bottom flex vcenter between">
            <div class="">
                <a href="#" class="btn--primary2 prev-button margin-r10" id=""><</a>
                <a href="#" class="btn--primary next-button" id="">Next</a>
            </div>
            {{ csrf_field() }}
            <input v-model="models.id" type="hidden" name="id" v-if="edit == true">
            <input class="btn__form btn--primary" type="submit" value="Save and Close" v-on:click="saveData">
        </div>
    </form>
</div>