<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { WeaponBanner, Weapon } from '@/models';

import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps<{
    banner?: WeaponBanner;
    weapons: Weapon[],
}>();

const id = props.banner? props.banner.id : undefined;
const name = ref(props.banner? props.banner.name : '');
const featured = ref(props.banner? props.banner.featured.map(m => m.id) : []);
const patch = ref(props.banner? props.banner.patch : '');
const start_date = ref(props.banner? props.banner.start_date : '');
const end_date = ref(props.banner? props.banner.end_date : '');

function updateBanner() {
    let object = {
        name: name.value, 
        patch: patch.value,
        start_date: start_date.value, 
        end_date: end_date.value,
        featured: featured.value,
    };
    if(id) {
        router.put(route('weaponBanners.update', id), object);
    } else {
        router.post(route('weaponBanners.store'), object);
    }
}

</script>

<template dark>
    <Head title="Edit Banner" />
    <AdminLayout>
        <v-container fluid dark>
            <v-form @submit.prevent="updateBanner">
                    <v-text-field v-model="name" label="name"></v-text-field>
                    <v-text-field v-model="patch" label="patch"></v-text-field>
                    <v-row>
                        <v-col> 
                            <v-text-field dark show-adjacent-months v-model="start_date" label="Start Date"></v-text-field>
                        </v-col>
                        <v-col>
                            <v-text-field dark show-adjacent-months v-model="end_date" label="End Date"></v-text-field>
                        </v-col>
                    </v-row>
                    <v-autocomplete 
                        chips 
                        multiple 
                        label="Weapons" 
                        v-model="featured" 
                        :items="weapons" 
                        item-title="name" 
                        item-value="id"
                    ></v-autocomplete>
                    <v-btn type="submit">Confirm</v-btn>
            </v-form>
        </v-container>
    </AdminLayout>
</template>

<style>

</style>
