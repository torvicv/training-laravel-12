<script setup>
    import Table from '@/pages/user/partials/Table.vue';
    import AppLayout from '@/layouts/AppLayout.vue';

    defineProps({
        users: {
            required: true,
            type: Object,
        }
    })
</script>
<template>
    <AppLayout>
        <Table :users="users" />
    </AppLayout>
</template>
