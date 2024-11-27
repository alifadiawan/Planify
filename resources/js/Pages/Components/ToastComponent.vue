<template>
  <div
    class="max-w-xs bg-blue-100 border border-blue-200 text-sm text-blue-800 rounded-lg dark:bg-blue-800/10 dark:border-blue-900 dark:text-blue-500"
    role="alert"
    tabindex="-1"
    aria-labelledby="hs-toast-soft-color-blue-label"
  >
    <div id="hs-toast-soft-color-blue-label" class="flex p-4">
      {{ message }}

      <div class="ms-auto">
        <button
          type="button"
          class="inline-flex shrink-0 justify-center items-center size-5 rounded-lg text-blue-800 opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100 dark:text-blue-200"
          aria-label="Close"
          @click="closeToast"
        >
          <span class="sr-only">Close</span>
          <svg
            class="shrink-0 size-4"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";

const visible = ref(false);
const message = ref("");

const showToast = (msg) => {
  message.value = msg;
  visible.value = true;
  setTimeout(() => {
    visible.value = false;
  }, 3000); // Toast disappears after 3 seconds
};

const closeToast = () => {
  visible.value = false;
};
</script>