<script setup>
import AuthenticatedUserLayout from "@/Layouts/AuthenticatedUserLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import StatusDadge from "@/Components/StatusDadge.vue";
import { ref } from "vue";
import CreateUpdateForm from "@/Pages/User/Post/Partials/CreateUpdateForm.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";

defineProps({
  posts: Object,
});

const showModal = ref(false);
const showConfirmModal = ref(false);
const post = ref(null);
const postId = ref(null);


function displayModal() {
  showModal.value = true;
}

function imagePath(path) {
  return '/storage/'+path;
}

function editPost(postObj) {
  post.value = postObj;
  showModal.value = true;
}

function deletePost() {
  router.delete(`/user/posts/${postId.value}`, {
    onSuccess: () => {
      closeConfirmModal();
    }
  })
}

function confirmDelete(post) {
  postId.value = post.id;
  showConfirmModal.value = true;
}

function closeConfirmModal() {
  postId.value = null;
  showConfirmModal.value = false;
}

function closeModal() {
  showModal.value = false;
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedUserLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="flex justify-between py-3">
              <h2 class="font-semibold text-xl">Post List</h2>
              <PrimaryButton @click="displayModal"> Add Post </PrimaryButton>
            </div>
            <div
              class="relative overflow-x-auto shadow-md sm:rounded-lg"
              v-if="posts.length"
            >
              <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
              >
                <thead
                  class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                  <tr>
                    <th scope="col" class="px-6 py-3">Image</th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    v-for="post in posts"
                    :key="post.id"
                  >
                    <th
                      scope="row"
                      class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                      <img
                        :src="imagePath(post.image_url)"
                        width="150"
                        height="150"
                        alt="post image"
                      />
                    </th>
                    <td class="px-6 py-4">{{ post.title }}</td>
                    <td class="px-6 py-4">{{ post.created_at }}</td>
                    <td class="px-6 py-4">
                      <StatusDadge :status="post.status" />
                    </td>
                    <td class="px-6 py-4">
                      <div class="flex gap-1">
                        <PrimaryButton @click.prevent="editPost(post)"> Edit </PrimaryButton>
                        <DangerButton @click.prevent="confirmDelete(post)">Delete</DangerButton>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <p class="text-center py-3" v-else>No post yet</p>
          </div>
        </div>
        <CreateUpdateForm :showModal="showModal" @close="closeModal" :post="post"/>
        <ConfirmationModal :show="showConfirmModal" @closeConfirm="closeConfirmModal" @confirm="deletePost" title="Delete Post"></ConfirmationModal>
      </div>
    </div>
  </AuthenticatedUserLayout>
</template>