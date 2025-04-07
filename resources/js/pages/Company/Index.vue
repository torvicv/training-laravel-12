<script setup>
    import Table from '@/pages/Company/partials/Table.vue';
    import AppLayout from '@/layouts/AppLayout.vue';

    defineProps({
        companies: {
            required: true,
            type: Object,
        }
    })
</script>
<template>
    <AppLayout>
        <Table :companies="companies" />
    </AppLayout>
</template>
