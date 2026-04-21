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

        <div class="col-span-1 sm:col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-2">Roles</label>

          <!-- ✅ Selected Roles Badges -->
          <div v-if="form.roles.length > 0" class="mb-3 flex flex-wrap gap-2">
            <span v-for="role in form.roles" :key="role"
              class="flex items-center gap-1 bg-blue-100 text-blue-700 text-xs font-medium px-3 py-1 rounded-full">
              {{
                list.roles.find(r => r.id === role)?.role_name
              }}

              <button v-if="editMode" type="button" @click="form.roles = form.roles.filter(r => r !== role)"
                class="ml-1 text-blue-500 hover:text-red-500">
                ✕
              </button>
            </span>
          </div>

          <!-- ✅ Roles List -->
          <div v-if="list.roles && list.roles.length > 0" class="border border-gray-200 rounded-xl p-3 bg-gray-50">

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
              <label v-for="role in list.roles" :key="role"
                class="flex items-center border rounded-lg px-3 py-2 cursor-pointer bg-white hover:bg-gray-50"
                :class="!editMode ? 'opacity-60 cursor-not-allowed' : ''">
                <input type="checkbox" :value="role.id" v-model="form.roles" :disabled="!editMode"
                  class="accent-blue-600" />

                <span class="ml-3 text-sm text-gray-700 capitalize">
                  {{ role.role_name }}
                </span>
              </label>
            </div>

          </div>
          <div v-else
            class="border border-dashed border-gray-300 rounded-xl p-4 text-center text-sm text-gray-500 bg-gray-50">
            No roles created yet.
          </div>
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
  roleList: Array,
});

const form = reactive({
  name: props.user.name,
  email: props.user.email,
  roles: props.user.roles?.map(r => r.id) || [],
});

const list = reactive({
  roles: props.roleList,
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

    const response = await axios.put(route('user.update', props.user.id), form);

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