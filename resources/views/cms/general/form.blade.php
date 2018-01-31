<div class="card form" id="toggle-open-content" style="display: none;">
    <form action="{{ route('cms.general.store') }}" method="POST" id="form-general" enctype="multipart/form-data" @submit.prevent>
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
                    <fimage id="favicon" name="favicon" v-model="favicon.image_url" label="Favicon Images" :ref="'favicon'" :options="favicon.options"></fimage>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <fimage id="logo" name="logo" v-model="logo.image_url" label="Logo Images" :ref="'logo'" :options="logo.options"></fimage>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="web_title" placeholder="Enter the web title here" name="web_title" v-model="models.web_title" label="Website Title"></ftext>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="og_title" placeholder="Enter the og title here" name="og_title" v-model="models.og_title" label="Open Graph Title"></ftext>
                </div>

                <div class="field">
                    <ftexteditor name="og_description" v-model="models.og_description" label="Open Graph Description" id="og_description"></ftexteditor>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <fimage id="og_images" name="og_images" v-model="og_images.image_url" label="Open Graph Images" :ref="'og_images'" :options="og_images.options"></fimage>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="latitude" placeholder="Enter the latitude here" name="latitude" v-model="models.latitude" label="Latitude"></ftext>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="longitude" placeholder="Enter the longitude here" name="longitude" v-model="models.longitude" label="Longitude"></ftext>
                </div>

                <div class="field">
                    <ftexteditor name="address" v-model="models.address" label="Address" id="Address"></ftexteditor>
                </div>

                <div class="field">
                    <ftexteditor name="address_introduction" v-model="models.address_introduction" label="Address Introduction" id="address_introduction"></ftexteditor>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="contact_title" placeholder="Enter the contact title here" name="contact_title" v-model="models.contact_title" label="Contact Title"></ftext>
                </div>

                <div class="field">
                    <ftexteditor name="contact_introduction" v-model="models.contact_introduction" label="Contact Introduction" id="contact_introduction"></ftexteditor>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <fimage id="contact_images" name="contact_images" v-model="contact_images.image_url" label="Contact Images" :ref="'contact_images'" :options="contact_images.options"></fimage>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="email" placeholder="Enter the email here" name="email" v-model="models.email" label="Email"></ftext>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="phone_number" placeholder="Enter the phone number here" name="phone_number" v-model="models.phone_number" label="Phone Number"></ftext>
                </div>

                <div class="field">
                    <ftexteditor name="open_hours" v-model="models.open_hours" label="open_hours" id="Open Hours"></ftexteditor>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="facebook_link" placeholder="Enter the facebook link here" name="facebook_link" v-model="models.facebook_link" label="Facebook Link"></ftext>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="contact_title" placeholder="Enter the contact title here" name="contact_title" v-model="models.contact_title" label="Contact_ Title"></ftext>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="twitter_link" placeholder="Enter the twitter link here" name="twitter_link" v-model="models.twitter_link" label="Twitter Link"></ftext>
                </div>

                <div class="field" v-if="showElementByDefaultLang(supportedLangKey)">
                    <ftext type='text' class="new__form__input__field" id="instagram_link" placeholder="Enter the instagram link here" name="instagram_link" v-model="models.instagram_link" label="Instagram Link"></ftext>
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