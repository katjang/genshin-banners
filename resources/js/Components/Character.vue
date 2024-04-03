<script setup lang="ts">
import { Banner, Character } from '@/models';
import { WeaponType } from '@/models';
import Counter from '@/Components/Counter.vue';
import BannerList from '@/Components/BannerList.vue';

const props = defineProps<{
    character: Character,
}>();

defineEmits(['click-character', 'click-weapon']);

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
        
        <BannerList :banners="character.banners" @click-character="$emit('click-character', $event)" @click-weapon="$emit('click-weapon', $event)"/>
    </div>
</template>