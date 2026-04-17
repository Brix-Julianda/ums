<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="relative bg-white p-8 rounded-lg shadow-lg w-96">
      <h4 class="text-2xl font-bold mb-6 text-center">Create Role</h4>

      <form class="space-y-4">
        <div>
          <InputField id="name" label="Role Name" type="text" v-model="form.name" placeholder="Enter a role name"
            :required="true" :validation="validation.name" :validation-message="'This input is required'" />
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
import InputField from '../Components/InputField.vue';
import Button from '../Components/Button.vue';

const form = reactive({
  name: '',
});

const validation = reactive({
  name: false,
});



</script>
<style scoped></style>