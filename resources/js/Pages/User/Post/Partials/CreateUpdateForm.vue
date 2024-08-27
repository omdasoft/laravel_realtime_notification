<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
  showModal: {
    type: Boolean,
    default: false,
  },
});

// const user = usePage().props.auth.user;

const form = useForm({
  title: "",
  body: "",
  image: "",
});

const emit = defineEmits(["close"]);

function closeModal() {
  emit("close");
}
</script>
<template>
  <section class="space-y-6">
    <Modal :show="showModal" @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">Create Post</h2>

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
        </div>

        <!--Post Image-->
        <div class="mt-6">
          <InputLabel for="Image" value="Image" class="sr-only" />

          <TextInput
            id="image"
            ref="image"
            v-model="form.image"
            type="file"
            class="mt-1 block w-3/4"
          />
          <InputError :message="form.errors.image" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
          <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>
          <PrimaryButton class="ms-3">
            Save
          </PrimaryButton>

        <!-- <DangerButton
                class="ms-3"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click="deleteUser"
              >
                Delete Account
        </DangerButton> -->
        </div>
      </div>
    </Modal>
  </section>
</template>