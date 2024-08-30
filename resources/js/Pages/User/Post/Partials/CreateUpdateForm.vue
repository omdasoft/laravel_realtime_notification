<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, onMounted, watch, computed } from "vue";

const props = defineProps({
  showModal: {
    type: Boolean,
    default: false,
  },
  post: {
    type: Object,
    default: null,
  },
});

// const user = usePage().props.auth.user;
const isUpdate = ref(false);
const postId = ref(null);
const form = useForm({
  title: "",
  body: "",
  image: "",
  _method: ""
});

// Update form when post prop changes
watch(
  () => props.post,
  (newPost) => {
    if (newPost) {
      form.title = newPost.title || "";
      form.body = newPost.body || "";
      form.image = "";
      isUpdate.value = true;
      postId.value = newPost.id;
      form._method = "put";
    } else {
      form._method = "";
      isUpdate.value = false;
      postId.value = null;
    }
  },
  { immediate: true }
);

function submitPost() {
  const url = isUpdate.value 
    ? route("user.posts.update", postId.value)
    : route("user.posts.store");

  if (!isUpdate.value) {
    form._method = "";
  }

  form.post(url, {
    onSuccess: () => {
      closeModal();
    },
  });
}

function handleFileUpload(event) {
  form.image = event.target.files[0];
}

const emit = defineEmits(["close"]);

function closeModal() {
  form.clearErrors();
  form.reset();
  isUpdate.value = false;
  postId.value = null;
  form._method = "";
  emit("close");
}
</script>
<template>
  <section class="space-y-6">
    <Modal :show="showModal" @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
          <span v-if="!isUpdate">Create Post</span>
          <span v-else>Update Post</span>
        </h2>

        <form @submit.prevent="submitPost" enctype="multipart/form-data">
          <div>
            <!--Post Title-->
            <div class="mt-6">
              <InputLabel for="title" value="Title" class="sr-only" />

              <TextInput
                id="title"
                ref="title"
                v-model="form.title"
                type="text"
                class="mt-1 block w-3/4"
                placeholder="Title"
              />
              <InputError :message="form.errors.title" class="mt-2" />
            </div>

            <!--Post Body-->
            <div class="mt-6">
              <InputLabel for="body" value="Body" class="sr-only" />

              <TextArea
                id="body"
                ref="body"
                v-model="form.body"
                class="mt-1 block w-3/4"
                placeholder="Body"
              />
              <InputError :message="form.errors.body" class="mt-2" />
            </div>

            <!--Post Image-->
            <div class="mt-6">
              <InputLabel for="image" value="Image" class="sr-only" />

              <TextInput
                id="image"
                ref="image"
                type="file"
                class="mt-1 block w-3/4"
                @change="handleFileUpload"
              />
              <InputError :message="form.errors.image" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
              <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>
              <PrimaryButton class="ms-3" :disabled="form.processing">
                <span v-if="form.processing">Saving..</span>
                <span v-else>Save</span>
              </PrimaryButton>
            </div>
          </div>
        </form>
      </div>
    </Modal>
  </section>
</template>