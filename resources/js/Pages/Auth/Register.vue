<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="relative bg-white p-8 rounded-lg shadow-lg w-96">

      <h2 class="text-2xl font-bold mb-6 text-center">Create User</h2>

      <form class="space-y-4">
        <div>
          <InputField id="name" label="Name" type="text" v-model="form.name" placeholder="Enter your full name"
            :required="true" :validation="validation.name" :validation-message="message.name" />
        </div>
        <div>
          <InputField id="email" label="Email" type="email" v-model="form.email" placeholder="Enter your email"
            :required="true" :validation="validation.email" :validation-message="message.email" />
        </div>

        <div>
          <InputField id="password" label="Password" type="password" v-model="form.password"
            placeholder="Enter your password" :required="true" :validation="validation.password"
            :validation-message="message.password" />
        </div>

        <div>
          <InputField id="confirm-password" label="Confirm Password" type="password" v-model="form.confirm_password"
            placeholder="Enter your password again" :required="true" :validation="validation.confirm_password"
            :validation-message="message.confirm_password" />
        </div>

        <div class="flex justify-end">
          <Button label="Create" color="green" size="md" icon="fas fa-plus" @click.prevent="create" />
        </div>

      </form>

    </div>
  </div>
</template>
<script setup>
import { reactive } from 'vue';
import Button from '../Components/Button.vue';
import InputField from '../Components/InputField.vue';
import Swal from 'sweetalert2';
import axios from 'axios';
import { route } from 'ziggy-js';

const form = reactive({
  name: '',
  email: '',
  password: '',
  confirm_password: '',
});

const validation = reactive({
  name: false,
  email: false,
  password: false,
  confirm_password: false,
});

const message = reactive({
  name: '',
  email: '',
  password: '',
  confirm_password: '',
});

const validationCreation = () => {
  let valid = false;

  if (!form.name) {
    valid = true;
    validation.name = true;
    message.name = 'Please input yout name';
  } else {
    validation.name = false;
    message.name = '';
  }

  if (!form.email) {
    valid = true;
    validation.email = true
    message.email = 'please input an email';
  } else {
    validation.email = false;
    message.email = '';
  }

  if (!form.password) {
    valid = true;
    validation.password = true;
    message.password = 'please input a password';
  } else {
    validation.password = false;
    message.password = '';
  }

  switch (true) {
    case !form.confirm_password:
      valid = true;
      validation.confirm_password = true;
      message.confirm_password = 'Please input your decided password';
      break;

    case form.confirm_password !== form.password:
      valid = true;
      validation.confirm_password = true;
      message.confirm_password = 'Password is not the same!';
      break;

    default:
      validation.confirm_password = false;
      message.confirm_password = '';
      break;
  }

  return valid;
}

const create = () => {
  const isInvalid = validationCreation();

  if (isInvalid) {
    Swal.fire({
      title: 'Error',
      text: 'Error creating a user',
      icon: 'error'
    });

    return;
  }

  axios.post(route('user.store'), form)
    .then((res) => {
      Swal.fire({
        title: 'Success',
        text: 'Created a user!',
        icon: 'success'
      }).then(() => {
        window.location.href = res.data.redirect;
      });
    })
    .catch((error) => {
      if (error.response && error.response.data.errors) {
        const messages = Object.values(error.response.data.errors).flat();
        Swal.fire({
          title: 'Error',
          html: messages.join('<br>'),
          icon: 'error',
        });
      }
    });
}
</script>