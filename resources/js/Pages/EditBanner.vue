<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { Banner, Character } from '@/models';

const props = defineProps<{
    banner?: Banner;
    characters: Character[],
}>();

const id = props.banner? props.banner.id : undefined;
const name = ref(props.banner? props.banner.name : '');
const featured = ref(props.banner? props.banner.featured.map(m => m.id) : []);
const patch = ref(props.banner? props.banner.patch : '');
const start_date = ref(props.banner? props.banner.start_date : '');
const end_date = ref(props.banner? props.banner.end_date : '');

function updateBanner() {
    if(id) {
       router.put('/banners/'+id, {
            name: name.value, 
            patch: patch.value,
            start_date: start_date.value, 
            end_date: end_date.value
       });
    } else {
        router.post('/banners', {
            name: name.value, 
            patch: patch.value,
            start_date: start_date.value, 
            end_date: end_date.value
        });
    }
    
}

</script>

<template dark>
    <Head title="Create Character" />
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
            <v-select variant="outlined" chips multiple label="Characters" v-model="featured" :items="characters" item-title="name" item-value="id"></v-select>
            <v-btn type="submit">Confirm</v-btn>
       </v-form>
    </v-container>
</template>

<style>

</style>
