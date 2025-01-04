import { defineStore } from "pinia"
import axios from "axios";
import router from "@/router";

export const userState = defineStore('user', {
  persist: true,
    state: () => ({
user:null        }),
    getters: {
      logout(){
        this.user = null
      },
      getUser: (state) => state.user
    },
    actions: {
     async login(data) {
        await axios.get('/sanctum/csrf-cookie').then(response => {
    // Login...
  });

await axios.post('/login',data)

await axios.get('/api/user').then((res => {
    if(res.status == 200){
        this.user = res.data;
        router.push({name:'dashboard'})
    }
   
}))


      },
    },
  })