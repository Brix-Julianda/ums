<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="relative bg-white p-8 rounded-lg shadow-lg w-96">
      <h4 class="text-2xl font-bold mb-6 text-center">Create Role</h4>

      <form class="space-y-4">
        <div>
          <InputField id="name" label="Role Name" type="text" v-model="form.role_name" placeholder="Enter a role name"
            :required="true" :validation="validation.role_name" :validation-message="'This input is required'" />
        </div>

        <div class="flex justify-end">
          <Button label="Create" size="md" icon="fas fa-plus" @click.prevent="create" />
        </div>
      </form>
    </div>

  </div>

</template>
<script setup>
import { reactive } from 'vue';
import InputField from '../Components/InputField.vue';
import Button from '../Components/Button.vue';
import Swal from 'sweetalert2';
import axios from 'axios';
import { route } from 'ziggy-js';

const form = reactive({
  role_name: '',
});

const validation = reactive({
  role_name: false,
});

const validateCreation = () => {
  let valid = false;

  if (!form.role_name) {
    valid = true;
    validation.role_name = true;
  } else {
    validation.role_name = false;
  }

  return valid;
}

const create = () => {
  const isInvalid = validateCreation();

  if (isInvalid) {
    Swal.fire({
      title: 'Error',
      text: 'Error creating a role',
      icon: 'error',
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000,
    })

    return;
  }

  axios.post(route('role.store'), form)
    .then((res) => {

      Swal.fire({
        title: 'Success',
        text: res.data.message,
        icon: 'success',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500,
      });

      // ✅ FORCE redirect (not dependent on Swal)
      setTimeout(() => {
        window.location.href = res.data.redirect;
      }, 1600);

    })
    .catch((error) => {
      const messages = Object.values(error.response?.data?.errors || {}).flat();

      Swal.fire({
        title: 'Error',
        html: messages.join('<br>'),
        icon: 'error',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
      });
    });
}


</script>
<style scoped></style>