<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Counter from '@/Components/Counter.vue';
import { Character } from '@/models';

defineProps<{
    characters: Character[];
}>();

const end_date = new Date('2023-04-02');

</script>

<template dark>
    <Head title="Overview" />
    <v-container fluid>
        <v-row>
            <v-col xs="6" sm="4" md="3" lg="2" v-for="character in characters">
                <v-card theme="dark" height="250">
                    <div class="d-flex flex-column justify-space-between" style="height: 100%;">
                        <!-- <div class="absolute left-0 right-0 top-0 bottom-0 -z-10">
                            <v-img
                                :src="`/images/icons/elements/` + character.element + `.svg`"
                                cover
                                eager
                                height="100%"
                            ></v-img>
                        </div> -->
                        <div class="absolute left-0 right-0 top-0 bottom-0 -z-10">
                            <v-img
                                :src="`/images/portraits/` + character.name.replace(' ', '_') + `_Icon.png`"
                                cover
                                eager
                                height="100%"
                            ></v-img>
                        </div>
                        <v-card-item class="z-1">
                            <v-card-title>
                                
                                <v-row no-gutters>
                                    <v-icon size="25">
                                        <v-img
                                            :src="`/images/icons/elements/` + character.element + `.svg`"
                                            cover
                                            eager
                                        ></v-img>
                                    </v-icon>
                                    {{character.name}}
                                </v-row>
                               
                            </v-card-title>
                            <v-card-subtitle>
                                <img :src="`/images/icons/rarity/` + character.rarity + `.png`">
                                <div class="absolute top-2 right-2">
                                    <v-img :src="`/images/icons/weapon_types/` + character.weapon_type + `.png`" width="40"> </v-img>
                                </div>
                            </v-card-subtitle>
                        </v-card-item>
                        <v-card-text class="z-1 flex-grow-0">
                            <!-- <Counter 
                                :start_date="character.last_banner.end_date"
                            /> -->
                            <v-sheet dark rounded>
                                <Counter 
                                    :start_date="end_date"
                                />
                            </v-sheet>
                        </v-card-text>
                        <!-- <v-img :src="`/images/portraits/` + character.name.replace(' ', '_') + `_Icon.png`" eager></v-img> -->
                    </div>
                </v-card>
            </v-col>
            {{ characters }}
        </v-row>
    </v-container>
</template>

<style>

</style>
