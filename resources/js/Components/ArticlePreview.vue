<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

dayjs.extend(relativeTime);
const props = defineProps(['article']);
 
const form = useForm({
    content: props.article.content,
});
 
const editing = ref(false);

function upperCase(value) {
  if (!value) return ''
  value = value.toString()
  return value.toUpperCase()
}

function goToUpdateArticle(article) {
    window.location.href = route('articles.edit', article);
}
</script>

<template>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="flex items-center w-full">
                <a :href="route('articles.show', article.id)">
                    <img :src="'/resources/articles/' + article.id + '/' + article.cover" class="max-w-20" />
                </a>
                <div class="flex justify-between items-center w-8/10 w-full ml-6">
                    <div class="flex justify-between w-full">
                        <a :href="route('articles.show', article.id)" class="mr-auto">
                          <span class="text-gray-800 hover:underline">{{ upperCase(article.title) }}</span>
                        </a>
                        <small class="ml-2 text-sm text-gray-600">{{ dayjs(article.created_at).fromNow() }}</small>
                        <small v-if="article.created_at !== article.updated_at" class="text-sm text-gray-600 ml-2"> &middot; edited</small>
                    </div>
                    <Dropdown v-if="article.user.id === $page.props.auth.user.id" class="ml-6">
                        <template #trigger>
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </template>
                        <template #content>
                            <button
                                class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out"
                                @click="goToUpdateArticle(article)">
                                Editer
                            </button>
                            <DropdownLink as="button" :href="route('articles.destroy', article.id)" method="delete">
                                Supprimer
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>
            <form v-if="editing" @submit.prevent="form.put(route('articles.update', article.id), { onSuccess: () => editing = false })">
                <p>Ajouter l'input pour les autres champs</p>
                <textarea v-model="form.content" class="mt-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                <InputError :content="form.errors.content" class="mt-2" />
                <div class="space-x-2">
                    <PrimaryButton class="mt-4">Save</PrimaryButton>
                    <button class="mt-4" @click="editing = false; form.reset(); form.clearErrors()">Cancel</button>
                </div>
            </form>
            <p v-else class="mt-4 text-lg text-gray-900">{{ article.content.substring(0,50) }}&nbsp;...</p>
        </div>
    </div>
</template>