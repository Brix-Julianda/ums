<template>
  <button :class="buttonClasses" :disabled="disabled" @click="handleClick">
    <!-- Left Icon -->
    <i v-if="icon && iconPosition === 'left'" :class="[icon, iconSize]"></i>

    <!-- Label -->
    <span class="flex items-center justify-center text-center leading-none">
      {{ label }}
    </span>

    <!-- Right Icon -->
    <i v-if="icon && iconPosition === 'right'" :class="[icon, iconSize]"></i>
  </button>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  label: { type: String, default: "Button" },
  color: { type: String, default: "blue" },
  size: { type: String, default: "md" },
  rounded: { type: String, default: "rounded-lg" },
  icon: { type: String, default: "" },
  iconPosition: { type: String, default: "left" },

  // ✅ NEW
  disabled: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["click"]);

const handleClick = (event) => {
  if (props.disabled) return;
  emit("click", event);
};

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
  xl: "px-8 py-4 text-lg",
};

const iconSizes = {
  sm: "text-sm",
  md: "text-sm",
  lg: "text-base",
  xl: "text-lg",
};

const buttonClasses = computed(() => {
  if (props.disabled) {
    return [
      "inline-flex items-center justify-center gap-2 font-semibold",
      sizes[props.size] || sizes.md,
      props.rounded,
      "bg-gray-200 text-gray-400 cursor-not-allowed border border-gray-200",
    ];
  }

  return [
    "inline-flex items-center justify-center gap-2 font-semibold transition duration-200",
    colors[props.color] || colors.blue,
    sizes[props.size] || sizes.md,
    props.rounded,
  ];
});

const iconSize = computed(() => iconSizes[props.size] || iconSizes.md);
</script>