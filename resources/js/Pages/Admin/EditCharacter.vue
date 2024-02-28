<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { Character, Element, elementSelectOptions, weaponSelectOptions } from '@/models';

import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps<{
    character?: Character;
}>();

const id = props.character? props.character.id : undefined;
const name = ref(props.character? props.character.name : '');
const rarity = ref(props.character? props.character.rarity : 4);
const weapon_type = ref(props.character? props.character.weapon_type : 0);
const element = ref(props.character? props.character.element: Element.GEO);
const featured_name = ref(props.character? props.character.featured_name : '');


function storeCharacter() {
    let object = {
        name: name.value, 
        rarity: rarity.value, 
        weapon_type: weapon_type.value,
        element: element.value,
        featured_name: featured_name.value
    } 
    if(id) {
        router.put(route('characters.update', id), object)
    } else {
        router.post(route('characters.store'), object);
    }
}

</script>

<template dark>
    <Head title="Create Character" />
    <AdminLayout>
        <v-container fluid>
        <v-form @submit.prevent="storeCharacter">
                <v-text-field v-model="name" label="name"></v-text-field>
                <v-select v-model="rarity" label="rarity" :items="[3,4,5]"></v-select>
                <v-select v-model="weapon_type" label="Weapon Type" :items="weaponSelectOptions"></v-select>
                <v-select v-model="element" label="Element" :items="elementSelectOptions"></v-select>
                <v-text-field v-model="featured_name" label="Featured Name"></v-text-field>
                <v-btn type="submit">Confirm</v-btn>
        </v-form>
        </v-container>
    </AdminLayout>
</template>

<style>

</style>
