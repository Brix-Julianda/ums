<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <!-- Login Container -->
    <div class="relative bg-white p-8 rounded-lg shadow-lg w-96">


      <!-- Login Form -->
      <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
      <form class="space-y-4">
        <div>
          <InputField id="email" label="Email" type="email" v-model="email" placeholder="Enter your email"
            :required="true" :validation="emailError" :validationMessage="emailMessage" />
        </div>

        <div>
          <InputField id="password" label="Password" type="password" v-model="password"
            placeholder="Enter your password" :required="true" :validation="passwordError"
            :validationMessage="passwordMessage" />
        </div>

        <div class="flex items-center">
          <input type="checkbox" id="rememberMe" v-model="rememberMe"
            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
          <label for="rememberMe" class="ml-2 block text-sm text-gray-700">Remember Me</label>
        </div>

        <Button label="Login" color="blue" icon="fas fa-sign-in-alt" @click="login" />
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import Swal from "sweetalert2";
import InputField from "../Components/InputField.vue";
import Button from "../Components/Button.vue";

const email = ref("");
const password = ref("");
const rememberMe = ref(false);

const login = () => {
  // Example alert
  Swal.fire({
    title: "Login Info",
    html: `
      Email: ${email.value} <br/>
      Password: ${password.value} <br/>
      Remember Me: ${rememberMe.value}
    `,
    icon: "info",
  });
};
</script>