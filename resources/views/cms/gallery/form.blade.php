<div class="card form" id="toggle-open-content" style="display: none;">
    <form action="{{ route('cms.gallery.store') }}" method="POST" id="form-gallery" enctype="multipart/form-data" @submit.prevent>
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

                <div class="field widthauto flex" v-if="showElementByDefaultLang(supportedLangKey)">
                    <fchosen :options="list_category" id="select-category" v-model="category_selector" name="category_id" label="Category Name"></fchosen>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="title" placeholder="Enter the title title here" name="title" v-model="models.title" label="Title News"></ftext>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <fimage id="thumbnail" name="thumbnail" v-model="thumbnail.image_url" label="Thumbnail Images" :ref="'thumbnail'" :options="thumbnail.options"></fimage>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <fimage id="filename" name="filename" v-model="filename.image_url" label="Detail Images" :ref="'filename'" :options="filename.options"></fimage>
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