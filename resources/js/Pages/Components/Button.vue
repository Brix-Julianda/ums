<template>
  <button :class="buttonClasses" :disabled="disabled || loading" @click="handleClick">
    <!-- Loading Spinner -->
    <i v-if="loading" class="fa fa-spinner fa-spin"></i>

    <!-- Left Icon -->
    <i v-if="icon && iconPosition === 'left' && !loading" :class="[icon, iconSize]"></i>

    <!-- Label (hidden on xs if iconOnly) -->
    <span v-if="!iconOnly" class="flex items-center justify-center text-center leading-none">
      {{ label }}
    </span>

    <!-- Right Icon -->
    <i v-if="icon && iconPosition === 'right' && !loading" :class="[icon, iconSize]"></i>
  </button>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  label: { type: String, default: "Button" },
  color: { type: String, default: "blue" },
  variant: { type: String, default: "solid" }, // solid | outline | ghost
  size: { type: String, default: "md" },
  rounded: { type: String, default: "rounded-xl" },
  icon: { type: String, default: "" },
  iconPosition: { type: String, default: "left" },

  disabled: { type: Boolean, default: false },
  loading: { type: Boolean, default: false },

  // NEW modern features
  iconOnly: { type: Boolean, default: false },
  fullWidth: { type: Boolean, default: false },
});

const emit = defineEmits(["click"]);

const handleClick = (event) => {
  if (props.disabled || props.loading) return;
  emit("click", event);
};

const baseColors = {
  blue: "blue",
  red: "red",
  green: "green",
  gray: "gray",
};

const variants = {
  solid: {
    blue: "bg-blue-600 hover:bg-blue-700 text-white",
    green: "bg-green-600 hover:bg-green-700 text-white",
    red: "bg-red-600 hover:bg-red-700 text-white",
    gray: "bg-gray-600 hover:bg-gray-700 text-white",
  },
  outline: {
    blue: "border border-blue-600 text-blue-600 hover:bg-blue-50",
    green: "border border-green-600 text-green-600 hover:bg-green-50",
    red: "border border-red-600 text-red-600 hover:bg-red-50",
    gray: "border border-gray-600 text-gray-600 hover:bg-gray-50",
  },
  ghost: {
    blue: "text-blue-600 hover:bg-blue-100",
    green: "text-green-600 hover:bg-green-100",
    red: "text-red-600 hover:bg-red-100",
    gray: "text-gray-600 hover:bg-gray-100",
  },
};

const sizes = {
  sm: "px-3 py-1.5 text-sm",
  md: "px-4 py-2 text-sm",
  lg: "px-5 py-2.5 text-base",
  xl: "px-6 py-3 text-lg",
};

const iconSizes = {
  sm: "text-sm",
  md: "text-sm",
  lg: "text-base",
  xl: "text-lg",
};

const buttonClasses = computed(() => {
  return [
    "inline-flex items-center justify-center gap-2 font-medium",
    "transition-all duration-200 ease-in-out",
    "focus:outline-none focus:ring-2 focus:ring-offset-1",
    "active:scale-95",
    sizes[props.size] || sizes.md,
    props.rounded,
    props.fullWidth ? "w-full" : "",

    props.disabled || props.loading
      ? "bg-gray-200 text-gray-400 cursor-not-allowed"
      : variants[props.variant][props.color] || variants.solid.blue,

    "shadow-sm hover:shadow-md",
  ];
});

const iconSize = computed(() => iconSizes[props.size] || iconSizes.md);
</script>
