<template>
  <div class="p-2">
    <div class="flex w-full bg-white shadow rounded-lg overflow-x p-5">
      <form class="space-y-4">
        <div>
          <InputField id="name" label="Name" type="text" v-model="form.name" placeholder="Enter your name"
            :required="true" :validation="validation.name" :validationMessage="validationMessage.name" />
        </div>
        <div>
          <InputField id="email" label="Email" type="email" v-model="form.email" placeholder="Enter your email"
            :required="true" :validation="validation.name" :validationMessage="validationMessage.email" />
        </div>
      </form>


    </div>
  </div>
</template>
<script setup>
import { reactive } from 'vue';
import InputField from '../Components/InputField.vue';
import AppLayout from '../Shared/NavBar.vue';

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
  name: false,
  email: false,
});





</script>