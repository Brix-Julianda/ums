<template>
  <div class="w-full mb-4">
    <!-- Label -->
    <label :for="id" class="block text-sm font-medium mb-1"
      :class="validation ? 'text-red-600' : disabled ? 'text-gray-400' : 'text-gray-700'">
      {{ label }}
      <span v-if="required" class="text-red-500">*</span>
    </label>

    <!-- Input -->
    <input :id="id" :type="type" :value="modelValue" :placeholder="placeholder" :disabled="disabled"
      @input="handleInput" class="w-full px-3 py-2 border rounded-md focus:outline-none transition"
      :class="inputClasses" />

    <!-- Validation Message -->
    <p v-if="validation && validationMessage && !disabled" class="text-sm text-red-500 mt-1">
      {{ validationMessage }}
    </p>
  </div>
</template>

<script setup>
import { computed } from 'vue';

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
  disabled: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["update:modelValue", "input"]);

const handleInput = (event) => {
  if (props.disabled) return;
  emit("update:modelValue", event.target.value);
  emit("input", event);
};

// 🎯 Dynamic class handling
const inputClasses = computed(() => {
  if (props.disabled) {
    return "bg-gray-100 border-gray-200 text-gray-400 cursor-not-allowed";
  }

  if (props.validation) {
    return "border-red-500 focus:ring-2 focus:ring-red-500";
  }

  return "border-gray-300 focus:ring-2 focus:ring-blue-500";
});
</script>