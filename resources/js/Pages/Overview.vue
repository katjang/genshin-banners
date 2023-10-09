<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Counter from '@/Components/Counter.vue';

defineProps<{
    characters: Character[];
}>();

const characters = [
    {
        id: 1,
        name: 'Ayaka',
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
        name: 'Ayato',
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


class Character {
    id!: number;
    name!: string;
    rarity!: number;
    type!: WeaponType;
    last_banner?: Banner;
}

enum WeaponType {
    BOW,
    CATALYST,
    CLAYMORE,
    POLEARM,
    SWORD,
}

class Banner {
    id!: number;
    name!: string;
    characters!: Character[];
    start_date!: Date;
    end_date!: Date;
}

</script>

<template dark>
    <Head title="Overview" />
    <div>
        <v-row>
            <v-col cols="3" md="4" sm="6" v-for="character in characters">
                <v-card theme="dark">
                    <v-card-item>
                        <v-card-title>{{character.name}}</v-card-title>
                        <v-card-subtitle>Four star catalyst</v-card-subtitle>
                    </v-card-item>
                    <v-card-text>
                        <div>
                            <Counter 
                                :start_date="character.last_banner.end_date"
                            />
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>
            {{ characters }}
        </v-row>
    </div>
</template>

<style>

</style>
