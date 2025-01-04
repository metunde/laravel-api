<template>
    <div>
        <div class="max-w-2xl my-10 mx-auto">

            <form action="#" method="post" @submit.prevent="create">
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
                    Publish post
                </button>
            </form>

            <div class="flex justify-evenly my-4">

                <h2 class="text-kl font-bold">Post</h2>
 
                <h2 class="text-xl font-bold">Actions</h2>

            </div>

            <div class="flex justify-evenly text-center space-y-3" v-for="post in posts">

                <p class="text-lg font-semibold">{{post.title}}</p>

                <div class="space-x-7 mr-10">

                    <RouterLink :to="{name:'post.update', params:{id:post.id}}" class="text-blue-400">Edit</RouterLink> >

                    <button @click="deletePost(post.id)" class="text-red-400">Delete</button>

                </div>

            </div>
</div>

<div class="flex justify-center space-x-3 mb-10">
 <button :disabled="!pagination.prev_page_url" @click="fetchPosts(pagination.prev_page_url)" class="text-blue-600 capitalize">previous</button>

<button :disabled="!pagination.next_page_url" @click="fetchPosts(pagination.next_page_url)" class="text-blue-600 capitalize">next</button>

</div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { RouterLink } from 'vue-router';
import { userState } from '@/store/user';

const store = userState();
const body = ref('');
const title = ref('');
const errors = ref({});
const posts = ref([]);
const pagination = ref({})

const create = () => {
    axios.post('/api/post', {
        title: title.value,
        body: body.value
    }).then(res => {
        if (res.status == 200) {
            title.value = '',
                body.value = '';
                fetchPosts();

        }
    }).catch(err => {
        if (err.response.status === 422) {
            errors.value = err.response.data.errors
        }
    });
}

const fetchPosts = (url = 'api/post') => {
    axios.get(url).then(res => {
        console.log(res);
        posts.value = res.data.posts.data;
        pagination.value = {
            next_page_url: res.data.posts.next_page_url,
            prev_page_url: res.data.posts.prev_page_url,
            

        }
    })
}

const deletePost = (id) =>{
    let answer = confirm('Are you sure')
    if(!answer){
        return
    }
axios.delete('/api/post/'+id).then(res => {
    if(res.status == 204){
        fetchPosts();
    };
})
}

fetchPosts();
</script>