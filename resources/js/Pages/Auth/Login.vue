<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <!-- Login Container -->
    <div class="relative bg-white p-8 rounded-lg shadow-lg w-96">


      <!-- Login Form -->
      <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
      <form class="space-y-4">
        <div>
          <InputField id="email" label="Email" type="email" v-model="form.email" placeholder="Enter your email"
            :required="true" :validation="validation.email" :validationMessage="validationMessage.email" />
        </div>

        <div>
          <InputField id="password" label="Password" type="password" v-model="form.password"
            placeholder="Enter your password" :required="true" :validation="validation.password"
            :validationMessage="validationMessage.password" />
        </div>

        <div class="flex items-center">
          <input type="checkbox" id="rememberMe" v-model="form.rememberMe"
            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
          <label for="rememberMe" class="ml-2 block text-sm text-gray-700">Remember Me</label>
        </div>

        <div class="flex justify-end">
          <Button label="Login" color="blue" size="md" icon="fas fa-sign-in-alt" @click.prevent="login" />
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import Swal from "sweetalert2";
import InputField from "../Components/InputField.vue";
import Button from "../Components/Button.vue";


const form = reactive({
  email: '',
  password: '',
  rememberMe: false,
})

const validation = reactive({
  email: false,
  password: false,
});

const validationMessage = reactive({
  email: '',
  password: '',
})

const loginValidation = () => {
  let valid = false;

  if (!form.email) {
    valid = true;
    validation.email = true;
    validationMessage.email = 'Please input an email';
  };

  if (!form.password) {
    valid = true;
    validation.password = true;
    validationMessage.password = 'please input a password';
  }

  return valid;
}

const login = () => {

  const validation = loginValidation();

  if (validation) {
    Swal.fire({
      title: 'Error',
      text: 'Please fill up the fields',
      icon: 'error'
    });
    return;
  } else {
    console.log('all validations are accepted!');
  }

};
</script>