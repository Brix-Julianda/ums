<template>
  <div class="p-2">
    <div class="flex flex-col w-full bg-white shadow rounded-lg overflow-x p-5">

      <div class="flex justify-between items-center mb-4">
        <div></div>

        <!-- Back Button -->
        <button @click="goBack" class="px-3 py-1 text-sm bg-gray-200 hover:bg-gray-300 rounded-lg">
          ← Back
        </button>
      </div>

      <div class="flex justify-end mb-4">
        <button @click="toggleEdit" :class="editMode ? 'bg-green-500' : 'bg-gray-400'"
          class="px-4 py-2 text-white rounded-lg">
          {{ editMode ? 'Edit Mode: ON' : 'Edit Mode: OFF' }}
        </button>
      </div>

      <form class="space-y-4">
        <div>
          <InputField id="name" label="Name" type="text" v-model="form.name" placeholder="Enter your name"
            :required="true" :validation="validation.name" :validationMessage="validationMessage.name"
            :disabled="!editMode" />
        </div>
        <div>
          <InputField id="email" label="Email" type="email" v-model="form.email" placeholder="Enter your email"
            :required="true" :validation="validation.email" :validationMessage="validationMessage.email"
            :disabled="!editMode" />
        </div>
      </form>

      <div class="flex justify-end mt-4">
        <Button label="Save Changes" color="blue" size="md" @click.prevent="saveChanges" :disabled="!editMode" />
      </div>


    </div>
  </div>
</template>
<script setup>
import { reactive, ref } from 'vue';
import InputField from '../Components/InputField.vue';
import AppLayout from '../Shared/NavBar.vue';
import Button from '../Components/Button.vue';
import Swal from 'sweetalert2';
import axios from 'axios';

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
  let valid = false;

  if (!form.name) {
    valid = false;
    validation.name = true;
    validationMessage.name = 'Name is required.';
  } else {
    validation.name = false;
    validationMessage.name = '';
  }

  if (!form.email) {
    valid = true;
    validation.email = true;
    validationMessage.email = 'Email is required.';
  } else {
    validation.email = false;
    validationMessage.email = '';
  }

  return valid;
}

const editMode = ref(false);


const toggleEdit = () => {
  editMode.value = !editMode.value;
};


const saveChanges = async () => {
  try {

    const validation = updateValidation();

    if (validation) {
      Swal.fire({
        title: 'Error',
        text: 'Please fill up the fields',
        icon: 'error',
        toast: true,
        position: 'top-end',
      })

      return;
    }

    const response = await axios.post(route('user.update', props.user.id), form);
    window.location.href = response.data.redirect;
    Swal.fire({
      title: 'Success',
      text: response.data.message,
      icon: 'success',
      toast: true,
      position: 'top-end',
    });


  } catch (error) {
    Swal.fire({
      title: 'Error',
      text: 'An error occurred while saving changes.' + error.message,
      icon: 'error',
    });
  }


};


</script>