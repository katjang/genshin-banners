<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Counter from '@/Components/Counter.vue';
import { Character } from '@/models';

defineProps<{
    characters: Character[];
}>();

const characters = [
    {
        id: 1,
        name: 'Beidou',
        rarity: 5,
        weapon_type: 1,
        last_banner: {
            id: 1,
            name: 'banner name',
            start_date: new Date('2023-03-02'),
            end_date: new Date('2023-10-05'),
            characters: [
                {
                    name: 'Ayaka',
                    rarity: 5,
                    weapon_type: 1,
                },
                {
                    name: 'Barbara',
                    rarity: 4,
                    weapon_type: 4,
                }, 
                {
                    name: 'Diona',
                    rarity: 4,
                    weapon_type: 3,
                }, 
                {
                    name: 'Fischl',
                    rarity: 4,
                    weapon_type: 1,
                }
            ]
        }
    },
    {
        id: 2,
        name: 'Bennett',
        rarity: 5,
        weapon_type: 1,
        last_banner: {
            id: 2,
            name: 'banner name',
            start_date: new Date('2023-12-02'),
            end_date: new Date('2023-12-02'),
            characters: [
                {
                    name: 'Ayato',
                    rarity: 5,
                    weapon_type: 1,
                },
                {
                    name: 'Barbara',
                    rarity: 4,
                    weapon_type: 2,
                }, 
                {
                    name: 'Diona',
                    rarity: 4,
                    weapon_type: 3,
                }, 
                {
                    name: 'Fischl',
                    rarity: 4,
                    weapon_type: 1,
                }
            ]
        }
    },
    {
        id: 3,
        name: 'Mona',
        rarity: 5,
        weapon_type: 1,
        last_banner: {
            id: 3,
            name: 'banner name',
            start_date: new Date('2023-03-02'),
            end_date: new Date('2023-06-02 14:00'),
            characters: [
                {
                    name: 'Ayaka',
                    rarity: 5,
                    weapon_type: 4,
                },
                {
                    name: 'Barbara',
                    rarity: 4,
                    weapon_type: 2,
                }, 
                {
                    name: 'Diona',
                    rarity: 4,
                    weapon_type: 3,
                }, 
                {
                    name: 'Fischl',
                    rarity: 4,
                    weapon_type: 1,
                }
            ]
        }
    },
];




</script>

<template dark>
    <Head title="Overview" />
    <v-container fluid>
        <v-row>
            <v-col cols="6" sm="4" md="3" lg="2" v-for="character in characters">
                <v-card theme="dark">
                    <v-card-item>
                        <v-card-title>{{character.name}}</v-card-title>
                        <v-card-subtitle>Four star catalyst</v-card-subtitle>
                    </v-card-item>
                    <v-img :src="`/images/portraits/` + character.name + `_Icon.png`"></v-img>
                    <v-card-text>
                        <Counter 
                            :start_date="character.last_banner.end_date"
                        />
                    </v-card-text>
                </v-card>
            </v-col>
            {{ characters }}
        </v-row>
    </v-container>
</template>

<style>

</style>
