<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ArticlePreview from '@/Components/ArticlePreview.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';

defineProps(['articles']);
 
const form = useForm({
    title: '',
    content: '',
    category: '',
    cover: '',
});
</script>
 
<template>
    <Head title="Liste des articles" />
 
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Liste de vos articles</h2>
        </template>
        <div class="mx-auto p-4 sm:p-6 lg:p-8">
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <ArticlePreview
                    v-for="article in articles"
                    :key="article.id"
                    :article="article"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>