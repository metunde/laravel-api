<template>
  <RouterView/>
</template>

<script setup>
import axios from 'axios' 
import { RouterView } from 'vue-router';

const login = async () => {
  

axios.get('http://localhost:8000/api/user').then((res => {console.log(res)}))

}

</script>
