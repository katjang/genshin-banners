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
            <v-row no-gutters>
                <v-btn :size="$vuetify.display.smAndDown? 'x-small' : ($vuetify.display.mdAndDown? 'small' : 'default')" prepend-icon="mdi-plus" variant="outlined" class="mx-2 my-1" :href="route('characters.create')">Character</v-btn>
                <v-btn :size="$vuetify.display.smAndDown? 'x-small' : ($vuetify.display.mdAndDown? 'small' : 'default')" prepend-icon="mdi-plus" variant="outlined" class="mx-2 my-1" :href="route('weapons.create')">Weapon</v-btn>
                <v-btn :size="$vuetify.display.smAndDown? 'x-small' : ($vuetify.display.mdAndDown? 'small' : 'default')" prepend-icon="mdi-plus" variant="outlined" class="mx-2 my-1" :href="route('banners.create')">Banner</v-btn>
            </v-row>
            <template v-slot:extension v-if="$slots.append">
                <slot name="append"></slot>
            </template>
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