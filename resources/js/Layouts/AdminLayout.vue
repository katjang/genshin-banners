<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const snackbar = ref(usePage().props.flash.message != undefined);

</script>

<template>
    <div>
        <v-toolbar color="purple">
            <v-btn :href="route('dashboard')"><v-toolbar-title>Admin dashboard</v-toolbar-title></v-btn>
            <v-spacer></v-spacer>
            <v-btn variant="outlined" class="mx-2" :href="route('character.create')">Add Character</v-btn>
            <v-btn variant="outlined" class="mx-2" :href="route('banner.create')">Add Banner</v-btn>
        </v-toolbar>
        <!-- Page Content -->
        <main theme="dark">
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