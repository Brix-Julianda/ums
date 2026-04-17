<template>
  <div class="p-3 sm:p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-xl rounded-2xl p-4 sm:p-6 space-y-6">

      <!-- Header -->
      <div class="flex items-center justify-between">

        <!-- Back Button (Button Component) -->
        <Button icon="fa fa-arrow-left" variant="ghost" iconOnly="false" color="gray" @click="goBack" />

        <!-- Edit Toggle -->
        <Button :icon="editMode ? 'fa fa-pen' : 'fa fa-lock'" :color="editMode ? 'green' : 'gray'" variant="solid"
          size="sm" @click="toggleEdit" label="Edit" />

      </div>

      <!-- Form -->
      <form class="grid grid-cols-1 sm:grid-cols-2 gap-4">

        <div class="col-span-1 sm:col-span-2">
          <InputField id="name" label="Name" type="text" v-model="form.name" placeholder="Enter your name"
            :required="true" :validation="validation.name" :validationMessage="validationMessage.name"
            :disabled="!editMode" />
        </div>

        <div class="col-span-1 sm:col-span-2">
          <InputField id="email" label="Email" type="email" v-model="form.email" placeholder="Enter your email"
            :required="true" :validation="validation.email" :validationMessage="validationMessage.email"
            :disabled="!editMode" />
        </div>

      </form>

      <!-- Actions -->
      <div class="flex justify-end">

        <Button label="Save" icon="fa fa-save" color="blue" variant="solid" :disabled="!editMode"
          @click="saveChanges" />

      </div>

    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import InputField from '../Components/InputField.vue';
import AppLayout from '../Shared/NavBar.vue';
import Swal from 'sweetalert2';
import axios from 'axios';
import { router } from '@inertiajs/vue3';
import Button from '../Components/Button.vue';

defineOptions({
  layout: AppLayout
});


const props = defineProps({
  user: Object,
});

const form = reactive({
  name: props.user.name,
  email: props.user.email,
});

const validation = reactive({
  name: false,
  email: false,
});

const validationMessage = reactive({
  name: '',
  email: '',
});

const updateValidation = () => {
  let hasError = false;

  if (!form.name) {
    hasError = true;
    validation.name = true;
    validationMessage.name = 'Name is required.';
  } else {
    validation.name = false;
    validationMessage.name = '';
  }

  if (!form.email) {
    hasError = true;
    validation.email = true;
    validationMessage.email = 'Email is required.';
  } else {
    validation.email = false;
    validationMessage.email = '';
  }

  return hasError;
};

const editMode = ref(false);

const toggleEdit = () => {
  editMode.value = !editMode.value;
};

const goBack = () => {
  router.visit(route('user.index'));
};

const saveChanges = async () => {
  try {
    const hasError = updateValidation();

    if (hasError) {
      Swal.fire({
        title: 'Error',
        text: 'Please fill up the fields',
        icon: 'error',
        toast: true,
        position: 'top-end',
      });
      return;
    }

    const response = await axios.post(route('user.update', props.user.id), form);

    Swal.fire({
      title: 'Success',
      text: response.data.message,
      icon: 'success',
      toast: true,
      position: 'top-end',
    });

    router.visit(response.data.redirect);

  } catch (error) {
    Swal.fire({
      title: 'Error',
      text: 'An error occurred while saving changes. ' + error.message,
      icon: 'error',
    });
  }
};
</script>