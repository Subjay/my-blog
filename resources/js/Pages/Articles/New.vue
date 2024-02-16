<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';

defineProps(['articles']);
 
const form = useForm({
    title: '',
    content: '',
    category: '',
    cover: '',
    imagePreview: '',
    imageFile: null,
    imageSelected: false,
    imageLoading: true,
});

const scriptTagRegex = /(<|&lt;|\\x3C|&#x3C;|&#60;|\\003C)\s*(\/|&#x2f;|&#47;|&sol;|\\002F)?\s*(script|style)\s*(>|&gt;|&#62;|\\x3E|&#x3e;|\\003E)/gi;

function sanitize(text) {
  return text.replace(scriptTagRegex, '');
}

function onPickFile () {
  document.querySelector('#cover-input').click()
}

function onFilePicked (event) {
  const files = event.target.files;
  const fileReader = new FileReader();

  fileReader.addEventListener('load', () => {
    form.imagePreview = fileReader.result;
    form.imageLoading = false;
  })

  fileReader.readAsDataURL(files[0]);
  form.imageSelected = true;
  form.cover = files[0].name;
  form.imageFile = files[0];
}

function removeFile() {
  form.imageSelected = false;
  form.imageLoading = true;
  form.cover = '';
}

function displayAPIErrors(err) {
  console.log(err);
}

function displayErrors() {
  if(form.title == '') {
    form.errors.title = 'Le titre ne peut pas être vide.'
  }

  if(form.content == '') {
    form.errors.content = 'Le contenu ne peut pas être vide.'
  }

  if(form.category == '') {
    form.errors.category = 'Veuillez sélectionner une catégorie.'
  }

  if(form.cover == '') {
    form.errors.cover = 'Il faut obligatoirement une image de couverture.'
  }
}

function isFormValid() {
  return form.title != '' &&
  form.content != '' &&
  form.category != '' &&
  form.cover != '';
}

function submitForm() {
  if(isFormValid()) {
    form.post(route('articles.store'), { onSuccess: () => form.reset() })
  }
  else {
    displayErrors();
  }
}

</script>
 
<template>
    <Head title="Ajout d'un article" />
 
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nouvel article</h2>
        </template>
        <div class="mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="submitForm" class="flex flex-col">
              <label for="title">Titre de l'article :</label>
              <input
                id="title"
                :value="form.title"
                @input="event => form.title = sanitize(event.target.value)"
                placeholder="Indiquez votre titre">
              <InputError :message="form.errors.title" class="mt-2" />
              
              <label for="content">Contenu de l'article :</label>
              <textarea
                id="content"
                :value="form.content"
                @input="event => form.content = sanitize(event.target.value)"
                placeholder="L&acirc;chez vous ;)"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
              ></textarea>
              <InputError :message="form.errors.content" class="mt-2" />

              <label for="category">Cat&eacute;gorie de l'article :</label>
              <select v-model="form.category">
                <option disabled value="">-- Choisissez une cat&eacute;gorie --</option>
                <option value="Technologie">Technologie</option>
                <option value="Bien-être">Bien &ecirc;tre</option>
                <option value="Autre">Autre</option>
              </select>
              <InputError :message="form.errors.category" class="mt-2" />

              <div v-if="!form.imageSelected" class="flex flex-col">
                <label for="cover">Image de couverture :</label>
                <button
                  id="cover"
                  type="button"
                  @click="onPickFile">Uploader une image</button>
                <input
                  id="cover-input"
                  type="file"
                  style="display: none"
                  ref="fileInput"
                  accept="image/*"
                  @change="onFilePicked"/>
              </div>

              <div v-else class="flex flex-col justify-center items-center">
                <p>Image ({{ form.cover }}) :</p>
                <div v-if="!form.imageLoading" class="relative size-1/3">
                  <img :src="form.imagePreview" />
                  <img src="/resources/icons/cross.svg" class="cursor-pointer size-6 absolute top-0 right-0 translate-x-[30%] translate-y-[-30%]" @click="removeFile"/>
                </div>
                <p v-else>Chargement de l'image</p>
              </div>
              <InputError :message="form.errors.cover" class="mt-2" />
              
              <PrimaryButton class="mt-4">Sauvegarder</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>