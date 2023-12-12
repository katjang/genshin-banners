<script setup lang="ts">
import { Character } from '@/models';
import { WeaponType } from '@/models';
import Counter from '@/Components/Counter.vue';

defineProps<{
    character: Character,
}>();
</script>

<template>
    <div class="position-absolute w-100 h-100 top-0 left-0">
        <v-img
            :src="`/images/icons/elements/` + character.element + `.svg`"
            cover
            eager
            width="100%"
            style="position: absolute;"
        ></v-img>
        <v-sheet color="#000000AA" class="position-absolute w-100 h-100 top-0 left-0"></v-sheet>
    </div>
    <div style="position: relative;">
        <h2 class="text-h2 d-flex align-end">
            <div>
                <v-avatar size="75">
                    <v-img
                        :src="`/images/portraits/` + character.name.replace(' ', '_') + `_Icon.png`"
                        cover
                        eager
                    ></v-img>
                </v-avatar>
            </div>
            {{ character.name }}
            <div v-if="character.banners && character.banners.length > 0" class="text-h4 ml-6">
                <Counter 
                    :start_date="new Date(character.banners[0].end_date)"
                    :row="true"
                />
            </div>
        </h2>
        <v-card-subtitle class="text-capitalize text-h5 pl-0" style="margin-left: 75px">
            <img :src="`/images/icons/rarity/` + character.rarity + `.png`">
            {{ WeaponType[character.weapon_type].toLowerCase() }}
        </v-card-subtitle>
        
        <v-timeline>
            <v-timeline-item v-for="banner in character.banners" :key="banner.id">
                <template v-slot:icon v-if="banner.featured">
                    <v-icon>
                        <v-avatar size="60" color="white" :image="`/images/portraits/` + banner.featured[0].name.replace(' ', '_') + `_Icon.png`"></v-avatar>
                    </v-icon>
                </template>
                <template v-slot:opposite>
                    <v-chip pill class="mr-1">
                        {{ new Date(banner.start_date).toLocaleString('en-us',{month:'long', year:'numeric', day: 'numeric'}) }}
                    </v-chip>
                    <v-icon icon="mdi-calendar-collapse-horizontal"></v-icon>
                    <v-chip pill class="ml-1">
                        {{ new Date(banner.end_date).toLocaleString('en-us',{month:'long', year:'numeric', day: 'numeric'}) }}
                    </v-chip>
                </template>
                <v-card>
                    <v-card-title class="text-h6">
                        {{ banner.name }}
                    </v-card-title>
                    <v-card-text class="bg-white text--primary pt-3">
                        <v-chip v-for="featured in banner.featured" class="ma-1" pill @click="$emit('click-character', featured.id)">
                            <v-avatar start>
                                <v-img :src="`/images/portraits/` + featured.name.replace(' ', '_') + `_Icon.png`"></v-img>
                            </v-avatar>
                            {{ featured.name }}
                        </v-chip>
                    </v-card-text>
                </v-card>
            </v-timeline-item>
        </v-timeline>
        <!-- <v-table v-if="character.banners">
            <tbody>
                <tr>
                    <td>
                        Featured
                    </td>
                    <td>
                        Start Date
                    </td>
                    <td>
                        End Date
                    </td>
                </tr>
                <tr v-for="banner in character.banners">
                    <td>
                        <v-chip v-for="featured in banner.featured">{{ featured.name }}</v-chip>
                    </td>
                    <td>
                        {{ banner.start_date }}
                    </td>
                    <td>
                        {{ banner.end_date }}
                    </td>
                </tr>
            </tbody>
        </v-table> -->
    </div>
</template>