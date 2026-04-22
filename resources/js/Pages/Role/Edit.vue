<template>
  <div class="p-3 sm:p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-xl rounded-2xl p-4 sm:p-6 space-y-6">

      <div class="flex items-center justify-between">
        <Button icon="fa fa-arrow-left" variant="ghost" iconOnly="false" color="gray" @click="goBack" />

        <Button :icon="editMode ? 'fa fa-pen' : 'fa fa-lock'" :color="editMode ? 'green' : 'gray'" variant="solid"
          size="sm" @click="toggleEdit" label="Edit" />
      </div>


      <form class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="col-span-1 sm:col-span-2">
          <InputField id="role-name" label="Role Name" type="text" v-model="form.role_name" :required="true"
            :disabled="!editMode" :validation="error.role_name" :validation-message="'This field is required'" />
        </div>
      </form>

      <div class="flex justify-end">
        <Button label="Save" icon="fa fa-save" color="blue" variant="solid" :disabled="!editMode" @click="updateRole" />
      </div>
    </div>
  </div>

</template>
<script setup>
import { onErrorCaptured, reactive, ref } from 'vue';
import Button from '../Components/Button.vue';
import InputField from '../Components/InputField.vue';
import AppLayout from '../Shared/NavBar.vue'
import Swal from 'sweetalert2';
import axios from 'axios';
import { router } from '@inertiajs/vue3';



defineOptions({
  layout: AppLayout,
});

const props = defineProps({
  role: Object
});

const form = reactive({
  role_name: props.role.role_name,
})

const editMode = ref(false);

const toggleEdit = () => {
  editMode.value = !editMode.value;
};

const error = reactive({
  role_name: false,
});

const validateRole = () => {
  let valid = false;

  if (!form.role_name) {
    valid = true;
    error.role_name = true;
  } else {
    error.role_name = false;
  }

  return valid;
}

const updateRole = async () => {

  try {
    const validation = validateRole();

    if (validation) {
      Swal.fire({
        title: 'Error',
        text: 'Please fill up the required field',
        icon: 'error',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
      });
      return
    }

    const response = await axios.post(route('role.update', props.role.id), form);

    Swal.fire({
      title: 'Success',
      text: response.data.message,
      icon: 'success',
      toast: true,
      position: 'top-end',
    });

    router.visit(response.data.redirect);

  } catch (error) {
    console.error(error);
    Swal.fire({
      title: 'Error',
      text: 'Error updating role',
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000,
      icon: 'error'
    })
  }
}

const goBack = () => {
  router.visit(route('role.index'));
};

</script>
<style scoped></style>