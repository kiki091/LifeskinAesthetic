<div class="card form" id="toggle-open-content" style="display: none;">
    <form action="{{ route('cms.about.store') }}" method="POST" id="form-about" enctype="multipart/form-data" @submit.prevent>
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
                    <fimage id="section_one_images" name="section_one_images" v-model="section_one_images.image_url" label="Section One Images" :ref="'section_one_images'" :options="section_one_images.options"></fimage>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="section_one_title" placeholder="Enter the title here" name="section_one_title" v-model="models.section_one_title" label="Section One Title"></ftext>
                </div>

                <div class="field">
                    <ftexteditor name="section_one_description" v-model="models.section_one_description" label="Section One Description" id="section_one_description"></ftexteditor>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <fimage id="contact_us_images" name="contact_us_images" v-model="contact_us_images.image_url" label="Contact Us Images" :ref="'contact_us_images'" :options="contact_us_images.options"></fimage>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="contact_us_title" placeholder="Enter the contact_us_title here" name="contact_us_title" v-model="models.contact_us_title" label="Contact Us Title"></ftext>
                </div>

                <div class="field">
                    <ftexteditor name="contact_us_introduction" v-model="models.contact_us_introduction" label="Contact Us Introduction" id="contact_us_introduction"></ftexteditor>
                </div>
            </div>
        </div>

        <div class="form--bottom flex vcenter between">
            <div class="">
            </div>
            {{ csrf_field() }}
            <input v-model="models.id" type="hidden" name="id" v-if="edit == true">
            <input class="btn__form btn--primary" type="submit" value="Save and Close" v-on:click="saveData">
        </div>
    </form>
</div>