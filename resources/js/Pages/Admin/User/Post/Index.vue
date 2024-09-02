<script setup>
import AuthenticatedAdminLayout from "@/Layouts/AuthenticatedAdminLayout.vue";
import SuccessButton from "@/Components/SuccessButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import StatusDadge from "@/Components/StatusDadge.vue";
import { Head, router } from "@inertiajs/vue3";
import {computed, ref} from "vue";

const props = defineProps({
  posts: Object,
});

const statusFilter = ref('all');

function imagePath(path) {
  return "/storage/" + path;
}

function updateStatus(post) {
  router.post(`/admin/users/posts/update-status/${post.id}`, {
    onError: () => console.log("error in updating the user post"),
  });
}

const filteredPosts = computed(() => {
    if (statusFilter.value === 'all') {
        return props.posts;
    }

    return props.posts.filter((post) => post.status === statusFilter.value);
})

</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedAdminLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        User Posts
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="py-3">
              <select
                id="status"
                v-model="statusFilter"
                @change="filterPostByStatus"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              >
                <option value="all">All</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
              </select>
            </div>
            <div
              class="relative overflow-x-auto shadow-md sm:rounded-lg"
              v-if="filteredPosts.length"
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
                    <th scope="col" class="px-6 py-3">User</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    v-for="post in filteredPosts"
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
                    <td class="px-6 py-4">{{ post?.user.name }}</td>
                    <td class="px-6 py-4">
                      <StatusDadge :status="post.status" />
                    </td>
                    <td class="px-6 py-4">
                      <div class="flex gap-1">
                        <DangerButton
                          @click.prevent="updateStatus(post)"
                          v-if="post.status === 'approved'"
                        >
                          Reject
                        </DangerButton>
                        <SuccessButton
                          @click.prevent="updateStatus(post)"
                          v-else
                        >
                          Approve
                        </SuccessButton>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <p class="text-center py-3" v-else>No post yet</p>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedAdminLayout>
</template>