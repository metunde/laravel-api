<template>
    <div>
        <div class="max-w-2xl my-10 mx-auto">

<form action="#" method="post" @submit.prevent="update">
    <div class="my-10">
        <label for="text" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
        <div class="mt-2">
            <input v-model="title" id="text" name="text" type="text" autocomplete="off"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">

            <p class="text-red-500">

            </p>
        </div>
        <p class="text-red-500" v-if="errors?.title">
            {{ errors.title[0] }}
        </p>
    </div>
    <label for="text" class="block text-sm font-medium leading-6 text-gray-900">Body</label>

    <div class="mb-4 w-full bg-gray-50 rounded-lg">
        <div class="bg-white ">
            <textarea v-model="body" id="editor" rows="8"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                placeholder="Write an article..."></textarea>
        </div>
        <p class="text-red-500" v-if="errors?.body">
            {{ errors.body[0] }}
        </p>
    </div>
    <button type="submit"
        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
        Update
    </button>
</form>
</div>
    </div>
</template>


<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
const post = ref({});
const route = useRoute();
const title = ref('');
const body = ref('');
const errors = ref({})

const fetchPost = () => {
    axios.get('/api/post/' + route.params.id).then(res => {
console.log(res);
title.value = res.data.post.title;
body.value = res.data.post.body;
    })
}

const update = () => {
    axios.put('/api/post/' + route.params.id, {
        title: title.value,
        body: body.value
    }).catch(err => {
        if (err.response.status == 422) {
            errors.value = err.response.data.errors
        }
    });
}


mounted: {
    fetchPost()
}
   

</script>