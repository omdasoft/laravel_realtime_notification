<script setup>
import { computed, onMounted, onUnmounted, watch } from "vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
  show: {
    title: Boolean,
    default: false,
  },
  title: {
    title: String,
    default: "confirm modal title",
  },
  maxWidth: {
    type: String,
    default: "2xl",
  },
  closeable: {
    type: Boolean,
    default: true,
  },
});

const emit = defineEmits(["confirm", "closeConfirm"]);

watch(
  () => props.show,
  () => {
    if (props.show) {
      document.body.style.overflow = "hidden";
    } else {
      document.body.style.overflow = null;
    }
  }
);

const close = () => {
  if (props.closeable) {
    emit("closeConfirm");
  }
};

const confirm = () => {
  emit("confirm");
};

const closeOnEscape = (e) => {
  if (e.key === "Escape" && props.show) {
    close();
  }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));

onUnmounted(() => {
  document.removeEventListener("keydown", closeOnEscape);
  document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
  return {
    sm: "sm:max-w-sm",
    md: "sm:max-w-md",
    lg: "sm:max-w-lg",
    xl: "sm:max-w-xl",
    "2xl": "sm:max-w-2xl",
  }[props.maxWidth];
});
</script>

<template>
  <Teleport to="body">
    <Transition leave-active-class="duration-200">
      <div
        v-show="show"
        class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
        scroll-region
      >
        <Transition
          enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0"
          enter-to-class="opacity-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100"
          leave-to-class="opacity-0"
        >
          <div
            v-show="show"
            class="fixed inset-0 transform transition-all"
            @click="close"
          >
            <div class="absolute inset-0 bg-gray-500 opacity-75" />
          </div>
        </Transition>

        <Transition
          enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to-class="opacity-100 translate-y-0 sm:scale-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100 translate-y-0 sm:scale-100"
          leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <div
            v-show="show"
            class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto"
            :class="maxWidthClass"
          >
            <div class="py-4">
              <h2 class="text-2xl font-bold text-gray-600 text-center">
                {{ title }}
              </h2>
              <p class="text-lg font-semibold text-gray-500 py-4 text-center">
                Are you sure, you want to delete this post ?
              </p>
              <div class="mt-6 flex justify-center">
                <SecondaryButton @click="close"> Cancel </SecondaryButton>
                <DangerButton class="ms-3" @click="confirm">
                  Delete
                </DangerButton>
              </div>
            </div>
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>
