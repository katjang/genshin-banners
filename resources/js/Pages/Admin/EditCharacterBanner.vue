<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { CharacterBanner, Character } from '@/models';

import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps<{
    banner?: CharacterBanner;
    characters: Character[],
}>();

const id = props.banner? props.banner.id : undefined;
const name = ref(props.banner? props.banner.name : '');
const featured = ref(props.banner? props.banner.featured.map(m => m.id) : []);
const patch = ref(props.banner? props.banner.patch : '');
const start_date = ref(props.banner? props.banner.start_date : '');
const end_date = ref(props.banner? props.banner.end_date : '');
const banner_name_placeholder = ref(props.banner? (props.banner.featured?.find((c: Character) => c.rarity == 5)?.featured_name) : '');
if(banner_name_placeholder.value == undefined) banner_name_placeholder.value = '';

function changeFeatured() {
    let featured_characters = props.characters.filter(c => featured.value.indexOf(c.id) > -1);
    let featured_five_star = featured_characters.find(c => c.rarity == 5);

    if(featured_five_star) {
        banner_name_placeholder.value = featured_five_star.featured_name? featured_five_star.featured_name : '';
    }
}

function updateBanner() {
    let object = {
        name: name.value, 
        patch: patch.value,
        start_date: start_date.value, 
        end_date: end_date.value,
        featured: featured.value,
    };
    if(id) {
        router.put(route('characterBanner.update', id), object);
    } else {
        router.post(route('characterBanner.create'), object);
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
                        v-model="featured" 
                        :items="characters" 
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
