<template>
  <button :class="buttonClasses" @click="$emit('click', $event)">
    <!-- Left Icon -->
    <i v-if="icon && iconPosition === 'left'" :class="[icon, 'mr-2']"></i>

    <!-- Label -->
    <span>{{ label }}</span>

    <!-- Right Icon -->
    <i v-if="icon && iconPosition === 'right'" :class="[icon, 'ml-2']"></i>
  </button>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  label: {
    type: String,
    default: "Button",
  },
  color: {
    type: String,
    default: "blue",
  },
  size: {
    type: String,
    default: "md",
  },
  rounded: {
    type: Boolean,
    default: true,
  },
  icon: {
    type: String,
    default: "",
  },
  iconPosition: {
    type: String,
    default: "left",
  },
});

const colors = {
  blue: "bg-blue-600 hover:bg-blue-700 text-white",
  red: "bg-red-600 hover:bg-red-700 text-white",
  green: "bg-green-600 hover:bg-green-700 text-white",
  gray: "bg-gray-600 hover:bg-gray-700 text-white",
  white: "bg-white border border-gray-300 text-gray-700 hover:bg-gray-100",
};

const sizes = {
  sm: "px-3 py-1 text-sm",
  md: "px-4 py-2 text-sm",
  lg: "px-6 py-3 text-base",
};

const buttonClasses = computed(() => [
  "flex items-center justify-center font-semibold transition duration-200",
  colors[props.color] || colors.blue,
  sizes[props.size] || sizes.md,
  props.rounded ? "rounded-lg" : "rounded-none",
]);
</script>