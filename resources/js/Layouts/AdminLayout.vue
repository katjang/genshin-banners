<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const snackbar = ref(usePage().props.flash.message != undefined);

</script>

<template>
    <div>
        <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>
        <!-- Page Content -->
        <main>
            <slot />
            <v-snackbar v-model="snackbar">
                {{ $page.props.flash.message }}

                <template v-slot:actions>
                    <v-btn
                        color="pink"
                        variant="text"
                        @click="snackbar = false"
                    >
                    Close
                    </v-btn>
                </template>
        </v-snackbar>
        </main>
    </div>
</template>