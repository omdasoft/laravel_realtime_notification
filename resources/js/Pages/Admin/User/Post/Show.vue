<script setup>
import AuthenticatedAdminLayout from "@/Layouts/AuthenticatedAdminLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SuccessButton from "@/Components/SuccessButton.vue";
import { Head, router } from "@inertiajs/vue3";


defineProps({
  post: {
    type: Object,
    required: true,
  },
});

function imagePath(path) {
  return "/storage/" + path;
}

function updateStatus(post) {
  router.post(`/admin/users/posts/update-status/${post.id}`, {
    onError: () => console.log("error in updating the user post"),
  });
}
</script>
<template>
  <Head title="User Post" />
  <AuthenticatedAdminLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Show Post
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <article
            class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert py-4"
          >
            <figure>
              <img :src="imagePath(post.image_url)" alt="post image" />
              <figcaption
                class="py-2 px-2 flex justify-between text-sm text-gray-600"
              >
                <span> Posted By : {{ post.user.name }} </span>
                <span>
                  {{ post.created_at }}
                </span>
              </figcaption>
            </figure>
            <h1 class="text-center font-extrabold text-2xl">
              {{ post.title }}
            </h1>
            <p class="py-3 text-lg text-gray-600 text-justify leading-8">
              {{ post.body }}
            </p>
            <div class="py-2 flex gap-2">
              <SuccessButton @click.prevent="updateStatus(post)">Approve</SuccessButton>
              <DangerButton @click.prevent="updateStatus(post)">Reject</DangerButton>
            </div>
          </article>
        </div>
      </div>
    </div>
  </AuthenticatedAdminLayout>
</template>