<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { Banner, Character, Weapon } from '@/models';

import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps<{
    banner?: Banner;
    characters: Character[],
    weapons: Weapon[],
}>();

const id = props.banner? props.banner.id : undefined;
const name = ref(props.banner? props.banner.name : '');
const featured_characters = ref(props.banner? props.banner.characters.map(m => m.id) : []);
const featured_weapons = ref(props.banner? props.banner.weapons.map(m => m.id) : []);
const patch = ref(props.banner? props.banner.patch : '');
const start_date = ref(props.banner? props.banner.start_date : '');
const end_date = ref(props.banner? props.banner.end_date : '');
const banner_name_placeholder = ref(props.banner? (props.banner.characters?.find((c: Character) => c.rarity == 5)?.featured_name) : '');
if(banner_name_placeholder.value == undefined) banner_name_placeholder.value = '';

function changeFeatured() {
    let a_featured_characters = props.characters.filter(c => featured_characters.value.indexOf(c.id) > -1);
    let featured_five_star = a_featured_characters.find(c => c.rarity == 5);

    if(featured_five_star && featured_weapons.value.length == 0) {
        banner_name_placeholder.value = featured_five_star.featured_name? featured_five_star.featured_name : '';
    } else {
        banner_name_placeholder.value = '';
    }
}

function updateBanner() {
    let object = {
        name: name.value, 
        patch: patch.value,
        start_date: start_date.value, 
        end_date: end_date.value,
        featured_characters: featured_characters.value,
        featured_weapons: featured_weapons.value,
    };
    if(id) {
        router.put(route('banners.update', id), object);
    } else {
        router.post(route('banners.store'), object);
    }
}

</script>

<template dark>
    <Head title="Edit Banner" />
    <AdminLayout>
        <v-container fluid dark>
            <v-form @submit.prevent="updateBanner">
                    <v-text-field persistent-placeholder :placeholder="banner_name_placeholder" v-model="name" label="name"></v-text-field>
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
                        label="Characters" 
                        v-model="featured_characters" 
                        :items="characters" 
                        item-title="name" 
                        item-value="id"
                        @update:modelValue="changeFeatured"
                    ></v-autocomplete>
                    <v-autocomplete 
                        chips 
                        multiple 
                        label="Weapons" 
                        v-model="featured_weapons" 
                        :items="weapons" 
                        item-title="name" 
                        item-value="id"
                        @update:modelValue="changeFeatured"
                    ></v-autocomplete>
                    <v-btn type="submit">Confirm</v-btn>
            </v-form>
        </v-container>
    </AdminLayout>
</template>

<style>

</style>
