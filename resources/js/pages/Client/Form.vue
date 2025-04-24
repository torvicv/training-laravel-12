<template>
    <div>
      <iframe
        :src="pdfUrl"
        style="width:100%; height:600px;"
      ></iframe>

      <form @submit.prevent="submit">
        <div>
          <label>Nombre</label>
          <input v-model="form.signerName" required />
        </div>

        <div>
          <label>DNI</label>
          <input v-model="form.signerDni" required />
        </div>

        <div>
          <label>Firma</label>
          <input type="file" @change="onFileChange" accept="image/*" required />
        </div>

        <button type="submit" :disabled="form.processing">
          Firmar PDF
        </button>
      </form>
    </div>
  </template>

  <script setup>
import { useForm } from '@inertiajs/vue3';

  const props = defineProps(['pdfUrl', 'submitRoute']);

  const form = useForm({
    signerName: '',
    signerDni: '',
    signature: null,
  });

  function onFileChange(e) {
    form.signature = e.target.files[0];
  }

  function submit() {
    form.post(props.submitRoute);
  }
  </script>