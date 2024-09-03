<script setup>
import { ref, onMounted } from "vue";
import VueFeather from "vue-feather";

const props = defineProps({
    notifications: {
        type: Object,
        default: null
    }
})

onMounted(() => {
    console.log(props.notifications);
})

const isNotificationOpen = ref(false);

const toggleNotification = () => {
  isNotificationOpen.value = !isNotificationOpen.value;
};
</script>
<template>
  <div class="relative inline-flex w-fit">
    <button type="button" @click="toggleNotification">
      <span
        class="absolute bottom-auto left-auto right-0 top-0 z-10 inline-block -translate-y-1/2 translate-x-2/4 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 whitespace-nowrap rounded-full bg-red-700 px-2.5 py-1 text-center align-baseline text-xs font-bold leading-none text-white"
      >
        {{ notifications?.length ?? 0 }}
      </span>
      <vue-feather type="bell"></vue-feather>
    </button>
    <!-- Notification Dropdown -->
    <div
      v-if="isNotificationOpen"
      class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-md shadow-lg z-50"
    >
      <div v-if="notifications" class="py-1">
        <a
          v-for="notification in notifications"
          :key="notification.id"
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex flex-col"
        >
            <h1 class="text-gray-400 flex flex-row justify-between font-mono">
                <span>
                    Posted By {{ notification.user }}
                </span>
                <span>
                    {{ notification.date }}
                </span>
            </h1>
            <p>
                {{ notification.title }}
            </p>
        </a>
      </div>
      <div v-else class="py-4 px-4 text-sm text-gray-500 text-center">No notifications</div>
    </div>
  </div>
</template>