<template>
<button @click='login'>click me</button>
  <h1 class="text-3xl font-bold underline text-red-600">
    Hello world!
  </h1>
  
</template>

<script setup>
import axios from 'axios' 

const login = async () => {
  
//  await axios.get('http://localhost:8000/sanctum/csrf-cookie').then(response => {
//     // Login...
//   });

// await axios.post('http://localhost:8000/login',{email:'greyw4300@gmail.com', password:'password'})

axios.get('http://localhost:8000/api/user').then((res => {console.log(res)}))

}

</script>
