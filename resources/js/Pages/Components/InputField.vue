<template>
  <div class="w-full mb-4">
    <!-- Label -->
    <label :for="id" class="block text-sm font-medium mb-1" :class="validation ? 'text-red-600' : 'text-gray-700'">
      {{ label }}
      <span v-if="required" class="text-red-500">*</span>
    </label>

    <!-- Input -->
    <input :id="id" :type="type" :value="modelValue" :placeholder="placeholder" @input="handleInput"
      class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2" :class="validation
        ? 'border-red-500 focus:ring-red-500'
        : 'border-gray-300 focus:ring-blue-500'" />

    <!-- Validation Message -->
    <p v-if="validation && validationMessage" class="text-sm text-red-500 mt-1">
      {{ validationMessage }}
    </p>
  </div>
</template>

<script setup>
const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: "",
  },
  type: {
    type: String,
    default: "text",
  },
  label: {
    type: String,
    default: "",
  },
  id: {
    type: String,
    default: "",
  },
  placeholder: {
    type: String,
    default: "",
  },
  required: {
    type: Boolean,
    default: false,
  },
  validation: {
    type: Boolean,
    default: false,
  },
  validationMessage: {
    type: String,
    default: "",
  },
});

const emit = defineEmits(["update:modelValue", "input"]);

const handleInput = (event) => {
  emit("update:modelValue", event.target.value);
  emit("input", event);
};
</script>